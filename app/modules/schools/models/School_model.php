<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class School_model extends MY_Model {

	// fields
	public $id;
	private $name;
    private $number;
    private $cue;
    private $telephone;
    private $level;
	private $city_id;

	// others fields
	/** @var string Name of the table. */
    protected $table_name = 'schools';

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

    protected $validation_rules = [        
        [
            'field' => 'number',
            'label' => 'lang:field_number',
            'rules' => 'trim|max_length[4]',
        ],
        [
            'field' => 'cue',
            'label' => 'lang:field_cue',
            'rules' => 'trim|max_length[9]',
        ],
        [
            'field' => 'telephone',
            'label' => 'lang:field_telephone',
            'rules' => 'trim|is_numeric|max_length[15]',
        ]
    ];

    protected $insert_validation_rules = [
        [
            'field' => 'name',
            'label' => 'lang:field_name',
            'rules' => 'required|trim|max_length[255]|is_unique[schools.name]',
        ],
    ];
    protected $updateValidationRules = [
        [
            'field' => 'name',
            'label' => 'lang:field_name',
            'rules' => 'required|trim|max_length[255]|is_unique[schools.name,schools.id]',
        ]
    ];

	function __construct(){
		parent::__construct();
	}


    // Return array asociativo $k->$v
    public function getSchools(){
        $this->db->from($this->table_name);
        $this->db->order_by('name','asc');
        $query = $this->db->get();
        $return = array();
        foreach ($query->result() as $k => $v) {
            $return[$v->id] = $v->name;
        }
        return $return;
    }
}

/* End of file Rrhh_model.php */
/* Location: .//D/www/futuro-srl/app/modules/rrhh/models/Rrhh_model.php */