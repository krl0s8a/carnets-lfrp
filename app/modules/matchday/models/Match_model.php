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
class Match_model extends MY_Model {

    /** @var string Name of the users table. */
    protected $table_name = 'co_bl_match';
    
    /** @var bool Use soft deletes or not. */
    protected $soft_deletes = false;

    /** @var string The date format to use. */
    protected $date_format = 'datetime';

    /** @var bool Set the modified time automatically. */
    protected $set_modified = false;

    protected $set_created = false;

    /** @var bool Skip the validation. */
    protected $skip_validation = false;

    /** @var array Validation rules. */
    protected $validation_rules = [

    ];

    /** @var Array Additional validation rules only used on insert. */
    protected $insert_validation_rules = [

    ];

    /** @var array Metadata for the model's database fields. */
    

    //--------------------------------------------------------------------------

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct() {
        $this->db_con = 'joomla';
        parent::__construct();
    }

    public function getMatches($matchday){
        $this->db->from($this->table_name.' as t1');
        $this->db->select('t1.*, t2.t_name as team1, t3.t_name as team2, t4.v_name');
        $this->db->join('co_bl_teams as t2','t2.id = t1.team1_id','left');
        $this->db->join('co_bl_teams as t3','t3.id = t1.team2_id','left');
        $this->db->join('co_bl_venue as t4','t4.id = t1.venue_id','left');
        $this->db->where('t1.m_id', $matchday);

        $query = $this->db->get();

        return $query->result();

    }

    public function getMatch($match){
        $this->db->from($this->table_name.' as t1');
        $this->db->select('t1.*, t2.t_name as team1, t3.t_name as team2, t4.v_name');
        $this->db->join('co_bl_teams as t2','t2.id = t1.team1_id','left');
        $this->db->join('co_bl_teams as t3','t3.id = t1.team2_id','left');
        $this->db->join('co_bl_venue as t4','t4.id = t1.venue_id','left');
        $this->db->where('t1.id', $match);

        $query = $this->db->get();

        return $query->row();

    }
}