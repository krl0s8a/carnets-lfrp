<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Point_model extends MY_Model {
    // others fields

    /** @var string Name of the table. */
    protected $table_name = 'points';

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
    // fields
    public $id;
    private $code;
    public $name;

    function __construct() {
        parent::__construct();
    }

    // Return array asociativo $k->$v
    public function getCities() {
        $this->db->from($this->table_name);
        $this->db->order_by('name', 'asc');
        $this->db->where('status', 'T');
        $query = $this->db->get();
        $return = array();
        foreach ($query->result() as $k => $v) {
            $return[$v->id] = $v->name;
        }
        return $return;
    }

    /**
     * Activar point
     */
    public function activate($id = null) {
        $this->db->where('id', $id);
        return $this->db->update($this->table_name, array('status' => 'T'));
    }

    /**
     * Desactivar
     */
    public function inactivate($id = null) {
        $this->db->where('id', $id);
        return $this->db->update($this->table_name, array('status' => 'F'));
    }

}

/* End of file City_model.php */
/* Location: .//home/carlos/public_html/futuroSRL/app/modules/cities/models/City_model.php */