<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Route_city_model extends MY_Model {

    /** @var string Name of the users table. */
    protected $table_name = 'routes_cities';

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
    //** Fields */
    private $route_id;
    private $city_id;
    private $order;

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }

    public function getLocationsByRoute($route_id = null) {
        $this->db->select('t1.*, t2.name');
        $this->db->from($this->table_name . ' as t1');
        $this->db->join('cities as t2', 't2.id = t1.city_id', 'left');
        $this->db->where('t1.route_id', $route_id);
        $this->db->order_by('t1.order', 'asc');
        $query = $this->db->get();

        return $query->result();
    }

    public function getDataPair($route_id) {
        $this->db->from($this->table_name);
        $this->db->where('route_id', $route_id);
        $this->db->order_by('order', 'asc');
        $query = $this->db->get();
        $_return = [];
        foreach ($query->result() as $k => $v) {
            $_return[$v->city_id] = $v->city_id;
        }
        return $_return;
    }

}

/* End of file route_model.php */
/* Location: .//home/carlos/public_html/futuroSRL/app/modules/routes/models/route_model.php */