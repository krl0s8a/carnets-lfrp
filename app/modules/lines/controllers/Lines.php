<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Lines extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->lang->load('lines');
        $this->load->model('line_model');

        Assets::add_module_js('lines', 'lines.js');
        Template::set_block('sub_nav', '_sub_nav');
    }

    public function index() {
        Template::set('toolbar_title', lang('mnt_lines'));
        Template::render();
    }

    public function create() {

        $data['action'] = 'create';
        $data['title'] = '<i class="fa fa-plus-circle"></i> ' . lang('create_line');
        echo $this->load->view('lines/form', $data, TRUE);
    }

    public function edit() {
        $id = (int) $this->uri->segment(3);
        if (empty($id)) {
            Template::set_message(lang('invalid_id'), 'danger');
            redirect('lines');
        }
        $line = $this->line_model->find($id);
        $data['action'] = 'edit';
        $data['title'] = '<i class="fa fa-edit"></i> ' . lang('edit_line') . ' [' . $line->id . ']';
        $data['line'] = $line;
        echo $this->load->view('lines/form', $data, TRUE);
    }

    public function updateLine() {
        $this->form_validation->set_rules($this->line_model->get_validation_rules('update'));
        $data = $this->line_model->prep_data($_POST);

        if ($this->form_validation->run($this) == TRUE && isset($_POST['id'])) {
            if ($this->line_model->update($_POST['id'], $data)) {
                log_activity(
                    $this->current_user->id,
                    lang('act_update_city') . ' : ' . $_POST['id'],
                    'Lineas'
                );
                echo json_encode(['error' => 0, 'msg' => lang('line_edit_success')]);
            } else {
                echo json_encode(['error' => 1, 'msg' => lang('line_edit_failure')]);
            }
        } else {
            echo json_encode(['error' => 1, 'msg' => validation_errors()]);
        }
    }

    public function createLine() {
        $this->form_validation->set_rules($this->line_model->get_validation_rules('insert'));
        $data = $this->line_model->prep_data($_POST);
        if ($this->form_validation->run() == TRUE) {
            if ($id = $this->line_model->insert($data)) {
                log_activity(
                    $this->current_user->id,
                    lang('act_create_city') . ' : ' . $id,
                    'Lineas'
                );
                echo json_encode(['error' => 0, 'msg' => lang('line_created_success')]);
            } else {
                echo json_encode(['error' => 1, 'msg' => lang('line_created_failure')]);
            }
        } else {
            echo json_encode(['error' => 1, 'msg' => validation_errors()]);
        }
    }


    public function delete() {
        $id = $this->uri->segment(3);
        echo $id;
        exit;
        if ($this->line_model->delete($id)) {
            Template::set_message('Exito', 'success');
        }
    }

    /**
     * Acciones sobre un abonos (borrar, excel e imprimir)
     */
    public function linesActions() {

        $this->form_validation->set_rules('form_action', lang('form_action'), 'required');

        if ($this->form_validation->run() == true) {
            if (!empty($_POST['val'])) {

                if ($this->input->post('form_action') == 'delete') {
                    $c = 0;
                    foreach ($_POST['val'] as $k => $v) {
                        if ($this->line_model->delete($v)) {
                            $c++;
                        }
                    }
                    log_activity(
                        $this->current_user->id,
                        lang('activity_delete_line') . ' : ' . "$id",
                        'Lineas'
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

    // Methods private
    private function save($type = 'insert', $id = 0) {

        $data = $this->line_model->prep_data($_POST);

        if ($type == 'insert') {
            $id = $this->line_model->insert($data);
            if (is_numeric($id)) {
                $result = $id;
            }
        } else {
            $result = $this->line_model->update($id, $data);
        }
        return $result;
    }

    // Methods Ajax
    function getLines() {
        if (!$this->input->is_ajax_request()) {
            redirect('404', 'refresh');
        } else {
            $this->load->library('datatables');
            $edit = "<a href='" . site_url('lines/edit/$1') . "' class='tip' title='" . lang('edit_line') . "'><i class=\"fa fa-edit\"></i></a>";
            $delete = "<a href='#' class='bpo' title='" . lang('delete_line') . "' data-content=\"<p>" . lang('r_u_sure') . "</p><button type='button' class='btn btn-danger' id='del' data-action='del'>" . lang('i_m_sure') . "</a> <button class='btn bpo-close'>" . lang('no') . "</button>\" data-html=\"true\" data-placement=\"left\" data-identifier=\"$1\"><i class=\"fa fa-trash-o\"></i></a>";
            $this->datatables
                ->select('t1.id as id, t1.name as name, t1.status as status')
                ->from('lines as t1')
                ->edit_column('status', '$1__$2', 'status, id')
                ->edit_column('name', '$1__$2', 'name, id')
                ->add_column('Actions', "<div class=\"text-center\">" . $edit . "</div>", 'id');

            echo $this->datatables->generate();
        }
    }

}