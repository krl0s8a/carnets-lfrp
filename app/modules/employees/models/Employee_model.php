<?php
defined('BASEPATH') || exit('No direct script access allowed');
/**
 * Bonfire
 *
 * An open source project to allow developers to jumpstart their development of
 * CodeIgniter applications.
 *
 * @package   Bonfire
 * @author    Bonfire Dev Team
 * @copyright Copyright (c) 2011 - 2016, Bonfire Dev Team
 * @license   http://opensource.org/licenses/MIT The MIT License
 * @link      http://cibonfire.com
 * @since     Version 1.0
 * @filesource
 */

/**
 * User Model.
 *
 * The central way to access and perform CRUD on users.
 *
 * @package Bonfire\Modules\Users\Models\User_model
 * @author  Bonfire Dev Team
 * @link    http://cibonfire.com/docs/developer
 */
class Employee_model extends MY_Model {

    /** @var string Name of the users table. */
    protected $table_name = 'employees';

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

    /** @var array Metadata for the model's database fields. */
    protected $field_info = [
        ['name' => 'id'],        
        ['name' => 'work_file'],
        ['name' => 'position'],
        ['name' => 'dateemployment'],
        ['name' => 'dateemploymentend'],
        ['name' => 'people_id'],
        ['name' => 'avatar'],
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

    public function arrEmployees(){
        $this->from($this->table_name.' as t1');
        $this->join('people as t2','t1.people_id = t2.id','left');
        $this->select('t1.id, t2.last_name, t2.first_name');
        $this->order_by('t2.last_name','asc');
        $rows = $this->find_all();
        $return = array();

        if(!empty($rows)){
            foreach ($rows as $v) {
                $return[$v->id] = $v->last_name.' '.$v->first_name;
            }
        }
        return $return;
    }

    public function arrDrivers(){
        $this->from($this->table_name.' as t1');
        $this->join('people as t2','t1.people_id = t2.id','left');
        $this->select('t1.id, t2.last_name, t2.first_name');
        $this->where('t1.position','Chofer');
        $this->order_by('t2.last_name','asc');
        $rows = $this->find_all();
        $return = array();

        if(!empty($rows)){
            foreach ($rows as $v) {
                $return[$v->id] = $v->last_name.' '.$v->first_name;
            }
        }
        return $return;
    }
    
}