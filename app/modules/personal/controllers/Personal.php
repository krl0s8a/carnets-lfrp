<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Personal extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->lang->load('personal');
        $this->load->model('personal_model');
        $this->config->load('personal');
        $this->load->helper(array('array', 'personal'));
        Assets::add_module_js('personal', 'personal.js');
        Assets::add_module_css('personal', 'personal.css');
        Template::set_block('sub_nav', '_sub_nav');
    }

    public function index() {
        Template::set('toolbar_title', lang('mngt_personal'));
        Template::render();
    }

    public function create() {

        if (isset($_POST['save'])) {
            if ($id = $this->save('insert')) {
                log_activity(
                    $this->current_user->id,
                    lang('activity_create_personal') . ' : ' . "$id",
                    'Personal'
                );
                Template::set_message(lang('personal_created_success'), 'success');
                Template::redirect('personal/edit/' . $id);
            } else {
                Template::set_message(lang('personal_created_failure'), 'danger');
            }
        }
        $this->load->model('state_model');
        Template::set('states', $this->state_model->getStates());
        // localidades por provincia
        $this->load->model('cities/city_model');
        Template::set('cities', $this->city_model->getCitiesByState(2));
        Template::set('toolbar_title', lang('create_personal'));
        Template::render();
    }

    public function edit() {

        $id = (int) $this->uri->segment(3);
        if (empty($id)) {
            Template::set_message(lang('invalid_id'), 'danger');
            redirect('personal');
        }

        if (isset($_POST['update_personal'])) {
            if ($this->savePersonal($id)) {
                log_activity(
                    $this->current_user->id,
                    lang('activity_update_personal') . ' : ' . "$id",
                    'personal'
                );
                Template::set_message(lang('personal_edit_success'), 'success');
            } else {
                Template::set_message(lang('personal_edit_failure'), 'danger');
            }
        } elseif (isset($_POST['update_laboral'])) {
            if ($this->saveLaboral($id)) {
                log_activity(
                    $this->current_user->id,
                    lang('activity_update_personal') . ' : ' . "$id",
                    'personal'
                );
                Template::set_message(lang('laboral_edit_success'), 'success');
            } else {
                Template::set_message(lang('laboral_edit_failure'), 'danger');
            }
        } elseif (isset($_POST['update_contact'])) {
            if ($this->saveContact($id)) {
                log_activity(
                    $this->current_user->id,
                    lang('activity_update_personal') . ' : ' . "$id",
                    'personal'
                );
                Template::set_message(lang('contact_edit_success'), 'success');
            } else {
                Template::set_message(lang('contact_edit_failure'), 'danger');
            }
        } elseif (isset($_POST['update_avatar'])) {
            if ($this->saveAvatar($id)) {
                log_activity(
                    $this->current_user->id,
                    lang('activity_update_personal') . ' : ' . "$id",
                    'personal'
                );
                Template::set_message(lang('avatar_edit_success'), 'success');
            } else {
                Template::set_message(lang('avatar_edit_failure'), 'danger');
            }
        } elseif (isset($_POST['update_doc'])) {
            if ($this->saveDoc($id)) {
                log_activity(
                    $this->current_user->id,
                    lang('activity_update_personal') . ' : ' . "$id",
                    'Personal'
                );
                Template::set_message(lang('doc_edit_success'), 'success');
            } else {
                Template::set_message(lang('doc_edit_failure'), 'danger');
            }
        }

        // echo '<pre>';
        // print_r($this->personal_model->find($id));
        // echo '</pre>';
        // exit;

        $this->load->model('personal_doc_model');
        Template::set('personal_doc', array_by_key_value('doc_id', 'due_date', $this->personal_doc_model->find_all_by('personal_id', $id)));

        Template::set('doc', $this->config->item('doc'));
        $this->load->model('state_model');
        Template::set('states', $this->state_model->getStates());
        // localidades por provincia
        $this->load->model('cities/city_model');
        Template::set('cities', $this->city_model->getCitiesByState(2));
        Template::set('toolbar_title', lang('edit_personal'));
        Template::set('personal', $this->personal_model->find($id));
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
            Template::redirect('personal');
        }
    }
    // Metodos privados

    /**
     * Solo guarda datos personales
     */
    private function savePersonal($id) {
        $this->form_validation->set_rules('last_name', lang('field_last_name'), 'trim|required');
        $this->form_validation->set_rules('first_name', lang('field_first_name'), 'trim|required');
        $this->form_validation->set_rules('birth', lang('field_birth'), 'trim|min_length[10]');
        $this->form_validation->set_rules('cuil', lang('field_cuil'), 'trim|required|min_length[8]|max_length[13]');

        if ($this->form_validation->run() == TRUE) {
            $data = array(
                'last_name'  => $_POST['last_name'],
                'first_name' => $_POST['first_name'],
                'birth'      => isset($_POST['birth']) ? formatDate($_POST['birth'], 'd/m/Y', 'Y-m-d') : '0000-00-00',
                'cuil'       => $_POST['cuil'],
                'gender'     => $_POST['gender']
            );
            return $this->personal_model->update($id, $data);
        } else {
            return false;
        }
    }

    /**
     * Solo guarda datos laborales
     */
    private function saveLaboral($id) {
        $this->form_validation->set_rules('position', lang('position'), 'trim|required');
        $this->form_validation->set_rules('work_file', lang('work_file'), 'trim|required');
        $this->form_validation->set_rules('dateemployment', lang('dateemployment'), 'trim|min_length[10]');
        $this->form_validation->set_rules('dateemploymentend', lang('dateemploymentend'), 'trim|min_length[10]');

        if ($this->form_validation->run() == TRUE) {
            $data = array(
                'position'          => $_POST['position'],
                'work_file'         => $_POST['work_file'],
                'dateemployment'    => isset($_POST['dateemployment']) ? formatDate($_POST['dateemployment'], 'd/m/Y', 'Y-m-d') : '0000-00-00',
                'dateemploymentend' => isset($_POST['dateemploymentend']) ? formatDate($_POST['dateemploymentend'], 'd/m/Y', 'Y-m-d') : '0000-00-00'
            );
            return $this->personal_model->update($id, $data);
        } else {
            return false;
        }
    }

    /**
     * Solo guarda informacion de contacto 
     */
    private function saveContact($id) {
        $data = array(
            'address'     => $_POST['address'],
            'state_id'    => $_POST['state_id'],
            'city_id'     => $_POST['city_id'],
            'movil_phone' => $_POST['movil_phone']
        );
        return $this->personal_model->update($id, $data);
    }

    /**
     * Actualiza la foto de perfil
     */
    private function saveAvatar($id) {
        //validate form input
        $this->form_validation->set_rules('avatar', lang('avatar'), 'trim');
        if ($this->form_validation->run() == true) {
            if ($_FILES['avatar']['size'] > 0) {
                $this->load->library('upload');

                $config['upload_path'] = 'assets/uploads/avatars';
                $config['allowed_types'] = 'gif|jpg|png';
                //$config['max_size'] = '500';
                $config['max_width'] = 800;
                $config['max_height'] = 800;
                $config['overwrite'] = false;
                $config['encrypt_name'] = true;
                $config['max_filename'] = 25;

                $this->upload->initialize($config);

                if (!$this->upload->do_upload('avatar')) {
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('error', $error);
                    redirect($_SERVER['HTTP_REFERER']);
                }

                $photo = $this->upload->file_name;

                $this->load->helper('file');
                $this->load->library('image_lib');
                $config['image_library'] = 'gd2';
                $config['source_image'] = 'assets/uploads/avatars/' . $photo;
                $config['new_image'] = 'assets/uploads/avatars/thumbs/' . $photo;
                $config['maintain_ratio'] = true;
                $config['width'] = 150;
                $config['height'] = 150;

                $this->image_lib->clear();
                $this->image_lib->initialize($config);

                if (!$this->image_lib->resize()) {
                    echo $this->image_lib->display_errors();
                }
                $rrhh = $this->personal_model->find($id);
                $data['avatar'] = $photo;
                if ($this->personal_model->update($id, $data)) {
                    return true;
                } else {
                    return false;
                }
            } else {
                $this->form_validation->set_rules('avatar', lang('avatar'), 'required');
            }
        }
    }

    // Elimina la foto de perfil
    public function deleteAvatar($id = null, $avatar = null) {
        unlink('assets/uploads/avatars/' . $avatar);
        unlink('assets/uploads/avatars/thumbs/' . $avatar);

        $this->rrhh_model->update($id, ['avatar' => null]);
        $this->session->set_flashdata('message', lang('avatar_deleted'));
        die("<script type='text/javascript'>setTimeout(function(){ window.top.location.href = '" . $_SERVER['HTTP_REFERER'] . "'; }, 0);</script>");
        redirect($_SERVER['HTTP_REFERER']);
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

    // Methods privvados
    private function saveDoc($id = null) {

        if ($id != null && is_numeric($id)) {
            $this->load->model('personal_doc_model');
            $this->personal_doc_model->delete_where(array('personal_id' => $id));
            if (isset($_POST['doc_id']) && is_array($_POST['doc_id'])) {
                $data = array();
                $this->load->model('personal_doc_model');
                foreach ($_POST['doc_id'] as $k => $v) {
                    $data[] = array(
                        'personal_id' => $id,
                        'doc_id'      => $k,
                        'due_date'    => !empty($_POST['due_date'][$k]) ? formatDate($_POST['due_date'][$k], 'd/m/Y', 'Y-m-d') : null
                    );
                }

                if ($this->personal_doc_model->insert_batch($data)) {
                    return true;
                } else {
                    return false;
                }
            }
        } else {
            return false;
        }
    }

    private function save($type = 'insert', $id = 0) {

        $this->form_validation->set_rules('last_name', lang('last_name'), 'trim|required');
        $this->form_validation->set_rules('first_name', lang('first_name'), 'trim|required');
        $this->form_validation->set_rules('cuil', lang('cuil'), 'trim|required');
        $this->form_validation->set_rules('work_file', lang('work_file'), 'trim|required|numeric');
        $this->form_validation->set_rules('email', lang('email'), 'trim|required|valid_email');

        if ($this->form_validation->run() === false) {
            return false;
        }

        $data = $this->personal_model->prep_data($_POST);

        if ($type == 'insert') {
            $id = $this->personal_model->insert($data);
            if (is_numeric($id)) {
                $result = $id;
            }
        } else {
            $result = $this->personal_model->update($id, $data);
        }
        return $result;
    }

    // Methods Ajax
    function getPersonal() {
        if (!$this->input->is_ajax_request()) {
            redirect('404', 'refresh');
        } else {
            $edit_user = '<a href="' . site_url('personal/edit/$1') . '"><i class="fa fa-edit"></i> ' . lang('edit_personal') . '</a>';
            $delete_link = "<a href='#' class='tip po' title='<b>" . $this->lang->line('delete_personal') . "</b>' data-content=\"<p>"
                . lang('r_u_sure') . "</p><a class='btn btn-danger po-delete-user' id='a__$1' href='" . site_url('personal/delete/$1') . "'>"
                . lang('i_m_sure') . "</a> <button class='btn po-close'>" . lang('no') . "</button>\"  rel='popover'><i class=\"fa fa-trash-o\"></i> "
                . lang('delete_personal') . '</a>';

            $action = '<div class="text-center"><div class="btn-group text-left">'
                . '<button type="button" class="btn btn-default btn-xs btn-primary dropdown-toggle" data-toggle="dropdown">'
                . lang('actions') . ' <span class="caret"></span></button><ul class="dropdown-menu pull-right" role="menu">';

            $action .= '<li>' . $edit_user . '</li>';

            $action .= '<li>' . $delete_link . '</li>';

            $action .= '</ul></div></div>';

            $this->load->library('datatables');
            $this->datatables
                ->select('t1.id as id, last_name, first_name, cuil, work_file, position, movil_phone, email')
                ->from('users as t1')
                //->where('t1.position', 'Chofer')
                ->edit_column('last_name', '$1__$2', 'last_name, id')
                ->add_column('Actions', $action, 'id');

            echo $this->datatables->generate();
        }
    }

    function createUser() {
        $this->load->model('role_model');
        $data['roles'] = $this->role_model->find_all();
        echo $this->load->view('rrhh/create_user', $data, TRUE);
    }

}

/* End of file Rrhh.php */
/* Location: .//D/www/futuro-srl/app/modules/rrhh/controllers/Rrhh.php */