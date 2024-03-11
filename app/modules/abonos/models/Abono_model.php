<?php

class Abono_model extends MY_Model {

    /** @var string Name of the users table. */
    protected $table_name = 'abonos';

    /** @var bool Use soft deletes or not. */
    protected $soft_deletes = false;

    /** @var string The date format to use. */
    protected $date_format = 'datetime';

    /** @var bool Set the modified time automatically. */
    protected $set_modified = true;

    /** @var bool Set the created time automatically (if true). */
    protected $set_created = true;

    /** @var bool Skip the validation. */
    protected $skip_validation = false;

    /** @var array Validation rules. */
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

    public function recover(){
        $sql = "SELECT t1.id, t2.from, t2.to FROM abonos as t1 LEFT JOIN prices as t2 ON t1.price_id = t2.id";

        $query = $this->db->query($sql);

        echo '<pre>';echo print_r();echo '</pre>'; exit();
    }
    /**
     * Pasajeros por Escuela
     * school : Identificador de escuela
     * type : Tipo de pasajero (docente o alumno)
     */
    public function getPassengersBySchool_($school, $type) {
        $this->db->from('passengers_schools as t1');
        $this->db->select('t2.id, t6.first_name,t6.last_name, t3.name as school, t4.id as from_default, t5.id as to_default');
        $this->db->join('passengers as t2', 't1.passenger_id = t2.id', 'left');
        $this->db->join('people as t6','t6.id = t2.people_id','left');
        $this->db->join('schools as t3', 't1.school_id = t3.id', 'left');
        $this->db->join('cities as t4', 't2.from_default = t4.id', 'left');
        $this->db->join('cities as t5', 't2.to_default = t5.id', 'left');
        $this->db->where('t3.id', $school);
        $this->db->where('t2.type', $type);
        $this->db->order_by('t2.last_name', 'ASC');
        $query = $this->db->get();

        return $query->result();
    }

    public function getPassengersBySchool($school, $type = 1) {
        $this->db->from('passengers as t1');
        $this->db->select('t1.id, t3.ffrom as from_default, t1.people_id, t3.tto as to_default, t4.name as name_to, t5.name as name_from, t6.first_name, t6.last_name');
        $this->db->join('passengers_schools as t2', 't2.passenger_id = t1.id', 'left');
        $this->db->join('people as t6','t6.id = t1.people_id','left');
        $this->db->join('passengers_tramos as t3', 't3.passenger_school_id = t2.id', 'left');
        $this->db->join('cities as t4', 't3.tto = t4.id', 'left');
        $this->db->join('cities as t5', 't3.ffrom = t5.id', 'left');
        $this->db->where('t1.type', $type);
        $this->db->where('t2.school_id', $school);
        $this->db->order_by('t6.last_name', 'asc');

        $query = $this->db->get();

        return $query->result();
    }
    public function getCitiesBySchool($school_id = null) {
        $this->db->from('routes_cities as t1');
        $this->db->select('t3.name, t3.id');
        $this->db->join('routes as t2', 't2.id = t1.route_id', 'left');
        $this->db->join('cities as t3', 't3.id = t1.city_id', 'left');
        $this->db->order_by('t3.name', 'asc');
        $this->db->order_by('t1.order', 'ASC');
        $query = $this->db->get();

        return $query->result();
    }

