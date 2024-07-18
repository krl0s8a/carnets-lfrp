<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Season_model extends MY_Model {

	// others fields

	/** @var string Name of the table. */
    protected $table_name = 'co_bl_seasons';

    /** @var string Name of the primary key. */
    protected $key = 's_id';

    /** @var bool Use soft deletes (if true). */
    protected $soft_deletes = false;

    /** @var string The date format to use. */
    protected $date_format = 'datetime';

    /** @var bool Set the created time automatically (if true). */
    protected $set_created = false;

    /** @var bool Set the modified time automatically (if true). */
    protected $set_modified = false;



	function __construct(){
		$this->db_con = 'joomla';
		parent::__construct();
	}

    public function find_all_by_tournament(){
        $sql = "SELECT t1.s_id as id, CONCAT_WS(' - ', t2.name, t1.s_name) as name 
        FROM co_bl_seasons as t1
        LEFT JOIN co_bl_tournament as t2
        ON t1.t_id = t2.id
        WHERE t1.status = 'Activo'
        ORDER BY t2.name DESC";
        $query = $this->db->query($sql);

        return $query->result();
    }

}