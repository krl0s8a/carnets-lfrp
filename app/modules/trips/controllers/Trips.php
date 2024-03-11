<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Trips extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->lang->load('trips');
        $this->load->model(array('trip_model', 'employees/employee_model'));
        $this->load->helper('array', 'date');

        Assets::add_module_js('trips', 'trips.js');
        Template::set_block('sub_nav', '_sub_nav');
    }

    public function index() {

        $this->load->model('services/service_model');
        Template::set('services', array_by_key_value('id', 'name', $this->service_model->find_all()));
        Template::set('toolbar_title', lang('management_trips'));
        Template::render();
    }

    public function create($service = null) {

        if (isset($_POST['save'])) {
            if ($id = $this->save('insert')) {
                if ($_POST['create_by'] == 'day') {
                    log_activity(
                            $this->current_user->id,
                            lang('activity_create_trip') . ' : ' . "$id",
                            'Viajes'
                    );
                    Template::set_message(lang('trip_created_success'), 'success');
                } else {
                    log_activity(
                            $this->current_user->id,
                            lang('activity_create_trip_period') . ' : ' . "$id",
                            'Viajes'
                    );
                    Template::set_message(lang('trip_created_success_period') . '' . $id, 'success');
                }

                Template::redirect('trips');
            } else {
                Template::set_message(lang('trip_created_failure'), 'danger');
            }
        }

        // Services
        $this->load->model('services/service_model');
        $this->load->model('buses/bus_model');
        Template::set('buses', $this->bus_model->format_dropdown('id', 'name'));
        Template::set('services', $this->service_model->getServices());
        Template::set('drivers', $this->employee_model->arrDrivers());
        Template::set('toolbar_title', lang('create_trip'));
        Template::render();
    }

    public function edit() {

        $id = (int) $this->uri->segment(3);
        if (empty($id)) {
            Template::set_message(lang('invalid_id'), 'danger');
            redirect('trips');
        }

        if (isset($_POST['save'])) {

            if ($this->save('update', $id)) {
                log_activity(
                        $this->current_user->id,
                        lang('activity_update_trip') . ' : ' . "$id",
                        'Viajes'
                );

                Template::set_message(lang('trip_edit_success'), 'success');
            } else {
                Template::set_message(lang('trip_edit_failure'), 'danger');
            }
        }

        // Choferes
        Template::set('drivers', $this->employee_model->arrDrivers());
        // Buses
        $this->load->model('buses/bus_model');
        Template::set('buses', array_by_key_value('id', 'name', $this->bus_model->find_all()));
        // Services
        $this->load->model('services/service_model');
        Template::set('services', $this->service_model->find_all());
        // Tipo de boletos
        $this->load->model('tickets/ticket_model');
        $this->ticket_model->where('status', 'T');
        Template::set('tickets', $this->ticket_model->find_all());
        // Tipos de boletos asignados al viaje
        $this->load->model('trips/trip_ticket_model');
        Template::set('tickets_trip', $this->trip_ticket_model->keyTicketByTrip($id));
        Template::set('toolbar_title', lang('edit_trip'));
        Template::set('trip', $this->trip_model->find($id));
        Template::render();
    }

    public function view() {
        Template::set('toolbar_title', lang('view_trip'));
        Template::render();
    }

    public function delete($id = null) {
        //$this->sma->checkPermissions(null, true);

        if ($this->input->get('id')) {
            $id = $this->input->get('id');
        }

        if ($this->trip_model->delete($id)) {
            if ($this->input->is_ajax_request()) {
                echo json_encode(['error' => 0, 'msg' => lang('trip_delete_success')]);
            }
            Template::redirect('trips');
        }
    }

    /**
     * Acciones sobre un abonos (borrar, excel e imprimir)
     */
    public function tripsActions() {

        $this->form_validation->set_rules('form_action', lang('form_action'), 'required');

        if ($this->form_validation->run() == true) {
            if (!empty($_POST['val'])) {

                if ($this->input->post('form_action') == 'delete') {
                    $c = 0;
                    foreach ($_POST['val'] as $k => $v) {
                        if ($this->trip_model->delete($v)) {
                            $c++;
                        }
                    }
                    log_activity(
                            $this->current_user->id,
                            lang('activity_delete_trip') . ' : ' . "$c",
                            'Viajes'
                    );
                    Template::set_message(lang('trip_deleted_success'), 'success');

                    redirect($_SERVER['HTTP_REFERER']);
                }
                // Exporte excel
                if ($this->input->post('form_action') == 'export_excel') {

                    $this->load->library('excel');
                    $this->excel->setActiveSheetIndex(0);
                    $this->excel->getActiveSheet()->setTitle(lang('sales'));
                    $this->excel->getActiveSheet()->SetCellValue('A1', lang('first_name'));
                    $this->excel->getActiveSheet()->SetCellValue('B1', lang('last_name'));
                    $this->excel->getActiveSheet()->SetCellValue('C1', lang('email'));
                    $this->excel->getActiveSheet()->SetCellValue('D1', lang('company'));
                    $this->excel->getActiveSheet()->SetCellValue('E1', lang('group'));
                    $this->excel->getActiveSheet()->SetCellValue('F1', lang('status'));

                    $row = 2;
                    foreach ($_POST['val'] as $id) {
                        $user = $this->site->getUser($id);
                        $this->excel->getActiveSheet()->SetCellValue('A' . $row, $user->first_name);
                        $this->excel->getActiveSheet()->SetCellValue('B' . $row, $user->last_name);
                        $this->excel->getActiveSheet()->SetCellValue('C' . $row, $user->email);
                        $this->excel->getActiveSheet()->SetCellValue('D' . $row, $user->company);
                        $this->excel->getActiveSheet()->SetCellValue('E' . $row, $user->group);
                        $this->excel->getActiveSheet()->SetCellValue('F' . $row, $user->status);
                        $row++;
                    }

                    $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
                    $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
                    $this->excel->getDefaultStyle()->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                    $filename = 'users_' . date('Y_m_d_H_i_s');
                    $this->load->helper('excel');
                    create_excel($this->excel, $filename);
                }
            } else {
                $this->session->set_flashdata('danger', lang('no_user_selected'));
                redirect($_SERVER['HTTP_REFERER']);
            }
        } else {
            Template::set_message(validation_errors(), 'danger');
            //$this->session->set_flashdata('danger', validation_errors());
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    // Methods private
    private function save($type = 'insert', $id = 0) {

        $data = $this->trip_model->prep_data($_POST);
        $data['date'] = formatDate($_POST['date'], 'd/m/Y', 'Y-m-d');
        if ($type == 'insert') {
            if ($_POST['create_by'] == 'day') {
                $id = $this->trip_model->insert($data);
                if (is_numeric($id)) {
                    // ingresamos los tipos de boletos asociados
                    /* if (isset($_POST['tickets']) && is_array($_POST['tickets'])) {
                      $tickets = [];
                      foreach ($_POST['tickets'] as $k => $v) {
                      $tickets[] = array(
                      'trip_id' => $id,
                      'ticket_id' => $v,
                      'amount' => 0
                      );
                      }
                      $this->load->model('trips/trip_ticket_model');
                      $this->trip_ticket_model->insert_batch($tickets);
                      } */
                    $result = $id;
                }
            } else {
                if (!empty($_POST['start_date']) && !empty($_POST['end_date']) && ($_POST['start_date'] < $_POST['end_date'])) {

                    $id = array();
                    $start_date = formatDate($_POST['start_date'], "d/m/Y", 'Y-m-d');
                    $end_date = formatDate($_POST['end_date'], "d/m/Y", 'Y-m-d');
                    $this->load->model('services/service_model');
                    $service_arr = $this->service_model->find($_POST['service_id']);

                    $days_service = explode('|', $service_arr->recurring);
                    $tickets = [];
                    $c++;
                    for ($i = strtotime($start_date); $i <= strtotime($end_date); $i += 86400) {
                        $day = nameDay(date('w', $i));
                        if (in_array($day, $days_service)) {
                            $trip = array(
                                'bus_id' => $_POST['bus_id'],
                                'service_id' => $_POST['service_id'],
                                'drive_id' => $_POST['drive_id'],
                                'date' => date('Y-m-d', $i),
                                'type' => $_POST['type'],
                                'status' => $_POST['status']
                            );
                            $ida = $this->trip_model->insert($trip);
                            /* if (is_numeric($ida) && isset($_POST['tickets']) && is_array($_POST['tickets'])) {
                              foreach ($_POST['tickets'] as $k => $v) {
                              $tickets[] = array(
                              'trip_id' => $ida,
                              'ticket_id' => $v,
                              'amount' => 0
                              );
                              }
                              } */
                            $c++;
                        }
                    }
                    if (isset($tickets) && !empty($tickets)) {
                        $this->load->model('trips/trip_ticket_model');
                        $this->trip_ticket_model->insert_batch($tickets);
                    }
                    $result = $c;
                } else {
                    $result = false;
                }
                return $result;
            }
        } else {
            $this->load->model('trips/trip_ticket_model');
            $this->trip_ticket_model->delete_where(array('trip_id' => $id));
            if (isset($_POST['tickets']) && is_array($_POST['tickets'])) {
                $tickets = [];
                foreach ($_POST['tickets'] as $k => $v) {
                    $tickets[] = array(
                        'trip_id' => $id,
                        'ticket_id' => $v,
                        'amount' => 0
                    );
                }

                $this->trip_ticket_model->insert_batch($tickets);
            }
            $result = $this->trip_model->update($id, $data);
        }
        return $result;
    }

    // Methods Ajax
    function getTrips() {
        if (!$this->input->is_ajax_request()) {
            redirect('404', 'refresh');
        } else {
            $detail_link = '<a href="#"></a>';
            $delete_link = "<a href='#' class='tip po' title='<b>" . $this->lang->line('delete_trip') . "</b>' data-content=\"<p>"
                    . lang('r_u_sure') . "</p><a class='btn btn-danger po-delete1' id='a__$1' href='" . site_url('trips/delete/$1') . "'>"
                    . lang('i_m_sure') . "</a> <button class='btn po-close'>" . lang('no') . "</button>\"  rel='popover'><i class=\"fa fa-trash-o\"></i> "
                    . lang('delete_trip') . '</a>';
            $action = '<div class="text-center"><div class="btn-group text-left">'
                    . '<button type="button" class="btn btn-default btn-xs btn-primary dropdown-toggle" data-toggle="dropdown">'
                    . lang('actions') . ' <span class="caret"></span></button>
	        <ul class="dropdown-menu pull-right" role="menu">
	            <li>' . $detail_link . '</li>
	            <li><a href="' . site_url('trips/edit/$1') . '"><i class="fa fa-edit"></i> ' . lang('edit_trip') . '</a></li><li class="divider"></li><li>' . $delete_link . '</li>';
            $action .= '</ul></div></div>';
            $this->load->model('services/service_location_model');
            $this->load->library('datatables');
            $this->datatables
                    ->select("t1.id as id, t1.id as ida, DATE_FORMAT(t1.date, '%Y-%m-%d') as date,t2.name as bus, CONCAT(t6.last_name,' ',t6.first_name) as drive, t5.name as line, t4.name as route, t3.name as service,(SELECT TSL1.departure_time FROM " . $this->service_location_model->get_table() . " AS TSL1 WHERE TSL1.service_id = t3.id AND TSL1.arrival_time IS NULL LIMIT 1) AS departure, (SELECT TSL2.arrival_time FROM `" . $this->service_location_model->get_table() . "` AS TSL2 WHERE TSL2.service_id = t3.id AND TSL2.departure_time IS NULL LIMIT 1) AS arrive, t1.status as status")
                    //->select('t1.id as id, t1.id as ida, t1.date, t2.name as bus, t6.last_name as full_name, t5.name as line, t4.name as route, t3.name as service, t3.name as service1, t3.name as service2, t1.status')
                    ->from('trips as t1')
                    ->join('employees as t7', 't7.id = t1.drive_id', 'left')
                    ->join('people as t6', 't6.id = t7.people_id', 'left')
                    ->join('buses as t2', 't2.id = t1.bus_id', 'left outer')
                    ->join('services as t3', 't3.id = t1.service_id', 'left outer')
                    ->join('routes as t4', 't4.id = t3.route_id', 'left outer')
                    ->join('lines as t5', 't5.id = t4.line_id', 'left outer')
                    ->edit_column('status', '$1__$2', 'status,id')
                    ->add_column('Actions', $action, 'id');

            echo $this->datatables->generate();
        }
    }
}
