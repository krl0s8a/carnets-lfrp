<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Banks extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->lang->load('banks');
        $this->load->helper('date');
        $this->load->model('bank_model');
        $this->load->model('bank_account_model');

        Assets::add_module_js('banks', 'banks.js');
        Template::set_block('sub_nav', '_sub_nav');
    }

    public function index() {
        Template::set('toolbar_title', lang('title_list_bank'));
        Template::render();
    }

    public function create() {

        if (isset($_POST['save'])) {
            if ($id = $this->save('insert')) {
                Template::set_message(lang('bank_created_success'), 'success');
                Template::redirect('banks');
            } else {
                Template::set_message(lang('bank_created_failure'), 'danger');
            }
        }

        Template::set('toolbar_title', lang('title_new_bank'));
        Template::render();
    }

    public function edit() {
        $id = (int) $this->uri->segment(3);
        if (empty($id)) {
            Template::set_message(lang('invalid_id'), 'danger');
            redirect('banks');
        }

        if (isset($_POST['save'])) {
            if ($id = $this->save('update', $id)) {
                Template::set_message(lang('bank_created_success'), 'success');
                Template::redirect('banks');
            } else {
                Template::set_message(lang('bank_created_failure'), 'danger');
            }
        }

        Template::set('bank', $this->bank_account_model->find($id));
        Template::set('toolbar_title', lang('title_edit_bank'));
        Template::render();
    }

    public function delete($id = null) {
        //$this->sma->checkPermissions(null, true);

        if ($this->input->get('id')) {
            $id = $this->input->get('id');
        }
        return $id;

        if ($this->bank_model->delete($id)) {
            if ($this->input->is_ajax_request()) {
                log_activity(
                    $this->current_user->id,
                    lang('activity_delete_abono') . ' : ' . $id,
                    'Bancos'
                );
                header('Content-Type: application/json');
                die(json_encode(['error' => 0, 'msg' => lang('abono_deleted_success')]));
                exit;
            }
            
            Template::set(lang('abono_deleted_success'), 'success');
            return redirect('banks');
        }
    }

    private function save($type = 'insert', $id = 0) {
        $this->form_validation->set_rules($this->bank_account_model->get_validation_rules($type));
		if ($this->form_validation->run() === false) {
			return false;
		}
        $data = $this->bank_account_model->prep_data($_POST);
        if ($type == 'insert') {
            $id = $this->bank_account_model->insert($data);
            if (is_numeric($id)) {
                $result = $id;
            }
        } else {
            echo $id;
            $result = $this->bank_account_model->update($id, $data);
        }
        return $result;
    }
    public function updateCity() {
        $this->form_validation->set_rules($this->city_model->get_validation_rules('update'));
        $data = $this->city_model->prep_data($_POST);
        if ($this->form_validation->run($this) == TRUE && isset($_POST['id'])) {
            if ($this->city_model->update($_POST['id'], $data)) {
                log_activity(
                    $this->current_user->id,
                    lang('act_update_city') . ' : ' . $_POST['id'],
                    'Localidades'
                );
                echo json_encode(['error' => 0, 'msg' => lang('city_edit_success')]);
            } else {
                echo json_encode(['error' => 1, 'msg' => lang('city_edit_failure')]);
            }
        } else {
            echo json_encode(['error' => 1, 'msg' => validation_errors()]);
        }
    }

    public function createBank() {
        $this->form_validation->set_rules($this->bank_account_model->get_validation_rules('insert'));
        $data = $this->bank_account_model->prep_data($_POST);
        if ($this->form_validation->run() == TRUE) {
            if ($id = $this->bank_account_model->insert($data)) {
                log_activity(
                    $this->current_user->id,
                    lang('act_create_city') . ' : ' . $id,
                    'Bancos y Cajas'
                );
                // Insertamos en la otra tabla
                $data2 = $this->bank_model->prep_data($_POST);
                $data2['dateo'] = formatDate($_POST['date'], 'd/m/Y', 'Y-m-d');
                $data2['datev'] = formatDate($_POST['date'], 'd/m/Y', 'Y-m-d');
                $data2['label'] = 'Saldo Inicial';
                $data2['fk_account'] = $id;
                $this->bank_model->insert($data2);
                echo json_encode(['error' => 0, 'msg' => lang('bank_created_success')]);
            } else {
                echo json_encode(['error' => 1, 'msg' => lang('bank_created_failure')]);
            }
        } else {
            echo json_encode(['error' => 1, 'msg' => validation_errors()]);
        }
    }

    /**
     * Acciones sobre un abonos (borrar, excel e imprimir)
     */
    public function banksActions() {

        $this->form_validation->set_rules('form_action', lang('form_action'), 'required');

        if ($this->form_validation->run() == true) {
            if (!empty($_POST['val'])) {

                if ($this->input->post('form_action') == 'delete') {
                    foreach ($_POST['val'] as $k => $v) {
                        $this->city_model->delete($v);
                        log_activity(
                            $this->current_user->id,
                            lang('act_delete_city') . ' : ' . $v,
                            'Localidades'
                        );
                    }
                    Template::set_message(lang('city_deleted_success'), 'success');

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
    function getBanksAccount() {
        if (!$this->input->is_ajax_request()) {
            redirect('404', 'refresh');
        } else {
            $this->load->library('datatables');

            $edit_bus = '<a href="' . site_url('banks/edit/$1') . '"><i class="fa fa-edit"></i> ' . lang('action_edit_bank') . '</a>';
            $delete_link = "<a href='#' class='tip po' title='<b>" . $this->lang->line('action_delete_bank') . "</b>' data-content=\"<p>"
                . lang('r_u_sure') . "</p><a class='btn btn-danger po-delete-bank' id='a__$1' href='" . site_url('banks/delete/$1') . "'>"
                . lang('i_m_sure') . "</a> <button class='btn po-close'>" . lang('no') . "</button>\"  rel='popover'><i class=\"fa fa-trash-o\"></i> "
                . lang('action_delete_bank') . '</a>';

            $action = '<div class="text-center"><div class="btn-group text-left">'
                . '<button type="button" class="btn btn-default btn-xs btn-primary dropdown-toggle" data-toggle="dropdown">'
                . lang('actions') . ' <span class="caret"></span></button><ul class="dropdown-menu pull-right" role="menu">';

            $action .= '<li>' . $edit_bus . '</li>';

            $action .= '<li>' . $delete_link . '</li>';

            $action .= '</ul></div></div>';

            $this->datatables
                ->select('t1.id as id, name, t1.type, t1.bank, t1.number, t1.status')
                ->from('bank_accounts as t1')
                ->edit_column('name', '$1__$2', 'name, id')
                ->add_column('Actions', $action, 'id');

            echo $this->datatables->generate();
        }
    }

}