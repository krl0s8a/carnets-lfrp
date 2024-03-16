<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Players  extends MY_Controller {
    
    function __construct() {
        parent::__construct();
        $this->lang->load('players');
        $this->load->model(array('player_model','seasons/season_model'));
        $this->load->helper('array');

        $this->digital_upload_path = 'files/';
        //$this->upload_path         = 'assets/photos/players/';
        $this->upload_path = $_SERVER['DOCUMENT_ROOT'].'/assets/photos/players/';
        //$this->thumbs_path         = 'assets/photos/players/thumbs/';
        $this->thumbs_path         = $_SERVER['DOCUMENT_ROOT'].'/assets/photos/players/thumbs/';
        $this->image_types         = 'gif|jpg|jpeg|png|tif';
        $this->digital_file_types  = 'zip|psd|ai|rar|pdf|doc|docx|xls|xlsx|ppt|pptx|gif|jpg|jpeg|png|tif|txt';
        $this->allowed_file_size   = '1024';
        $this->popup_attributes    = ['width' => '900', 'height' => '600', 'window_name' => 'sma_popup', 'menubar' => 'yes', 'scrollbars' => 'yes', 'status' => 'no', 'resizable' => 'yes', 'screenx' => '0', 'screeny' => '0'];

        Assets::add_module_js('players', 'players.js');
        Template::set_block('sub_nav', '_sub_nav');
    }

    public function index() {
        //$this->auth->restrict($this->busManage);
    
        Template::set('toolbar_title', lang('index_player'));
        Template::render();
    }

    public function create(){
        if ($this->input->is_ajax_request()) {
            echo $this->load->view('players/create_modal');
        } else {
            if (isset($_POST['save']) || isset($_POST['saveandnew'])) {
                if ($id = $this->save('insert')) {
                    log_activity(
                        $this->current_user->id,
                        lang('act_create_player') . ' : ' . $id,
                        'Jugadores'
                    );
                    Template::set_message(lang('player_created_success'), 'success');
                    if (isset($_POST['saveandnew'])) {
                        Template::redirect('players/create');
                    } else {
                        Template::redirect('players');
                    }
                    
                } else {
                    Template::set_message(lang('player_created_failure'), 'danger');
                }
            }
            Template::set('seasons',array_by_key_value('id', 'name', $this->season_model->find_all_by_tournament(), 'No seleccionado'));
            Template::set('toolbar_title', lang('create_player'));
            Template::render();
        }        
    }

    public function view($id = null){
        $data['player'] = $this->player_model->find($id);
        $this->load->view('players/view_modal', $data);
    }

    public function ajax_save_player(){

        $this->form_validation->set_rules('last_name', lang('lbl_last_name'), 'required');
        $this->form_validation->set_rules('first_name', lang('lbl_first_name'), 'required');
        $this->form_validation->set_rules('dni', lang('lbl_dni'), 'required');
        $this->form_validation->set_rules('birth', lang('lbl_birth'), 'required');

        if ($this->form_validation->run() === true) {
            $data = $this->player_model->prep_data($_POST);
            if ($this->player_model->update($_POST['id'], $data)) {
                $this->futuro->send_json(['error' => 0, 'msg' => 'Actualizado']);
            } else {
                $this->futuro->send_json(['error' => 1, 'msg' => 'No se actualizo']);
            }
        } else {
            $this->futuro->send_json(['error' => 1, 'msg' => validation_errors()]);
        }
    }
    public function ajax_add_player(){

        $this->form_validation->set_rules('last_name', lang('lbl_last_name'), 'required');
        $this->form_validation->set_rules('first_name', lang('lbl_first_name'), 'required');
        $this->form_validation->set_rules('dni', lang('lbl_dni'), 'required');
        $this->form_validation->set_rules('birth', lang('lbl_birth'), 'required');

        if ($this->form_validation->run() === true) {
            $data = $this->player_model->prep_data($_POST);
            if ($this->player_model->insert($data)) {
                $this->futuro->send_json(['error' => 0, 'msg' => 'Agregado']);
            } else {
                $this->futuro->send_json(['error' => 1, 'msg' => 'No se agrego']);
            }
        } else {
            $this->futuro->send_json(['error' => 1, 'msg' => validation_errors()]);
        }        
    }

    public function edit() {
        //$this->auth->restrict($this->busEdit);
        $id = (int) $this->uri->segment(3);
        if (empty($id)) {
            Template::set_message(lang('invalid_id'), 'danger');
            redirect('players');
        }
        if (isset($_POST['save']) || isset($_POST['saveandnew'])) {
            if ($this->save('update', $id)) {
                log_activity(
                    $this->current_user->id,
                    lang('act_update_player') . ' : ' . $id,
                    'Jugadores'
                );
                Template::set_message(lang('player_edit_success'), 'success');
                if (isset($_POST['saveandclose'])) {
                    Template::redirect('players');
                }
            } else {
                Template::set_message(lang('player_edit_failure'), 'danger');
            }
        }

        Template::set('seasons',array_by_key_value('id', 'name', $this->season_model->find_all_by_tournament(), 'No seleccionado'));
        Template::set('toolbar_title', lang('edit_player'));
        
        Template::set('player', $this->player_model->find($id));
        Template::render();
    }

    public function delete($id = null) {
        //$this->auth->restrict($this->busDelete);
        if ($this->input->get('id')) {
            $id = $this->input->get('id');
        }

        if ($this->player_model->delete($id)) {
            log_activity(
                $this->current_user->id,
                lang('action_delete_player') . ' : ' . $id,
                'Jugadores'
            );
            header('Content-Type: application/json');
            die(json_encode(['error' => 0, 'msg' => lang('player_deleted_success')]));
            exit;
        }        
        Template::set_message(lang('player_deleted_success'), 'success');
        Template::redirect('players');
    }
    public function actions() {

        $this->form_validation->set_rules('form_action', lang('form_action'), 'required');

        if ($this->form_validation->run() == true) {
            if (!empty($_POST['val'])) {

                if ($this->input->post('form_action') == 'delete') {                
                    foreach ($_POST['val'] as $k => $v) {
                        $this->player_model->delete($v);
                        log_activity(
                            $this->current_user->id,
                            lang('act_delete_player') . ' : ' . $v,
                            'Jugadores'
                        );
                    }
                    Template::set_message(lang('players_deleted_success'), 'success');
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
        $this->form_validation->set_rules('last_name', lang('lbl_last_name'), 'required');
        $this->form_validation->set_rules('first_name', lang('lbl_first_name'), 'required');
        $this->form_validation->set_rules('dni', lang('lbl_dni'), 'required');
        $this->form_validation->set_rules('birth', lang('lbl_birth'), 'required');
        
        if ($this->form_validation->run() === false) {
            return false;
        }

        $data = $this->player_model->prep_data($_POST);

        if (isset($_FILES['photo']['name']) && !empty($_FILES['photo']['name'])) {
            $photo = $this->store_photo();
            if (isset($photo['file_name'])) {
                $data['photo'] = $photo['file_name'];
            }
        }

        if ($type == 'insert') {
            $id = $this->player_model->insert($data);
            if (is_numeric($id)) {
                $result = $id;
            }
        } else {
            $result = $this->player_model->update($id, $data);
        }
        return $result;
    }

    private function store_photo() {
        $config['upload_path'] = $this->upload_path;
        $config['allowed_types'] = $this->image_types;
        $config['max_size'] = 2000;
        $config['max_width'] = 2000;
        $config['max_height'] = 2000;
        $config['file_name'] = "pl" . uniqid();

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('photo')) {
            return $this->upload->display_errors();
        } else {
            $photo = $this->upload->file_name;
            $this->load->library('image_lib');
            $config['image_library']  = 'gd2';
            $config['source_image']   = $this->upload_path . $photo;
            $config['new_image']      = $this->thumbs_path . $photo;
            $config['maintain_ratio'] = true;
            $config['width']          = 75;
            $config['height']         = 75;
            $this->image_lib->clear();
            $this->image_lib->initialize($config);
            $this->image_lib->resize();
            // if (!$this->image_lib->resize()) {
            //     echo $this->image_lib->display_errors();
            // }
            return $this->upload->data();
        }
    }

    // Methods Ajax
    function get_players() {
        if (!$this->input->is_ajax_request()) {
            redirect('404', 'refresh');
        } else {
            $this->load->library('datatables');
            $edit_player = '<a href="' . site_url('players/edit/$1') . '"><i class="fa fa-edit"></i> ' . lang('action_edit_player') . '</a>';
            $delete_link = "<a href='#' class='tip po' title='<b>" . $this->lang->line('action_delete_player') . "</b>' data-content=\"<p>"
                . lang('r_u_sure') . "</p><a class='btn btn-danger po-delete-player' id='a__$1' href='" . site_url('players/delete/$1') . "'>"
                . lang('i_m_sure') . "</a> <button class='btn po-close'>" . lang('no') . "</button>\"  rel='popover'><i class=\"fa fa-trash-o\"></i> "
                . lang('action_delete_player') . '</a>';
            $action = '<div class="text-center"><div class="btn-group text-left">'
                . '<button type="button" class="btn btn-default btn-xs btn-primary dropdown-toggle" data-toggle="dropdown">'
                . lang('actions') . ' <span class="caret"></span></button><ul class="dropdown-menu pull-right" role="menu">';

            $action .= '<li>' . $edit_player . '</li>';
            $action .= '<li>' . $delete_link . '</li>';
            $action .= '</ul></div></div>';
            $this->datatables->set_database('joomla');
            $this->datatables
                ->select('t1.id as id, t1.photo, t1.last_name, t1.first_name, t1.dni, t1.birth, t1.shortname')
                ->from('co_bl_players as t1')
                //->edit_column('status', '$1__$2', 'status, id')
                //->edit_column('name', '$1__$2', 'name, id')
                ->add_column('Actions', $action, 'id');

            echo $this->datatables->generate();
        }
    }

    function suggestions($term = null, $limit = null){
        if ($this->input->get('term')) {
            $term = $this->input->get('term', true);
        }
        $limit           = $this->input->get('limit', true);
        $rows['results'] = $this->player_model->get_player_suggestions($term, $limit);
        $this->futuro->send_json($rows);
    }

}