<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Schools extends MY_Controller {
	private $schoolAdd = 'System.School.Add';
    private $schoolManage = 'System.School.Manage';
    private $schoolDelete = 'System.School.Delete';
    private $schoolEdit = 'System.School.Edit';
	function __construct() {
		parent::__construct();
		$this->lang->load('schools');
		$this->load->model('school_model');

		Assets::add_module_js('schools', 'schools.js');
		Template::set_block('sub_nav', '_sub_nav');
	}

	public function index() {
		$this->auth->restrict($this->schoolManage);
		Template::set('toolbar_title', lang('management_schools'));
		Template::render();
	}

	public function create() {
		$this->auth->restrict($this->schoolAdd);
		if (isset($_POST['save'])) {
			if ($id = $this->save('insert')) {
				log_activity(
					$this->current_user->id,
					lang('act_create_school') . ' : ' . $id,
					'schools'
				);
				Template::set_message(lang('school_created_success'), 'success');
				Template::redirect('schools');
			} else {
				Template::set_message(lang('school_created_failure'), 'danger');
			}
		}

		$this->load->model('cities/city_model');
		$cities = $this->city_model->getCities();
		Template::set('cities', $cities);
		Template::set('toolbar_title', lang('create_school'));
		Template::render();
	}

	public function edit() {
		$this->auth->restrict($this->schoolEdit);
		$id = (int) $this->uri->segment(3);
		if (empty($id)) {
			Template::set_message(lang('invalid_id'), 'danger');
			redirect('schools');
		}

		if (isset($_POST['save'])) {
			if ($this->save('update', $id)) {
				log_activity(
					$this->current_user->id,
					lang('act_update_school') . ' : ' . $id,
					'schools'
				);
				Template::set_message(lang('school_edit_success'), 'success');
			} else {
				Template::set_message(lang('school_edit_failure'), 'danger');
			}
		}

		$this->load->model('cities/city_model');
		$cities = $this->city_model->getCities();
		Template::set('cities', $cities);
		Template::set('toolbar_title', lang('edit_school'));
		Template::set('school', $this->school_model->find($id));
		Template::render();
	}
	/**
	 * Vista de los datos de una escuela
	 */
	public function view($id = null) {
		$this->auth->restrict($this->schoolView);
		$this->load->model('cities/city_model');
		$data['cities'] = $this->city_model->getCities();
		$data['school'] = $this->school_model->find($id);
		$this->load->view('schools/view', $data);
	}

	public function delete($id = null){
		$this->auth->restrict($this->schoolDelete);

		if ($this->input->get('id')) {
            $id = $this->input->get('id');
        }

        if ($this->school_model->delete($id)) {
			log_activity(
                $this->current_user->id,
                lang('act_delete_school') . ' : ' . $id,
                'schools'
            );
            if ($this->input->is_ajax_request()) {
                $this->futuro->send_json(['error' => 0, 'msg' => lang('school_delete_success')]);
            }
            Template::set_message(lang('school_delete_success'), 'success');
        	Template::redirect('schools');
        }        
	}
	/**
	 * Docentes por escuela
	 */
	public function teachers($id = null) {

		$this->load->model('passengers/passenger_school_model');

		$data['school'] = $this->school_model->find($id);
		$data['teachers'] = $this->passenger_school_model->getTeacherBySchool($id);
		$this->load->view('schools/teachers', $data);
	}
	/**
	 * Acciones sobre un abonos (borrar, excel e imprimir)
	 */
	public function schoolsActions() {

		$this->form_validation->set_rules('form_action', lang('form_action'), 'required');

		if ($this->form_validation->run() == true) {
			if (!empty($_POST['val'])) {

				if ($this->input->post('form_action') == 'delete') {
					$this->auth->restrict($this->schoolDelete);
					$q = '';
					foreach ($_POST['val'] as $k => $v) {
						if($this->school_model->delete($v)){
							$q .= $v.',';
						}
					}
					log_activity(
						$this->current_user->id,
						lang('act_deleted_school') . ' : '.substr($q, 0, -1),
						'schools'
					);
					Template::set_message(lang('school_deleted_success'), 'success');

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
			redirect($_SERVER['HTTP_REFERER']);
		}
	}

	// Methods private
	private function save($type = 'insert', $id = 0) {
		$this->form_validation->set_rules($this->school_model->get_validation_rules($type));
		if ($this->form_validation->run() === false) {
			return false;
		}
		$data = $this->school_model->prep_data($_POST);

		if ($type == 'insert') {
			$id = $this->school_model->insert($data);
			if (is_numeric($id)) {
				$result = $id;
			}
		} else {
			$result = $this->school_model->update($id, $data);
		}
		return $result;
	}

	// Methods Ajax
	function getSchools() {
		if (!$this->input->is_ajax_request()) {
			redirect('404', 'refresh');
		} else {
			$teachers = '<a href="' . site_url('schools/teachers/$1') . '" data-toggle="modal" data-target="#myModal"><i class="fa fa-users"></i> ' . lang('teachers_school') . '</a>';
			$delete_link = "<a href='#' class='tip po' title='<b>" . $this->lang->line('delete_school') . "</b>' data-content=\"<p>"
				. lang('r_u_sure') . "</p><a class='btn btn-danger po-delete-school' id='a__$1' href='" . site_url('schools/delete/$1') . "'>"
				. lang('i_m_sure') . "</a> <button class='btn po-close'>" . lang('no') . "</button>\"  rel='popover'><i class=\"fa fa-trash-o\"></i> "
				. lang('delete_school') . '</a>';

			$action = '<div class="text-center"><div class="btn-group text-left">'
				. '<button type="button" class="btn btn-default btn-xs btn-primary dropdown-toggle" data-toggle="dropdown">'
				. lang('actions') . ' <span class="caret"></span></button>
	        <ul class="dropdown-menu pull-right" role="menu">
	            
	            <li><a href="' . site_url('schools/edit/$1') . '"><i class="fa fa-edit"></i> ' . lang('edit_school') . '</a></li><li class="divider"></li><li> ' . $delete_link . '</li>';
			$action .= '</ul></div></div>';

			$this->load->library('datatables');
			$this->datatables
				->select('t1.id as id, t1.name as name, t1.number, t1.cue, t1.level, t2.name as city_name')
				->from('schools as t1')
				->join('cities as t2', 't2.id = t1.city_id', 'left')
				->edit_column('name', '$1__$2', 'name, id')
				->add_column('Actions', $action, 'id');
			//->add_column('Actions', "<div class=\"text-center\"><a href='" . site_url('schools/teachers/$1') . "' class='tip' title='" . lang('teachers_school') . "' data-toggle='modal' data-target='#myModal'> <i class=\"fa fa-users\"></i> </a><a href='" . site_url('schools/edit/$1') . "' class='tip' title='" . lang('edit_school') . "'> <i class=\"fa fa-edit\"></i> </a></div>", 'id');

			echo $this->datatables->generate();
		}
	}

}

/* End of file Rrhh.php */
/* Location: .//D/www/futuro-srl/app/modules/rrhh/controllers/Rrhh.php */