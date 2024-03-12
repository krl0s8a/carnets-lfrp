<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Cards extends MY_Controller {

    private $photo = '';

    function __construct() {
        parent::__construct();
        $this->lang->load('cards');
        $this->load->helper(array('array','players/player'));
        $this->load->model(array('card_model','players/player_model','seasons/season_model','teams/team_model'));

        Assets::add_module_js('cards', 'cards.js');
        Assets::add_module_css('cards', 'cards.css');
        Template::set_block('sub_nav', '_sub_nav');
    }

    public function index() {
        Template::set('toolbar_title', lang('management_cities'));
        Template::render();
    }

    public function create() {
        //$this->auth->restrict($this->busAdd);
        if (isset($_POST['save'])) {
           
            if ($this->save('insert')) {
                $this->print_card();
                log_activity(
                    $this->current_user->id,
                    lang('act_create_bus') . ' : ' . $id,
                    'Carnets'
                );
                Template::set_message(lang('card_created_success'), 'success');
                Template::redirect('buses');
            } else {
                Template::set_message(lang('card_created_failure'), 'danger');
            }
        }

        $this->team_model->order_by('t_name');
        Template::set('teams',array_by_key_value('id', 't_name', $this->team_model->find_all(), 'No seleccionado'));
        Template::set('seasons',array_by_key_value('id', 'name', $this->season_model->find_all_by_tournament(), 'No seleccionado'));
        Template::set('toolbar_title', lang('create_card'));
        Template::render();
    }

    
    private function print_card(){

        $this->load->library('pdf');
        // array(
        //     1 => 'Masculino',
        //     2 => 'Femenino',
        //     3 => 'Standar Masculino',
        //     4 => 'Standar Femenino'
        // ),
        /*array(
            1 => 'Residente',
            2 => 'Residente hijo',
            3 => 'Residente hija',
            4 => 'Residente nieto',
            5 => 'Residente nieta',
            6 => 'Residente esposo',
            7 => 'Residente esposa',
            8 => 'Residente federado',
            9 => 'Residente federada',
            10 => 'Residente vitalicio',
            11 => 'Libre',
            12 => 'Libre federada',
            13 => 'Libre residente'
        );*/
        // Obtenemos los datos para el carnet
        $card = $this->card_model->find_data_card($_POST['team_id'],$_POST['player'],$_POST['season_id']);
        //$card = $this->card_model->find_data_card(79,1,33);
        switch ($_POST['category']) {
            case 1: // masculino
                if (in_array($_POST['type_player'], array(1, 2,4,6,8,10))) {
                    $template = 'masculino-residente.png';
                } else {
                    $template = 'masculino-libre.png';
                }
                break;
            case 2: // femenino
                if (in_array($_POST['type_player'], array(1, 3, 5,7,9,10))) {
                    $template = 'femenino-residente.png';
                } else {
                    $template = 'femenino-libre.png';
                }
                break;
            case 3: // standar masculino
                if (in_array($_POST['type_player'], array(1, 2,4,6,8,10))) {
                    $template = 'masculino-residente-standar.png';
                } else {
                    $template = 'masculino-libre-standar.png';
                }
                break;
            default: // standar femenino
                // code...
                break;
        }
        
        $this->pdf->setMargins(0, 0, 0);
        $this->pdf->AddPage('L', array(90, 60));
        $this->pdf->Image($_SERVER['DOCUMENT_ROOT'].'/assets/images/template_card/'.$template,0,0, 90,60);
        $this->pdf->Image($_SERVER['DOCUMENT_ROOT'].'/assets/photos/shields/'.$card->emblem,40,1, 17,17);
        $this->pdf->Image($_SERVER['DOCUMENT_ROOT'].'/assets/images/qr.png',70,0, 20,20);
        $this->pdf->Image($_POST['location_photo'],0,24.7, 23.3,23.3);
        $this->pdf->SetAutoPageBreak(true, 0);

        $this->pdf->SetFont('Arial', 'B', 8);
        // Calculo edad
        if (in_array($_POST['category'], array(3,4))) {
            if (isset($card->birth) && !empty($card->birth)) {
                $edad = edad($card->birth);                
                if ($edad > 34) {     
                    $this->pdf->SetXY(9,20);               
                    $this->pdf->Cell(6, 8, '> 35' , 0);
                } else {
                    $this->pdf->SetXY(10,20);
                    $this->pdf->Cell(6, 8, $edad , 0);
                }
            }
            
        }
        $this->pdf->SetFont('Arial', '', 6);
        // Nombre del equipo
        $this->pdf->SetXY(32,21.5);
        $this->pdf->Cell(35, 8, strtoupper($card->team_name), 0);
        // Apellid
        $this->pdf->SetXY(34.2,26.4);
        $this->pdf->Cell(35, 8, strtoupper($card->last_name), 0);
        // Nombre
        $this->pdf->SetXY(34.3,31.1);
        $this->pdf->Cell(35, 8, strtoupper(utf8_decode($card->first_name)), 0);
        // Tipo jugador
        $this->pdf->SetXY(41,36.5);
        $this->pdf->Cell(35, 8, strtoupper(type_player()[$card->type_player]), 0);
        // N° carnet
        $this->pdf->SetFont('Arial', 'B', 8);
        $this->pdf->SetXY(35.5,40.6);
        $this->pdf->Cell(35, 9, strtoupper($card->number), 0);
        // Valido desde
        $this->pdf->SetFont('Arial', '', 6);
        $this->pdf->SetXY(39,47);
        $this->pdf->Cell(35, 8, date('d/m/Y', strtotime($card->datetime)), 0);

        $this->pdf->output();
    }

    public function save_photo(){
        $imagenCodificada = file_get_contents("php://input"); //Obtener la imagen
        if(strlen($imagenCodificada) <= 0) exit("No se recibió ninguna imagen");
        //La imagen traerá al inicio data:image/png;base64, cosa que debemos remover
        $imagenCodificadaLimpia = str_replace("data:image/png;base64,", "", urldecode($imagenCodificada));

        //Venía en base64 pero sólo la codificamos así para que viajara por la red, ahora la decodificamos y
        //todo el contenido lo guardamos en un archivo
        $imagenDecodificada = base64_decode($imagenCodificadaLimpia);

        //Calcular un nombre único
        $nombreImagenGuardada = $_SERVER['DOCUMENT_ROOT']."/assets/uploads/photos/photo_" . uniqid() . ".png";
        $this->photo = $nombreImagenGuardada;
        //Escribir el archivo
        file_put_contents($nombreImagenGuardada, $imagenDecodificada);

        //Terminar y regresar el nombre de la foto
        $location = base_url('assets/uploads/photos/photo_'. uniqid() . '.png');
        exit($nombreImagenGuardada);
        //exit($nombreImagenGuardada);
    }

    public function edit() {
        $id = (int) $this->uri->segment(3);
        if (empty($id)) {
            Template::set_message(lang('invalid_id'), 'danger');
            redirect('cities');
        }

        $this->load->model('state_model');
        $data['states'] = $this->state_model->getStates();
        $data['city'] = $this->city_model->find($id);
        echo $this->load->view('cities/edit', $data, TRUE);
    }

    private function save($type = 'insert', $id = 0) {

        $data = $this->card_model->prep_data($_POST);
        if ($type == 'insert') {
            $where = array(
                'team_id' => $_POST['team_id'], 
                'player_id' => $_POST['player'], 
                'season_id' => $_POST['season_id']
            );
            $card = $this->card_model->find_by($where);
            
            if (!empty($card) && is_object($card)) {
                // actualizamos
                //$result = 1; 
                $result = $this->card_model->update($where, $data);
            } else {
                $this->card_model->insert($data);
                $result = 1;
            }
            
        } else {
            $result = $this->card_model->update($id, $data);
        }
        return $result;
    }

    // Acciones sobre un abonos (borrar, excel e imprimir)

    public function citiesActions() {

        $this->form_validation->set_rules('form_action', lang('form_action'), 'required');

        if ($this->form_validation->run() == true) {
            if (!empty($_POST['val'])) {

                if ($this->input->post('form_action') == 'delete') {
                    foreach ($_POST['val'] as $k => $v) {
                        $this->city_model->delete($v);
                        log_activity(
                            $this->current_user->id,
                            lang('act_delete_city') . ' : ' . $v,
                            'Localidades'
                        );
                    }
                    Template::set_message(lang('city_deleted_success'), 'success');

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
    function get_cards() {
        if (!$this->input->is_ajax_request()) {
            redirect('404', 'refresh');
        } else {
            $action = '<a href="'.site_url('cards/print_card_public/$1/$2').'">Imprimir</a>';
            $this->load->library('datatables');
            $this->datatables->set_database('joomla');
            $this->datatables
                ->select('t2.id, concat_ws(" ",t2.last_name, t2.first_name), t3.t_name, t4.s_name, t1.number, t1.datetime')
                ->from('co_bl_players_team as t1')
                ->join('co_bl_players as t2', 't2.id = t1.player_id', 'left')
                ->join('co_bl_teams as t3', 't3.id = t1.team_id', 'left')
                ->join('co_bl_seasons as t4', 't4.s_id = t1.season_id', 'left')
                ->where('t1.confirmed',1)
                ->add_column('Actions', $action, 't2.id');
                //->edit_column('name', '$1__$2', 'name, id')
                //->edit_column('status', '$1__$2', 'status, id');
            echo $this->datatables->generate();
        }
    }
}