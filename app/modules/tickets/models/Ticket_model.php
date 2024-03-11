<?php

class Ticket_model extends MY_Model {

    /** @var string Name of the users table. */
    protected $table_name = 'tickets';

    /** @var bool Use soft deletes or not. */
    protected $soft_deletes = false;

    /** @var string The date format to use. */
    protected $date_format = 'datetime';

    /** @var bool Set the modified time automatically. */
    protected $set_modified = false;

    /** @var bool Set the created time automatically (if true). */
    protected $set_created = false;

    /** @var bool Skip the validation. */
    protected $skip_validation = false;

    /** @var array Validation rules. */
    protected $validation_rules = [
        [
            'field' => 'price',
            'label' => 'lang:field_price',
            'rules' => 'trim|required',
        ],
        [
            'field' => 'quantity',
            'label' => 'lang:field_quantity',
            'rules' => 'required|numeric',
        ],
        [
            'field' => 'status',
            'label' => 'lang:status',
            'rules' => '',
        ]
    ];
    protected $insert_validation_rules = [
        [
            'field' => 'name',
            'label' => 'lang:field_name',
            'rules' => 'required|trim|max_length[100]|is_unique[tickets.name]',
        ],
        [
            'field' => 'code',
            'label' => 'lang:field_code',
            'rules' => 'required|trim|max_length[100]|is_unique[tickets.code]',
        ],
    ];
    protected $updateValidationRules = [
        [
            'field' => 'name',
            'label' => 'lang:field_name',
            'rules' => 'required|trim|max_length[100]|unique[tickets.name,tickets.id]',
        ],
        [
            'field' => 'code',
            'label' => 'lang:field_code',
            'rules' => 'required|trim|max_length[100]|unique[tickets.code,tickets.id]',
        ]
    ];

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct() {
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

    /**
     * Arreglo asociativo
     */
    public function getTickets($option = '') {
        $this->db->from($this->table_name);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            if ($option == '') {
                $return = [];
            } else {
                $return[''] = $option;
            }
            foreach ($query->result() as $k => $v) {
                $return[$v->id] = '[' . $v->code . '] ' . $v->name;
            }
            return $return;
        } else {
            return false;
        }
    }

}

/* End of file modelName.php */
/* Location: ./application/models/modelName.php */