    public function getCitiesByRoute($route) {
        $this->db->from('cities as t1');
        $this->db->select('t1.name, t1.id');
        $this->db->join('routes_cities as t2', 't2.city_id = t1.id', 'left');
        $this->db->where('t2.route_id', $route);
        $this->db->order_by('t2.order', 'ASC');
        $query = $this->db->get();

        $return = array();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $k => $v) {
                $return[$v->id] = $v->name;
            }
        }
        return $return;
    }

    public function getAbono($id) {
        $this->db->from($this->table_name . ' as t1');
        $this->db->select('t1.*, t8.last_name,t8.first_name,t3.id as passenger_id, t8.dni, t3.type, t4.name as school_name, period, ida, vta, t5.price, t5.from, t5.to, t6.name as name_from, t7.name as name_to, t1.status as status, t4.id as school_id');
        $this->db->join('passengers_schools as t2', 't1.passenger_school_id = t2.id', 'left');
        $this->db->join('passengers as t3', 't3.id = t2.passenger_id', 'left');
        $this->db->join('people as t8','t8.id = t3.people_id','left');
        $this->db->join('schools as t4', 't4.id = t2.school_id', 'left');
        $this->db->join('prices as t5', 't5.id = t1.price_id', 'left');
        $this->db->join('cities as t6', 't6.id = t5.from', 'left');
        $this->db->join('cities as t7', 't7.id = t5.to', 'left');
        $this->db->where('t1.id', $id);
        $query = $this->db->get();

        return $query->row();
    }

    public function citiesByRoute($route_id) {
        $this->db->from('cities as t1');
        $this->db->join('routes_cities as t2', 't2.city_id = t1.id', 'left');
        $this->db->where('t2.route_id', $route_id);
        $this->db->order_by('t2.order', 'asc');
        $query = $this->db->get();
        $return = array();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $k => $v) {
                $return[$v->id] = $v->name;
            }
        }
        return $return;
    }

    /**
     * Recuperar el numero de abono maximo
     */
    public function getMaxNumberAbono() {
        $this->db->from($this->table_name);
        $this->db->select_max('number_abono');

        $query = $this->db->get();
        $max = $query->row()->number_abono;
        if (empty($max)) {
            return 0;
        } else {
            return $max;
        }
    }

    /**
     * Retorna tarifa activa de una linea
     */
    public function tariffActiveByLine($line_id) {
        $this->db->from('tariffs');
        $this->db->where('line_id', $line_id);
        $this->db->where('status', 'T');
        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return $query->row()->id;
        } else {
            return 0;
        }
    }

    /**
     * Verifica si un abono a sido creado en un periodo determinado
     */
    public function abonoCreated($passenger_id, $school_id, $from, $to, $year, $month) {
        $this->db->from($this->table_name . ' as t1');
        $this->db->select('t1.*');
        $this->db->join('passengers_schools as t2', 't2.id = t1.passenger_school_id', 'left');
        $this->db->join('passengers as t3', 't3.id = t2.passenger_id', 'left');
        $this->db->join('prices as t4', 't4.id = t1.price_id', 'left');
        $this->db->where('t1.period', $month . '/' . $year);
        $this->db->where('t2.passenger_id', $passenger_id);
        $this->db->where('t2.school_id', $school_id);
        $this->db->where('t4.from', $from);
        $this->db->where('t4.to', $to);

        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return $query->row();
        } else {
            return false;
        }
    }

    /**
     * Lineas por pasajero_escuela_id 
     */
    public function getLinesByPassengerSchool($ps_id = null) {
        $this->db->from('lines as t1');
        $this->db->select('t1.id as id, t1.name as name');
        $this->db->join('routes as t2', 't2.line_id = t1.id', 'left');
        $this->db->join('routes_cities as t3', 't3.route_id = t2.id', 'left');
        $this->db->join('schools as t4', 't4.city_id = t3.city_id', 'left');
        $this->db->join('passengers_schools as t5', 't5.school_id = t4.id', 'left');
        $this->db->where('t5.id', $ps_id);
        $this->db->group_by('t1.id');

        $query = $this->db->get();

        return $query->result();
    }

    /**
     * Retorna las lines de acuerdo a un origen y destino 
     */
    public function getLinesActives($from, $to) {
        $this->db->from('lines as t1');
        $this->db->select('t1.*');
        $this->db->join('tariffs as t2', 't2.line_id = t1.id', 'left');
        $this->db->join('prices as t3', 't3.tariff_id = t2.id', 'left');
        $this->db->where('t3.from', $from);
        $this->db->where('t3.to', $to);

        $query = $this->db->get();
        return $query->result();
    }
}