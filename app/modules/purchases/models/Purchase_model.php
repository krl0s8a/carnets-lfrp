<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Purchase_model extends MY_Model {

	// others fields
	/** @var string Name of the table. */
    protected $table_name = 'purchases';

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
            'field' => 'code',
            'label' => 'lang:field_code',
            'rules' => 'trim|max_length[10]',
        ],
        [
            'field' => 'state_id',
            'label' => 'lang:field_state',
            'rules' => 'trim',
        ],
        [
            'field' => 'status',
            'label' => 'lang:status',
            'rules' => 'trim',
        ]
    ];
    protected $insert_validation_rules = [
        [
            'field' => 'name',
            'label' => 'lang:field_name',
            'rules' => 'required|trim|max_length[150]|is_unique[purchases.name]',
        ],
    ];
    protected $updateValidationRules = [
        [
            'field' => 'name',
            'label' => 'lang:field_name',
            'rules' => 'required|trim|max_length[150]|unique[purchases.name,purchases.id]',
        ],
    ];

	function __construct(){
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
	public function getPurchases(){
		$this->db->from($this->table_name);
		$this->db->order_by('name','asc');
		$this->db->where('status','T');
		$query = $this->db->get();
		$return = array();
		foreach ($query->result() as $k => $v) {
			$return[$v->id] = $v->name;
		}
		return $return;
	}

}

/* End of file City_model.php */
/* Location: .//home/carlos/public_html/futuroSRL/app/modules/purchases/models/City_model.php */