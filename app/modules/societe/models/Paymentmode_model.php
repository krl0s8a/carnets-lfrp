<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Paymentmode_model extends MY_Model {
    // others fields

    /** @var string Name of the table. */
    protected $table_name = 'societe_rib';

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
        ]
    ];
    protected $insert_validation_rules = [
        [
            'field' => 'label',
            'label' => 'lang:lbl_label',
            'rules' => 'required|trim|max_length[150]|is_unique[societe_rib.label]',
        ],
    ];
    protected $updateValidationRules = [
        [
            'field' => 'label',
            'label' => 'lang:lbl_label',
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
