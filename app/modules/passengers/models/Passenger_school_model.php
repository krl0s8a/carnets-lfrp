<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Passenger_school_model extends MY_Model {
	/** @var string Name of the passengers_schools table. */
	protected $table_name = 'passengers_schools';
    /** @var string Name of the primary key. */
    protected $key = 'id';
    /** @var bool Use soft deletes or not. */
    protected $soft_deletes = false;

    /** @var string The date format to use. */
    protected $date_format = 'datetime';

    /** @var bool Set the modified time automatically. */
    protected $set_modified = false;

    /** @var bool Set the created time automatically (if true). */
    protected $set_created = false;

    /** @var bool Skip the validation. */
    protected $skip_validation = false;
	/** properties */
	private $passenger_id;
	private $school_id;
	/**
     * Constructor
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * return id of row
     * @param $pid : Identificador de pasajero
     * @param $sid : Identificador de escuela
     */
	
	public function getIdRow($pid, $sid = 0, $type=1){
		$this->db->from($this->table_name);
		$this->db->where('passenger_id', $pid);
		$this->db->where('school_id', $sid);
		$row = $this->db->get()->row();

		if ($row) {
			return $row->id;
		} else {
            if ($type == 2) { // alumno
                $data = array('passenger_id' => $pid,'school_id'=>$sid);
                $this->db->insert($this->table_name, $data);
                $id = $this->db->insert_id();
                if (is_numeric($id)) {
                    return $id;
                } else {
                    return false;
                }
            }
		}		
	}

    /**
     * return array schools by passenger
     * @param $p : Identificador de pasajero
     */
    public function getSchoolsByPassenger($p){
        $this->db->from($this->table_name);
        $this->db->where('passenger_id', $p);

        $result = $this->db->get()->result();
        $return = array();
        if (count($result) > 0) {           
            foreach ($result as $k => $v) {
                $return[] = $v->school_id;
            }
        } 
        return $return;
    }
    /**
     * return array teachers by school
     * @param $s : Identificado de escuela
     */
    public function getTeacherBySchool($s){
        $this->db->select('t1.*');
        $this->db->from('passengers as t1');
        $this->db->join($this->table_name.' as t2','t1.id = t2.passenger_id','left');
        $this->db->where('t2.school_id', $s);
        $this->db->where('t1.type',1); // Docente
        $this->db->order_by('t1.last_name','asc');
        $query = $this->db->get();

        return $query->result();
    }
}

/* End of file Passenger_school_model.php */
/* Location: .//home/carlos/public_html/futuroSRL/app/modules/passengers/models/Passenger_school_model.php */