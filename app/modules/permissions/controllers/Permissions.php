<?php

defined('BASEPATH') || exit('No direct script access allowed');

/**
 * Bonfire
 *
 * An open source project to allow developers to jumpstart their development of
 * CodeIgniter applications.
 *
 * @package   Bonfire
 * @author    Bonfire Dev Team
 * @copyright Copyright (c) 2011 - 2018, Bonfire Dev Team
 * @license   http://opensource.org/licenses/MIT The MIT License.
 * @link      http://cibonfire.com
 * @since     Version 1.0
 * @filesource
 */

/**
 * Permissions Settings Context
 *
 * Allows the management of the Bonfire permissions.
 *
 * @package Bonfire\Modules\Permissions\Controllers\Settings
 * @author  Bonfire Dev Team
 * @link    http://cibonfire.com/docs
 *
 */
class Permissions extends MY_Controller {

    /**
     * Sets up the require permissions and loads required classes
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();

        $this->auth->restrict('Bonfire.Permissions.View');
        $this->auth->restrict('Bonfire.Permissions.Manage');

        $this->load->model('permission_model');
        $this->lang->load('permissions');
        $this->load->helper('inflector');

        Assets::add_module_js('permissions', 'permissions.js');
        Template::set_block('sub_nav', '_sub_nav');
    }

    /**
     * Displays a list of all permissions with pagination
     *
     * @return void
     */
    public function index() {
        // Deleting anything?
        if (isset($_POST['delete'])) {
            $checked = $this->input->post('checked');

            if (!empty($checked) && is_array($checked)) {
                $result = false;
                foreach ($checked as $pid) {
                    $result = $this->permission_model->delete($pid);
                }

                if ($result) {
                    Template::set_message(count($checked) . ' ' . lang('perm_deleted') . '.', 'success');
                } else {
                    Template::set_message(lang('perm_del_failure') . $this->permission_model->error, 'danger');
                }
            } else {
                Template::set_message(lang('perm_del_error') . $this->permission_model->error, 'danger');
            }
        }

        Template::set('limit', $this->settings_lib->item('site.list_limit'));
        Template::set("toolbar_title", lang("perm_manage"));
        Template::render();
    }

    /**
     * Create a new permission in the database
     *
     * @return void
     */
    /* public function create_back() {
        if (isset($_POST['save'])) {
            if ($this->savePermissions()) {
                Template::set_message(lang("perm_create_success"), 'success');
                redirect('permissions');
            }
        }

        Template::set('toolbar_title', lang("perm_create_new_button"));
        Template::set_view('permission_form');
        Template::render();
    } */

    /**
     * Edit a permission record
     *
     * @return void
     */
    /* public function edit_back() {
        $id = (int) $this->uri->segment(3);
        if (empty($id)) {
            Template::set_message(lang("perm_invalid_id"), 'danger');
            redirect('permissions');
        }

        if (isset($_POST['save'])) {
            if ($this->savePermissions('update', $id)) {
                Template::set_message(lang("perm_edit_success"), 'success');
            }
        }

        Template::set('permissions', $this->permission_model->find($id));
        Template::set('toolbar_title', lang("perm_edit_heading"));
        Template::set_view('permission_form');
        Template::render();
    } */

    /**
     * Save the permission record to the database
     *
     * @param string $type The type of save operation (insert or edit)
     * @param int    $id   The record ID in the case of edit
     *
     * @return bool
     */
    private function savePermissions($type = 'insert', $id = 0) {
        $this->form_validation->set_rules('name', 'lang:bf_name', 'required|trim|max_length[30]');
        $this->form_validation->set_rules('description', 'lang:bf_description', 'trim|max_length[100]');
        $this->form_validation->set_rules('status', 'lang:bf_status', 'required|trim');
        if ($this->form_validation->run() === false) {
            return false;
        }

        unset($_POST['submit'], $_POST['save']);

        if ($type == 'insert') {
            $id = $this->permission_model->insert($_POST);
            return is_numeric($id);
        } elseif ($type == 'update') {
            return $this->permission_model->update($id, $_POST);
        }

        // Unsupported value for $type.
        return false;
    }

    /*
     * Event Ajax - List permissions
     */

    public function create() {
        $data['title'] = '<i class="fa fa-edit"></i> Agregar';
        $data['action'] = 'create';
        echo $this->load->view('permissions/form', $data, TRUE);
    }

    public function permissionsActions() {

        $this->form_validation->set_rules('form_action', lang('form_action'), 'required');

        if ($this->form_validation->run() == true) {
            if (!empty($_POST['val'])) {

                if ($this->input->post('form_action') == 'delete') {
                    $qt = 0;
                    $ids = '';
                    foreach ($_POST['val'] as $k => $v) {
                        $this->permission_model->delete($v);
                        $qt++;
                        $ids .= $v . ',';
                    }
                    log_activity(
                        $this->current_user->id,
                        lang('act_deleted_permission') . ' : ' . $qt . ' con id: ' . substr($ids, 0, -1),
                        'permissions'
                    );
                    Template::set_message(lang('perm_deleted_success'), 'success');

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

    // AJAX
    function getPermissions() {
        if (!$this->input->is_ajax_request()) {
            redirect('404', 'refresh');
        } else {
            $this->load->library('datatables');
            $this->datatables
                ->select('t1.permission_id as id, t1.name as name, t1.description as to, t1.status as status')
                ->from('permissions as t1')
                ->edit_column('status', '$1__$2', 'status, id')
                ->edit_column('name', '$1__$2', 'name, id')
                ->add_column('Actions', "<div class=\"text-center\"><a href='" . site_url('permissions/edit/$1') . "' class='tip' title='" . lang('edit_permission') . "'><i class=\"fa fa-edit\"></i></a></div>", 'id');

            echo $this->datatables->generate();
        }
    }

    public function edit($permId = '') {

        $data['permission'] = $this->permission_model->find($permId);
        $data['action'] = 'edit';
        $data['title'] = '<i class="fa fa-edit"></i> Editar';
        echo $this->load->view('permissions/form', $data, TRUE);
    }

    public function updatePermission() {
        $this->form_validation->set_rules($this->permission_model->get_validation_rules('update'));
        $data = $this->permission_model->prep_data($_POST);

        if ($this->form_validation->run($this) == TRUE && isset($_POST['id'])) {
            if ($this->permission_model->update($_POST['id'], $data)) {
                log_activity(
                    $this->current_user->id,
                    lang('act_update_activity') . ' : ' . $_POST['id'],
                    'Permisos'
                );
                echo json_encode(['error' => 0, 'msg' => lang('perm_edit_success')]);
            } else {
                echo json_encode(['error' => 1, 'msg' => lang('perm_edit_failure')]);
            }
        } else {
            echo json_encode(['error' => 1, 'msg' => validation_errors()]);
        }
    }

    public function createPermission() {
        $this->form_validation->set_rules($this->permission_model->get_validation_rules('insert'));
        $data = $this->permission_model->prep_data($_POST);
        if ($this->form_validation->run() == TRUE) {
            if ($id = $this->permission_model->insert($data)) {
                log_activity(
                    $this->current_user->id,
                    lang('act_create_activity') . ' : ' . $id,
                    'Permisos'
                );
                echo json_encode(['error' => 0, 'msg' => lang('perm_created_success')]);
            } else {
                echo json_encode(['error' => 1, 'msg' => lang('perm_created_failure')]);
            }
        } else {
            echo json_encode(['error' => 1, 'msg' => validation_errors()]);
        }
    }

}