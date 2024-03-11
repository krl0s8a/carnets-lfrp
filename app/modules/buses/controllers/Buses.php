<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Buses extends MY_Controller {
    private $busAdd = 'System.Bus.Add';
    private $busManage = 'System.Bus.Manage';
    private $busDelete = 'System.Bus.Delete';
    private $busEdit = 'System.Bus.Edit';
    function __construct() {
        parent::__construct();
        $this->lang->load('buses');
        $this->load->model('bus_model');
        $this->load->helper('bus');

        Assets::add_module_js('buses', 'buses.js');
        Template::set_block('sub_nav', '_sub_nav');
    }

    public function index() {
        $this->auth->restrict($this->busManage);
        Template::set('toolbar_title', lang('management_bus'));
        Template::render();
    }

    public function create() {
        $this->auth->restrict($this->busAdd);
        if (isset($_POST['save'])) {
            if ($id = $this->save('insert')) {
                log_activity(
                    $this->current_user->id,
                    lang('act_create_bus') . ' : ' . $id,
                    'buses'
                );
                Template::set_message(lang('bus_created_success'), 'success');
                Template::redirect('buses');
            } else {
                Template::set_message(lang('bus_created_failure'), 'danger');
            }
        }
        Template::set('toolbar_title', lang('create_bus'));
        Template::render();
    }

    public function edit() {
        $this->auth->restrict($this->busEdit);
        $id = (int) $this->uri->segment(3);
        if (empty($id)) {
            Template::set_message(lang('invalid_id'), 'danger');
            redirect('buses');
        }
        if (isset($_POST['save'])) {
            if ($this->save('update', $id)) {
                log_activity(
                    $this->current_user->id,
                    lang('act_update_bus') . ' : ' . $id,
                    'buses'
                );
                Template::set_message(lang('bus_edit_success'), 'success');
                //Template::redirect('buses');
            } else {
                Template::set_message(lang('bus_edit_failure'), 'danger');
            }
        }

        Template::set('toolbar_title', lang('edit_bus'));
        Template::set('bus', $this->bus_model->find($id));
        Template::render();
    }

    public function delete($id = null) {
        $this->auth->restrict($this->busDelete);
        if ($this->input->get('id')) {
            $id = $this->input->get('id');
        }

        if ($this->bus_model->delete($id)) {
            log_activity(
                $this->current_user->id,
                lang('act_delete_bus') . ' : ' . $id,
                'buses'
            );
            header('Content-Type: application/json');
            die(json_encode(['error' => 0, 'msg' => lang('bus_deleted_success')]));
            exit;
        }        
        Template::set_message(lang('bus_deleted_success'), 'success');
        Template::redirect('buses');
    }
    public function busesActions() {

        $this->form_validation->set_rules('form_action', lang('form_action'), 'required');

        if ($this->form_validation->run() == true) {
            if (!empty($_POST['val'])) {

                if ($this->input->post('form_action') == 'delete') {
                    $qt = 0;
                    $ids = '';
                    foreach ($_POST['val'] as $k => $v) {
                        $this->bus_model->delete($v);
                        $qt++;
                        $ids .= $v . ',';
                    }
                    log_activity(
                        $this->current_user->id,
                        lang('act_delete_bus_batch') . ' : ' . $qt . ' con id: ' . $ids,
                        'buses'
                    );
                    Template::set_message(lang('bus_deleted_success'), 'success');

                    redirect($_SERVER['HTTP_REFERER']);
                }
                // Exportar a excel
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

        $data = $this->bus_model->prep_data($_POST);
        if ($type == 'insert') {
            $id = $this->bus_model->insert($data);
            if (is_numeric($id)) {
                $result = $id;
            }
        } else {
            $result = $this->bus_model->update($id, $data);
        }
        return $result;
    }

    // Methods Ajax
    function getBuses() {
        if (!$this->input->is_ajax_request()) {
            redirect('404', 'refresh');
        } else {
            $this->load->library('datatables');
            $edit_bus = '<a href="' . site_url('buses/edit/$1') . '"><i class="fa fa-edit"></i> ' . lang('action_edit_bus') . '</a>';
            $delete_link = "<a href='#' class='tip po' title='<b>" . $this->lang->line('us_delete_user') . "</b>' data-content=\"<p>"
                . lang('r_u_sure') . "</p><a class='btn btn-danger po-delete-bus' id='a__$1' href='" . site_url('buses/delete/$1') . "'>"
                . lang('i_m_sure') . "</a> <button class='btn po-close'>" . lang('no') . "</button>\"  rel='popover'><i class=\"fa fa-trash-o\"></i> "
                . lang('action_delete_bus') . '</a>';

            $action = '<div class="text-center"><div class="btn-group text-left">'
                . '<button type="button" class="btn btn-default btn-xs btn-primary dropdown-toggle" data-toggle="dropdown">'
                . lang('actions') . ' <span class="caret"></span></button><ul class="dropdown-menu pull-right" role="menu">';

            $action .= '<li>' . $edit_bus . '</li>';

            $action .= '<li>' . $delete_link . '</li>';

            $action .= '</ul></div></div>';

            $this->datatables
                ->select('t1.id as id, name, t1.registration, t1.model, t1.status as status')
                ->from('buses as t1')
                ->edit_column('status', '$1__$2', 'status, id')
                ->edit_column('name', '$1__$2', 'name, id')
                ->add_column('Actions', $action, 'id');

            echo $this->datatables->generate();
        }
    }

}

/* End of file Rrhh.php */
/* Location: .//D/www/futuro-srl/app/modules/rrhh/controllers/Rrhh.php */