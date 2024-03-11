<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Trip_ticket_model extends MY_Model {
    // others fields

    /** @var string Name of the table. */
    protected $table_name = 'trips_tickets';

    /** @var bool Use soft deletes (if true). */
    protected $soft_deletes = false;

    /** @var string The date format to use. */
    protected $date_format = 'datetime';

    /** @var bool Set the created time automatically (if true). */
    protected $set_created = false;

    /** @var bool Set the modified time automatically (if true). */
    protected $set_modified = false;
    // fields
    private $trip_id;
    private $ticket_id;
    private $amount;

    function __construct() {
        parent::__construct();
    }

    public function keyTicketByTrip($id) {
        $this->db->from($this->table_name);
        $this->db->where('trip_id', $id);
        $query = $this->db->get();

        $return = array();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $k => $v) {
                $return[] = $v->ticket_id;
            }
        }
        return $return;
    }

}

/* End of file City_model.php */
/* Location: .//home/carlos/public_html/futuroSRL/app/modules/cities/models/City_model.php */