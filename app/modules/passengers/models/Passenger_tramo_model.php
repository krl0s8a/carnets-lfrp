<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Passenger_tramo_model extends MY_Model {
	/** @var string Name of the passengers_schools table. */
	protected $table_name = 'passengers_tramos';
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
	
	/**
     * Constructor
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }

    // Devuelve los nombres de los puntos origen y destino de un tramo

    public function getPoints($id){
        $this->db->from($this->table_name.' as t1');
        $this->db->select("t1.id, t2.name as from, t3.name as to");
        $this->db->join('cities as t2',"t2.id = t1.ffrom",'left');
        $this->db->join('cities as t3',"t3.id = t1.tto",'left');
        $this->db->where('t1.id',$id);
        $query = $this->db->get();

        return $query->row();
    }

    public function getPointsAll($id){
        $this->db->from($this->table_name);
        $this->db->select("$this->table_name.id, t2.name as ffrom, t3.name as tto");
        $this->db->join('cities as t2',"t2.id = $this->table_name.ffrom",'left');
        $this->db->join('cities as t3',"t3.id = $this->table_name.tto",'left');
        $this->db->where("$this->table_name.passenger_school_id",$id);
        $query = $this->db->get();

        return $query->result();
    }

    // Devuelve verdadero si el tramo de un pasajero existe
    public function existPoints($ps,$f,$t){
        $this->db->from($this->table_name);
        $this->db->where('passenger_school_id',$ps);
        $this->db->where('ffrom',$f);
        $this->db->where('tto',$t);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

}

/* End of file Passenger_school_model.php */
/* Location: .//home/carlos/public_html/futuroSRL/app/modules/passengers/models/Passenger_tramo_model.php */