<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Payment_salary_model extends MY_Model {
    // others fields

    /** @var string Name of the table. */
    protected $table_name = 'payment_salary';

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
        ['name' => 'date_payment'],
        ['name' => 'amount'],
        ['name' => 'type_payment'],
        ['name' => 'note'],
        ['name' => 'fk_salary'],
        ['name' => 'fk_bank_account']
    ];

    function __construct() {
        parent::__construct();
    }

    public function totalPaymentsBySalary($salary_id = 0) {
        $this->db->from($this->table_name);
        $this->db->select_sum('amount', 'amount');
        $this->db->where('fk_salary', $salary_id);
        $query = $this->db->get();
        if (empty($query->row()->amount)) {
            return 0;
        } else {
            return $query->row()->amount;
        }

    }

    public function getPaymentsBySalary($salary_id) {
        $this->db->from($this->table_name . ' as t1');
        $this->db->join('bank_accounts as t2', 't1.fk_bank_account = t2.id', 'left');
        $this->db->select('t1.*, t2.name as bank');
        $this->db->where('fk_salary', $salary_id);

        $query = $this->db->get();

        return $query->result();
    }

}
