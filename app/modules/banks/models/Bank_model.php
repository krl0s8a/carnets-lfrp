<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Bank_model extends MY_Model {
    // others fields

    /** @var string Name of the table. */
    protected $table_name = 'bank';

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
        [
            'field' => 'datev',
            'label' => 'lang:field_code',
            'rules' => 'trim|max_length[10]',
        ],
        [
            'field' => 'dateo',
            'label' => 'lang:field_state',
            'rules' => 'trim',
        ],
        [
            'field' => 'amount',
            'label' => 'lang:status',
            'rules' => 'trim',
        ]
    ];
    protected $insert_validation_rules = [
    ];
    protected $updateValidationRules = [
    ];

    function __construct() {
        parent::__construct();
    }

    public function get_validation_rules($type = 'update') {
        if ($type != 'update') {
            return parent::get_validation_rules($type);
        }

        // When updating, add the role_name update rule.
        $validationRules = parent::get_validation_rules($type);
        $validationRules = array_merge($validationRules, $this->updateValidationRules);

        return $validationRules;
    }

    // Return array asociativo $k->$v
    public function getCities() {
        $this->db->from($this->table_name);
        $this->db->order_by('name', 'asc');
        $this->db->where('status', 'T');
        $query = $this->db->get();
        $return = array();
        foreach ($query->result() as $k => $v) {
            $return[$v->id] = $v->name;
        }
        return $return;
    }

    public function getCitiesByState($state_id) {
        $this->db->from($this->table_name);
        $this->db->order_by('name', 'asc');
        $this->db->where('state_id', $state_id);
        $this->db->where('status', 'T');
        $query = $this->db->get();
        $return = array();
        foreach ($query->result() as $k => $v) {
            $return[$v->id] = $v->code . ' - ' . $v->name;
        }
        return $return;
    }

}

/* End of file City_model.php */
/* Location: .//home/carlos/public_html/futuroSRL/app/modules/cities/models/City_model.php */