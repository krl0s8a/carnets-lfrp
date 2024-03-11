<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tariff_model extends MY_Model {
	/** @var string Name of the passengers_schools table. */
	protected $table_name = 'tariffs';
    /** @var bool Use soft deletes or not. */
    protected $soft_deletes = false;

    /** @var string The date format to use. */
    protected $date_format = 'datetime';

    /** @var bool Set the modified time automatically. */
    protected $set_modified = false;

    /** @var bool Set the created time automatically (if true). */
    protected $set_created = false;

    /** @var bool Skip the validation. */
    protected $skip_validation = true;
    
    //** Fields */
    private $name;
    private $date_start;
    private $date_end;
    private $status;

	/**
     * Constructor
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }	

}

/* End of file Price_model.php */
/* Location: .//home/carlos/public_html/futuroSRL/app/modules/tariffs/models/Price_model.php */