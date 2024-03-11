<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Scrolls extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->lang->load('scrolls');
        $this->load->model('scroll_model');
        $this->load->helper(array('array', 'number'));

        Assets::add_module_js('scrolls', 'scrolls.js');
        Template::set_block('sub_nav', '_sub_nav');
    }

    public function index() {
        Template::set('toolbar_title', lang('mng_scrolls'));
        Template::render();
    }

    public function load() {

        if (isset($_POST['save'])) {
            $data = $this->scroll_model->prep_data($_POST);
            $arr = [];
            if (isset($_POST['serial'])) {
                foreach ($_POST['serial'] as $k => $v) {
                    $arr[] = array(
                        'ticket_id' => $_POST['ticket_id'],
                        'serial' => $_POST['serial'][$k],
                        'ffrom' => $_POST['ffrom'][$k],
                        'tto' => $_POST['tto'][$k],
                        'last_assigned' => $_POST['ffrom'][$k],
                        'quantity' => $_POST['tto'][$k] - $_POST['ffrom'][$k] + 1,
                        'status' => 'Sin asignar'
                    );
                }
                $this->scroll_model->insert_batch($arr);
            }
            $c = count($arr);

            if (is_numeric($c) && $c > 0) {
                log_activity(
                        $this->current_user->id,
                        lang('act_create_scroll') . ' : ' . "$c",
                        'Boletos'
                );
                Template::set_message(lang('created_success'), 'success');
                Template::redirect('scrolls');
            } else {
                Template::set_message(lang('created_failure'), 'danger');
            }
        }
        $this->load->model('tickets/ticket_model');
        $tickets = $this->ticket_model->getTickets();

        if (is_array($tickets)) {
            $ticket = $this->ticket_model->find(key($tickets));
        }
        Template::set('type_tickets', $tickets);
        Template::set('ticket', $ticket);
        Template::set('toolbar_title', lang('create_scroll'));
        Template::render();
    }

    public function edit() {
        $id = (int) $this->uri->segment(3);
        if (empty($id)) {
            Template::set_message(lang('invalid_id'), 'danger');
            redirect('scrolls');
        }
        $data['scroll'] = $this->scroll_model->find($id);
        $this->load->model('tickets/ticket_model');
        $data['type_tickets'] = $this->ticket_model->getTickets();
        echo $this->load->view('scrolls/edit', $data, TRUE);
    }

    public function assign($id = null) {
        $data['scroll'] = $this->scroll_model->find($id);
        // Conductores
        $this->load->model('rrhh/rrhh_model');
        $data['drives'] = $this->rrhh_model->getChoferes();
        // Tipos de boletos
        $this->load->model('tickets/ticket_model');
        $data['tickets'] = $this->ticket_model->getTickets();
        echo $this->load->view('scrolls/assign', $data, TRUE);
    }

    public function delete($id = null) {
        if ($this->input->get('id')) {
            $id = $this->input->get('id');
        }

        if ($this->scroll_model->delete($id)) {
            if ($this->input->is_ajax_request()) {
                log_activity(
                        $this->current_user->id,
                        lang('act_delete_scroll') . ' : ' . $id,
                        'Boletos'
                );
                header('Content-Type: application/json');
                die(json_encode(['error' => 0, 'msg' => lang('deleted_success')]));
                exit;
            }
        }
    }

    /**
     * Acciones sobre un abonos (borrar, excel e imprimir)
     */
    public function scrollsActions() {

        $this->form_validation->set_rules('form_action', lang('form_action'), 'required');

        if ($this->form_validation->run() == true) {
            if (!empty($_POST['val'])) {

                if ($this->input->post('form_action') == 'delete') {
                    $c = 0;
                    foreach ($_POST['val'] as $k => $v) {
                        if ($this->scroll_model->delete($v)) {
                            $c++;
                        }
                    }
                    log_activity(
                            $this->current_user->id,
                            lang('act_delete_scroll') . ' : ' . "$c",
                            'Boletos'
                    );
                    Template::set_message(lang('rrhh_deleted_success'), 'success');

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
     * Guarda la edicion de un formulario scroll
     */
    public function save() {
        if (!$this->input->is_ajax_request()) {
            redirect('404', 'refresh');
        } else {
            $this->form_validation->set_rules('serial', lang('field_serial'), 'trim|required');
            if ($this->form_validation->run() == TRUE) {
                if (isset($_POST['id'])) {
                    $data = $this->scroll_model->prep_data($_POST);
                    if ($this->scroll_model->update($_POST['id'], $data)) {
                        log_activity(
                                $this->current_user->id,
                                lang('act_update_scroll') . ' : ' . $_POST['id'],
                                'Boletos'
                        );
                        echo json_encode(['error' => 0, 'msg' => lang('update_success')]);
                    } else {
                        echo json_encode(['error' => 1, 'msg' => lang('update_failure')]);
                    }
                }
            } else {
                echo json_encode(['error' => 1, 'msg' => validation_errors()]);
            }
        }
    }

    // Methods Ajax
    function getScrolls() {
        if (!$this->input->is_ajax_request()) {
            redirect('404', 'refresh');
        } else {
            $assign = '<a href="' . site_url('scrolls/assign/$1') . '" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus-square"></i>' . lang('assigned_scroll') . '</a>';
            $edit_scroll = '<a href="' . site_url('scrolls/edit/$1') . '" data-toggle="modal" data-target="#myModal"><i class="fa fa-edit"></i> ' . lang('edit_scroll') . '</a>';
            $delete_link = "<a href='#' class='tip po' title='<b>" . $this->lang->line('delete_scroll') . "</b>' data-content=\"<p>"
                    . lang('r_u_sure') . "</p><a class='btn btn-danger po-delete-scroll' id='a__$1' href='" . site_url('scrolls/delete/$1') . "'>"
                    . lang('i_m_sure') . "</a> <button class='btn po-close'>" . lang('no') . "</button>\"  rel='popover'><i class=\"fa fa-trash-o\"></i> "
                    . lang('delete_scroll') . '</a>';

            $action = '<div class="text-center"><div class="btn-group text-left">'
                    . '<button type="button" class="btn btn-default btn-xs btn-primary dropdown-toggle" data-toggle="dropdown">'
                    . lang('actions') . ' <span class="caret"></span></button>
	        <ul class="dropdown-menu pull-right" role="menu"><li>' . $edit_scroll . '</li><li>' . $assign . '</li>
	            <li>' . $delete_link . '</li>';
            $action .= '</ul></div></div>';

            $this->load->library('datatables');
            $this->datatables
                    ->select('t1.id as id, t1.id as ida, t2.name as type, t1.serial, t1.ffrom, t1.tto, (t1.quantity), t1.status')
                    ->from('scrolls as t1')
                    ->join('tickets as t2', 't2.id = t1.ticket_id', 'left')
                    ->edit_column('ida','$1__$2','id, id')
                    ->add_column('Actions', $action, 'id');

            echo $this->datatables->generate();
        }
    }

    // Generar todos los rollos a registrar segun algunos parametros 
    function getScrollsLoad() {
        if (!$this->input->is_ajax_request()) {
            redirect('404', 'refresh');
        } else {
            if (empty($_GET['serial_prev'])) {
                echo '<div class="alert alert-danger">Ingrese el Nro de serie</div>';
            } else {
                $data = array(
                    'inicial' => $_GET['ticket_prev'],
                    'rollos' => $_GET['quantity_prev'],
                    'boletos' => $_GET['tickets_scroll'],
                    'serie' => $_GET['serial_prev']
                );
                echo $this->load->view('scrolls/scrolls', $data, TRUE);
            }
        }
    }

    //Retorna los datos de un ticket
    function getTicket() {
        if (!$this->input->is_ajax_request()) {
            redirect('404', 'refresh');
        } else {
            $this->load->model('tickets/ticket_model');
            echo json_encode($this->ticket_model->find($_GET['ticket_id']));
        }
    }

}
