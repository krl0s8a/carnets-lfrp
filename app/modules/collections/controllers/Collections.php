<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Collections extends MY_Controller {

	function __construct(){
		parent::__construct();
		$this->lang->load('collections');
		$this->load->model('trips/trip_model');
		$this->load->helper('array','date');
		
		Assets::add_module_js('collections', 'collections.js');
		Template::set_block('sub_nav', '_sub_nav');
	}

	public function index(){

		$this->load->model('rrhh/rrhh_model');
		Template::set('drives', $this->rrhh_model->getChoferes());
		Template::set('toolbar_title', lang('management_trips'));
		Template::render();
	}

	public function create(){
		
		if (isset($_POST['save'])) {
			if ($id = $this->save('insert')) {
				log_activity(
                    $this->current_user->id,
                    lang('activity_create_trip') . ' : '."$id",
                    'passengers'
            	);
				Template::set_message(lang('trip_created_success'), 'success');
				Template::redirect('trips');
			} else {
				Template::set_message(lang('trip_created_failure'), 'danger');
			}
		}
		// Choferes
		$this->load->model('rrhh/rrhh_model');
		Template::set('choferes', $this->rrhh_model->getChoferes());
		// Buses
		$this->load->model('buses/bus_model');
		Template::set('buses', array_by_key_value('id','name',$this->bus_model->find_all()));
		// Services
		$this->load->model('services/service_model');
		Template::set('services', $this->service_model->find_all());
		// Tipo de boletos
		$this->load->model('tickets/ticket_model');
		$this->ticket_model->where('status','T');
		Template::set('tickets', $this->ticket_model->find_all());
		Template::set('toolbar_title', lang('create_trip'));
		Template::render();
	}

	public function edit(){

		$id = (int) $this->uri->segment(3);
		if (empty($id)) {
			Template::set_message(lang('invalid_id'), 'danger');
            redirect('trips');
		}

		if (isset($_POST['save'])) {
			
			if ($this->save('update', $id)) {
				Template::set_message(lang('trip_edit_success'), 'success');
			} else {
				Template::set_message(lang('trip_edit_failure'), 'danger');
			}
		}

		// Choferes
		$this->load->model('rrhh/rrhh_model');
		Template::set('choferes', $this->rrhh_model->getChoferes());
		// Buses
		$this->load->model('buses/bus_model');
		Template::set('buses', array_by_key_value('id','name',$this->bus_model->find_all()));
		// Services
		$this->load->model('services/service_model');
		Template::set('services', $this->service_model->find_all());
		// Tipo de boletos
		$this->load->model('tickets/ticket_model');
		$this->ticket_model->where('status','T');
		Template::set('tickets', $this->ticket_model->find_all());
		// Tipos de boletos asignados al viaje
		$this->load->model('trips/trip_ticket_model');
		Template::set('tickets_trip',$this->trip_ticket_model->keyTicketByTrip($id));
		Template::set('toolbar_title', lang('edit_trip'));
		Template::set('trip', $this->trip_model->find($id));
		Template::render();
	}

	public function view(){
		Template::set('toolbar_title', lang('view_trip'));
		Template::render();
	}

	public function delete(){
		//$this->sma->checkPermissions(null, true);

        if ($this->input->get('id')) {
            $id = $this->input->get('id');
        } else {
        	$id = $this->uri->segment(3);
        }

        if ($this->trip_model->delete($id)) {
            Template::set_message('Exito','success');
            redirect('trips');
        }
	}

	/**
	 * Acciones sobre un abonos (borrar, excel e imprimir)
	 */
	public function tripsActions(){

        $this->form_validation->set_rules('form_action', lang('form_action'), 'required');
        
        if ($this->form_validation->run() == true) {
            if (!empty($_POST['val'])) {           	

                if ($this->input->post('form_action') == 'delete') {
                	foreach ($_POST['val'] as $k => $v) {
                		$this->trip_model->delete($v);
                	}
                	Template::set_message(lang('trip_deleted_success'),'success');

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
        	Template::set_message(validation_errors(),'danger');
            //$this->session->set_flashdata('danger', validation_errors());
            redirect($_SERVER['HTTP_REFERER']);
        }
	}

	// Methods private
	private function save($type = 'insert', $id = 0){

		$data = $this->trip_model->prep_data($_POST);
		$data['date'] = formatDate($_POST['date'],'d/m/Y','Y-m-d');
		if ($type == 'insert') {
			$id = $this->trip_model->insert($data);
            if (is_numeric($id)) {
            	// ingresamos los tipos de boletos asociados
            	if (isset($_POST['tickets']) && is_array($_POST['tickets'])) {
            		$tickets = [];
            		foreach ($_POST['tickets'] as $k => $v) {
            			$tickets[] = array(
            				'trip_id' => $id,
            				'ticket_id' => $v,
            				'amount' => 0
            			);
            		}
            		$this->load->model('trips/trip_ticket_model');
            		$this->trip_ticket_model->insert_batch($tickets);
            	}
                $result = $id;
            }
		} else {
			$result = $this->trip_model->update($id, $data);
		}
		return $result;
	}

	// Methods Ajax
	function getTrips(){
		if (!$this->input->is_ajax_request()) {
            redirect('404','refresh');
        } else {
        	$date = (isset($_POST['date']) && !empty($_POST['date'])) ? formatDate($_POST['date'],'d/m/Y','Y-m-d') : date('Y-m-d');
        	$this->load->model('trips/trip_model');
        	$this->trip_model->select('trips.date, services.name as  service, buses.name as bus, rrhh.last_name, rrhh.first_name, trips.status');
        	$this->trip_model->join('buses','buses.id = trips.bus_id','left');
        	$this->trip_model->join('services','services.id = trips.service_id','left');
        	$this->trip_model->join('rrhh','rrhh.id = trips.drive_id','left');
        	$this->trip_model->where('trips.date', $date);

        	$trips = $this->trip_model->find_all();
        	$html = '';

        	if (is_array($trips)) {
        		foreach ($trips as $k => $v) {
        			$html .= '<tr>';
        			$html .= '<td style="text-align: center;">'.formatDate($v->date,'Y-m-d','d/m/Y').'</td>';
        			$html .= '<td>'.$v->service.'</td>';
        			$html .= '<td>'.$v->bus.'</td>';
        			$html .= '<td>'.$v->last_name.' '.$v->first_name.'</td>';
        			if ($v->status == 'T') {
        				$html .= '<td>Habilitado</td>';
        			} else {
        				$html .= '<td>Suspendido</td>';
        			}
        			$html .= '<td style="text-align: center;"><a href="#">EE</a></td>';
        			$html .= '</tr>';
        		}
        	} else {
        		$html .= '<tr>';
    			$html .= '<td colspan="6">No hay viajes registrados para la fecha seleccionada</td>';
    			$html .= '</tr>';
        	}

        	echo $html;
        	
        }
	}	 
}