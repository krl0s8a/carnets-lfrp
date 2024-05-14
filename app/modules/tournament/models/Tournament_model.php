<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tournament_model extends MY_Model {

	// others fields

	/** @var string Name of the table. */
    protected $table_name = 'co_bl_tournament';

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



	function __construct(){
		$this->db_con = 'joomla';
		parent::__construct();
	}

    
}