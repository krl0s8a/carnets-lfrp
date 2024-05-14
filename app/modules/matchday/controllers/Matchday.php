<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Matchday extends MY_Controller {

	function __construct(){
		parent::__construct();

		$this->load->model(array('matchday_model','match_model','players/players_team_model','seasons/season_model','teams/team_model','tournament/tournament_model'));
		$this->load->helper(array('date','players/player'));
		$this->lang->load('matchday');
		Assets::add_module_js('matchday', 'matchday.js');
        Template::set_block('sub_nav', '_sub_nav');
	}

	public function index()	{
		Template::render();
	}

	public function test(){
		
	}

	public function edit(){
		$id = (int) $this->uri->segment(3);
        if (empty($id)) {
            Template::set_message(lang('invalid_id'), 'danger');
            redirect('matchday');
        }
        $matches = $this->match_model->getMatches($id);
        $matchday = $this->matchday_model->find($id);

        Template::set('matchday', $matchday);
        Template::set('matches', $matches);
        Template::render();
	}

	public function print_game_sheet($match){
		$match = $this->match_model->getMatch($match);
		$matchday = $this->matchday_model->find($match->m_id);

		$season = $this->season_model->find($matchday->s_id);
		$tournament = $this->tournament_model->find($season->t_id);

		$players_team1 = $this->players_team_model->playersByTeamOrderName($matchday->s_id, $match->team1_id);
		$players_team2 = $this->players_team_model->playersByTeamOrderName($matchday->s_id, $match->team2_id);

		$this->load->library('pdf');   
		$pdf = new Pdf('P','mm','A4');  
		$pdf->setMargins(0, 0, 0);
        $pdf->AddPage('L', array(297, 210));
        $pdf->SetAutoPageBreak(true, 0);
		$pdf->Image($_SERVER['DOCUMENT_ROOT'].'/assets/images/lfrp.jpg',90,5, 60,13);  
		//$pdf->AddPage('L');
        $pdf->SetXY(3.5,3);
        $pdf->Cell(290,16,'',1);
        $pdf->SetXY(3.5,3);
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(145,8,$matchday->m_name.' | '.$season->s_name,0);
        // Nombre del torneo
        $pdf->SetXY(3.5,11);
        $pdf->Cell(145,8,strtoupper($tournament->name),0);

        $pdf->SetXY(148.5,3);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(50,8,'DIA DE JUEGO: '.formatDate($match->m_date,'Y-m-d','d/m/Y'),0);
        $pdf->Cell(30,8,'HORA: '.$match->m_time,0);
        $pdf->Cell(65,8,'CANCHA: '.$match->v_name,0);

        $pdf->SetXY(148.5,11);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(72.5,8,'Inicio/Final 1er tiempo: ................../...............',0);
        $pdf->Cell(75.5,8,'Inicio/Final 2do tiempo: ................../...............',0);
        // Nombre de equipos
        $pdf->SetXY(3.5,19);
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->SetFillColor(128,128,128);
        $pdf->Cell(145,7,'LOCAL: '.strtoupper($match->team1),1,'','C',true);
        $pdf->Cell(145,7,'VISITANTE: '.strtoupper($match->team2),1,'','C',true);
        // Titulos
        $pdf->SetXY(3.5,26);
        $pdf->SetFont('Arial', 'B', 7);
        $pdf->Cell(8,5,utf8_decode('N°'),1,'','C');
        $pdf->Cell(55,5,'APELLIDO Y NOMBRE',1);
        $pdf->Cell(12,5,'CARNET',1);
        $pdf->Cell(6,5,'T/S',1);
        $pdf->Cell(20,5,'DNI',1,'','C');
        $pdf->Cell(25,5,'FIRMA',1,'','C');
        $pdf->Cell(6,5,'A',1,'','C');
        $pdf->Cell(6,5,'R',1,'','C');
        $pdf->Cell(7,5,'GOL',1,'','C');

        $pdf->Cell(8,5,utf8_decode('N°'),1,'','C');
        $pdf->Cell(55,5,'APELLIDO Y NOMBRE',1);
        $pdf->Cell(12,5,'CARNET',1);
        $pdf->Cell(6,5,'T/S',1);
        $pdf->Cell(20,5,'DNI',1,'','C');
        $pdf->Cell(25,5,'FIRMA',1,'','C');
        $pdf->Cell(6,5,'A',1,'','C');
        $pdf->Cell(6,5,'R',1,'','C');
        $pdf->Cell(7,5,'GOL',1,'','C');

        // Lista de jugadores
        $pdf->SetFont('Arial', '', 9);
        // Equipo local
        $x = 31;
        for ($i = 0; $i < 25; ++$i) {
        	$pdf->SetXY(3.5,$x);
		    $pdf->Cell(8,6,'',1,'','C');
	        $pdf->Cell(55,6, isset($players_team1[$i]) ? utf8_decode($players_team1[$i]->last_name.', '.$players_team1[$i]->first_name) : '' ,1);
	        $pdf->Cell(12,6,isset($players_team1[$i]) ? utf8_decode($players_team1[$i]->number) :'',1,'','C');
	        $pdf->Cell(6,6,'',1);
	        $pdf->Cell(20,6,'',1);
	        $pdf->Cell(25,6,'',1);
	        $pdf->Cell(6,6,'',1);
	        $pdf->Cell(6,6,'',1);
	        $pdf->Cell(7,6,'',1);   	
	        $x = $x + 6;
        }

        // Equipo visitante
        $x = 31;
        for ($i = 0; $i < 25; ++$i) {
        	$pdf->SetXY(148.5,$x);
		    $pdf->Cell(8,6,'',1,'','C');
	        $pdf->Cell(55,6, isset($players_team2[$i]) ? utf8_decode($players_team2[$i]->last_name.', '.$players_team2[$i]->first_name) : '' ,1);
	        $pdf->Cell(12,6,isset($players_team2[$i]) ? utf8_decode($players_team2[$i]->number) :'',1,'','C');
	        $pdf->Cell(6,6,'',1);
	        $pdf->Cell(20,6,'',1);
	        $pdf->Cell(25,6,'',1);
	        $pdf->Cell(6,6,'',1);
	        $pdf->Cell(6,6,'',1);
	        $pdf->Cell(7,6,'',1);   	
	        $x = $x + 6;
        }
        
        $pdf->SetXY(3.5,181);
        $pdf->Cell(145,6,'TOTAL GOLES (Local): ',1,'','C');
        $pdf->Cell(145,6,'TOTAL GOLES (Visitante): ',1,'','C');

        $pdf->SetXY(3.5,187);
        $pdf->Cell(145,20,'',1);
        $pdf->Cell(145,20,'',1);

        $pdf->SetXY(3.5,202);
        $pdf->Cell(145,5,'FIRMA Y ACLARACION (CAPITAN)',0,'','C');
        $pdf->Cell(145,5,'FIRMA Y ACLARACION (CAPITAN)',0,'','C');

        $pdf->output('D',$match->team1.' vs '.$match->team2);
	}

	/**
	 * Lista de jugadores de un equipo / Modal
	 */
	public function players_by_team($team_id, $matchday_id){
		$matchday = $this->matchday_model->find($matchday_id);
		$data['team'] = $this->team_model->find($team_id);
		$data['players'] = $this->players_team_model->playersByTeamOrderName($matchday->s_id, $team_id);
		$data['type_player'] = type_player();
		echo $this->load->view('players_by_team', $data, TRUE);
	}

	function get_matchday(){
		if (!$this->input->is_ajax_request()) {
			redirect('404');
		} else {
			$this->load->library('datatables');
			$action = '';
			$this->datatables->set_database('joomla');
            $this->datatables
                ->select('t1.id as id, t1.id as ref, t1.m_name as namematchday, is_playoff, t1.ordering, t2.s_name, t3.name')
                ->from('co_bl_matchday as t1')
                ->join('co_bl_seasons as t2','t2.s_id = t1.s_id','left')
                ->join('co_bl_tournament as t3', 't3.id = t2.t_id', 'left')
                ->edit_column('ref', '$1__$2', 'ref,id')
                ->add_column('Actions', $action, 'id');
            echo $this->datatables->generate();
		}
	}

}