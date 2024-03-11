<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Routes extends MY_Controller {
    private $routeAdd = 'System.Route.Add';
    private $routeManage = 'System.Route.Manage';
    private $routeDelete = 'System.Route.Delete';
    private $routeEdit = 'System.Route.Edit';
    function __construct() {
        parent::__construct();
        $this->lang->load('routes');
        $this->load->model('route_model');
        $this->load->helper('array', 'date');

        Assets::add_module_js('routes', 'routes.js');
        Template::set_block('sub_nav', '_sub_nav');
    }

    public function index() {
        $this->auth->restrict($this->routeManage);
        Template::set('toolbar_title', lang('management_routes'));
        Template::render();
    }

    public function edit() {
        $this->auth->restrict($this->routeEdit);
        $id = (int) $this->uri->segment(3);

        if (empty($id)) {
            Template::set_message(lang('invalid_id'), 'danger');
            redirect('routes');
        }

        if (isset($_POST['route_update'])) {

            if ($this->save('update', $id)) {
                log_activity(
                    $this->current_user->id,
                    lang('activity_update_route') . ' : ' . "$id",
                    'routes'
                );
                Template::set_message(lang('route_edit_success'), 'success');
            } else {
                Template::set_message(lang('route_edit_failure'), 'danger');
            }
        }

        $arr = $this->route_model->find($id);
        $this->load->model('routes/route_city_model');
        $this->route_city_model->order_by('order', 'asc');
        $cities_route = $this->route_city_model->find_all_by('route_id', $arr->id);

        $this->load->model('cities/city_model');
        $cities = $this->city_model->getCities();

        $this->load->model('lines/line_model');
        Template::set('lines', $this->line_model->getLines());

        Template::set('toolbar_title', lang('edit_route'));
        Template::set('route', $arr);
        Template::set('cities_route', $cities_route);
        Template::set('cities', $cities);
        Template::render();
    }

    public function create() {
        $this->auth->restrict($this->routeAdd);
        if (isset($_POST['save'])) {
            if ($id = $this->save('insert')) {
                $this->saveLocations($id);
                log_activity(
                    $this->current_user->id,
                    lang('activity_create_route') . ' : ' . "$id",
                    'routes'
                );
                Template::set_message(lang('route_create_success'), 'success');
                redirect('routes');
            } else {
                Template::set_message(lang('route_create_failure'), 'danger');
            }
        }

        $this->load->model('lines/line_model');
        Template::set('lines', $this->line_model->getLines());

        $this->load->model('cities/city_model');
        Template::set('cities', $this->city_model->getCities());
        Template::set('toolbar_title', lang('create_route'));
        Template::render();
    }

    /**
     * Acciones sobre un abonos (borrar, excel e imprimir)
     */
    public function routesActions() {

        $this->form_validation->set_rules('form_action', lang('form_action'), 'required');

        if ($this->form_validation->run() == true) {
            if (!empty($_POST['val'])) {

                if ($this->input->post('form_action') == 'delete') {
                    $this->auth->restrict($this->routeDelete);
                    $cnt = 0;
                    foreach ($_POST['val'] as $k => $v) {
                        if ($this->route_model->delete($v)) {
                            $cnt++;
                        }
                    }
                    log_activity(
                        $this->current_user->id,
                        lang('activity_delete_route') . ' : ' . "$cnt",
                        'routes'
                    );
                    Template::set_message(lang('route_deleted_success'), 'success');

                    Template::redirect($_SERVER['HTTP_REFERER']);
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

    /**
     * Metodos privados
     */
    private function saveLocations($id) {
        if (isset($_POST['index_arr']) && $_POST['index_arr'] != '') {
            $index_arr = explode("|", $_POST['index_arr']);

            $this->load->model('routes/route_city_model');
            $data = array();
            foreach ($index_arr as $k => $index) {
                if (isset($_POST['city_id_' . $index]) && (int) $_POST['city_id_' . $index] > 0) {
                    $city_id = $_POST['city_id_' . $index];
                    $length = isset($_POST['length_' . $index]) ? $_POST['length_' . $index] : 0;
                    $data[] = array(
                        'route_id' => $id,
                        'city_id'  => $city_id,
                        'order'    => $k + 1,
                        'length'   => $length
                    );
                    if ($k == 0) {
                        $update['from_city_id'] = $city_id;
                    }
                    if ($k == count($index_arr) - 1) {
                        $update['to_city_id'] = $city_id;
                    }
                }
            }

            $this->route_city_model->insert_batch($data);
        }
        $this->route_model->update($id, $update);
    }

    private function save($type = 'insert', $id = 0) {

        $data = $this->route_model->prep_data($_POST);

        if ($type == 'insert') {
            $id = $this->route_model->insert($data);
            if (is_numeric($id)) {
                $result = $id;
            }
        } else {
            // Actulizamos las localidades del recorrido
            $this->load->model('routes/route_city_model');
            // Borramos previamente las localidades del recorrido
            $this->route_city_model->delete_where(array('route_id' => $id));
            // Insertamos nuevamente las localidades
            $this->saveLocations($id);
            $result = $this->route_model->update($id, $data);
        }
        return $result;
    }

    /**
     * Peticiones AJAX
     */
    function getRoutes() {
        if (!$this->input->is_ajax_request()) {
            redirect('404', 'refresh');
        } else {
            $this->load->library('datatables');
            $this->datatables
                ->select('t1.id as id, t1.name as name, t4.name as line, t1.direction, t2.name as from, t3.name as to, t1.status as status')
                ->from('routes as t1')
                ->join('cities as t2', 't2.id = t1.from_city_id', 'left')
                ->join('cities as t3', 't3.id = t1.to_city_id', 'left')
                ->join('lines as t4', 't4.id = t1.line_id', 'left')
                ->edit_column('status', '$1__$2', 'status, id')
                ->edit_column('name', '$1__$2', 'name, id');
            //->add_column('Actions', "<div class=\"text-center\"><a href='" . site_url('routes/edit/$1') . "' class='tip' title='" . lang('edit_rrhh') . "'><i class=\"fa fa-edit\"></i></a></div>", 'id');

            echo $this->datatables->generate();
        }
    }

    function ajaxGetRowLocationHTML() {
        $this->load->model('cities/city_model');
        $data['cities'] = $this->city_model->getCities();
        echo $this->load->view('routes/row_location', $data, TRUE);
    }
}