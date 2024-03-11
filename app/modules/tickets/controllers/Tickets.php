<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Tickets extends MY_Controller {

    function __construct() {
        parent::__construct();

        $this->lang->load('tickets');
        $this->load->model('ticket_model');
        $this->load->helper('date');
        Assets::add_module_js('tickets', 'tickets.js');
        Template::set_block('sub_nav', '_sub_nav');
    }

    public function index() {

        Template::set('toolbar_title', lang('management_tickets'));
        Template::render();
    }

    public function create() {
        echo $this->load->view('tickets/create', array(), TRUE);
    }

    public function updateTicket() {
        $this->form_validation->set_rules($this->ticket_model->get_validation_rules('update'));
        $data = $this->ticket_model->prep_data($_POST);
        if ($this->form_validation->run($this) == TRUE && isset($_POST['id'])) {
            if ($this->ticket_model->update($_POST['id'], $data)) {
                log_activity(
                    $this->current_user->id,
                    lang('act_update_ticket') . ' : ' . $_POST['id'],
                    'Tipos de boleto'
                );
                echo json_encode(['error' => 0, 'msg' => lang('ticket_edit_success')]);
            } else {
                echo json_encode(['error' => 1, 'msg' => lang('ticket_edit_failure')]);
            }
        } else {
            echo json_encode(['error' => 1, 'msg' => validation_errors()]);
        }
    }

    public function createTicket() {
        $this->form_validation->set_rules($this->ticket_model->get_validation_rules('insert'));
        $data = $this->ticket_model->prep_data($_POST);
        if ($this->form_validation->run() == TRUE) {
            if ($id = $this->ticket_model->insert($data)) {
                log_activity(
                    $this->current_user->id,
                    lang('act_create_ticket') . ' : ' . $id,
                    'Tipos de boleto'
                );
                echo json_encode(['error' => 0, 'msg' => lang('ticket_created_success')]);
            } else {
                echo json_encode(['error' => 1, 'msg' => lang('ticket_created_failure')]);
            }
        } else {
            echo json_encode(['error' => 1, 'msg' => validation_errors()]);
        }
    }

    public function delete($id = null) {
        if ($this->input->get('id')) {
            $id = $this->input->get('id');
        }

        if ($this->ticket_model->delete($id)) {
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
     * Ver y/o modificar dats de un abono
     */
    public function edit($id) {
        $id = (int) $this->uri->segment(3);
        if (empty($id)) {
            Template::set_message(lang('invalid_id'), 'danger');
            redirect('tickets');
        }
        echo 'fsdfsdf';
        $data['ticket'] = $this->ticket_model->find($id);
        echo $this->load->view('tickets/edit', $data, TRUE);
    }

    /**
     * Acciones sobre un abonos (borrar, excel e imprimir)
     */
    public function ticketActions() {

        $this->form_validation->set_rules('form_action', lang('form_action'), 'required');

        if ($this->form_validation->run() == true) {
            if (!empty($_POST['val'])) {

                if ($this->input->post('form_action') == 'delete') {
                    foreach ($_POST['val'] as $k => $v) {
                        $this->ticket_model->delete($v);
                    }

                    $this->session->set_flashdata('message', lang('users_deleted'));
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
                // Print tickets
                if ($this->input->post('form_action') == 'print_tickets') {
                    $this->load->library('pdf');
                    $this->printTicket($_POST['val']);
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

    //-----------------------------Metodos privados---------------------------/
    private function saveTicket($type = 'insert', $id = 0) {

        $this->form_validation->set_rules($this->ticket_model->get_validation_rules($type));

        if ($this->form_validation->run() === false) {
            return false;
        }

        // Compile our core user elements to save.
        $data = $this->ticket_model->prep_data($this->input->post());

        if ($type == 'insert') {

            $id = $this->ticket_model->insert($data);
            if (is_numeric($id)) {
                $result = $id;
            }
        } else {
            $result = $this->ticket_model->update($id, $data);
        }

        return $result;
    }

    /**
     * Metodo AJAX que recupera todos los abonos registrados en forma paginada.
     */
    function getTickets() {
        if (!$this->input->is_ajax_request()) {
            redirect('404', 'refresh');
        } else {
            $delete = "<a href='#' class='tip po' title='<b>" . $this->lang->line('delete_ticket') . "</b>' data-content=\"<p>"
                . lang('r_u_sure') . "</p><a class='btn btn-danger po-delete-ticket' id='a__$1' href='" . site_url('tickets/delete/$1') . "'>"
                . lang('i_m_sure') . "</a> <button class='btn po-close'>" . lang('no') . "</button>\"  rel='popover'><i class=\"fa fa-trash-o\"></i> "
                . lang('delete_ticket') . '</a>';

            $action = '<div class="text-center"><div class="btn-group text-left">'
                . '<button type="button" class="btn btn-default btn-xs btn-primary dropdown-toggle" data-toggle="dropdown">'
                . lang('actions') . ' <span class="caret"></span></button><ul class="dropdown-menu pull-right" role="menu">
	            <li><a href="' . site_url('tickets/edit/$1') . '" data-toggle="modal" data-target="#myModal"><i class="fa fa-edit"></i> ' . lang('edit_ticket') . '</a></li><li class="divider"></li><li> ' . $delete . '</li></ul></div></div>';

            $this->load->library('datatables');
            $this->datatables
                ->select('t1.id as id, t1.code as code, t1.name, t1.price, t1.quantity, t1.status as status')
                ->from('tickets as t1')
                ->edit_column('status', '$1__$2', 'status, id')
                ->edit_column('code', '$1__$2', 'code, id')
                ->add_column('Actions', $action, 'id');

            echo $this->datatables->generate();
        }
    }

}