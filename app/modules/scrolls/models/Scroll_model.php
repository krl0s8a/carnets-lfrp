<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Scroll_model extends MY_Model {

	// others fields
	/** @var string Name of the table. */
    protected $table_name = 'scrolls';

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
	public $ticket_id;
	private $serial;
	private $ticket;
	private $quantity;
	private $status;

	function __construct(){
		parent::__construct();
	}

    public function getLastScrollAvailable($ticket_id){
        $this->db->from($this->table_name.' as t1');
        $this->db->where('t1.ticket_id', $ticket_id);
        $this->db->where('t1.status','Sin asignar');
        $this->db->order_by('t1.ffrom','asc');
        $this->db->limit(1);
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