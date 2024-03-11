<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Route_model extends MY_Model {

    /** @var string Name of the users table. */
    protected $table_name = 'routes';

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
    protected $validation_rules = [        
        [
            'field' => 'number',
            'label' => 'lang:field_number',
            'rules' => 'trim|max_length[4]',
        ],
        [
            'field' => 'cue',
            'label' => 'lang:field_cue',
            'rules' => 'trim|max_length[9]',
        ],
        [
            'field' => 'telephone',
            'label' => 'lang:field_telephone',
            'rules' => 'trim|is_numeric|max_length[15]',
        ]
    ];

    protected $insert_validation_rules = [
        [
            'field' => 'name',
            'label' => 'lang:field_name',
            'rules' => 'required|trim|max_length[255]|is_unique[routes.name]',
        ],
    ];
    protected $updateValidationRules = [
        [
            'field' => 'name',
            'label' => 'lang:field_name',
            'rules' => 'required|trim|max_length[255]|is_unique[routes.name,routes.id]',
        ]
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
     * 
     */
    public function routesActives() {
        $this->db->select('routes.id, routes.name, c1.name as city1, c2.name as city2');
        $this->db->join('cities as c1', 'routes.from_city_id = c1.id', 'left');
        $this->db->join('cities as c2', 'routes.to_city_id = c2.id', 'left');
        $this->db->where('routes.status', 'T');

        return parent::find_all();
    }

    /**
     * return schools by route
     */
    public function schoolsByRoute($route_id) {
        $this->db->select('schools.id, schools.name, cities.name as cityname');
        $this->db->from('routes_cities');
        $this->db->join('schools', 'routes_cities.city_id = schools.city_id', 'inner');
        $this->db->join('cities', 'cities.id = routes_cities.city_id', 'inner');
        $this->db->where('routes_cities.route_id', $route_id);
        $this->db->order_by('schools.name', 'asc');

        $query = $this->db->get();
        return $query->result();
    }

    /**
     * return tariffs actives by route
     */
    public function tariffsByRoute($route_id) {
        $this->db->select('tariffs.id, tariffs.name');
        $this->db->from('tariffs');
        $this->db->where('tariffs.route_id', $route_id);
        $this->db->where('tariffs.status', 'T');

        $query = $this->db->get();
        return $query->result();
    }

}