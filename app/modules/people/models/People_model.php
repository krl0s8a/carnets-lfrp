<?php
defined('BASEPATH') || exit('No direct script access allowed');
class People_model extends MY_Model {

    /** @var string Name of the users table. */
    protected $table_name = 'people';

    /** @var bool Use soft deletes or not. */
    protected $soft_deletes = false;

    /** @var string The date format to use. */
    protected $date_format = 'datetime';

    /** @var bool Set the modified time automatically. */
    protected $set_modified = true;

    /** @var bool Skip the validation. */
    protected $skip_validation = false;

    /** @var array Validation rules. */
    protected $validation_rules = [
        
    ];

    /** @var Array Additional validation rules only used on insert. */
    protected $insert_validation_rules = [

    ];

    protected $field_info = [
        ['name' => 'id'],        
        ['name' => 'first_name'],
        ['name' => 'last_name'],
        ['name' => 'birth'],
        ['name' => 'gender'],
        ['name' => 'cuil'],
        ['name' => 'dni'],
        ['name' => 'address'],
        ['name' => 'movil_phone'],
        ['name' => 'city_id'],
        ['name' => 'email'],
        ['name' => 'created_on'],
        ['name' => 'modified_on']
    ];
    //--------------------------------------------------------------------------

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }
}