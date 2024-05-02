<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Season_teams_model extends MY_Model {

	// others fields

	/** @var string Name of the table. */
    protected $table_name = 'co_bl_season_teams';

    /** @var bool Use soft deletes (if true). */
    protected $soft_deletes = false;

    /** @var string The date format to use. */
    protected $date_format = 'datetime';

    /** @var bool Set the created time automatically (if true). */
    protected $set_created = false;

    /** @var bool Set the modified time automatically (if true). */
    protected $set_modified = false;



	function __construct(){
		$this->db_con = 'joomla';
		parent::__construct();
	}

    public function findTeamsBySeason($team_id = 0) {
        $sql = "SELECT t1.s_id as id, t1.s_name as name 
        FROM  co_bl_seasons as t1
        LEFT JOIN  $this->table_name as t2
        ON t1.s_id = t2.season_id
        WHERE t2.team_id = $team_id";

        $query = $this->db->query($sql);

        return $query->result();
    }

}