<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Purchases extends MY_Controller {

	function __construct(){
		parent::__construct();
		$this->lang->load('purchases');
		$this->load->model('purchase_model');
		
		Assets::add_module_js('purchases', 'purchases.js');
		Template::set_block('sub_nav', '_sub_nav');
	}

	public function index(){
		Template::set('toolbar_title', lang('mngt_purchases'));
		Template::render();
	}

	public function create(){
		
		$this->load->model('state_model');
		$data['states'] = $this->state_model->getStates();
		echo $this->load->view('purchases/create', $data, TRUE);
	}

	public function edit(){
		$id = (int) $this->uri->segment(3);
		if (empty($id)) {
			Template::set_message(lang('invalid_id'), 'danger');
            redirect('purchases');
		}

		$this->load->model('state_model');
		$data['states'] = $this->state_model->getStates();
		$data['city'] = $this->city_model->find($id);
		echo $this->load->view('purchases/edit', $data, TRUE);
	}

	public function updateCity(){
		$this->form_validation->set_rules($this->city_model->get_validation_rules('update'));
		$data = $this->city_model->prep_data($_POST);
		if ($this->form_validation->run($this) == TRUE && isset($_POST['id'])) {
			if ($this->city_model->update($_POST['id'], $data)) {
				log_activity(
	                $this->current_user->id,
	                lang('act_update_city') . ' : '.$_POST['id'],
	                'Localidades'
	            );
	            echo json_encode(['error' => 0, 'msg' => lang('city_edit_success')]);
			} else {
				echo json_encode(['error' => 1, 'msg' => lang('city_edit_failure')]);
			}
		} else {
			echo json_encode(['error' => 1, 'msg' => validation_errors()]);
		}
	}

	public function createCity(){
		$this->form_validation->set_rules($this->city_model->get_validation_rules('insert'));
		$data = $this->city_model->prep_data($_POST);
		if ($this->form_validation->run() == TRUE) {
			if ($id = $this->city_model->insert($data)) {
				log_activity(
	                $this->current_user->id,
	                lang('act_create_city') . ' : '.$id,
	                'Localidades'
	            );
	            echo json_encode(['error' => 0, 'msg' => lang('city_created_success')]);
			} else {
				echo json_encode(['error' => 1, 'msg' => lang('city_created_failure')]);
			}
		} else {
			echo json_encode(['error' => 1, 'msg' => validation_errors()]);
		}
	}

	/**
	 * Acciones sobre un abonos (borrar, excel e imprimir)
	 */
	public function citiesActions(){

        $this->form_validation->set_rules('form_action', lang('form_action'), 'required');
        
        if ($this->form_validation->run() == true) {
            if (!empty($_POST['val'])) {           	

                if ($this->input->post('form_action') == 'delete') {
                	foreach ($_POST['val'] as $k => $v) {
                		$this->city_model->delete($v);
                		log_activity(
			                $this->current_user->id,
			                lang('act_delete_city') . ' : '.$v,
			                'Localidades'
			            );
                	}
                	Template::set_message(lang('city_deleted_success'),'success');

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

	// Methods Ajax
	function getPurchases(){
		if (!$this->input->is_ajax_request()) {
            redirect('404','refresh');
        } else {
            $this->load->library('datatables');
            $this->datatables
                ->select('t1.id as id, t1.id as ida, t1.code, t1.name, t2.name as state, t1.status as status')
                ->from('purchases as t1')
                ->join('states as t2','t2.id = t1.state_id','left')
                ->edit_column('status', '$1__$2', 'status, id')
                ->add_column('Actions', "<div class=\"text-center\"><a href='" . site_url('purchases/edit/$1') . "' class='tip' title='" . lang('edit_city') . "' data-toggle=\"modal\" data-target=\"#myModal\"><i class=\"fa fa-edit\"></i></a></div>", 'id');

            echo $this->datatables->generate();
        }
	}	 
}