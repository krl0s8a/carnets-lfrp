<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Points extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->lang->load('points');
        $this->load->model('point_model');

        Assets::add_module_js('points', 'points.js');
        Template::set_block('sub_nav', '_sub_nav');
    }

    public function index() {
        Template::set('toolbar_title', lang('title_list_points'));
        Template::render();
    }

    public function create() {

        if ($this->input->is_ajax_request()) {
            $this->load->model('cities/city_model');
            $data['cities'] = $this->city_model->getCities();
            echo $this->load->view('points/create', $data, TRUE);
        }
    }

    public function save() {
        if (!$this->input->is_ajax_request()) {
            redirect('404', 'refresh');
        } else {
            $this->form_validation->set_rules('name', lang('field_name'), 'trim|required');
            if ($this->form_validation->run() == TRUE) {
                $data = $this->point_model->prep_data($_POST);
                if (isset($_POST['id'])) {
                    if ($this->point_model->update($_POST['id'], $data)) {
                        log_activity(
                            $this->current_user->id,
                            lang('act_update') . ' : ' . $_POST['id'],
                            'Puntos de venta'
                        );
                        echo json_encode(['error' => 0, 'msg' => lang('update_success')]);
                    } else {
                        echo json_encode(['error' => 1, 'msg' => lang('update_failure')]);
                    }
                } else {
                    $id = $this->point_model->insert($data);
                    if (is_numeric($id)) {
                        log_activity(
                            $this->current_user->id,
                            lang('act_create') . ' : ' . $id,
                            'Puntos de venta'
                        );
                        echo json_encode(['error' => 0, 'msg' => lang('create_success')]);
                    } else {
                        echo json_encode(['error' => 1, 'msg' => lang('create_failure')]);
                    }
                }
            } else {
                echo json_encode(['error' => 1, 'msg' => validation_errors()]);
            }
        }
    }

    public function edit() {
        $id = (int) $this->uri->segment(3);
        if (empty($id)) {
            Template::set_message(lang('invalid_id'), 'danger');
            redirect('points');
        }
        if ($this->input->is_ajax_request()) {
            $data['point'] = $this->point_model->find($id);
            $this->load->model('cities/city_model');
            $data['cities'] = $this->city_model->getCities();
            echo $this->load->view('points/edit', $data, TRUE);
        }
    }

    public function delete($id = null) {
        if ($this->input->get('id')) {
            $id = $this->input->get('id');
        }

        if ($this->point_model->delete($id)) {
            if ($this->input->is_ajax_request()) {
                log_activity(
                    $this->current_user->id,
                    lang('activity_delete_point') . ' : ' . $id,
                    'points'
                );
                header('Content-Type: application/json');
                die(json_encode(['error' => 0, 'msg' => lang('point_deleted_success')]));
                exit;
            }
            Template::set(lang('point_deleted_success'), 'success');
            return redirect('points');
        }
    }

    public function activate($id = null) {
        if ($this->point_model->activate($id)) {
            Template::set_message(lang('activate_success'), 'success');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function inactivate($id = null) {
        if ($this->point_model->inactivate($id)) {
            Template::set_message(lang('inactivate_success'), 'success');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    /**
     * Acciones sobre un abonos (borrar, excel e imprimir)
     */
    public function pointsActions() {

        $this->form_validation->set_rules('form_action', lang('form_action'), 'required');

        if ($this->form_validation->run() == true) {
            if (!empty($_POST['val'])) {

                if ($this->input->post('form_action') == 'delete') {
                    foreach ($_POST['val'] as $k => $v) {
                        $this->point_model->delete($v);
                    }
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

    // Methods Ajax
    function getPoints() {
        if (!$this->input->is_ajax_request()) {
            redirect('404', 'refresh');
        } else {
            $delete_link = "<a href='#' class='tip po' title='<b>" . $this->lang->line('delete_point') . "</b>' data-content=\"<p>"
                . lang('r_u_sure') . "</p><a class='btn btn-danger po-delete-point' id='a__$1' href='" . site_url('points/delete/$1') . "'>"
                . lang('i_m_sure') . "</a> <button class='btn po-close'>" . lang('no') . "</button>\"  rel='popover'><i class=\"fa fa-trash-o\"></i> "
                . lang('delete_point') . '</a>';

            $action = '<div class="text-center"><div class="btn-group text-left">'
                . '<button type="button" class="btn btn-default btn-xs btn-primary dropdown-toggle" data-toggle="dropdown">'
                . lang('actions') . ' <span class="caret"></span></button><ul class="dropdown-menu pull-right" role="menu">
	            <li><a href="' . site_url('points/edit/$1') . '"><i class="fa fa-edit"></i> ' . lang('edit_point') . '</a></li><li class="divider"></li><li> ' . $delete_link . '</li></ul></div></div>';

            $this->load->library('datatables');
            $this->datatables
                ->select('t1.id as id, t1.name, t2.name as name_city')
                ->from('points as t1')
                ->join('cities as t2', 't2.id = t1.city_id', 'left')
                ->edit_column('t1.name', '$1__$2', 't1.name, id')
                ->add_column('Actions', $action, 'id');

            echo $this->datatables->generate();
        }
    }

}
