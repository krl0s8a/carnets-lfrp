<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bus_model extends MY_Model {

	// fields
	public $id;
	private $name;
	private $registration;
	public $model;
	public $status;

	// others fields
	/** @var string Name of the table. */
    protected $table_name = 'buses';

    /** @var string Name of the primary key. */
    protected $key = 'id';

    /** @var bool Use soft deletes (if true). */
    protected $soft_deletes = false;

    /** @var string The date format to use. */
    protected $date_format = 'datetime';

    /** @var bool Set the created time automatically (if true). */
    protected $set_created = true;

    /** @var bool Set the modified time automatically (if true). */
    protected $set_modified = true;

	function __construct(){
		parent::__construct();
	}


}