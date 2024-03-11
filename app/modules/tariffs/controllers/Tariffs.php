<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tariffs extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this->lang->load('tariffs');
		$this->load->model('tariff_model');
		$this->load->helper(array('array', 'date'));

		Assets::add_module_js('tariffs', 'tariffs.js');
		Assets::add_module_css('tariffs', 'tariffs.css');
		Template::set_block('sub_nav', '_sub_nav');
	}

	public function index() {

		Template::set('toolbar_title', lang('management_tariffs'));
		Template::render();
	}

	public function create() {

		if (isset($_POST['save'])) {

			if ($id = $this->save('insert')) {
				if (is_numeric($id)) {

					log_activity(
						$this->current_user->id,
						lang('activity_create_tariff') . ' : ' . "$id",
						'Tarifas'
					);
					Template::set_message(lang('tariff_create_success'), 'success');
					Template::redirect('tariffs');
				} else {
					Template::set_message(lang('tariff_create_failure'), 'danger');
				}
			}

		}
		// Recorridos para los abonos
		$this->load->model('lines/line_model');

		Template::set('lines', $this->line_model->find_all());
		Template::set('toolbar_title', lang('create_tariff'));
		Template::render();
	}

	public function edit($id = null) {

		if (isset($_POST['save'])) {
			if ($this->save('update', $id)) {
				log_activity(
					$this->current_user->id,
					lang('activity_update_tariff') . ' : ' . "$id",
					'Tarifas'
				);
				Template::set_message(lang('tariff_edit_success'), 'success');
			} else {

			}
		}
		$this->tariff_model->select('tariffs.*, routes.id as route_id');
		$this->tariff_model->join('routes', 'routes.line_id = tariffs.line_id', 'left');
		$this->tariff_model->order_by('routes.direction', 'asc');
		$tariff_arr = $this->tariff_model->find_all_by('tariffs.id', $id);

		if (is_array($tariff_arr)) {
			$arr = array();
			foreach ($tariff_arr as $tariff) {
				$this->load->model('routes/route_city_model');
				$arr[$tariff->route_id]['location_arr'] = $this->route_city_model->getLocationsByRoute($tariff->route_id);
				$location_id_arr = $this->route_city_model->getDataPair($tariff->route_id);

				$price_arr = array();
				if (!empty($location_id_arr)) {
					$this->load->model('tariffs/price_model');
					$this->price_model->where_in('from', $location_id_arr);
					$_price_arr = $this->price_model->find_all_by('route_id', $tariff->route_id);

					if (!empty($_price_arr)) {
						foreach ($_price_arr as $v) {
							$price_arr[$v->from . '_' . $v->to] = $v->price;
						}
					}
				}
				$arr[$tariff->route_id]['price_arr'] = $price_arr;

				$this->load->model('routes/route_model');
				$arr[$tariff->route_id]['route'] = $this->route_model->find($tariff->route_id);
			}

		}

		Template::set('arr', $arr);
		$this->load->model('routes/route_model');
		Template::set('routes', array_by_key_value('id', 'name', $this->route_model->find_all()));
		Template::set('tariff', $tariff);
		Template::set('toolbar_title', lang('edit_tariff'));
		Template::render();
	}

	public function activate($id, $code = false) {

		if ($this->tariff_model->update($id, array('status' => 'T'))) {
			Template::set_message(lang('activate_success'), 'success');
			Template::redirect('tariffs');
		}
	}

	public function desactivate($id = null) {

		if ($this->tariff_model->update($id, array('status' => 'F'))) {
			Template::set_message(lang('desactivate_success'), 'success');
			Template::redirect('tariffs');
		}
	}

	public function delete($id = null) {
		if ($this->input->get('id')) {
			$id = $this->input->get('id');
		}

		if ($this->tariff_model->delete($id)) {
			if ($this->input->is_ajax_request()) {
				log_activity(
					$this->current_user->id,
					lang('activity_delete_tariff') . ' : ' . $id,
					'Tariffs'
				);
				header('Content-Type: application/json');
				die(json_encode(['error' => 0, 'msg' => lang('tariff_deleted_success')]));
				exit;
			}
			Template::set(lang('tariff_deleted_success'), 'success');
			return redirect('tariffs');
		}
	}
	/**
	 * Acciones sobre un abonos (borrar, excel e imprimir)
	 */
	public function tariffsActions() {

		$this->form_validation->set_rules('form_action', lang('form_action'), 'required');

		if ($this->form_validation->run() == true) {
			if (!empty($_POST['val'])) {

				if ($this->input->post('form_action') == 'delete') {
					$d = 0;
					foreach ($_POST['val'] as $k => $v) {
						if ($this->tariff_model->delete($v)) {
							$d++;
						}
					}
					log_activity(
						$this->current_user->id,
						lang('activity_delete_tariff') . ' : ' . "$d",
						'Tarifas'
					);
					Template::set_message(lang('tariff_deleted_success'), 'success');

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

	private function saveCreateGridPrice($id = null) {
		$data = array();

		foreach ($_POST['tramos'] as $k => $v) {
			$this->load->model('routes/route_city_model');
			$location_arr = $this->route_city_model->getLocationsByRoute($v);
			$number_of_locations = count($location_arr);
			foreach ($location_arr as $k => $row) {
				if ($k <= ($number_of_locations - 2)) {
					$j = 1;
					foreach ($location_arr as $col) {
						if ($j > 1) {
							$cnt = 0;
							$price = isset($_POST['price_' . $row->city_id . '_' . $col->city_id . '_' . $v]) ? $_POST['price_' . $row->city_id . '_' . $col->city_id . '_' . $v] : '';
							if ($price != '') {
								if (!is_numeric($price)) {
									$price = ':NULL';
								} else {
									if ($price < 0) {
										$price = ':NULL';
									}
								}
							} else {
								$price = ':NULL';
							}
							$data[] = array(
								'tariff_id' => $id,
								'route_id' => $v,
								'from' => $row->city_id,
								'to' => $col->city_id,
								'price' => $price
							);
						}
						$j++;
					}
				}
			}
		}

		// Insert batch
		$this->load->model('tariffs/price_model');
		$this->price_model->insert_batch($data);
	}

	private function saveUpdateGridPrice($id = null) {
		$data = array();

		foreach ($_POST['tramos'] as $k => $v) {
			$this->load->model('tariffs/price_model');
			// actualizamos precios de la tarifa
			$data = [];
			$this->load->model('routes/route_city_model');
			$location_arr = $this->route_city_model->getLocationsByRoute($v);
			$number_of_locations = count($location_arr);
			foreach ($location_arr as $k => $row) {
				if ($k <= ($number_of_locations - 2)) {
					$j = 1;
					foreach ($location_arr as $col) {
						if ($j > 1) {
							$cnt = 0;
							$price = isset($_POST['price_' . $row->city_id . '_' . $col->city_id . '_' . $v]) ? $_POST['price_' . $row->city_id . '_' . $col->city_id . '_' . $v] : '';
							if ($price != '') {
								if (!is_numeric($price)) {
									$price = ':NULL';
								} else {
									if ($price < 0) {
										$price = ':NULL';
									}
								}
							} else {
								$price = ':NULL';
							}
							$where = array(
								'tariff_id' => $id,
								'route_id' => $v,
								'from' => $row->city_id,
								'to' => $col->city_id,
							);

							if ($this->price_model->existPrice($where)) {
								$data = array('price' => $price);
								$this->price_model->update($where, $data);
							} else {
								$where['price'] = $price;
								$this->price_model->insert($where);
							}
							unset($where);
						}
						$j++;
					}
				}
			}
		}

	}

	private function save($type = 'insert', $id = 0) {
		$data = $this->tariff_model->prep_data($_POST);
		$data['start_date'] = formatDate($_POST['start_date'], 'd/m/Y', 'Y-m-d');
		$data['end_date'] = formatDate($_POST['end_date'], 'd/m/Y', 'Y-m-d');

		if ($type == 'insert') {
			$id = $this->tariff_model->insert($data);
			if (is_numeric($id)) {
				// Guardamos los precios de los recorridos
				$this->saveCreateGridPrice($id);
				$result = $id;
			}
		} else {
			$this->saveUpdateGridPrice($id);
			$result = $this->tariff_model->update($id, $data);
		}
		return $result;
	}

	/**
	 * Functions AJAX
	 */
	function getGridPrice() {
		if (!$this->input->is_ajax_request()) {
			redirect('404', 'refresh');
		} else {
			// Recuperamos los recorridos de la linea
			$this->load->model('routes/route_model');
			$routes = $this->route_model->find_all_by('line_id', $_GET['line_id']);

			if (is_array($routes)) {
				foreach ($routes as $route) {
					$this->load->model('routes/route_city_model');
					$data['route'] = $route;
					$data['location_arr'] = $this->route_city_model->getLocationsByRoute($route->id);

					echo $this->load->view('tariffs/grid_price', $data, TRUE);
				}
			}
		}
	}

	function getTariffs() {
		if (!$this->input->is_ajax_request()) {
			redirect('404', 'refresh');
		} else {
			$delete_link = "<a href='#' class='tip po' title='<b>" . $this->lang->line('delete_tariff') . "</b>' data-content=\"<p>"
				. lang('r_u_sure') . "</p><a class='btn btn-danger po-delete1' id='a__$1' href='" . site_url('tariffs/delete/$1') . "'>"
				. lang('i_m_sure') . "</a> <button class='btn po-close'>" . lang('no') . "</button>\"  rel='popover'><i class=\"fa fa-trash-o\"></i> "
				. lang('delete_tariff') . '</a>';

			$action = '<div class="text-center"><div class="btn-group text-left">'
				. '<button type="button" class="btn btn-default btn-xs btn-primary dropdown-toggle" data-toggle="dropdown">'
				. lang('actions') . ' <span class="caret"></span></button>
	        <ul class="dropdown-menu pull-right" role="menu">
	            <li><a href="' . site_url('tariffs/edit/$1') . '"><i class="fa fa-edit"></i> ' . lang('edit_tariff') . '</a></li><li class="divider"></li><li> ' . $delete_link . '</li>';
			$action .= '</ul></div></div>';

			$this->load->library('datatables');
			$this->datatables
				->select('t1.id as id, t1.name as name, t2.name as line, t1.start_date, t1.end_date, t1.status')
				->from('tariffs as t1')
				->join('lines as t2', 't2.id = t1.line_id', 'left')
				->edit_column('t1.status', '$1__$2', 't1.status, id')
				->edit_column('name', '$1__$2', 'name, id')
				//->add_column('Actions', "<div class=\"text-center\"><a href='" . site_url('tariffs/edit/$1') . "' class='tip' title='" . lang('edit_tariff') . "'><i class=\"fa fa-edit\"></i></a></div>", 'id');
				->add_column('Actions', $action, 'id');

			echo $this->datatables->generate();
		}
	}
}