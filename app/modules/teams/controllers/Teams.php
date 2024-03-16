<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Teams extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->lang->load('teams');
        $this->load->model('team_model');
        //$this->config->load('teams');
        $this->load->helper(array('array', 'personal'));
        Assets::add_module_js('teams', 'teams.js');
        Assets::add_module_css('teams', 'teams.css');
        Template::set_block('sub_nav', '_sub_nav');
    }

    public function index() {
        Template::set('toolbar_title', lang('index_teams'));
        Template::render();
    }

    public function create() {

        if (isset($_POST['save'])) {
            if ($id = $this->save('insert')) {
                log_activity(
                    $this->current_user->id,
                    lang('act_create_team') . ' : ' . "$id",
                    'Equipos'
                );
                Template::set_message(lang('team_created_success'), 'success');
                Template::redirect('teams/edit/' . $id);
            } else {
                Template::set_message(lang('team_created_failure'), 'danger');
            }
        }

        Template::set('toolbar_title', lang('create_team'));
        Template::render();
    }

    public function edit() {
        
        $id = (int) $this->uri->segment(3);
        if (empty($id)) {
            Template::set_message(lang('invalid_id'), 'danger');
            redirect('teams');
        }

        if (isset($_POST['save']) || isset($_POST['saveandclose'])) {
            if ($this->save('update', $id)) {
                log_activity(
                    $this->current_user->id,
                    lang('act_update_team') . ' : ' . "$id",
                    'Equipos'
                );
                Template::set_message(lang('team_edit_success'), 'success');
                if (isset($_POST['saveandclose'])) {
                    Template::redirect('teams');
                }                
            } else {
                Template::set_message(lang('team_edit_failure'), 'danger');
            }
        } 
      
        Template::set('team', $this->team_model->find($id));
        Template::render();
    }

    public function delete($id = null) {
        //$this->sma->checkPermissions(null, true);

        if ($this->input->get('id')) {
            $id = $this->input->get('id');
        }

        if ($this->personal_model->delete($id)) {
            if ($this->input->is_ajax_request()) {
                echo json_encode(['error' => 0, 'msg' => 'Eliminado']);
            }
            Template::redirect('teams');
        }
    }
    
    /**
     * Acciones sobre un abonos (borrar, excel e imprimir)
     */
    public function actions() {

        $this->form_validation->set_rules('form_action', lang('form_action'), 'required');

        if ($this->form_validation->run() == true) {
            if (!empty($_POST['val'])) {

                if ($this->input->post('form_action') == 'delete') {
                    $c = 0;
                    foreach ($_POST['val'] as $k => $v) {
                        if ($this->personal_model->delete($v)) {
                            $c++;
                        }
                    }
                    log_activity(
                        $this->current_user->id,
                        lang('activity_delete_rrhh') . ' : ' . "$c",
                        'RRHH'
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

    private function save($type = 'insert', $id = 0) {

        $this->form_validation->set_rules('t_name', lang('lbl_t_name'), 'trim|required');
        $this->form_validation->set_rules('short_name', lang('lbl_short_name'), 'trim');
        $this->form_validation->set_rules('t_descr', lang('lbl_t_descr'), 'trim');
        $this->form_validation->set_rules('t_city', lang('lbl_t_city'), 'trim');
        
        if ($this->form_validation->run() === false) {
            return false;
        }
        
        $data = $this->team_model->prep_data($_POST);

        if (isset($_FILES['t_emblem']['name']) && !empty($_FILES['t_emblem']['name'])) {
            $photo = $this->store_photo();
            if (isset($photo['file_name'])) {
                $data['t_emblem'] = $photo['file_name'];
            }
        } 
        
        //echo "<pre>"; print_r($data); echo "</pre>"; exit;
        if ($type == 'insert') {
            $id = $this->team_model->insert($data);
            if (is_numeric($id)) {
                $result = $id;
            }
        } else {
            $result = $this->team_model->update($id, $data);
        }
        return $result;
    }

    private function store_photo() {
        $config['upload_path'] = $_SERVER['DOCUMENT_ROOT'].'/assets/photos/shields/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 2000;
        $config['max_width'] = 1500;
        $config['max_height'] = 1500;
        $config['file_name'] = "bl" . uniqid();

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('t_emblem')) {
            return $this->upload->display_errors();
        } else {
            return $this->upload->data();
        }
    }
    // Methods Ajax
    function get_teams() {
        if (!$this->input->is_ajax_request()) {
            redirect('404', 'refresh');
        } else {
            $edit_user = '<a href="' . site_url('teams/edit/$1') . '"><i class="fa fa-edit"></i> ' . lang('edit_team') . '</a>';
            $delete_link = "<a href='#' class='tip po' title='<b>" . $this->lang->line('delete_team') . "</b>' data-content=\"<p>"
                . lang('r_u_sure') . "</p><a class='btn btn-danger po-delete-user' id='a__$1' href='" . site_url('teams/delete/$1') . "'>"
                . lang('i_m_sure') . "</a> <button class='btn po-close'>" . lang('no') . "</button>\"  rel='popover'><i class=\"fa fa-trash-o\"></i> "
                . lang('delete_team') . '</a>';

            $action = '<div class="text-center"><div class="btn-group text-left">'
                . '<button type="button" class="btn btn-default btn-xs btn-primary dropdown-toggle" data-toggle="dropdown">'
                . lang('actions') . ' <span class="caret"></span></button><ul class="dropdown-menu pull-right" role="menu">';

            $action .= '<li>' . $edit_user . '</li>';

            $action .= '<li>' . $delete_link . '</li>';

            $action .= '</ul></div></div>';
            $this->load->library('datatables');
            $this->datatables->set_database('joomla');
            $this->datatables
                ->select('t1.id as id, t1.t_name, t1.short_name, t1.t_descr, t1.t_city')
                ->from('co_bl_teams as t1')
                //->where('t1.position', 'Chofer')
                //->edit_column('last_name', '$1__$2', 'last_name, id')
                ->add_column('Actions', $action, 'id');

            echo $this->datatables->generate();
        }
    }

}