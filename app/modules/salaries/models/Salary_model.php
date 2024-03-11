<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Salary_model extends MY_Model {
    // others fields

    /** @var string Name of the table. */
    protected $table_name = 'salary';

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
    // Validations
    protected $validation_rules = [
        
    ];
    protected $insert_validation_rules = [
        
    ];
    protected $updateValidationRules = [
        
    ];
    protected $field_info = [
        ['name' => 'id'],        
        ['name' => 'fk_employee'],
        ['name' => 'amount_salary'],
        ['name' => 'type_payment_default'],
        ['name' => 'label'],
        ['name' => 'date_start_period'],
        ['name' => 'date_end_period'],
        ['name' => 'date_payment'],
        ['name' => 'note'],
        ['name' => 'status'],
        ['name' => 'fk_bank_account_defautl']
    ];

    function __construct() {
        parent::__construct();
    }

   
}
