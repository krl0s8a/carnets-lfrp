<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Passenger_model extends MY_Model {
    /** @var string Name of the users table. */
    protected $table_name = 'passengers';

    /** @var bool Use soft deletes or not. */
    protected $soft_deletes = false;

    /** @var string The date format to use. */
    protected $date_format = 'datetime';

    /** @var bool Set the modified time automatically. */
    protected $set_modified = false;

    /** @var bool Set the created time automatically (if true). */
    protected $set_created = true;

    /** @var bool Skip the validation. */
    protected $skip_validation = true;
    /** properties */
    private $id;
    private $type;
    private $first_name;
    private $last_name;
    private $dni;
    private $from_default;
    private $to_default;
    private $addredd_city;

    /**
     * @var array Validation rules. Note that role_name rules for updates are added
     * by this model's overridden get_validation_rules() method.
     */
    protected $validation_rules = [

    ];
    /**
     * Constructor
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * return id by dni
     * @param $dni : DNI del pasajero
     */
    public function getIdByDni($dni) {
        $this->db->select('*');
        $this->db->from($this->table_name);
        $this->db->where('dni', $dni);
        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return $query->row()->id;
        } else {
            return false;
        }
    }
    /**
     * Return passenger by type
     */
    public function getByType_($type = 0) {

        $this->from($this->table_name . ' as t1');
        $this->select('t1.id, t2.last_name, t2.first_name, t1.type');
        $this->join('people as t2', 't1.people_id = t2.id', 'left');
        $this->order_by('t2.last_name', 'asc');
        $query = $this->find_all_by('t1.type', $type);

        $return = array();
        if (count($query) > 0) {
            foreach ($query as $k => $v) {
                $return[$v->id] = $v->last_name . ' ' . $v->first_name;
            }
        }
        return $return;
    }

    public function getPassengersByType($type = 0) {
        $sql = "SELECT t1.id, t2.last_name, t2.first_name, t1.type FROM passengers as t1 LEFT JOIN people as t2 ON t1.people_id = t2.id WHERE t1.type = $type ORDER BY t2.last_name ASC";
        $query = $this->db->query($sql);

        $return = array();
        if (count($query->result()) > 0) {
            foreach ($query->result() as $v) {
                $return[$v->id] = $v->last_name . ' ' . $v->first_name;
            }
        }
        return $return;
    }

    public function getPassenger($id) {
        $sql = "SELECT t1.*, t2.first_name, t2.last_name, t2.dni 
        FROM passengers as t1 
        LEFT JOIN people as t2 
        ON t1.people_id = t2.id 
        WHERE t1.id = $id";

        $query = $this->db->query($sql);

        return $query->row();
    }

    /**
     * Buscar un estudiante por DNI.
     * Devuelve sus datos y origen y destino por defecto
     */
    public function findStudentByDni($dni = 0) {
        $this->db->from($this->table_name . ' as t1');
        $this->db->select('t1.id, t1.last_name, t1.first_name, t3.ffrom, t3.tto');
        $this->db->join('passengers_schools as t2', 't2.passenger_id = t1.id', 'left');
        $this->db->join('passengers_tramos as t3', 't3.passenger_school_id = t2.id', 'left');
        $this->db->where('t1.dni', $dni);
        $this->db->where('t1.type', 2);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    /**
     * Buscar estudiante por Id
     * Devuelve sus datos de origen y destino
     */
    public function findStudentById($id = 0) {
        $this->db->from($this->table_name . ' as t1');
        $this->db->select('t1.id, t1.last_name, t1.first_name, t3.ffrom, t3.tto');
        $this->db->join('passengers_schools as t2', 't2.passenger_id = t1.id', 'left');
        $this->db->join('passengers_tramos as t3', 't3.passenger_school_id = t2.id', 'left');
        $this->db->where('t1.id', $id);
        $this->db->where('t1.type', 2);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    /**
     * Existe estudiante
     */
    public function existPassenger($dni = '') {
        if (empty($dni)) {
            return true;
        } else {
            $this->db->from($this->table_name);
            $this->db->where('dni', $dni);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function arrPassengers() {
        $sql = 'SELECT t1.id, t2.last_name, t2.first_name, t2.dni FROM passengers as t1 LEFT JOIN people as t2 ON t2.id = t1.people_id ORDER BY t2.last_name ASC';
        $query = $this->db->query($sql);

        foreach ($query->result() as $v) {
            $r[$v->id] = $v->last_name . ' ' . $v->first_name . ' [' . $v->dni . ']';
        }

        return $r;
    }
}