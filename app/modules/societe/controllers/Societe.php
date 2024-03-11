<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Societe extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->lang->load('societe');
        $this->load->model('societe_model');

        Assets::add_module_js('societe', 'societe.js');
        Template::set_block('sub_nav', '_sub_nav');
    }

    public function index() {
        $this->load->config('config');
        Template::set('types', config_item('types'));
        Template::set('toolbar_title', lang('manage_societe'));
        Template::render();
    }

    public function create() {
        $this->load->model('state_model');
        $data['states'] = $this->state_model->getStates();
        $this->load->config('config');
        $data['types'] = config_item('types');
        $this->load->model('cities/city_model');
        $data['cities'] = $this->city_model->getCitiesByState(2);
        echo $this->load->view('societe/create', $data, TRUE);
    }

    public function paymentmodes($id) {

        // Recuperar cuentas bancarias asociadas
        $this->load->model('societe/paymentmode_model');
        Template::set('paymentsmode', $this->paymentmode_model->find_all_by('fk_soc', $id));

        Template::set('societe', $this->societe_model->find($id));
        Template::set('toolbar_title', lang('payment_modes'));
        Template::render();
    }

    public function create_paymentmode($id) {
        $this->load->model('societe/paymentmode_model');
        $this->paymentmode_model->select('id');
        $this->paymentmode_model->order_by('id', 'desc');
        $this->paymentmode_model->limit(1);
        $q = $this->paymentmode_model->find_all();
        if (is_array($q) && !empty($q)) {
            $data['label'] = $q[0]->id + 1;
        } else {
            $data['label'] = 1;
        }

        $data['fk_soc'] = $id;
        echo $this->load->view('societe/create_paymentmode', $data, TRUE);
    }

    public function edit() {
        $id = (int) $this->uri->segment(3);
        if (empty($id)) {
            Template::set_message(lang('invalid_id'), 'danger');
            redirect('societe');
        }
        if (isset($_POST['save'])) {
            $this->form_validation->set_rules($this->societe_model->get_validation_rules('update'));
            $update = $this->societe_model->prep_data($_POST);

            if ($this->form_validation->run() == true) {

                if ($this->societe_model->update($id, $update)) {
                    log_activity(
                        $this->current_user->id,
                        lang('act_update_societe') . ' : ' . $id,
                        'Terceros'
                    );
                    Template::set_message(lang('societe_update_success'), 'success');
                } else {
                    Template::set_message(lang('societe_update_failure'), 'danger');
                }
            }
        }
        $this->load->model('cities/city_model');
        Template::set('cities', $this->city_model->getCitiesByState(2));
        $this->load->model('state_model');
        Template::set('states', $this->state_model->getStates());
        $data['societe'] = $this->societe_model->find($id);
        $this->load->config('config');
        Template::set('types', config_item('types'));
        Template::set('societe', $this->societe_model->find($id));
        Template::set('toolbar_title', lang('title_edit_societe'));
        Template::render();
    }

    public function delete($id = null) {
        if ($this->input->get('id')) {
            $id = $this->input->get('id');
        }

        if ($this->societe_model->delete($id)) {
            if ($this->input->is_ajax_request()) {
                log_activity(
                    $this->current_user->id,
                    lang('act_delete_societe') . ' : ' . $id,
                    'Terceros'
                );
                header('Content-Type: application/json');
                die(json_encode(['error' => 0, 'msg' => lang('societe_deleted_success')]));
                exit;
            }
        }
    }

    public function updateCity() {
        $this->form_validation->set_rules($this->societe_model->get_validation_rules('update'));
        $data = $this->societe_model->prep_data($_POST);
        if ($this->form_validation->run($this) == TRUE && isset($_POST['id'])) {
            if ($this->societe_model->update($_POST['id'], $data)) {
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

    public function createSociete() {
        $this->form_validation->set_rules($this->societe_model->get_validation_rules('insert'));
        $data = $this->societe_model->prep_data($_POST);
        if ($this->form_validation->run() == TRUE) {
            if ($id = $this->societe_model->insert($data)) {
                log_activity(
                    $this->current_user->id,
                    lang('act_create_societe') . ' : ' . $id,
                    'Terceros'
                );
                echo json_encode(['error' => 0, 'msg' => lang('societe_created_success')]);
            } else {
                echo json_encode(['error' => 1, 'msg' => lang('societe_created_failure')]);
            }
        } else {
            echo json_encode(['error' => 1, 'msg' => validation_errors()]);
        }
    }

    public function createPaymentmode() {
        $this->load->model('societe/paymentmode_model');
        $this->form_validation->set_rules($this->paymentmode_model->get_validation_rules('insert'));
        $data = $this->paymentmode_model->prep_data($_POST);

        if ($this->form_validation->run() == TRUE) {
            if ($id = $this->paymentmode_model->insert($data)) {
                log_activity(
                    $this->current_user->id,
                    lang('act_create_societe') . ' : ' . $id,
                    'Terceros'
                );
                echo json_encode(['error' => 0, 'msg' => lang('societe_created_success')]);
            } else {
                echo json_encode(['error' => 1, 'msg' => lang('societe_created_failure')]);
            }
        } else {
            echo json_encode(['error' => 1, 'msg' => validation_errors()]);
        }
    }

    /**
     * Acciones sobre un abonos (borrar, excel e imprimir)
     */
    public function societeActions() {

        $this->form_validation->set_rules('form_action', lang('form_action'), 'required');

        if ($this->form_validation->run() == true) {
            if (!empty($_POST['val'])) {

                if ($this->input->post('form_action') == 'delete') {
                    foreach ($_POST['val'] as $k => $v) {
                        $this->societe_model->delete($v);
                        log_activity(
                            $this->current_user->id,
                            lang('act_delete_societe') . ' : ' . $v,
                            'Terceros'
                        );
                    }
                    Template::set_message(lang('societe_deleted_success'), 'success');

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
    function getSociete() {
        if (!$this->input->is_ajax_request()) {
            redirect('404', 'refresh');
        } else {
            $assigned = '<a href="' . site_url('societe/assigned/$1') . '" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus-square"></i>' . lang('assigned_scroll') . '</a>';
            $edit_societe = '<a href="' . site_url('societe/edit/$1') . '"><i class="fa fa-edit"></i> ' . lang('edit_societe') . '</a>';
            $delete_link = "<a href='#' class='tip po' title='<b>" . $this->lang->line('delete_societe') . "</b>' data-content=\"<p>"
                . lang('r_u_sure') . "</p><a class='btn btn-danger po-delete' id='a__$1' href='" . site_url('societe/delete/$1') . "'>"
                . lang('i_m_sure') . "</a> <button class='btn po-close'>" . lang('no') . "</button>\"  rel='popover'><i class=\"fa fa-trash-o\"></i> "
                . lang('delete_societe') . '</a>';

            $action = '<div class="text-center"><div class="btn-group text-left">'
                . '<button type="button" class="btn btn-default btn-xs btn-primary dropdown-toggle" data-toggle="dropdown">'
                . lang('actions') . ' <span class="caret"></span></button>
	        <ul class="dropdown-menu pull-right" role="menu"><li>' . $edit_societe . '</li><li>' . $delete_link . '</li>';
            $action .= '</ul></div></div>';

            $this->load->library('datatables');
            $this->datatables
                ->select('t1.id as id, t1.name as name, t1.cuit, t1.type, t1.phone, CONCAT_WS("__",t1.client,t1.provider) as tercero')
                ->from('societe as t1')
                ->edit_column('name', '$1__$2', 'name, id')
                ->add_column('Actions', $action, 'id');

            echo $this->datatables->generate();
        }
    }

}