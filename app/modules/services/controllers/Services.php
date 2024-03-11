<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Services extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->lang->load('services');
        $this->load->model('service_model');

        $this->load->helper('date');
        $this->load->helper('array');

        Assets::add_module_js('services', 'services.js');
        Template::set_block('sub_nav', '_sub_nav');
    }

    public function index() {
        Template::set('toolbar_title', lang('management_service'));
        Template::render();
    }

    public function create() {

        if (isset($_POST['service_create'])) {
            if ($id = $this->save('insert')) {
                log_activity(
                        $this->current_user->id,
                        lang('activity_create_service') . ' : ' . "$id",
                        'services'
                );
                Template::set_message(lang('service_created_success'), 'success');
                Template::redirect('services');
            } else {
                Template::set_message(lang('service_created_failure'), 'danger');
            }
        }
        // Routes
        $this->load->model('routes/route_model');
        $this->route_model->join('lines', 'lines.id = routes.line_id', 'left');
        $this->route_model->select('routes.id, lines.name as line, routes.name,direction');
        $this->route_model->where('routes.status', 'T');
        $this->route_model->order_by('lines.name', 'asc');
        Template::set('routes', $this->route_model->find_all());

        $this->load->model('lines/line_model');
        Template::set('lines', array_by_key_value('id', 'name', $this->line_model->find_all(), lang('lbl_choose')));

        Template::set('toolbar_title', lang('create_service'));
        Template::render();
    }

    public function edit() {

        $id = (int) $this->uri->segment(3);
        if (empty($id)) {
            Template::set_message(lang('invalid_id'), 'danger');
            redirect('services');
        }

        if (isset($_POST['service_update'])) {

            if ($this->save('update', $id)) {
                log_activity(
                        $this->current_user->id,
                        lang('activity_update_service') . ' : ' . "$id",
                        'services'
                );
                Template::set_message(lang('service_edit_success'), 'success');
            } else {
                Template::set_message(lang('service_edit_failure'), 'danger');
            }
        }
        $service = $this->service_model->find($id);
        // Rutas del servicio
        $this->load->model('routes/route_city_model');
        $this->route_city_model->select('routes_cities.*, t2.name as city_name');
        $this->route_city_model->join('cities as t2', 't2.id = routes_cities.city_id', 'left');
        $this->route_city_model->where('routes_cities.route_id', $service->route_id);
        $this->route_city_model->order_by('routes_cities.order', 'ASC');
        Template::set('location_arr', $this->route_city_model->find_all());

        // Time
        $sl_arr = array();
        $this->load->model('services/service_location_model');
        $_sl_arr = $this->service_location_model->find_all_by('service_id', $service->id);
        if (is_array($_sl_arr)) {
            foreach ($_sl_arr as $k => $v) {
                $sl_arr[$v->location_id] = $v;
            }
        }

        Template::set('sl_arr', $sl_arr);

        // Routes
        $this->load->model('routes/route_model');
        $this->route_model->where('status', 'T');

        Template::set('routes', array_by_key_value('id', 'name', $this->route_model->find_all()));
        Template::set('toolbar_title', lang('edit_service'));
        Template::set('service', $service);
        Template::render();
    }

    /**
     * Acciones sobre un abonos (borrar, excel e imprimir)
     */
    public function servicesActions() {
        
        $this->form_validation->set_rules('form_action', lang('form_action'), 'required');
                if ($this->form_validation->run() == true) {
            if (!empty($_POST['val'])) {

                if ($this->input->post('form_action') == 'delete') {
                    foreach ($_POST['val'] as $k => $v) {
                        $this->service_model->delete($v);
                    }
                    log_activity(
                            $this->current_user->id,
                            lang('activity_delete_service') . ' : ' . "$cnt",
                            'services'
                    );

                    Template::set_message(lang('service_deleted_success'), 'success');

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

    /**
     * Metodos privados
     */
    private function saveTimes($id) {
        $this->load->model('routes/route_city_model');
        $this->route_city_model->where('route_id', $_POST['route_id']);
        $this->route_city_model->order_by('order', 'asc');
        $location_arr = $this->route_city_model->find_all();

        $this->load->model('services/service_location_model');

        $number_of_locations = count($location_arr);
        $b_data = array();
        $today = date('Y-m-d');
        foreach ($location_arr as $k => $v) {
            $data = array();
            $data['service_id'] = $id;
            $data['location_id'] = $v->city_id;
            if ($k == 0) {
                $data['arrival_time'] = null;
                $b_data['departure_time'] = date('H:i:s', strtotime($today . ' ' . $_POST['departure_time_' . $v->city_id]));
            } else {
                $data['arrival_time'] = date('H:i:s', strtotime($today . ' ' . $_POST['arrival_time_' . $v->city_id]));
            }
            if ($k == ($number_of_locations - 1)) {
                $data['departure_time'] = null;
                $b_data['arrival_time'] = date('H:i:s', strtotime($today . ' ' . $_POST['arrival_time_' . $v->city_id]));
            } else {
                $data['departure_time'] = date('H:i:s', strtotime($today . ' ' . $_POST['departure_time_' . $v->city_id]));
            }
            //$this->service_location_model->update($where, $data);
            $this->service_location_model->insert($data);
            // ":NULL"
        }

        $this->service_model->update($id, $b_data);
    }

    private function save($type = 'insert', $id = 0) {

        $data = $this->service_model->prep_data($_POST);
        $data['start_date'] = formatDate($_POST['start_date'], 'd/m/Y', 'Y-m-d');
        $data['end_date'] = formatDate($_POST['end_date'], 'd/m/Y', 'Y-m-d');
        $data['recurring'] = !empty($_POST['recurring']) ? join("|", $_POST['recurring']) : ':NULL';

        if ($type == 'insert') {
            $id = $this->service_model->insert($data);
            if (is_numeric($id)) {
                $this->saveTimes($id);
                $result = $id;
            }
        } else {
            // Eliminamos 		
            $this->load->model('services/service_location_model');
            $this->service_location_model->delete_where(array('service_id' => $id));
            // Mandamos a guardar
            $this->saveTimes($id);
            $result = $this->service_model->update($id, $data);
        }
        return $result;
    }

    // Methods Ajax
    function getServices() {
        if (!$this->input->is_ajax_request()) {
            redirect('404', 'refresh');
        } else {
            $create_trip = '<a href="' . site_url('trips/create/$1') . '"><i class="fa fa-plus-square"></i> ' . lang('create_trip') . '</a>';
            $delete_link = "<a href='#' class='tip po' title='<b>" . $this->lang->line('delete_service') . "</b>' data-content=\"<p>"
                    . lang('r_u_sure') . "</p><a class='btn btn-danger po-delete1' id='a__$1' href='" . site_url('services/delete/$1') . "'>"
                    . lang('i_m_sure') . "</a> <button class='btn po-close'>" . lang('no') . "</button>\"  rel='popover'><i class=\"fa fa-trash-o\"></i> "
                    . lang('delete_service') . '</a>';

            $action = '<div class="text-center"><div class="btn-group text-left">'
                    . '<button type="button" class="btn btn-default btn-xs btn-primary dropdown-toggle" data-toggle="dropdown">'
                    . lang('actions') . ' <span class="caret"></span></button>
	        <ul class="dropdown-menu pull-right" role="menu">
	            <li>' . $create_trip . '</li>
	            <li><a href="' . site_url('services/edit/$1') . '"><i class="fa fa-edit"></i> ' . lang('edit_service') . '</a></li><li class="divider"></li><li> ' . $delete_link . '</li>';
            $action .= '</ul></div></div>';

            $this->load->library('datatables');
            $this->datatables
                    ->select('t1.id as id, t1.name as name, t3.name as line, t2.name as route_name, t1.departure_time,t1.arrival_time, t1.start_date,t1.end_date')
                    ->from('services as t1')
                    ->join('routes as t2', 't2.id = t1.route_id', 'left')
                    ->join('lines as t3', 't3.id = t2.line_id', 'left')
                    ->edit_column('name', '$1__$2', 'name, id')
                    ->add_column('Actions', $action, 'id');

            echo $this->datatables->generate();
        }
    }

    function getLocations() {
        if (!$this->input->is_ajax_request()) {
            redirect('404', 'refresh');
        } else {
            if (isset($_POST['route_id']) && (int) $_POST['route_id'] > 0) {
                $this->load->model('routes/route_city_model');
                $this->route_city_model->select('routes_cities.*, t2.name as city_name');
                $this->route_city_model->join('cities as t2', 't2.id = routes_cities.city_id', 'left');
                $this->route_city_model->where('routes_cities.route_id', $_POST['route_id']);
                $this->route_city_model->order_by('routes_cities.order', 'ASC');

                $data['location_arr'] = $this->route_city_model->find_all();

                echo $this->load->view('services/getLocations', $data, TRUE);
            }
        }
    }

    function getRoutes() {
        if (!$this->input->is_ajax_request()) {
            redirect('404', 'refresh');
        } else {
            $this->load->model('routes/route_model');
            $lines = $this->route_model->find_all_by('line_id', $_POST['line_id']);

            if (is_array($lines)) {
                $options = '--Seleccione recorrido--';
                foreach ($lines as $k => $v) {
                    $options .= '<option value="' . $v->id . '">' . $v->name . '</option>';
                }
            } else {
                $options = 'No hay recorridos';
            }

            echo $options;
        }
    }
}

/* End of file Rrhh.php */
/* Location: .//D/www/futuro-srl/app/modules/rrhh/controllers/Rrhh.php */