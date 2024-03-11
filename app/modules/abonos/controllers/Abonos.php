<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Abonos extends MY_Controller {

    // Abonos generados para vista previa
    private $arr = [];
    private $message = '';

    function __construct() {
        parent::__construct();
        $this->lang->load('abonos');
        $this->load->model('abonos/abono_model');
        $this->load->config('passenger');
        $this->load->helper(array('date', 'number', 'array'));
        Assets::add_module_js('abonos', 'abonos.js');
        Assets::add_module_css('abonos', 'abonos.css');
        Template::set_block('sub_nav', '_sub_nav');
    }

    public function index() {
        if (isset($_POST['form_action'])) {
            if (!empty($_POST['val'])) {
                if ($this->input->post('form_action') == 'delete') {
                    $c = 0;
                    foreach ($_POST['val'] as $id) {
                        if ($id != $this->session->userdata('user_id')) {
                            if ($this->user_model->delete($id)) {
                                $c++;
                            }
                        }
                    }
                    if ($c > 0) {
                        Template::set_message(lang('us_deleted') . $c, 'success');
                    } else {
                        Template::set_message(lang('us_deleted_0'), 'danger');
                    }
                }
                if ($this->input->post('form_action') == 'export_excel') {
                    Template::set_message('Todavia falta esta funcionalidad', 'warning');
                }
            } else {
                Template::set_message(lang('us_no_selected'), 'danger');
            }
        }

        $this->load->helper('date_helper');

        Template::set('per_page', $this->settings_lib->item('site.list_limit'));
        Template::set('toolbar_title', lang('management_abonos'));
        Template::render();
    }

    public function recover(){
        
        $this->abono_model->select('abonos.id, passengers.people_id');
        $this->abono_model->join('passengers_schools ', 'abonos.passenger_school_id = passengers_schools.id', 'left');
        $this->abono_model->join('passengers', 'passengers.id = passengers_schools.passenger_id', 'left');
        $rows = $this->abono_model->find_all();

        foreach ($rows as $v) {
            $data = array(
                'people_id' => $v->people_id
            );

            $this->abono_model->update($v->id, $data);
        }
    }
    public function create() {

        if (isset($_POST['save'])) {
            if ($id = $this->saveAbono('insert')) {
                log_activity(
                    $this->current_user->id,
                    lang('activity_create_abono') . ' : ' . $_POST['number_abono'],
                    'Abonos'
                );
                Template::set_message(lang('abono_created_success'), 'success');
                Template::redirect('abonos');
            } else {
                Template::set_message(lang('abono_created_failure'), 'danger');
            }
        }
        $this->load->model('passengers/passenger_model');
        ;
        Template::set('passengers', $this->passenger_model->arrPassengers());

        // Escuelas
        $this->load->model('schools/school_model');
        Template::set('schools', $this->school_model->getSchools());
        // Localidades
        $this->load->model('cities/city_model');
        Template::set('cities', $this->city_model->getCities());
        Template::set('toolbar_title', lang('create_abono'));
        Template::render();
    }

    /**
     * Ver y/o modificar dats de un abono
     */
    public function edit($id) {

        if (isset($_POST['save'])) {
            if ($this->saveAbono('update', $id)) {
                Template::set_message(lang('abono_edit_success'), 'success');
                log_activity(
                    $this->current_user->id,
                    lang('activity_update_abono') . ' : ' . "$id",
                    'Abonos'
                );
            } else {
                Template::set_message(lang('abono_edit_failure'), 'danger');
            }
        } else if (isset($_POST['print'])) {
            $data[] = $id;
            $this->printAbono($data);
        } else if(isset($_POST['delete'])){
            $this->abono_model->delete($id);
            Template::set('Eliminado', 'success');
            return redirect('abonos');
        }

        $abono = $this->abono_model->getAbono($id);

        $this->load->model('cities/city_model');
        Template::set('cities', $this->city_model->getCities());
        // Tarifas
        $this->load->model('tariffs/tariff_model');
        $this->tariff_model->where('status', 'T');
        Template::set('tariffs', array_by_key_value('id', 'name', $this->tariff_model->find_all_by('line_id', $abono->line_id)));

        $this->load->model('lines/line_model');
        Template::set('lines', $this->line_model->getLinesByFromTo($abono->from, $abono->to));
        // Escuelas
        $this->load->model('schools/school_model');
        Template::set('schools', array_by_key_value('id', 'name', $this->school_model->find_all()));

        Template::set('abono', $abono);
        Template::set('typepassenger', config_item('typepassenger'));
        Template::set('toolbar_title', lang('edit_abono'));
        Template::render();
    }

    /**
     * Eliminar un abono
     */
    public function delete($id = null) {
        //$this->sma->checkPermissions(null, true);

        if ($this->input->get('id')) {
            $id = $this->input->get('id');
        }

        if ($this->abono_model->delete($id)) {
            if ($this->input->is_ajax_request()) {
                log_activity(
                    $this->current_user->id,
                    lang('activity_delete_abono') . ' : ' . $id,
                    'Abonos'
                );
                header('Content-Type: application/json');
                die(json_encode(['error' => 0, 'msg' => lang('abono_deleted_success')]));
                exit;
            }
            Template::set(lang('abono_deleted_success'), 'success');
            return redirect('abonos');
        }
    }

    /**
     * Busqueda avanzada
     */
    public function search() {
        Template::set('toolbar_title', 'Busqueda avanzada');
        Template::render();
    }

    /**
     * Imprimir un solo abono
     */
    public function print($id = null) {
        $this->printAbono(array('0' => $id));
    }

    /**
     * Generar abonos en lote
     */
    public function createMultiple() {

        if (isset($_POST['save'])) {
            if ($this->saveAbonoMultiple()) {
                if (count($this->arr) == 0) {
                    Template::set_message('No se creo ningun abono', 'warning');
                } else {
                    Template::set_message($this->message, 'success');
                }

                Template::set('abonos', $this->arr);
                Template::set_view('abonos/forPrint');
            } else {
                Template::set_message(lang('create_abono_failure'), 'danger');
            }
        } elseif (isset($_POST['print'])) {
            $this->printAbono($_POST['abonos']);
        }

        // Escuelas
        $this->load->model('schools/school_model');
        $this->school_model->order_by('name', 'asc');
        Template::set('schools', array_by_key_value('id', 'name', $this->school_model->find_all(), lang('lbl_no_school')));

        Template::set('toolbar_title', lang('create_abono_lote'));
        Template::render();
    }

    /**
     * Reports
     */
    public function reports() {
        if (isset($_POST['generate'])) {

        }

        Template::set('toolbar_title', lang('reports'));
        Template::render();
    }

    /**
     * Print ticket
     */
    private function printAbono($d, $dir = 'asc') {
        // Cambiamos orden 
        if ($dir == 'desc') {
            $data = array_reverse($d);
        } else {
            $data = $d;
        }
        $this->load->library('pdf');
        foreach ($data as $k => $v) {
            // recuperar datos
            $print = $this->settings_lib->item('allow_print_number_ticket');
            $ticket = $this->abono_model->getAbono($v);
            $type = 'DOCENTE';
            if ($ticket->type == 2) {
                $type = 'ESTUDIANTIL';
            } else if ($ticket->type == 3) {
                $type = 'PARTICULAR';
            }
            // Actualizar estado
            $this->abono_model->update($v, array('status' => 2)); // Impreso

            $count = $ticket->ida + $ticket->vta;
            $this->pdf->setMargins(0, 0, 0);
            $this->pdf->AddPage('L', array(227, 76.5));
            $this->pdf->SetAutoPageBreak(true, 0);

            // 4mm top + Serie
            $this->pdf->Cell(227, 8, '', 0);
            $this->pdf->Ln();
            $this->pdf->Cell(111.5, 5, '', 0);
            $this->pdf->Ln();

            //--------------LATERAL IZQUIERDO---------------------/
            // Nro de abono
            $this->pdf->SetFont('Arial', 'B', 14);
            $this->pdf->Cell(80, 6, '', 0);
            $this->pdf->Cell(26.5, 6, '', 0);
            $this->pdf->Ln();

            // Vacio
            $this->pdf->Cell(111.5, 3, '', 0);
            $this->pdf->Ln();

            // Apellido y Nombre
            $this->pdf->SetFont('Arial', '', 11);
            $this->pdf->Cell(33, 5.5, '', 0);
            $this->pdf->Cell(68.5, 5.5, utf8_decode(strtoupper($ticket->last_name . ' ' . $ticket->first_name)), 0);
            $this->pdf->Ln();

            // Vacio
            $this->pdf->Cell(111.5, 4, '', 0);
            $this->pdf->Ln();

            // DNI / Tipo / Rebaja / Importe / Periodo
            $this->pdf->Cell(1, 6, '', 0); //vacio
            $this->pdf->Cell(30, 6, $ticket->dni, 0, 0, 'C'); // dni
            $this->pdf->Cell(14, 6, $ticket->type, 0, 0, 'C'); // tipo
            $this->pdf->Cell(15, 6, $ticket->discount, 0, 0, 'C'); // Descuento
            $this->pdf->Cell(16, 6, '***', 0, 0, 'C');
            $this->pdf->Cell(23.5, 6, $ticket->period, 0, 0, 'C'); // periodo
            $this->pdf->Ln();

            // Vacio
            $this->pdf->Cell(111.5, 3.5, '', 0);
            $this->pdf->Ln();

            // Origen/Destino - Cantidad
            $this->pdf->Cell(1, 6, '', 0);
            $this->pdf->Cell(90, 6, strtoupper($ticket->name_from . ' a ' . $ticket->name_to), 0, 0, 'C');
            $this->pdf->Cell(8.5, 6, ($ticket->ida + $ticket->vta), 0, 0, 'C');
            $this->pdf->Ln();

            // Vacio
            $this->pdf->Cell(111.5, 16, '', 0);
            $this->pdf->Ln();

            // Fecha
            $this->pdf->Cell(5, 4, '', 0);
            $this->pdf->Cell(9, 4, date('d', strtotime($ticket->created_on)), 0); // Dia
            $this->pdf->Cell(10, 4, date('m', strtotime($ticket->created_on)), 0, 0, 'C'); // Mes
            $this->pdf->Cell(11, 4, date('Y', strtotime($ticket->created_on)), 0); // Año
            $this->pdf->Ln();

            //-------------FIN LATERAL IZQUIERDO------------------/
            //--------------LATERAL DERECHO-----------------------/
            $this->pdf->SetXY(110, 6);
            $this->pdf->Cell(10, 7.5, '', 0);
            $this->pdf->Cell(10, 7.5, ($ticket->ida + $ticket->vta), 0, 0, 'C');
            $this->pdf->Cell(20, 7.5, '', 0);
            $this->pdf->Cell(28, 7.5, '', 0);
            $this->pdf->SetFont('Arial', 'B', 14);
            $this->pdf->Cell(15, 7.5, '', 0);
            $this->pdf->Cell(25, 7.5, '', 0, 0);
            $this->pdf->Ln();

            // Casillas
            $this->pdf->SetFont('Arial', 'B', 24);
            // 1ra fial
            $this->pdf->SetXY(109, 16);
            for ($i = 0; $i < 7; $i++) {
                if ($count < 8 && $count > $i || $count > 7) {
                    $this->pdf->Cell(13.5, 8, '', 0);
                } elseif ($count < 8 && $count <= $i) {
                    $this->pdf->Cell(13.5, 8, 'X', 0, 0, 'C');
                }
            }
            $this->pdf->Ln();
            // 2da fila
            $this->pdf->SetXY(109, 24);
            for ($i = 0; $i < 7; $i++) {
                if ($count > 7 + $i) {
                    $this->pdf->Cell(13.5, 8, '', 0);
                } else {
                    $this->pdf->Cell(13.5, 8, 'X', 0, 0, 'C');
                }
            }
            // 3ra fila
            $this->pdf->SetXY(109, 32);
            for ($i = 0; $i < 7; $i++) {
                if ($count > 14 + $i) {
                    $this->pdf->Cell(13.5, 8, '', 0);
                } else {
                    $this->pdf->Cell(13.5, 8, 'X', 0, 0, 'C');
                }
            }
            // 4ta fila
            $this->pdf->SetXY(109, 40);
            for ($i = 0; $i < 7; $i++) {
                if ($count > 21 + $i) {
                    $this->pdf->Cell(13.5, 8, '', 0);
                } else {
                    $this->pdf->Cell(13.5, 8, 'X', 0, 0, 'C');
                }
            }
            // 5ta fila
            $this->pdf->SetXY(109, 48);
            for ($i = 0; $i < 7; $i++) {
                if ($count > 28 + $i) {
                    $this->pdf->Cell(13.5, 8, '', 0);
                } else {
                    $this->pdf->Cell(13.5, 8, 'X', 0, 0, 'C');
                }
            }
            // 6ta fila
            $this->pdf->SetXY(109, 56);
            for ($i = 0; $i < 7; $i++) {
                if ($count > 35 + $i) {
                    $this->pdf->Cell(13.5, 8, '', 0);
                } else {
                    $this->pdf->Cell(13.5, 8, 'X', 0, 0, 'C');
                }
            }
            // 7ma fila
            $this->pdf->SetXY(109, 64);
            for ($i = 0; $i < 7; $i++) {
                if ($count > 42 + $i) {
                    $this->pdf->Cell(13.5, 8, '', 0);
                } else {
                    $this->pdf->Cell(13.5, 8, 'X', 0, 0, 'C');
                }
            }
            $this->pdf->SetXY(110, 71); //108.5
            $this->pdf->SetFont('Arial', 'B', 10);
            $this->pdf->Cell(12, 5, '', 0);
            $this->pdf->Cell(39, 5, $ticket->name_from, 0); // Desde
            $this->pdf->Cell(10.5, 5, '', 0);
            $this->pdf->Cell(47, 5, $ticket->name_to, 0); // Hasta
            //------------FIN LATERAL DERECHO---------------------/
        }

        $this->pdf->output();
    }

    /**
     * Acciones sobre un abonos (borrar, excel e imprimir)
     */
    public function abonoActions() {

        $this->form_validation->set_rules('form_action', lang('form_action'), 'required');

        if ($this->form_validation->run() == true) {
            if (!empty($_POST['val'])) {

                if ($this->input->post('form_action') == 'delete') {
                    foreach ($_POST['val'] as $k => $v) {
                        $this->abono_model->delete($v);
                    }

                    $this->session->set_flashdata('message', lang('users_deleted'));
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
                // Print abonos
                if ($this->input->post('form_action') == 'print_tickets') {
                    $this->load->library('pdf');
                    $this->printAbono($_POST['val']);
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

    public function assignTramo($p = null, $s = null) {
        $this->load->model('cities/city_model');
        $data['cities'] = $this->city_model->getCities();
        $data['passenger_id'] = $p;
        $this->load->model('schools/school_model');
        $data['school'] = $this->school_model->find($s);
        echo $this->load->view('abonos/assignTramo', $data, TRUE);
    }

    private function saveAbonoMultiple() {
        if ($_POST['type'] == 2) { // Alumno
            $this->load->model('passengers/passenger_school_model');
            $this->load->model('tariffs/price_model');
            if (isset($_POST['checked']) && is_array($_POST['checked']) && !empty($_POST['checked'])) {
                $this->load->model('cities/city_model');
                foreach ($_POST['checked'] as $k => $v) {
                    if (isset($_POST['line'][$k])) {
                        $tariff_id = $this->abono_model->tariffActiveByLine($_POST['line'][$k]);
                        $price_id = $this->price_model->getIdRow($tariff_id, $_POST['from'][$k], $_POST['to'][$k]);
                        if ($price_id == 0) {
                            $pt = array(
                                'passenger_school_id' => $this->passenger_school_model->getIdRow($v, $_POST['school_id'], 2),
                                'ffrom'               => $_POST['from'][$k],
                                'tto'                 => $_POST['to'][$k]
                            );
                            $this->load->model('passengers/passenger_tramo_model');
                            $price_id = $this->passenger_tramo_model->insert($pt);
                        }
                        if ($price_id > 0 && ($_POST['ida'][$k] + $_POST['vta'][$k]) > 0) {
                            $data = array(
                                'passenger_school_id' => $this->passenger_school_model->getIdRow($v, $_POST['school_id'], 2),
                                'tariff_id'           => $tariff_id,
                                'line_id'             => $_POST['line'][$k],
                                'code'                => $_POST['code'][$k],
                                'ida'                 => $_POST['ida'][$k],
                                'vta'                 => $_POST['vta'][$k],
                                'discount'            => $_POST['discount'][$k],
                                'price_id'            => $price_id,
                                'status'              => 1,
                                'period'              => $_POST['month'] . '/' . $_POST['year']
                            );

                            if ($id = $this->abono_model->insert($data)) {
                                $this->arr[] = array(
                                    'passenger_id' => $v,
                                    'abono_id'     => $id,
                                    'code'         => $_POST['code'][$k],
                                    'passenger'    => $_POST['name_full'][$k],
                                    'from'         => $this->city_model->find($_POST['from'][$k])->name,
                                    'to'           => $this->city_model->find($_POST['to'][$k])->name,
                                    'ida'          => $_POST['ida'][$k],
                                    'vta'          => $_POST['vta'][$k],
                                    'discount'     => $_POST['discount'][$k]
                                );
                            }
                        }
                    }
                }
            }
        } else { // Docente
            $this->load->model('passengers/passenger_school_model');
            $this->load->model('tariffs/price_model');
            $print = array();

            if (isset($_POST['checked']) && is_array($_POST['checked']) && !empty($_POST['checked'])) {
                foreach ($_POST['checked'] as $k => $v) {
                    $tariff_id = $this->abono_model->tariffActiveByLine($_POST['line'][$k]);
                    $price_id = $this->price_model->getIdRow($tariff_id, $_POST['from'][$k], $_POST['to'][$k]);
                    if ($price_id > 0 && ($_POST['ida'][$k] + $_POST['vta'][$k]) > 0) {
                        $data = array(
                            'passenger_school_id' => $this->passenger_school_model->getIdRow($v, $_POST['school_id']),
                            'people_id' => $_POST['people_id'][$k],
                            'tariff_id'           => $tariff_id,
                            'line_id'             => $_POST['line'][$k],
                            'ida'                 => $_POST['ida'][$k],
                            'vta'                 => $_POST['vta'][$k],
                            'discount'            => $_POST['discount'][$k],
                            'price_id'            => $price_id,
                            'status'              => 1,
                            'period'              => $_POST['month'] . '/' . $_POST['year']
                        );

                        if ($id = $this->abono_model->insert($data)) {
                            $this->arr[] = array(
                                'passenger_id' => $v,
                                'abono_id'     => $id,
                                'passenger'    => $_POST['name_flast'][$k],
                                'from'         => $_POST['name_from'][$k],
                                'to'           => $_POST['name_to'][$k],
                                'ida'          => $_POST['ida'][$k],
                                'vta'          => $_POST['vta'][$k],
                                'discount'     => $_POST['discount'][$k]
                            );
                        }
                    }
                }
            }
            // La clave del arreglo update es el id del abono
            if (isset($_POST['update']) && is_array($_POST['update']) && !empty($_POST['update'])) {

                foreach ($_POST['update'] as $k => $v) {
                    $tariff_id = $this->abono_model->tariffActiveByLine($_POST['line'][$k]);
                    $price_id = $this->price_model->getIdRow($tariff_id, $_POST['from'][$k], $_POST['to'][$k]);
                    if ($price_id > 0 && ($_POST['ida'][$k] + $_POST['vta'][$k]) > 0) {
                        $update = array(
                            'tariff_id' => $tariff_id,
                            'line_id'   => $_POST['line'][$k],
                            'ida'       => $_POST['ida'][$k],
                            'vta'       => $_POST['vta'][$k],
                            'discount'  => $_POST['discount'][$k],
                            'price_id'  => $price_id,
                        );
                        if ($this->abono_model->update($v, $update)) {
                            $this->arr[] = array(
                                'abono_id'  => $v,
                                'passenger' => $_POST['name_flast'][$k],
                                'from'      => $_POST['name_from'][$k],
                                'to'        => $_POST['name_to'][$k],
                                'ida'       => $_POST['ida'][$k],
                                'vta'       => $_POST['vta'][$k],
                                'discount'  => $_POST['discount'][$k]
                            );
                        }
                    }
                }
                $this->message .= 'Abonos actualizados: ' . count($this->arr);
            }
        }

        return true;
    }

    public function saveAbonoLote() {
        $this->load->model('passengers/passenger_school_model');
        $this->load->model('tariffs/price_model');
        $print = array();

        if (isset($_POST['checked']) && is_array($_POST['checked']) && !empty($_POST['checked'])) {
            foreach ($_POST['checked'] as $k => $v) {
                if (isset($_POST['line'][$k]) && !empty($_POST['line'][$k])) {
                    $tariff_id = $this->abono_model->tariffActiveByLine($_POST['line'][$k]);
                    $price_id = $this->price_model->getIdRow($tariff_id, $_POST['from'][$k], $_POST['to'][$k]);
                    if ($price_id > 0) {
                        $data[] = array(
                            'passenger_school_id' => $this->passenger_school_model->getIdRow($v, $_POST['school_id']),
                            'tariff_id'           => $tariff_id,
                            'line_id'             => $_POST['line'][$k],
                            'number_abono'        => $_POST['number_abono'][$k],
                            'ida'                 => $_POST['ida'][$k],
                            'vta'                 => $_POST['vta'][$k],
                            'discount'            => $_POST['discount'][$k],
                            'price_id'            => $price_id,
                            'status'              => 1,
                            'period'              => $_POST['month'] . '/' . $_POST['year']
                        );
                    }
                }
            }

            foreach ($data as $key => $value) {
                $print[] = $this->abono_model->insert($value);
            }
            $data = array('message' => 'Se generaron ' . count($print) . ' abonos', 'type' => 'success', 'print' => $print);
            echo json_encode($data);
            //Template::set_message('Abonos que se registraron: '.count($print),'success');        
        }
        // La clave del arreglo update es el id del abono
        if (isset($_POST['update']) && is_array($_POST['update']) && !empty($_POST['update'])) {

            foreach ($_POST['update'] as $k => $v) {
                $tariff_id = $this->abono_model->tariffActiveByLine($_POST['line'][$k]);
                $price_id = $this->price_model->getIdRow($tariff_id, $_POST['from'][$k], $_POST['to'][$k]);
                if ($price_id > 0) {
                    $update = array(
                        'tariff_id'    => $tariff_id,
                        'line_id'      => $_POST['line'][$k],
                        'number_abono' => $_POST['number_abono'][$k],
                        'ida'          => $_POST['ida'][$k],
                        'vta'          => $_POST['vta'][$k],
                        'discount'     => $_POST['discount'][$k],
                        'price_id'     => $price_id,
                    );
                    $this->abono_model->update($v, $update);
                    $print[] = $v;
                }
            }
            Template::set_message('Abonos que se actualizaron: ' . count($print), 'success');
        }
    }

    /**
     * Agregar nuevo docente
     */
    public function addTeacher() {
        $this->load->model('cities/city_model');
        $data['cities'] = $this->city_model->getCities();
        $this->load->model('schools/school_model');
        $data['schools'] = $this->school_model->getSchools();
        echo $this->load->view('abonos/addTeacher', $data, TRUE);
    }

    /**
     * Agregar alumno
     */
    public function addStudent() {
        $this->load->model('cities/city_model');
        $data['cities'] = $this->city_model->getCities();
        $this->load->model('schools/school_model');
        $data['schools'] = $this->school_model->getSchools();
        echo $this->load->view('abonos/addStudent', $data, TRUE);
    }

    //-----------------------------Metodos privados---------------------------/
    private function saveAbono($type = 'insert', $id = 0) {
        $this->form_validation->set_rules('line_id', lang('lbl_line'), 'required');
        $this->form_validation->set_rules('tariff_id', lang('lbl_tariff'), 'required');
        $this->form_validation->set_rules('from', lang('field_from'), 'trim|required|callback_from_to_different');

        if ($this->form_validation->run($this) === false) {
            return false;
        }

        // Compile our core user elements to save.
        $data = $this->abono_model->prep_data($this->input->post());
        if (isset($_POST['month']) && isset($_POST['year'])) {
            $data['period'] = $_POST['month'] . '/' . $_POST['year'];
        }

        if ($type == 'insert') {
            $this->load->model('passengers/passenger_school_model');
            $this->load->model('passengers/passenger_model');
           /*  $this->load->model('passengers/passenger_model');
            $this->load->model('passengers/passenger_school_model');
            $passenger_id = $this->passenger_model->getIdByDni($_POST['dni']);

            if (!$passenger_id) {
                // Insertamos datos del pasajero
                $passenger_id = $this->passenger_model->insert(
                    array(
                        'type'         => $_POST['type'],
                        'first_name'   => $_POST['first_name'],
                        'last_name'    => $_POST['last_name'],
                        'dni'          => $_POST['dni'],
                        'level'        => 'N',
                        'address_city' => $_POST['from']
                    )
                );
            } */
            $school_id = isset($_POST['school_id']) ? $_POST['school_id'] : 0;
            $passenger_id = $_POST['passenger_id'];
            // Recuperamos el id de persona
            $passenger = $this->passenger_model->find($passenger_id);
            // Verificamos pasajero/escuela
            $id_ps = $this->passenger_school_model->getIdRow($passenger_id, $school_id);
            if (!$id_ps) {
                $id_ps = $this->passenger_school_model->insert(
                    array(
                        'passenger_id' => $passenger_id,
                        'school_id'    => $school_id
                    )
                );
            }
            $this->load->model('tariffs/price_model');
            $data['passenger_school_id'] = $id_ps;

            $data['price_id'] = $this->price_model->getIdRow($_POST['tariff_id'], $_POST['from'], $_POST['to']);
            $data['people_id'] = $passenger->people_id;
            $id = $this->abono_model->insert($data);
            if (is_numeric($id)) {
                $result = $id;
            }
        } else {
            $this->load->model('tariffs/price_model');
            $data['price_id'] = $this->price_model->getIdRow($_POST['tariff_id'], $_POST['from'], $_POST['to']);
            $result = $this->abono_model->update($id, $data);
        }

        return $result;
    }

    // Callbacks
    public function from_to_different() {
        if ($_POST['from'] == $_POST['to']) {
            $this->form_validation->set_message('from_to_different', 'El Origen y Destino tienen que ser diferentes.');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    /* ------------------------------------AJAX------------------------------- */

    /**
     * Metodo AJAX que recupera todos los abonos registrados en forma paginada.
     */
    function getAbonos() {
        if (!$this->input->is_ajax_request()) {
            redirect('404', 'refresh');
        } else {

            $delete_link = "<a href='#' class='tip po' title='<b>" . $this->lang->line('abo_delete') . "</b>' data-content=\"<p>"
                . lang('r_u_sure') . "</p><a class='btn btn-danger po-delete-abono' id='a__$1' href='" . site_url('abonos/delete/$1') . "'>"
                . lang('i_m_sure') . "</a> <button class='btn po-close'>" . lang('no') . "</button>\"  rel='popover'><i class=\"fa fa-trash-o\"></i> "
                . lang('abo_delete') . '</a>';
            $action = '<div class="text-center"><div class="btn-group text-left">'
                . '<button type="button" class="btn btn-default btn-xs btn-primary dropdown-toggle" data-toggle="dropdown">'
                . lang('actions') . ' <span class="caret"></span></button>
            <ul class="dropdown-menu pull-right" role="menu">                
                <li><a href="' . site_url('abonos/edit/$1') . '"><i class="fa fa-edit"></i> ' . lang('abo_edit') . '</a></li><li><a href="' . site_url('abonos/print/$1') . '"><i class="fa fa-print"></i> ' . lang('abo_print') . '</a></li><li class="divider"></li><li> ' . $delete_link . '</li>';
            $action .= '</ul></div></div>';

            $this->load->library('datatables');
            $this->datatables
                ->select('t1.id as id0, t1.id as id, concat_ws(" ",t4.last_name , t4.first_name) as full_name, t1.period, t8.name as line, t6.name as from, t7.name as to, t1.ida , t1.vta, t1.status as status')
                ->from('abonos as t1')
                ->join('people as t4','t1.people_id = t4.id','left')
                ->join('prices as t5', 't5.id = t1.price_id', 'left')
                ->join('cities as t6', 't6.id = t5.from', 'left')
                ->join('cities as t7', 't7.id = t5.to', 'left')
                ->join('lines as t8','t8.id = t1.line_id','left')
                ->edit_column('status', '$1__$2', 'status, id')
                ->edit_column('id', '$1__$2', 'id, id')
                ->add_column('Actions', $action, 'id');

            echo $this->datatables->generate();
        }
    }

    /**
     * Recupear pasajeros por escuela
     */
    function ajaxGetPassengersBySchool() {
        if (!$this->input->is_ajax_request()) {
            redirect('404', 'refresh');
        } else {
            if ($_POST['type'] == 1) { // Docente
                $passengers = $this->abono_model->getPassengersBySchool($_POST['school_id'], $_POST['type']);
                $aux = array();
                if (is_array($passengers) && !empty($passengers)) {
                    $this->load->model('lines/line_model');
                    foreach ($passengers as $p) {
                        $p->exist = $this->abono_model->abonoCreated($p->id, $_POST['school_id'], $p->from_default, $p->to_default, $_POST['year'], $_POST['month']);
                        $p->lines = $this->line_model->getLinesByFromTo($p->from_default, $p->to_default);
                        $aux[] = $p;
                    }
                }

                $data['school_id'] = $_POST['school_id'];
                $data['passengers'] = $aux;

                $data['cities'] = array_by_key_value('id', 'name', $this->abono_model->getCitiesBySchool($_POST['school_id']));

                echo $this->load->view('abonos/ajaxPassengersBySchool', $data, TRUE);
            } else { // alumno
                $this->load->model('passengers/passenger_model');
                $data['students'] = $this->passenger_model->getPassengersByType(2);
                echo $this->load->view('abonos/searchStudent', $data, TRUE);
            }
        }
    }

    /**
     * Devolver las escuelas por recorrido
     */
    function getSchoolsByRoute() {
        if (!$this->input->is_ajax_request()) {
            redirect('404', 'refresh');
        } else {
            $this->load->model('routes/route_model');
            $schools = array_by_key_value('id', 'name', $this->route_model->schoolsByRoute($_GET['route']));
            $html = '';
            if (is_array($schools)) {
                foreach ($schools as $k => $v) {
                    $html .= '<option value="' . $k . '">' . $v . '</option>';
                }
            }
            echo $html;
        }
    }

    /**
     * Devuelve las tarifas del recorrido
     */
    function getTariffsByRoute() {
        if (!$this->input->is_ajax_request()) {
            redirect('404', 'refresh');
        } else {
            $this->load->model('routes/route_model');
            $tariffs = array_by_key_value('id', 'name', $this->route_model->tariffsByRoute($_GET['route']));
            $html = '';
            if (is_array($tariffs)) {
                foreach ($tariffs as $k => $v) {
                    $html .= '<option value="' . $k . '">' . $v . '</option>';
                }
            }
            echo $html;
        }
    }

    /**
     * Cargar una fila de un abono
     */
    function ajaxAddRowTeacher() {
        if (!$this->input->is_ajax_request()) {
            redirect('404', 'refresh');
        } else {
            // recuepramos pasajeros por tipo
            $this->load->model('passengers/passenger_model');
            $this->load->model('cities/city_model');
            $data['passengers'] = $this->passenger_model->getByType($_GET['type']);
            $data['cities'] = $this->city_model->getCities();
            $data['number_abono'] = $_GET['number_abono_start'] + $_GET['length'];
            echo $this->load->view('abonos/addRowTeacher', $data, TRUE);
        }
    }

    /**
     * Retornas las lineas que pasan por una escuela
     */
    function getLinesBySchool() {
        if (!$this->input->is_ajax_request()) {
            redirect('404', 'refresh');
        } else {
            $this->load->model('lines/line_model');
            $lines = $this->line_model->getLinesBySchool($_GET['school_id']);
            $options = '';
            if (is_array($lines)) {
                $options .= '<option value="">--Seleccione--</option>';
                foreach ($lines as $line) {
                    $options .= '<option value="' . $line->id . '">' . $line->name . '</option>';
                }
            } else {
                $options .= '<option value="">--No hay lineas--</option>';
            }
            echo $options;
        }
    }

    /**
     * Retorna las tarifas activas de una linea
     */
    function getTariffsByLine() {
        if (!$this->input->is_ajax_request()) {
            redirect('404', 'refresh');
        } else {
            $this->load->model('tariffs/tariff_model');
            $this->tariff_model->where('status', 'T');
            $result = $this->tariff_model->find_all_by('line_id', $_GET['line_id']);

            $options = '';
            if (is_array($result)) {
                $options .= '<option value="">--Seleccione--</option>';
                foreach ($result as $tariff) {
                    $options .= '<option value="' . $tariff->id . '">' . $tariff->name . '</option>';
                }
            } else {
                $options .= '<option value="">--No hay tarifas--</option>';
            }
            echo $options;
        }
    }

    /**
     * Recuperar los datos de un pasajero si es que existe
     */
    function getPassengerByDni() {
        if (!$this->input->is_ajax_request()) {
            redirect('404', 'refresh');
        } else {
            $this->load->model('passengers/passenger_model');
            $p = $this->passenger_model->find_by('dni', $_GET['dni']);
            if ($p) {
                echo json_encode($p);
            } else {
                echo 0;
            }
        }
    }

    /**
     * Devolver las lienas disponibles de acuero al origen y destino
     */
    function getLines() {
        if (!$this->input->is_ajax_request()) {
            redirect('404', 'refresh');
        } else {
            $this->load->model('lines/line_model');
            $lines = $this->line_model->getLinesByFromTo($_GET['from'], $_GET['to']);
            $html = '';
            if (is_array($lines)) {
                $html .= '<option value=""></option>';
                foreach ($lines as $k => $v) {
                    $html .= '<option value="' . $k . '">' . $v . '</option>';
                }
            }
            echo $html;
        }
    }

    /**
     * Devuelve el precio de un boleto
     */
    function getPrice() {
        if (!$this->input->is_ajax_request()) {
            redirect('404', 'refresh');
        } else {
            $this->load->model('tariffs/price_model');
            $price = $this->price_model->getPrice($_GET['tariff_id'], $_GET['from'], $_GET['to']);

            echo $price;
        }
    }

    /**
     * Guarda un nuevo tramo para llegar a una escuela
     */
    function saveAssignTramo() {
        if (!$this->input->is_ajax_request()) {
            redirect('404', 'refresh');
        } else {
            if ($_POST['ffrom'] == $_POST['tto']) {
                echo json_encode(array(
                    'message' => lang('tramo_equal_failure'),
                    'alert'   => 'alert-danger'
                ));
            } else {
                $this->load->model('passengers/passenger_school_model');
                $id = $this->passenger_school_model->getIdRow($_POST['passenger_id'], $_POST['school_id']);
                if (is_numeric($id)) {
                    $data = array(
                        'passenger_school_id' => $id,
                        'ffrom'               => $_POST['ffrom'],
                        'tto'                 => $_POST['tto']
                    );
                    $this->load->model('passengers/passenger_tramo_model');
                    if ($this->passenger_tramo_model->insert($data)) {
                        echo json_encode(array(
                            'message' => lang('tramo_create_success'),
                            'alert'   => 'success'
                        ));
                    } else {
                        echo json_encode(array(
                            'message' => lang('tramo_create_failure'),
                            'alert'   => 'danger'
                        ));
                    }
                }
            }
        }
    }

    /**
     * Agregar un docente y/o ubicaciones
     */
    function saveTeacher() {
        if (!$this->input->is_ajax_request()) {
            redirect('404', 'refresh');
        } else {
            $p = isset($_POST['passenger_id']) ? $_POST['passenger_id'] : '';
            $s = $_POST['school_id'];
            $from = $_POST['from'];
            $to = $_POST['to'];
            $message = '';
            if ($from != $to) {
                if ($p == '') {
                    // Ingresamos los datos del docente
                    $this->load->model('passengers/passenger_model');
                    $p = $this->passenger_model->insert(array(
                        'type'       => 1,
                        'level'      => 'D',
                        'first_name' => $_POST['first_name'],
                        'last_name'  => $_POST['last_name'],
                        'dni'        => $_POST['dni']
                    ));
                    $message = 'El docente fue agregado.';
                }

                if (is_numeric($p)) {
                    $this->load->model('passengers/passenger_school_model');
                    $ps = $this->passenger_school_model->getIdRow($p, $s);
                    if (is_numeric($ps)) {
                        # Insertamos origen destino
                        $data['passenger_school_id'] = $ps;
                    } else {
                        // Insertamos pasejero - escuela
                        $data['passenger_school_id'] = $ps = $this->passenger_school_model->insert(array('passenger_id' => $p, 'school_id' => $s));
                    }
                    $this->load->model('passengers/passenger_tramo_model');
                    if ($this->passenger_tramo_model->existPoints($ps, $from, $to)) {
                        // El tramo ya existe
                        $message .= ' El punto Origen y Destino ya existen para la escuela seleccionada';
                        $type = 'warning';
                    } else {
                        $data['ffrom'] = $from;
                        $data['tto'] = $to;
                        if (is_numeric($this->passenger_tramo_model->insert($data))) {
                            $message .= ' Se agrego el punto Origen y Destino para llegar a la Escuela';
                            $type = 'success';
                        }
                    }
                } else {
                    $message = 'Error al agregar el docente';
                    $type = 'danger';
                }
            } else {
                $message .= 'El campo Origen y Destino tienen que ser distintos';
                $type = 'danger';
            }

            echo json_encode(array('message' => $message, 'type' => $type));
        }
    }

    /**
     * Agregar un estudiante
     */
    function saveStudent() {
        if (!$this->input->is_ajax_request()) {
            redirect('404', 'refresh');
        } else {
            $p = isset($_POST['passenger_id']) ? $_POST['passenger_id'] : '';
            $s = isset($_POST['school_id']) ? $_POST['school_id'] : 0;
            $from = $_POST['from'];
            $to = $_POST['to'];
            $message = '';
            if ($from != $to) {
                if ($p == '') {
                    // Ingresamos los datos del docente
                    $this->load->model('passengers/passenger_model');
                    $p = $this->passenger_model->insert(array(
                        'type'       => 2,
                        'level'      => $_POST['level'],
                        'first_name' => $_POST['first_name'],
                        'last_name'  => $_POST['last_name'],
                        'dni'        => $_POST['dni']
                    ));
                    $message = 'El alumno fue agregado.';
                }

                if (is_numeric($p)) {
                    $this->load->model('passengers/passenger_school_model');
                    $ps = $this->passenger_school_model->getIdRow($p, $s);
                    if (is_numeric($ps)) {
                        # Insertamos origen destino
                        $data['passenger_school_id'] = $ps;
                    } else {
                        // Insertamos pasejero - escuela
                        $data['passenger_school_id'] = $ps = $this->passenger_school_model->insert(array('passenger_id' => $p, 'school_id' => $s));
                    }
                    $this->load->model('passengers/passenger_tramo_model');
                    if ($this->passenger_tramo_model->existPoints($ps, $from, $to)) {
                        // El tramo ya existe
                        $message .= ' El punto Origen y Destino ya existen para la escuela seleccionada';
                        $type = 'warning';
                    } else {
                        $data['ffrom'] = $from;
                        $data['tto'] = $to;
                        if (is_numeric($this->passenger_tramo_model->insert($data))) {
                            $message .= ' Se agrego el punto Origen y Destino.';
                            $type = 'success';
                        }
                    }
                } else {
                    $message = 'Error al agregar el alumno';
                    $type = 'danger';
                }
            } else {
                $message .= 'El campo Origen y Destino tienen que ser distintos';
                $type = 'danger';
            }

            echo json_encode(array('message' => $message, 'type' => $type));
        }
    }

    /**
     * Buscar un estudiante por dni
     */
    function searchStudentByDni() {
        if (!$this->input->is_ajax_request()) {
            redirect('404', 'refresh');
        } else {
            $this->load->model('passengers/passenger_model');
            $st = $this->passenger_model->findStudentByDni($_GET['dni']);
            if ($st) {

                $this->load->model('cities/city_model');
                $data['cities'] = $this->city_model->getCities();
                $this->load->model('lines/line_model');
                $data['lines'] = $this->line_model->getLinesByFromTo($st->ffrom, $st->tto);
                $data['st'] = $st;
                echo $this->load->view('abonos/addRowStudent', $data, TRUE);
            } else {
                echo '';
            }
        }
    }

    /**
     * Buscar estudiante por id
     */
    function searchStudentById() {
        if (!$this->input->is_ajax_request()) {
            redirect('404', 'refresh');
        } else {
            $this->load->model('passengers/passenger_model');
            $st = $this->passenger_model->findStudentById($_GET['id']);
            if ($st) {
                $this->load->model('cities/city_model');
                $data['cities'] = $this->city_model->getCities();
                $this->load->model('lines/line_model');
                $data['lines'] = $this->line_model->getLinesByFromTo($st->ffrom, $st->tto);
                $data['st'] = $st;
                echo $this->load->view('abonos/addRowStudent', $data, TRUE);
            } else {
                echo '';
            }
        }
    }

}