<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Assignment_model extends MY_Model {
    // others fields

    /** @var string Name of the table. */
    protected $table_name = 'assignments';

    /** @var string Name of the primary key. */
    protected $key = 'id';

    /** @var bool Use soft deletes (if true). */
    protected $soft_deletes = false;

    /** @var string The date format to use. */
    protected $date_format = 'datetime';

    /** @var bool Set the created time automatically (if true). */
    protected $set_created = true;

    /** @var bool Set the modified time automatically (if true). */
    protected $set_modified = false;
    // fields
    public $ticket_id;
    private $serial;
    private $ticket;
    private $quantity;
    private $status;

    function __construct() {
        parent::__construct();
    }

    /**
     * Asignaciones en progreso de un chofer
     */
    public function assignToProgress($drive_id) {
        $this->db->from('tickets as t1');
        $this->db->select('t1.name, t3.number_ticket_start, t3.number_ticket_end, t2.tto, t2.ffrom');
        $this->db->join('scrolls as t2', 't2.ticket_id = t1.id', 'left');
        $this->db->join('assignments as t3', 't3.scroll_id = t2.id', 'left');
        $this->db->where('t2.status', 'Asignado');
        //$this->db->where('t3.number_ticket_end <','t2.tto');
        $this->db->where('t3.drive_id', $drive_id);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    /**
     * Todos los datos de una asgnacion
     */
    public function getAssign($id) {
        $this->db->from($this->table_name . ' as t1');
        $this->db->select('t1.*, t3.serial, t5.first_name,t5.last_name, t4.name');
        $this->db->join('employees as t2', 't2.id = t1.drive_id', 'left');
        $this->db->join('people as t5', 't5.id = t2.people_id','left');
        $this->db->join('scrolls as t3', 't3.id = t1.scroll_id', 'left');
        $this->db->join('tickets as t4', 't4.id = t3.ticket_id', 'left');
        $this->db->where('t1.id', $id);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return $query->row();
        } else {
            return false;
        }
    }

}

/* End of file City_model.php */
/* Location: .//home/carlos/public_html/futuroSRL/app/modules/cities/models/City_model.php */