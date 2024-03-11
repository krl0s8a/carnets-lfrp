<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Employees extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->lang->load('employees');
        $this->load->model('employee_model');
        $this->config->load('personal');
        $this->load->helper(array('array', 'employee'));
        Assets::add_module_js('employees', 'employees.js');
        Assets::add_module_css('employees', 'employees.css');
        Template::set_block('sub_nav', '_sub_nav');
    }

    public function index() {
        Template::set('toolbar_title', lang('title_list_employees'));
        Template::render();
    }

    public function create() {

        if (isset($_POST['save'])) {
            if ($id = $this->save()) {
                log_activity(
                    $this->current_user->id,
                    lang('activity_create_personal') . ' : ' . "$id",
                    'Personal'
                );
                Template::set_message(lang('personal_created_success'), 'success');
                Template::redirect('employees/edit/' . $id);
            } else {
                Template::set_message(lang('personal_created_failure'), 'danger');
            }
        }
        $this->load->model('state_model');
        Template::set('states', $this->state_model->getStates());
        // localidades por provincia
        $this->load->model('cities/city_model');
        Template::set('cities', $this->city_model->getCitiesByState(2));
        Template::set('toolbar_title', lang('title_new_employee'));
        Template::render();
    }

    public function edit() {

        $id = (int) $this->uri->segment(3);
        if (empty($id)) {
            Template::set_message(lang('invalid_id'), 'danger');
            redirect('employees');
        }

        if (isset($_POST['update_personal'])) {
            if ($this->savePersonal($id)) {
                log_activity(
                    $this->current_user->id,
                    lang('activity_update_employee') . ' : ' . "$id",
                    'employees'
                );
                Template::set_message(lang('employee_edit_success'), 'success');
            } else {
                Template::set_message(lang('employee_edit_failure'), 'danger');
            }
        } elseif (isset($_POST['update_laboral'])) {
            if ($this->saveLaboral($id)) {
                log_activity(
                    $this->current_user->id,
                    lang('activity_update_personal') . ' : ' . "$id",
                    'employees'
                );
                Template::set_message(lang('laboral_edit_success'), 'success');
            } else {
                Template::set_message(lang('laboral_edit_failure'), 'danger');
            }
        } elseif (isset($_POST['update_contact'])) {
            if ($this->saveContact($id)) {
                log_activity(
                    $this->current_user->id,
                    lang('activity_update_employee') . ' : ' . "$id",
                    'employees'
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
                    'employees'
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
                    'employees'
                );
                Template::set_message(lang('doc_edit_success'), 'success');
            } else {
                Template::set_message(lang('doc_edit_failure'), 'danger');
            }
        }

        $this->load->model('employee_doc_model');
        $employee_doc = array_by_key_value('doc_id', 'due_date', $this->employee_doc_model->find_all_by('employee_id', $id));
        Template::set('employee_doc', $employee_doc);

        Template::set('doc', $this->config->item('doc'));
        $this->load->model('state_model');
        Template::set('states', $this->state_model->getStates());
        // localidades por provincia
        $this->load->model('cities/city_model');
        Template::set('cities', $this->city_model->getCitiesByState(2));
        Template::set('toolbar_title', lang('title_edit_employee'));

        $this->employee_model->join('people', 'employees.people_id = people.id', 'left');
        $this->employee_model->join('cities', 'people.city_id = cities.id', 'left');
        Template::set('employee', $this->employee_model->find($id));
        Template::render();
    }

    public function delete($id = null) {

        if ($this->input->get('id')) {
            $id = $this->input->get('id');
        }

        if ($this->employee_model->delete($id)) {
            if ($this->input->is_ajax_request()) {
                echo json_encode(['error' => 0, 'msg' => 'Eliminado']);
            }
            Template::redirect('employees');
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
        $this->form_validation->set_rules('gender', lang('field_gender'), 'trim');
        $this->form_validation->set_rules('cuil', lang('field_cuil'), 'trim|required|min_length[8]|max_length[13]');
        $this->form_validation->set_rules('dni', lang('field_dni'), 'trim|required|min_length[7]|max_length[8]');

        if ($this->form_validation->run() == TRUE) {
            $this->load->model('people/people_model');
            $data = array(
                'last_name' => $_POST['last_name'],
                'first_name' => $_POST['first_name'],
                'birth' => isset($_POST['birth']) ? formatDate($_POST['birth'], 'd/m/Y', 'Y-m-d') : '0000-00-00',
                'cuil' => $_POST['cuil'],
                'gender' => $_POST['gender']
            );
            return $this->people_model->update($_POST['people_id'], $data);
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
                'position' => $_POST['position'],
                'work_file' => $_POST['work_file'],
                'dateemployment' => isset($_POST['dateemployment']) ? formatDate($_POST['dateemployment'], 'd/m/Y', 'Y-m-d') : '0000-00-00',
                'dateemploymentend' => isset($_POST['dateemploymentend']) ? formatDate($_POST['dateemploymentend'], 'd/m/Y', 'Y-m-d') : '0000-00-00'
            );
            return $this->employee_model->update($id, $data);
        } else {
            return false;
        }
    }

    /**
     * Solo guarda informacion de contacto 
     */
    private function saveContact($id) {
        $this->form_validation->set_rules('email', lang('field_email'), 'trim|valid_email');
        $this->form_validation->set_rules('address', lang('field_address'), 'trim|max[255]');
        $data = array(
            'address' => $_POST['address'],
            'city_id' => $_POST['city_id'],
            'movil_phone' => $_POST['movil_phone'],
            'email' => $_POST['email']
        );

        if ($this->form_validation->run() == TRUE) {
            $this->load->model('people/people_model');
            return $this->people_model->update($_POST['people_id'], $data);
        } else {
            return false;
        }

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
                $rrhh = $this->employee_model->find($id);
                $data['avatar'] = $photo;
                if ($this->employee_model->update($id, $data)) {
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
                        if ($this->employee_model->delete($v)) {
                            $c++;
                        }
                    }
                    log_activity(
                        $this->current_user->id,
                        lang('activity_delete_employee') . ' : ' . "$c",
                        'employees'
                    );
                    Template::set_message(lang('employee_deleted_success'), 'success');

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
    private function saveDoc($id) {
        if ($id != null && is_numeric($id)) {
            $this->load->model('employee_doc_model');
            $this->employee_doc_model->delete_where(array('employee_id' => $id));
            if (isset($_POST['doc_id']) && is_array($_POST['doc_id'])) {
                $data = array();
                $this->load->model('employee_doc_model');
                foreach ($_POST['doc_id'] as $k => $v) {
                    $data[] = array(
                        'employee_id' => $id,
                        'doc_id' => $k,
                        'due_date' => !empty($_POST['due_date'][$k]) ? formatDate($_POST['due_date'][$k], 'd/m/Y', 'Y-m-d') : null
                    );
                }

                if ($this->employee_doc_model->insert_batch($data)) {
                    return true;
                } else {
                    return false;
                }
            }
        } else {
            return false;
        }
    }

    private function save() {

        $this->form_validation->set_rules('last_name', lang('last_name'), 'trim|required');
        $this->form_validation->set_rules('first_name', lang('first_name'), 'trim|required');
        $this->form_validation->set_rules('cuil', lang('cuil'), 'trim|required|is_unique[people.cuil]');
        $this->form_validation->set_rules('dni', lang('dni'), 'trim|required|is_unique[people.dni]');
        $this->form_validation->set_rules('work_file', lang('work_file'), 'trim|required|numeric');
        $this->form_validation->set_rules('email', lang('email'), 'trim|required|valid_email|is_unique[people.email]');
        $this->form_validation->set_rules('work_file', lang('work_file'), 'trim|required|is_unique[employees.work_file]');

        if ($this->form_validation->run() === false) {
            return false;
        }
        $this->load->model('people/people_model');
        $people = $this->people_model->prep_data($_POST);
        $people['birth'] = isset($_POST['birth']) ? formatDate($_POST['birth'], 'd/m/Y', 'Y-m-d') : '0000-00-00';

        $people_id = $this->people_model->insert($people);

        if (is_numeric($people_id)) {
            // Preparamos al empleado
            $employee = $this->employee_model->prep_data($_POST);
            $employee['dateemployment'] = isset($_POST['dateemployment']) ? formatDate($_POST['dateemployment'], 'd/m/Y', 'Y-m-d') : '0000-00-00';
            $employee['dateemploymentend'] = isset($_POST['dateemploymentend']) ? formatDate($_POST['dateemploymentend'], 'd/m/Y', 'Y-m-d') : '0000-00-00';
            $employee['people_id'] = $people_id;
            $employee_id = $this->employee_model->insert($employee);

            $result = $employee_id;
        }
        return $result;
    }

    // Methods Ajax
    function getEmployees() {
        if (!$this->input->is_ajax_request()) {
            redirect('404', 'refresh');
        } else {
            $edit_user = '<a href="' . site_url('employees/edit/$1') . '"><i class="fa fa-edit"></i> ' . lang('edit_employee') . '</a>';
            $delete_link = "<a href='#' class='tip po' title='<b>" . $this->lang->line('delete_personal') . "</b>' data-content=\"<p>"
                . lang('r_u_sure') . "</p><a class='btn btn-danger po-delete-user' id='a__$1' href='" . site_url('employees/delete/$1') . "'>"
                . lang('i_m_sure') . "</a> <button class='btn po-close'>" . lang('no') . "</button>\"  rel='popover'><i class=\"fa fa-trash-o\"></i> "
                . lang('delete_employee') . '</a>';

            $action = '<div class="text-center"><div class="btn-group text-left">'
                . '<button type="button" class="btn btn-default btn-xs btn-primary dropdown-toggle" data-toggle="dropdown">'
                . lang('actions') . ' <span class="caret"></span></button><ul class="dropdown-menu pull-right" role="menu">';

            $action .= '<li>' . $edit_user . '</li>';
            $action .= '<li>' . $delete_link . '</li>';

            $action .= '</ul></div></div>';

            $this->load->library('datatables');
            $this->datatables
                ->select('t1.id as id, last_name, first_name, t2.cuil, work_file, position, t1.dateemployment, t2.movil_phone')
                ->join('people as t2', 't1.people_id = t2.id', 'inner')
                ->from('employees as t1')
                //->where('t1.position', 'Chofer')
                ->edit_column('last_name', '$1__$2', 'last_name,id')
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