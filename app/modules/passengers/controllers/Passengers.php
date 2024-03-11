<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Passengers extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->lang->load('passengers');
        $this->load->model(array('people/people_model', 'passenger_model'));
        $this->load->helper(array('array', 'customer'));

        Assets::add_module_js('passengers', 'passengers.js');
        Template::set_block('sub_nav', '_sub_nav');
    }

    public function index() {
        Template::set('toolbar_title', lang('management_customers'));
        Template::render();
    }

    public function import() {
        $this->form_validation->set_rules('userfile', lang('upload_file'), 'xss_clean');

        if ($this->form_validation->run() == true) {
            if (isset($_FILES['userfile'])) {
                $this->load->library('upload');
                $config['upload_path'] = $this->digital_upload_path;
                $config['allowed_types'] = 'csv';
                $config['max_size'] = $this->allowed_file_size;
                $config['overwrite'] = true;
                $config['encrypt_name'] = true;
                $config['max_filename'] = 25;
                $this->upload->initialize($config);

                if (!$this->upload->do_upload()) {
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('danger', $error);
                    Template::set_message(lang('import_empty'), 'warning');
                    Template::redirect('passengers/importStudents');
                }

                $csv = $this->upload->file_name;

                $arrResult = [];
                $handle = fopen($this->digital_upload_path . $csv, 'r');
                if ($handle) {
                    while (($row = fgetcsv($handle, 5000, ',')) !== false) {
                        $arrResult[] = $row;
                    }
                    fclose($handle);
                }

                $titles = array_shift($arrResult);
                $insert = [];
                $levels = array('P', 'S', 'T', 'U', 'p', 's', 't', 'u');
                $i = 0;
                $aux = [];
                foreach ($arrResult as $key => $value) {
                    $dni = isset($value[2]) ? trim($value[2]) : '';

                    if (!$this->passenger_model->existPassenger($dni)) {
                        if (!in_array($dni, $aux)) {
                            $insert[] = array(
                                'type' => 2, // student
                                'level' => isset($value[3]) && in_array($value[3], $levels) ? strtoupper(trim($value[3])) : '',
                                'dni' => $dni,
                                'first_name' => isset($value[1]) ? trim($value[1]) : '',
                                'last_name' => isset($value[0]) ? trim($value[0]) : ''
                            );
                            array_push($aux, $dni);
                        }
                    }
                }

                if (!empty($insert) && $this->passenger_model->insert_batch($insert)) {
                    log_activity(
                        $this->current_user->id,
                        lang('activity_import_teacher') . ' : ' . count($insert),
                        'Pasajeros'
                    );
                    Template::set_message(lang('import_success') . count($insert), 'success');
                    redirect('passengers/students');
                } else {
                    Template::set_message(lang('import_empty'), 'warning');
                }
            }
        }

        Template::set('toolbar_title', lang('import_by_cvs'));
        Template::render();
    }

    public function create() {
        $this->load->model('schools/school_model');
        $data['schools'] = $this->school_model->getSchools();
        echo $this->load->view('passengers/create', $data, TRUE);
    }

    public function edit() {
        $id = (int) $this->uri->segment(3);
        if (empty($id)) {
            Template::set_message(lang('invalid_id'), 'danger');
            redirect('passengers');
        }

        if (isset($_POST['delete'])) {
            if ($this->passenger_model->delete($id)) {
                Template::set_message(lang('customer_deleted_success'), 'success');
                redirect('passengers');
            }
        }

        if (isset($_POST['save'])) {
            if ($this->save('update', $id)) {
                log_activity(
                    $this->current_user->id,
                    lang('activity_update_teacher') . ' : ' . "$id",
                    'Pasajeros'
                );
                Template::set_message(lang('customer_edit_success'), 'success');
            } else {
                Template::set_message(lang('customer_edit_failure'), 'danger');
            }
        }

        // schools by docente
        $this->load->model('passengers/passenger_school_model');
        $this->passenger_school_model->select('passengers_schools.id as id,name');
        $this->passenger_school_model->join('schools', 'schools.id = passengers_schools.school_id', 'inner');
        $this->passenger_school_model->where('passenger_id', $id);
        $pbs = $this->passenger_school_model->find_all();
        $aux = [];
        if (is_array($pbs) && !empty($pbs)) {
            $this->load->model('passengers/passenger_tramo_model');
            foreach ($pbs as $k => $v) {
                $aux[] = array(
                    'id' => $v->id,
                    'name' => $v->name,
                    'tramos' => $this->passenger_tramo_model->getPointsAll($v->id)
                );
            }
        }
        Template::set('pbs', $aux);

        // Schools
        $this->load->model('schools/school_model');
        $this->school_model->order_by('name', 'asc');
        Template::set('schools', array_by_key_value('id', 'name', $this->school_model->find_all(), '--Seleccione una escuela a agregar--'));

        // Cities
        $this->load->model('cities/city_model');
        Template::set('cities', $this->city_model->getCities());

        Template::set('customer', $this->passenger_model->getPassenger($id));
        Template::set('toolbar_title', lang('edit_customer'));
        Template::render();
    }

    public function delete($id = null) {
        if ($this->input->get('id')) {
            $id = $this->input->get('id');
        }

        if ($this->passenger_model->delete($id)) {
            if ($this->input->is_ajax_request()) {
                log_activity(
                    $this->current_user->id,
                    lang('activity_delete_customer') . ' : ' . $id,
                    'Clientes'
                );
                header('Content-Type: application/json');
                die(json_encode(['error' => 0, 'msg' => lang('customer_deleted_success')]));
                exit;
            }
            Template::set(lang('abono_deleted_success'), 'success');
            return redirect('abonos');
        }
    }

    public function actions() {

        $this->form_validation->set_rules('form_action', lang('form_action'), 'required');

        if ($this->form_validation->run() == true) {
            if (!empty($_POST['val'])) {

                if ($this->input->post('form_action') == 'delete') {
                    foreach ($_POST['val'] as $k => $v) {
                        $this->passenger_model->delete($v);
                    }
                    Template::set_message(lang('customer_deleted_success'), 'success');

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
                    $filename = 'teachers_' . date('Y_m_d_H_i_s');
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

        $this->form_validation->set_rules('dni', lang('lbl_dni'), 'trim|required');
        $this->form_validation->set_rules('last_name', lang('lbl_last_name'), 'trim|required');
        $this->form_validation->set_rules('first_name', lang('lbl_first_name'), 'trim');

        if ($this->form_validation->run() === false) {
            return false;
        }

        $passenger = $this->passenger_model->prep_data($_POST);
        $people = $this->people_model->prep_data($_POST);

        if ($type == 'insert') {
            $passenger['type'] = 1;

            $id = $this->passenger_model->insert($passenger);
            if (is_numeric($id)) {
                // Insertamos las escuelas asociadas
                if (isset($_POST['schools']) && is_array($_POST['schools'])) {
                    $aux = array();
                    foreach ($_POST['schools'] as $k => $v) {
                        $aux[] = array(
                            'school_id' => $v,
                            'passenger_id' => $id
                        );
                    }
                    $this->load->model('passengers/passenger_school_model');
                    $this->passenger_school_model->insert_batch($aux);
                }
                $return = $id;
            }
        } else {
            // modificamos los datos como persona
            $this->people_model->update($this->input->post('people_id'), $people);
            $return = $this->passenger_model->update($id, $passenger);
        }

        return $return;
    }

    public function download() {
        if (!empty($_GET['file'])) {
            $fileName = basename($_GET['file']);
            $filePath = FCPATH . 'assets/cvs/' . $fileName;
            if (!empty($fileName) && file_exists($filePath)) {
                // Define headers
                header("Cache-Control: public");
                header("Content-Description: File Transfer");
                header("Content-Disposition: attachment; filename=$fileName");
                //header("Content-Type: application/zip");
                header("Content-Transfer-Encoding: binary");

                // Read the file
                readfile($filePath);
                exit;
            } else {
                echo 'El archivo no existe.';
            }
        }
    }

    function getPassengers() {
        if (!$this->input->is_ajax_request()) {
            redirect('404', 'refresh');
        } else {

            $delete_link = "<a href='#' class='tip po' title='<b>" . $this->lang->line('delete_customer') . "</b>' data-content=\"<p>"
                . lang('r_u_sure') . "</p><a class='btn btn-danger po-delete-customer' id='a__$1' href='" . site_url('passengers/delete/$1') . "'>"
                . lang('i_m_sure') . "</a> <button class='btn po-close'>" . lang('no') . "</button>\"  rel='popover'><i class=\"fa fa-trash-o\"></i> "
                . lang('delete_customer') . '</a>';

            $action = '<div class="text-center"><div class="btn-group text-left">'
                . '<button type="button" class="btn btn-default btn-xs btn-primary dropdown-toggle" data-toggle="dropdown">'
                . lang('actions') . ' <span class="caret"></span></button><ul class="dropdown-menu pull-right" role="menu">
	            <li><a href="' . site_url('passengers/edit/$1') . '"><i class="fa fa-edit"></i> ' . lang('edit_customer') . '</a></li><li class="divider"></li><li> ' . $delete_link . '</li></ul></div></div>';

            $this->load->library('datatables');
            $this->datatables
                ->select('t1.id as id, concat(t2.last_name," ",t2.first_name) as alias, t2.dni,  t1.type, t3.name as from_default, t4.name as to_default')
                ->from('passengers as t1')
                ->join('people as t2', 't2.id = t1.people_id', 'left')
                ->join('cities as t3', 't3.id = t1.from_default', 'left')
                ->join('cities as t4', 't4.id = t1.to_default', 'left')
                ->join('cities as t5', 't5.id = t1.address_city', 'left')
                ->edit_column('alias', '$1__$2', 'alias, id')
                //->add_column('Actions', "<div class=\"text-center\"><a href='" . site_url('passengers/editTeacher/$1') . "' class='tip' title='" . lang('edit_teacher') . "'><i class=\"fa fa-edit\"></i></a></div>", 'id');
                ->add_column('Actions', $action, 'id');

            echo $this->datatables->generate();
        }
    }

    function deleteSchool() {
        if (!$this->input->is_ajax_request()) {
            redirect('404', 'refresh');
        } else {
            $this->load->model('passengers/passenger_school_model');
            if ($this->passenger_school_model->delete($_POST['ps'])) {
                echo json_encode(['error' => 0, 'mge' => 'Elimiando']);
            } else {
                echo json_encode(['error' => 0, 'mge' => 'Elimiando']);
            }
        }
    }

    function deleteTramo() {
        if (!$this->input->is_ajax_request()) {
            redirect('404', 'refresh');
        } else {
            $this->load->model('passengers/passenger_tramo_model');
            if ($this->passenger_tramo_model->delete($_POST['tr'])) {
                echo json_encode(['error' => 0, 'mge' => 'Eliminado']);
            } else {
                echo json_encode(['error' => 1, 'mge' => 'Error']);
            }
        }
    }

    // Agregar una escuela a un docente
    function addSchool() {
        if (!$this->input->is_ajax_request()) {
            redirect('404', 'refresh');
        } else {
            $data = array(
                'passenger_id' => $_POST['passenger'],
                'school_id' => $_POST['school']
            );
            $this->load->model('passengers/passenger_school_model');
            if ($id = $this->passenger_school_model->insert($data)) {
                $this->load->model('schools/school_model');
                $this->school_model->order_by('name', 'asc');
                $school = $this->school_model->find($_POST['school']);
                $html_school = '<p><span class="btn-sm btn-danger delete-school" id="' . $id . '"><i class="fa fa-close"></i></span> ' . $school->name . '</p>';

                $data['id'] = $id;
                $this->load->model('cities/city_model');
                $data['cities'] = $this->city_model->getCities();
                $this->load->model('schools/school_model');
                $data['city'] = $this->school_model->find($_POST['school']);
                $html_tramo = $this->load->view('passengers/fieldsetTramos', $data, TRUE);
                echo json_encode(array('school' => $html_school, 'tramo' => $html_tramo));
            }
        }
    }

    // Agregar un punto origen-destino de un pasajero
    function addTramo() {
        if (!$this->input->is_ajax_request()) {
            redirect('404', 'refresh');
        } else {
            $data = array(
                'passenger_school_id' => $_POST['ps'],
                'ffrom' => $_POST['from'],
                'tto' => $_POST['to']
            );
            $this->load->model('passengers/passenger_tramo_model');
            if ($id = $this->passenger_tramo_model->insert($data)) {
                $pts = $this->passenger_tramo_model->getPoints($id);

                $html = '<p><span class="btn-sm btn-danger delete-tramo" id="tr_' . $pts->id . '"><i class="fa fa-close"></i></span>';
                $html .= ' <b>DESDE</b> : ' . $pts->from;
                $html .= ' | <b>HASTA</b> : ' . $pts->to . '</p>';
                echo $html;
            }
        }
    }

    function ajaxGetPassenger(){
        if ($this->input->is_ajax_request()) {
            $people = $this->people_model->find_by('dni', $_POST['dni']);
            
            echo json_encode($people);
        }
    }

    function ajaxSaveCreate() {
        if (!$this->input->is_ajax_request()) {
            redirect('404', 'refresh');
        } else {

            $this->form_validation->set_rules('dni', lang('lbl_dni'), 'trim|required|is_numeric|max_length[11]');
            $this->form_validation->set_rules('last_name', lang('lbl_last_name'), 'trim|required');
            $this->form_validation->set_rules('first_name', lang('lbl_first_name'), 'trim');

            if ($this->form_validation->run() === false) {
                echo json_encode(['error' => 1, 'msg' => validation_errors()]);
            } else {
                $people = $this->people_model->prep_data($_POST);
                $passenger = $this->passenger_model->prep_data($_POST);
                if (isset($_POST['people_id']) && !empty($_POST['people_id'])) {
                    // actualizar persona
                    $this->people_model->update($_POST['people_id'], $people);
                    $passenger['people_id'] = $_POST['people_id'];
                } else {
                    // Insertamos la persona
                    $passenger['people_id'] = $this->people_model->insert($people);
                }    
                
                $id = $this->passenger_model->insert($passenger);
                if (is_numeric($id)) {
                    echo json_encode(['error' => 0, 'msg' => lang('customer_create_success'), 'id' => $id]);
                } else {
                    echo json_encode(['error' => 1, 'msg' => lang('customer_create_failure')]);
                }
            }
        }
    }
}

/* End of file Passengers.php */
/* Location: .//D/www/futuro-srl/app/modules/passengers/controllers/Passengers.php */