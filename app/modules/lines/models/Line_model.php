<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Line_model extends MY_Model {

	// others fields
	/** @var string Name of the table. */
	protected $table_name = 'lines';

	/** @var string Name of the primary key. */
	protected $key = 'id';

	/** @var bool Use soft deletes (if true). */
	protected $soft_deletes = false;

	/** @var string The date format to use. */
	protected $date_format = 'datetime';

	/** @var bool Set the created time automatically (if true). */
	protected $set_created = false;

	/** @var bool Set the modified time automatically (if true). */
	protected $set_modified = false;

	protected $validation_rules = [
		[
			'field' => 'name',
			'label' => 'lang:field_name',
			'rules' => 'required|trim|max_length[100]',
		],
		[
			'field' => 'status',
			'label' => 'lang:status',
			'rules' => 'required|trim',
		],
	];

	function __construct() {
		parent::__construct();
	}

	// Return array asociativo $k->$v
	public function getLines() {
		$this->db->from($this->table_name);
		$this->db->order_by('name', 'asc');
		$this->db->where('status', 'T');
		$query = $this->db->get();
		$return = array();
		foreach ($query->result() as $k => $v) {
			$return[$v->id] = '[' . $v->id . '] ' . $v->name;
		}
		return $return;
	}

	// Return lines by school
	public function getLinesBySchool($school = null) {
		$this->db->from($this->table_name . ' as t1');
		$this->db->select('t1.id as id, t1.name as name');
		$this->db->join('routes as t2', 't2.line_id = t1.id', 'left');
		$this->db->join('routes_cities as t3', 't3.route_id = t2.id', 'left');
		$this->db->join('schools as t4', 't4.city_id = t3.city_id', 'left');
		$this->db->where('t4.id', $school);
		$this->db->group_by('t1.id');

		$query = $this->db->get();

		return $query->result();
	}

	// Lineas por origen y destino
	public function getLinesByFromTo($from, $to) {
		$this->db->from($this->table_name . ' as t1');
		$this->db->select('t1.*');
		$this->db->join('tariffs as t2', 't2.line_id = t1.id', 'left');
		$this->db->join('prices as t3', 't3.tariff_id = t2.id', 'left');
		$this->db->where('t3.from', $from);
		$this->db->where('t3.to', $to);
		$this->db->where('t2.status', 'T');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			$arr = [];
			foreach ($query->result() as $row) {
				$arr[$row->id] = $row->name;
			}
			return $arr;
		} else {
			return [];
		}
	}
}

/* End of file City_model.php */
/* Location: .//home/carlos/public_html/futuroSRL/app/modules/cities/models/City_model.php */