<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Societe_model extends MY_Model {
    // others fields

    /** @var string Name of the table. */
    protected $table_name = 'societe';

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
            'field' => 'type',
            'label' => 'lang:lbl_type',
            'rules' => 'trim|max_length[2]',
        ],
        [
            'field' => 'client',
            'label' => 'lang:lbl_client',
            'rules' => 'trim|max_length[1]',
        ],
        [
            'field' => 'provider',
            'label' => 'lang:lbl_provider',
            'rules' => 'trim|max_length[1]',
        ],
        [
            'field' => 'name_alias',
            'label' => 'lang:lbl_name_alias',
            'rules' => 'trim|max_length[150]',
        ],
        [
            'field' => 'email',
            'label' => 'lang:lbl_email',
            'rules' => 'trim|max_length[50]|email',
        ],
        [
            'field' => 'cuit',
            'label' => 'lang:lbl_cuit',
            'rules' => 'trim|required|max_length[13]',
        ],
        [
            'field' => 'address',
            'label' => 'lang:lbl_address',
            'rules' => 'trim|max_length[255]',
        ],
        [
            'field' => 'state_id',
            'label' => 'lang:lbl_state',
            'rules' => 'trim',
        ],
        [
            'field' => 'city_id',
            'label' => 'lang:lbl_city',
            'rules' => 'trim',
        ],
        [
            'field' => 'phone',
            'label' => 'lang:lbl_phone',
            'rules' => 'trim|max_length[20]',
        ],
        [
            'field' => 'fax',
            'label' => 'lang:lbl_fax',
            'rules' => 'trim|max_length[20]',
        ],
        [
            'field' => 'url',
            'label' => 'lang:lbl_url',
            'rules' => 'trim|max_length[255]',
        ],
        [
            'field' => 'iva',
            'label' => 'lang:lbl_iva',
            'rules' => 'trim|max_length[1]',
        ],
        [
            'field' => 'value_iva',
            'label' => 'lang:lbl_value_iva',
            'rules' => 'trim|max_length[2]',
        ]
    ];
    protected $insert_validation_rules = [
        [
            'field' => 'name',
            'label' => 'lang:lbl_name',
            'rules' => 'required|trim|max_length[150]|is_unique[societe.name]',
        ],
    ];
    protected $updateValidationRules = [
        [
            'field' => 'name',
            'label' => 'lang:lbl_name',
            'rules' => 'required|trim|max_length[150]',
        ],
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

}
