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
        Template::set('toolbar_title', 'Confección de carnets');
        Template::render();
    }

    public function create() {
        //$this->auth->restrict($this->busAdd);
        if (isset($_POST['saveandclose']) || isset($_POST['saveandnew'])) {           
            if ($this->save('insert')) {                
                log_activity(
                    $this->current_user->id,
                    lang('act_create_card'),
                    'Carnets'
                );
                Template::set_message(lang('card_created_success'), 'success');
                if (isset($_POST['saveandclose'])) {
                    Template::redirect('cards');
                }                  
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
        // Obtenemos los datos para el carnet
        $card = $this->card_model->find_data_card($_POST['team_id'],$_POST['player'],$_POST['season_id']);
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
        $this->pdf->AddPage('L', array(78.99,53.34));

        $this->pdf->Image($_SERVER['DOCUMENT_ROOT'].'/assets/images/template_card/'.$template,0,0, 78.99,53.34);
        if (!empty($card->emblem) && file_exists($_SERVER['DOCUMENT_ROOT'].'/assets/photos/shields/'.$card->emblem)) {
            $this->pdf->Image($_SERVER['DOCUMENT_ROOT'].'/assets/photos/shields/'.$card->emblem,34,1, 16,16);
        }        
        $this->pdf->Image($_SERVER['DOCUMENT_ROOT'].'/assets/images/qr.png',62,0, 17,17);        
        if (!empty($card->photo)) {
            $this->pdf->Image($_POST['location_photo'],0,22.3, 20.4,20.4);
        }        
        $this->pdf->SetAutoPageBreak(true, 0);
        $this->pdf->SetFont('Arial', 'B', 8);
        // Calculo edad
        if (in_array($_POST['category'], array(3,4))) {
            if (isset($card->birth) && !empty($card->birth)) {
                $edad = edad($card->birth);                
                if ($edad > 34) {     
                    $this->pdf->SetXY($x+6.8,$y+18.3);               
                    $this->pdf->Cell(6, 6, '> 35' , 0);
                } else {
                    $this->pdf->SetXY($x+7.8,$y+18.3);
                    $this->pdf->Cell(6, 6, $edad , 0);
                }
            }            
        }
        $this->pdf->SetFont('Arial', '', 6);
        // Nombre del equipo
        $this->pdf->SetXY(27.5,19.5);
        $this->pdf->Cell(40, 6, strtoupper($card->short_name), 0);
        // Apellid
        $this->pdf->SetXY(30,23.95);
        $this->pdf->Cell(35, 6, strtoupper($card->last_name), 0);
        // Nombre
        $this->pdf->SetXY(30,28.35);
        $this->pdf->Cell(35, 6, strtoupper(utf8_decode($card->first_name)), 0);
        // Tipo jugador
        $this->pdf->SetXY(35,33);
        $this->pdf->Cell(35, 6, strtoupper(type_player()[$card->type_player]), 0);
        // N° carnet
        $this->pdf->SetFont('Arial', 'B', 8);
        $this->pdf->SetXY(31,37.2);
        $this->pdf->Cell(35, 6, strtoupper($card->number), 0);
        // Valido desde
        $this->pdf->SetFont('Arial', '', 6);
        $this->pdf->SetXY(34,42.5);
        $this->pdf->Cell(35, 6, date('d/m/Y', strtotime($card->datetime)), 0);

        $this->pdf->output();
    }

    private function print_a4($data = array()){
        if (is_array($data) && !empty($data)) {
            $qt = count($data);
            $this->load->library('pdf');            
            $this->pdf->AddPage('P', 'A4');
            $this->pdf->setMargins(0, 0, 0);
            $y = -43.34;
            for ($i = 0; $i < $qt; ++$i) {
                if (in_array($i, array(0,2,4,6,8))) {
                    $x = 15;
                    $y += 53.34;
                } else {
                    $x = 110; // para tamaño grande
                    //$x = 115; // para tamaño chico
                }
                //$this->card($this->pdf, $data[$i],$x,$y);
                $this->card_big($this->pdf, $data[$i],$x,$y);  
            }             
            $this->pdf->output();
        }
    }


    private function card_big($obj, $data, $x, $y){
        // Obtenemos los datos para el carnet
        list($season_id, $team_id, $player_id) = explode('/', $data);
        $card = $this->card_model->find_data_card($team_id,$player_id,$season_id);
        switch ($card->category) {
            case 1: // masculino
                if (in_array($card->type_player, array(1, 2,4,6,8,10))) {
                    $template = 'masculino-residente-grande.png';
                } else {
                    $template = 'masculino-libre-grande.png';
                }
                break;
            case 2: // femenino
                if (in_array($card->type_player, array(1, 3, 5,7,9,10))) {
                    $template = 'femenino-residente-grande.png';
                } else {
                    $template = 'femenino-libre-grande.png';
                }
                break;
            case 3: // standar masculino
                if (in_array($card->type_player, array(1, 2,4,6,8,10))) {
                    $template = 'masculino-residente-standar-grande.png';
                } else {
                    $template = 'masculino-libre-standar-grande.png';
                }
                break;
            default: // standar femenino
                if (in_array($card->type_player, array(1, 3, 5,7,9,10))) {
                    $template = 'femenino-residente-standar-grande.png';
                } else {
                    $template = 'femenino-libre-standar-grande.png';
                }
                break;
        }        
        $obj->Image($_SERVER['DOCUMENT_ROOT'].'/assets/images/template_card/'.$template,$x+0,$y+0, 85.09,53.34);
        // Escudo del equipo
        if (!empty($card->emblem) && file_exists($_SERVER['DOCUMENT_ROOT'].'/assets/photos/shields/'.$card->emblem)) {
            $obj->Image($_SERVER['DOCUMENT_ROOT'].'/assets/photos/shields/'.$card->emblem,$x+39,$y+1, 16,16);
        }       
        // Imagen qr 
        $obj->Image($_SERVER['DOCUMENT_ROOT'].'/assets/images/qr.png',$x+68.1,$y+0, 17,17);
        
        if (!empty($card->photo && file_exists($_SERVER['DOCUMENT_ROOT'].'/assets/uploads/photos/'.$card->photo))) {
            $obj->Image($_SERVER['DOCUMENT_ROOT'].'/assets/uploads/photos/'.$card->photo,$x+0,$y+22.3, 20.4,20.4);
        } else if(!empty($card->photo_player) && file_exists($_SERVER['DOCUMENT_ROOT'].'/assets/photos/players/'.$card->photo_player)){
            $obj->Image($_SERVER['DOCUMENT_ROOT'].'/assets/photos/players/'.$card->photo_player,$x+0,$y+22.3, 20.4,20.4);
        }        
        $obj->SetFont('Arial', 'B', 8);
        // Calculo edad
        if (in_array($card->category, array(3,4))) {
            if (isset($card->birth) && !empty($card->birth)) {
                $edad = edad($card->birth);                
                if ($edad > 34) {     
                    $obj->SetXY($x+6.8,$y+18.3);               
                    $obj->Cell(6, 6, '> 35' , 0);
                } else {
                    $obj->SetXY($x+7.8,$y+18.3);
                    $obj->Cell(6, 6, $edad , 0);
                }
            }
            
        }
        $obj->SetFont('Arial', '', 6);
        // Nombre del equipo
        $obj->SetXY($x+27.5,$y+19.5);
        $obj->Cell(40, 6, strtoupper(utf8_decode($card->short_name)), 0);
        // Apellid
        $obj->SetXY($x+30,$y+23.95);
        $obj->Cell(35, 6, strtoupper(utf8_decode($card->last_name)), 0);
        // Nombre
        $obj->SetXY($x+30,$y+28.35);
        $obj->Cell(35, 6, strtoupper(utf8_decode($card->first_name)), 0);
        // Tipo jugador
        $obj->SetXY($x+35,$y+33);
        $obj->Cell(35, 6, strtoupper(type_player()[$card->type_player]), 0);
        // N° carnet
        $obj->SetFont('Arial', 'B', 8);
        $obj->SetXY($x+31,$y+37.2);
        $obj->Cell(35, 6, strtoupper($card->number), 0);
        // Valido desde
        $obj->SetFont('Arial', '', 6);
        $obj->SetXY($x+34,$y+42.5);
        $obj->Cell(35, 6, date('d/m/Y', strtotime($card->datetime)), 0);
    }

    private function card($obj, $data, $x, $y){
        // Obtenemos los datos para el carnet
        list($season_id, $team_id, $player_id) = explode('/', $data);
        $card = $this->card_model->find_data_card($team_id,$player_id,$season_id);
        switch ($card->category) {
            case 1: // masculino
                if (in_array($card->type_player, array(1, 2,4,6,8,10))) {
                    $template = 'masculino-residente.png';
                } else {
                    $template = 'masculino-libre.png';
                }
                break;
            case 2: // femenino
                if (in_array($card->type_player, array(1, 3, 5,7,9,10))) {
                    $template = 'femenino-residente.png';
                } else {
                    $template = 'femenino-libre.png';
                }
                break;
            case 3: // standar masculino
                if (in_array($card->type_player, array(1, 2,4,6,8,10))) {
                    $template = 'masculino-residente-standar.png';
                } else {
                    $template = 'masculino-libre-standar.png';
                }
                break;
            default: // standar femenino
                if (in_array($card->type_player, array(1, 3, 5,7,9,10))) {
                    $template = 'femenino-residente-standar.png';
                } else {
                    $template = 'femenino-libre-standar.png';
                }
                break;
        }        
        $obj->Image($_SERVER['DOCUMENT_ROOT'].'/assets/images/template_card/'.$template,$x+0,$y+0, 78.99,53.34);

        if (!empty($card->emblem) && file_exists($_SERVER['DOCUMENT_ROOT'].'/assets/photos/shields/'.$card->emblem)) {
            $obj->Image($_SERVER['DOCUMENT_ROOT'].'/assets/photos/shields/'.$card->emblem,$x+34,$y+1, 16,16);
        }        
        $obj->Image($_SERVER['DOCUMENT_ROOT'].'/assets/images/qr.png',$x+62,$y+0, 17,17);
        
        if (!empty($card->photo && file_exists($_SERVER['DOCUMENT_ROOT'].'/assets/uploads/photos/'.$card->photo))) {
            $obj->Image($_SERVER['DOCUMENT_ROOT'].'/assets/uploads/photos/'.$card->photo,$x+0,$y+22.3, 20.4,20.4);
        } else if(!empty($card->photo_player) && file_exists($_SERVER['DOCUMENT_ROOT'].'/assets/photos/players/'.$card->photo_player)){
            $obj->Image($_SERVER['DOCUMENT_ROOT'].'/assets/photos/players/'.$card->photo_player,$x+0,$y+22.3, 20.4,20.4);
        }        
        $obj->SetFont('Arial', 'B', 8);
        // Calculo edad
        if (in_array($card->category, array(3,4))) {
            if (isset($card->birth) && !empty($card->birth)) {
                $edad = edad($card->birth);                
                if ($edad > 34) {     
                    $obj->SetXY($x+6.8,$y+18.3);               
                    $obj->Cell(6, 6, '> 35' , 0);
                } else {
                    $obj->SetXY($x+7.8,$y+18.3);
                    $obj->Cell(6, 6, $edad , 0);
                }
            }
            
        }
        $obj->SetFont('Arial', '', 6);
        // Nombre del equipo
        $obj->SetXY($x+27.5,$y+19.5);
        $obj->Cell(40, 6, strtoupper(utf8_decode($card->short_name)), 0);
        // Apellid
        $obj->SetXY($x+30,$y+23.95);
        $obj->Cell(35, 6, strtoupper(utf8_decode($card->last_name)), 0);
        // Nombre
        $obj->SetXY($x+30,$y+28.35);
        $obj->Cell(35, 6, strtoupper(utf8_decode($card->first_name)), 0);
        // Tipo jugador
        $obj->SetXY($x+35,$y+33);
        $obj->Cell(35, 6, strtoupper(type_player()[$card->type_player]), 0);
        // N° carnet
        $obj->SetFont('Arial', 'B', 8);
        $obj->SetXY($x+31,$y+37.2);
        $obj->Cell(35, 6, strtoupper($card->number), 0);
        // Valido desde
        $obj->SetFont('Arial', '', 6);
        $obj->SetXY($x+34,$y+42.5);
        $obj->Cell(35, 6, date('d/m/Y', strtotime($card->datetime)), 0);
    }

    public function save_photo(){
        $imagenCodificada = file_get_contents("php://input"); //Obtener la imagen
        if(strlen($imagenCodificada) <= 0) exit("No se recibió ninguna imagen");
        //La imagen traerá al inicio data:image/png;base64, cosa que debemos remover
        $imagenCodificadaLimpia = str_replace("data:image/png;base64,", "", urldecode($imagenCodificada));

        //Venía en base64 pero sólo la codificamos así para que viajara por la red, ahora la decodificamos y
        //todo el contenido lo guardamos en un archivo
        $imagenDecodificada = base64_decode($imagenCodificadaLimpia);
        $filename = uniqid().'.png';
        //Calcular un nombre único
        $nombreImagenGuardada = $_SERVER['DOCUMENT_ROOT']."/assets/uploads/photos/photo_". $filename;

        // $this->load->library('image_lib');
        // $config['image_library']  = 'gd2';
        // $config['source_image']   = $_SERVER['DOCUMENT_ROOT']."/assets/uploads/photos/photo_". $filename;
        // $config['new_image']      = $_SERVER['DOCUMENT_ROOT']."/assets/photos/players/thumbs/photo_". $filename;
        // $config['maintain_ratio'] = true;
        // $config['width']          = 75;
        // $config['height']         = 75;
        // $this->image_lib->clear();
        // $this->image_lib->initialize($config);
        // $this->image_lib->resize();
        //Escribir el archivo
        file_put_contents($nombreImagenGuardada, $imagenDecodificada);

        //Terminar y regresar el nombre de la foto
        $location = base_url('assets/uploads/photos/photo_'. uniqid() . '.png');
        exit($nombreImagenGuardada);
        //exit($nombreImagenGuardada);
    }

    public function edit() {
        $team_id = (int) $this->uri->segment(4);
        $player_id = (int) $this->uri->segment(5);
        $season_id = (int) $this->uri->segment(3);
        
        $card = $this->card_model->find_data_card($team_id,$player_id,$season_id);
        
        if ($card) {
            $this->team_model->order_by('t_name');
            $data['card'] = $card;
            $data['teams'] = array_by_key_value('id', 't_name', $this->team_model->find_all(), 'No seleccionado');
            $data['seasons'] = array_by_key_value('id', 'name', $this->season_model->find_all_by_tournament(), 'No seleccionado');
            
            echo $this->load->view('cards/edit', $data, TRUE);
        } else {
            echo '<p>Datos no disponibles.</p>';
        }
    }

    public function save_edit(){
        if ($this->input->is_ajax_request()) {
            $where = array(
                'team_id' => $_POST['team_id'], 
                'player_id' => $_POST['player_id'], 
                'season_id' => $_POST['season_id']
            );
            $data = array(
                'number' => $_POST['number'],
                'type_player' => $_POST['type_player'],
                'datetime' => formatDate($_POST['datetime'],'d/m/Y','Y-m-d').' '.date('H:i:s'),
                'category' => $_POST['category'],
                'status' => $_POST['status'],
                'card' => 1
            );
            
            if ($this->card_model->update($where, $data)) {
                $this->futuro->send_json(['error' => 0, 'msg' => 'Actualizado']);
            } else {
                $this->futuro->send_json(['error' => 1, 'msg' => 'No se actualizo']);
            }
            
        } else {
            redirect('404');
        }
    }

    public function test(){
        $this->load->library('pdf');        
        // Obtenemos los datos para el carnet
        $card = $this->card_model->find_data_card(79,1,32);
        switch ($card->category) {
            case 1: // masculino
                if (in_array($card->type_player, array(1, 2,4,6,8,10))) {
                    $template = 'masculino-residente.png';
                } else {
                    $template = 'masculino-libre.png';
                }
                break;
            case 2: // femenino
                if (in_array($card->type_player, array(1, 3, 5,7,9,10))) {
                    $template = 'femenino-residente.png';
                } else {
                    $template = 'femenino-libre.png';
                }
                break;
            case 3: // standar masculino
                if (in_array($card->type_player, array(1, 2,4,6,8,10))) {
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
        $this->pdf->AddPage('L', array(78.99,53.34));
        $this->pdf->Image($_SERVER['DOCUMENT_ROOT'].'/assets/images/template_card/'.$template,0,0, 78.99,53.34);
        $this->pdf->Image($_SERVER['DOCUMENT_ROOT'].'/assets/photos/shields/'.$card->emblem,35,1, 16,16);
        $this->pdf->Image($_SERVER['DOCUMENT_ROOT'].'/assets/images/qr.png',62,0, 17,17);
        if (!empty($card->photo)) {
            $this->pdf->Image($_SERVER['DOCUMENT_ROOT'].'/assets/uploads/photos/'.$card->photo,0,22.3, 20.4,20.4);
        }        
        $this->pdf->SetAutoPageBreak(true, 0);

        $this->pdf->SetFont('Arial', 'B', 8);
        // Calculo edad
        if (in_array($card->category, array(3,4)) || true) {
            if (isset($card->birth) && !empty($card->birth)) {
                $edad = edad($card->birth);                
                if ($edad > 34) {     
                    $this->pdf->SetXY(6.8,18.3);               
                    $this->pdf->Cell(6, 6, '> 35' , 0);
                } else {
                    $this->pdf->SetXY(7.8,18.3);
                    $this->pdf->Cell(6, 6, $edad , 0);
                }
            }
            
        }
        $this->pdf->SetFont('Arial', '', 6);
        // Nombre del equipo
        $this->pdf->SetXY(27.5,19.5);
        $this->pdf->Cell(40, 6, strtoupper($card->short_name), 0);
        // Apellid
        $this->pdf->SetXY(29.5,23.95);
        $this->pdf->Cell(35, 6, strtoupper($card->last_name), 0);
        // Nombre
        $this->pdf->SetXY(29.7,28.35);
        $this->pdf->Cell(35, 6, strtoupper(utf8_decode($card->first_name)), 0);
        // Tipo jugador
        $this->pdf->SetXY(34,33);
        $this->pdf->Cell(35, 6, strtoupper(type_player()[$card->type_player]), 0);
        // N° carnet
        $this->pdf->SetFont('Arial', 'B', 8);
        $this->pdf->SetXY(31,37.2);
        $this->pdf->Cell(35, 6, strtoupper($card->number), 0);
        // Valido desde
        $this->pdf->SetFont('Arial', '', 6);
        $this->pdf->SetXY(34,42.5);
        $this->pdf->Cell(35, 6, date('d/m/Y', strtotime($card->datetime)), 0);

        $this->pdf->output();
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
                $result = $this->card_model->update($where, $data);
            } else {
                $this->card_model->insert($data);
                $result = 1;
            }      
            if ($result) {
                // player list
                $this->load->model('players/playerlist_model');
                if (!$this->playerlist_model->find_by($where)) {
                    $this->playerlist_model->insert($where);
                }                
            }
        }
        return $result;
    }

    public function actions() {

        $this->form_validation->set_rules('form_action', lang('form_action'), 'required');
    
        if ($this->form_validation->run() == true) {
            if (!empty($_POST['val'])) {
                if ($this->input->post('form_action') == 'delete') {
                    $c = 0;
                    foreach ($_POST['val'] as $k => $v) {
                        list($s,$t,$p) = explode('/', $v);
                        if (isset($s) && isset($t) && isset($p)) {
                            $where = array(
                                'team_id' => $t,
                                'player_id' => $p,
                                'season_id' => $s
                            );
                            //$this->card_model->update($where,array('confirmed' => 0));
                            if ($this->card_model->delete_where($where)) {
                                $c++;
                            }
                        }
                    }
                    Template::set_message(lang('cards_deleted_success').' : '.$c, 'success');

                    redirect($_SERVER['HTTP_REFERER']);
                }
                // Print abonos
                if ($this->input->post('form_action') == 'print_cards') {
                    if (count($_POST['val']) > 10) {
                        Template::set_message('Imprimir en cantidades no mayor a 10', 'warning');
                        redirect($_SERVER['HTTP_REFERER']);
                    } else {
                        $this->print_a4($_POST['val']); // grande
                        if (!empty($_POST['val'])) {
                            foreach ($_POST['val'] as $v) {
                                list($s,$t,$p) = explode('/', $v);
                                $where = array(
                                    'team_id' => $t,
                                    'player_id' => $p,
                                    'season_id' => $s
                                );
                                //$this->card_model->update($where,array('status' => 'T'));
                            }
                        }
                        exit();
                    }                    
                }
                if ($this->input->post('form_action') == 'status_pending') {
                    if (!empty($_POST['val'])) {
                        foreach ($_POST['val'] as $v) {
                            list($s,$t,$p) = explode('/', $v);
                            $where = array(
                                'team_id' => $t,
                                'player_id' => $p,
                                'season_id' => $s
                            );
                            $this->card_model->update($where,array('status' => 'F'));
                        }
                        Template::set_message('Cambio de estado realizado', 'success');
                        redirect($_SERVER['HTTP_REFERER']);
                    }
                    exit();
                }
            } else {
                $this->session->set_flashdata('danger', lang('no_user_selected'));
                redirect($_SERVER['HTTP_REFERER']);
            }
        } else {
            Template::set_message(validation_errors(), 'danger');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    // Methods Ajax
    function get_cards() {
        if (!$this->input->is_ajax_request()) {
            redirect('404', 'refresh');
        } else {
            $this->load->library('datatables');
            $this->datatables->set_database('joomla');
            $action = '<div class="text-center"><a class="tip" title="Editar" href="'.site_url('cards/edit/$1').'" data-toggle="modal" data-target="#myModal"><i class="fa fa-edit"></i></a></div>';
            $this->datatables
                ->select('concat_ws("/",t4.s_id,t3.id,t2.id) as id, concat_ws(" ",t2.last_name, t2.first_name) as full_name, t3.t_name, concat_ws(" - ",t4.s_name,t5.name) as tournament, t1.number, t1.type_player, t1.datetime, t1.status')
                ->from('co_bl_players_team as t1')
                ->join('co_bl_players as t2', 't2.id = t1.player_id', 'left')
                ->join('co_bl_teams as t3', 't3.id = t1.team_id', 'left')
                ->join('co_bl_seasons as t4', 't4.s_id = t1.season_id', 'left')
                ->join('co_bl_tournament as t5', 't5.id = t4.t_id','left')
                ->where('t1.card',1)
                ->add_column('Actions', $action, 'id');
            echo $this->datatables->generate();
        }
    }
}