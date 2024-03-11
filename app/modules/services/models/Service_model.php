<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Service_model extends MY_Model {

    // fields
    public $id;
    private $name;
    private $registration;
    public $model;
    public $status;

    // others fields

    /** @var string Name of the table. */
    protected $table_name = 'services';

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

    function __construct() {
        parent::__construct();
    }

    public function getServices() {
        $this->db->select('t1.id, t1.arrival_time,t1.departure_time,t1.name,t3.name as name_line,t2.direction, t3.id as line_id');
        $this->db->from($this->table_name . ' as t1');
        $this->db->join('routes as t2', 't2.id = t1.route_id', 'left');
        $this->db->join('lines as t3', 't3.id = t2.line_id', 'left');
        $this->db->order_by('line_id', 'desc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $arr = [];
            foreach ($query->result() as $row) {
                $dir = ($row->direction == 1) ? 'Ida' : 'Vuelta';
                $arr[$row->id] = '[' . $row->id . '] ' . $row->name . ' | ' . lang('field_departure') . ':' . formatTime($row->departure_time, 'H:i:s', 'H:i') . ' ' . lang('field_arrival') . ':' . formatTime($row->arrival_time, 'H:i:s', 'H:i') . ' - ' . $row->name_line . ' - ' . $dir;
            }
            return $arr;
        } else {
            return [];
        }
    }

}

/* End of file Rrhh_model.php */
/* Location: .//D/www/futuro-srl/app/modules/rrhh/models/Rrhh_model.php */