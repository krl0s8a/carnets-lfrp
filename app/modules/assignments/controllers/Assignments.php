<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Assignments extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->lang->load('assignments');
        $this->load->model('assignments/assignment_model');
        $this->load->helper('array', 'date');

        Assets::add_module_js('assignments', 'assignments.js');
        Template::set_block('sub_nav', '_sub_nav');
    }

    public function index() {
        Template::set('toolbar_title', lang('mng_assigns'));
        Template::render();
    }

    public function create() {
        // Conductores
        $this->load->model('employees/employee_model');
        $data['drives'] = $this->employee_model->arrDrivers();
        // Tipos de boletos
        $this->load->model('tickets/ticket_model');
        $data['tickets'] = $this->ticket_model->getTickets('--Seleccione un tipo de boleto--');
        echo $this->load->view('assignments/create', $data, TRUE);
    }

    public function edit($id = null) {

        $id = (int) $this->uri->segment(3);
        if (empty($id)) {
            Template::set_message(lang('invalid_id'), 'danger');
            redirect('assignments');
        }
        echo $id;

        $data['assign'] = $this->assignment_model->getAssign($id);

        echo $this->load->view('assignments/edit', $data, TRUE);
    }

    public function delete($id = null) {
        if ($this->input->get('id')) {
            $id = $this->input->get('id');
        }

        $assign = $this->assignment_model->find($id);

        if (is_object($assign)) {
            if ($this->assignment_model->delete($id)) {
                // actualimos estado assign
                $this->load->model('scrolls/scroll_model');
                $this->scroll_model->update($assign->scroll_id, array('status' => 'Sin asignar'));
                if ($this->input->is_ajax_request()) {
                    log_activity(
                            $this->current_user->id,
                            lang('act_delete_assign') . ' : ' . $id,
                            'Asignacion'
                    );
                    header('Content-Type: application/json');
                    die(json_encode(['error' => 0, 'msg' => lang('deleted_success')]));
                    exit;
                }
            }
        }
    }

    /**
     * Acciones sobre un abonos (borrar, excel e imprimir)
     */
    public function assigmentsActions() {

        $this->form_validation->set_rules('form_action', lang('form_action'), 'required');

        if ($this->form_validation->run() == true) {
            if (!empty($_POST['val'])) {

                if ($this->input->post('form_action') == 'delete') {
                    foreach ($_POST['val'] as $k => $v) {
                        $this->assignment_model->delete($v);
                    }
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

    // Methods Ajax
    function getAssignments() {
        if (!$this->input->is_ajax_request()) {
            redirect('404', 'refresh');
        } else {
            $assigned = '<a href="' . site_url('scrolls/assigned/$1') . '" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus-square"></i>' . lang('assigned_scroll') . '</a>';
            $edit_assign = '<a href="' . site_url('assignments/edit/$1') . '" data-toggle="modal" data-target="#myModal"><i class="fa fa-edit"></i> ' . lang('edit_assign') . '</a>';
            $delete_link = "<a href='#' class='tip po' title='<b>" . $this->lang->line('delete_assign') . "</b>' data-content=\"<p>"
                    . lang('r_u_sure') . "</p><a class='btn btn-danger po-delete-assign' id='a__$1' href='" . site_url('assignments/delete/$1') . "'>"
                    . lang('i_m_sure') . "</a> <button class='btn po-close'>" . lang('no') . "</button>\"  rel='popover'><i class=\"fa fa-trash-o\"></i> "
                    . lang('delete_assign') . '</a>';

            $action = '<div class="text-center"><div class="btn-group text-left">'
                    . '<button type="button" class="btn btn-default btn-xs btn-primary dropdown-toggle" data-toggle="dropdown">'
                    . lang('actions') . ' <span class="caret"></span></button>
            <ul class="dropdown-menu pull-right" role="menu"><li>' . $edit_assign . '</li>
                <li>' . $delete_link . '</li>';
            $action .= '</ul></div></div>';

            $this->load->library('datatables');
            $this->datatables
                    //->select('t1.id as id, DATE_FORMAT(t1.created_on,"%d/%m/%Y %h:%i"), CONCAT_WS(" ",t2.last_name, t2.first_name) as drive, t4.name, t3.serial, t1.number_ticket_start, t1.number_ticket_end, t1.status')
                    ->select('t1.id as id, DATE_FORMAT(t1.created_on,"%d/%m/%Y %h:%i"), CONCAT_WS(" ",t5.last_name, t5.first_name) as drive, t4.name, t3.serial, t1.number_ticket_start, t1.number_ticket_end, t1.status')
                    ->from('assignments as t1')
                    ->join('employees as t2', 't2.id = t1.drive_id', 'left')
                    ->join('people as t5','t5.id = t2.people_id','left')
                    ->join('scrolls as t3', 't3.id = t1.scroll_id', 'left')
                    ->join('tickets as t4', 't4.id = t3.ticket_id', 'left')
                    ->add_column('Actions', $action, 'id');

            echo $this->datatables->generate();
        }
    }

    /**
     * Obtener el rollo disponible para asignar
     */
    function getLastScrollAvailable() {
        if (!$this->input->is_ajax_request()) {
            redirect('404', 'refresh');
        } else {
            $this->load->model('scrolls/scroll_model');
            $obj = $this->scroll_model->getLastScrollAvailable($_POST['ticket_id']);
            if (is_object($obj)) {
                echo json_encode($obj);
            } else {
                echo 0;
            }
        }
    }

    /**
     * Guardar una asignacion
     */
    function saveAssignment() {
        if (!$this->input->is_ajax_request()) {
            redirect('404', 'refresh');
        } else {
            $this->form_validation->set_rules('ticket_id', lang('field_type_ticket'), 'trim|required');
            $this->form_validation->set_rules('serial', lang('field_serial'), 'trim|required');
            $this->form_validation->set_rules('number_ticket_start', lang('field_number_ticket_start'), 'trim|required');
            $this->form_validation->set_rules('number_ticket_end', lang('field_number_ticket_end'), 'trim|required');

            if ($this->form_validation->run() == TRUE) {
                $data = $this->assignment_model->prep_data($_POST);
                if ($id = $this->assignment_model->insert($data)) {
                    //Cambiar el estado del rollo a Asignado
                    $this->load->model('scrolls/scroll_model');
                    $this->scroll_model->update($_POST['scroll_id'], array('status' => 'Asignado'));
                    log_activity(
                            $this->current_user->id,
                            lang('act_create_assign') . ' : ' . $id,
                            'Asignacion'
                    );
                    echo json_encode(['error' => 0, 'msg' => lang('create_success')]);
                } else {
                    echo json_encode(['error' => 1, 'msg' => lang('create_failure')]);
                }
            } else {
                echo json_encode(['error' => 1, 'msg' => validation_errors()]);
            }
        }
    }

    /**
     * 
     */
    function updateAssign() {
        if (!$this->input->is_ajax_request()) {
            redirect('404', 'refresh');
        } else {
            $this->form_validation->set_rules('serial', lang('field_serial'), 'trim|required');
            $this->form_validation->set_rules('number_ticket_start', lang('field_number_ticket_start'), 'trim|required');
            $this->form_validation->set_rules('number_ticket_end', lang('field_number_ticket_end'), 'trim|required');

            if ($this->form_validation->run() == TRUE) {
                $data = $this->assignment_model->prep_data($_POST);
                if ($this->assignment_model->update($_POST['id'], $data)) {
                    log_activity(
                            $this->current_user->id,
                            lang('act_update_assign') . ' : ' . $_POST['id'],
                            'Asignacion'
                    );
                    echo json_encode(['error' => 0, 'msg' => lang('update_success')]);
                } else {
                    echo json_encode(['error' => 1, 'msg' => lang('update_failure')]);
                }
            } else {
                echo json_encode(['error' => 1, 'msg' => validation_errors()]);
            }
        }
    }

    /**
     * Asignaciones en progreso de un chofer
     */
    function assignToProgress() {
        if (!$this->input->is_ajax_request()) {
            redirect('404', 'refresh');
        } else {
            $assigns = $this->assignment_model->assignToProgress($_GET['drive_id']);
            if (is_array($assigns)) {
                $html = '<div class="alert alert-info alert-dismissible">';
                $html .= '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
                foreach ($assigns as $k => $v) {
                    $html .= '<p><b>' . $v->name . '</b> | ' . $v->number_ticket_start . ' / ' . $v->number_ticket_end . ' [' . $v->tto . ']</p>';
                }
                $html .= '</div>';
                echo $html;
            }
        }
    }

}
