<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Bank_account_model extends MY_Model {
    // others fields

    /** @var string Name of the table. */
    protected $table_name = 'bank_accounts';

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
            'field' => 'type', // tipo de cuenta
            'label' => 'lang:lbl_courant',
            'rules' => 'trim',
        ],
        [
            'field' => 'currency_code', // moneda
            'label' => 'lang:lbl_corrency_code',
            'rules' => 'trim|max_length[3]',
        ],
        [
            'field' => 'clos',
            'label' => 'lang:lbl_clos',
            'rules' => 'trim',
        ],
        [
            'field' => 'fk_country',
            'label' => 'lang:lbl_country',
            'rules' => 'trim',
        ],
        [
            'field' => 'min_allowed',
            'label' => 'lang:lbl_min_allowed',
            'rules' => 'trim',
        ],
        [
            'field' => 'min_desired',
            'label' => 'lang:lbl_min_desired',
            'rules' => 'trim',
        ],
        [
            'field' => 'bank',
            'label' => 'lang:lbl_bank',
            'rules' => 'trim',
        ],
        [
            'field' => 'number',
            'label' => 'lang:lbl_number',
            'rules' => 'trim',
        ],
        [
            'field' => 'domiciliation',
            'label' => 'lang:lbl_domiciliation',
            'rules' => 'trim',
        ]
    ];
    protected $insert_validation_rules = [
        [
            'field' => 'name',
            'label' => 'lang:lbl_name',
            'rules' => 'required|trim|max_length[30]|is_unique[bank_accounts.name]',
        ],
    ];
    protected $updateValidationRules = [
        [
            'field' => 'name',
            'label' => 'lang:lbl_name',
            'rules' => 'required|trim|max_length[30]|is_unique[bank_accounts.name,bank_accounts.id]',
        ],
    ];

    function __construct() {
        parent::__construct();
    }

}
