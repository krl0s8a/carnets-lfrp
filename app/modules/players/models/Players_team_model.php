<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Players_team_model extends MY_Model {

	// others fields

	/** @var string Name of the table. */
    protected $table_name = 'co_bl_players_team';

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
    /**
     * Retorna los jugadores de un equipo que participa 
     * en un determinado torneo
    **/
    public function playersByTeam($season_id, $team_id){
        $sql = "SELECT t1.season_id, t1.team_id, t1.player_id, t1.number, t1.type_player, t2.first_name, t2.last_name, t2.dni
            FROM $this->table_name as t1
            LEFT JOIN co_bl_players as t2
            ON t1.player_id = t2.id
            WHERE t1.team_id = $team_id
            AND t1.season_id = $season_id
            ORDER BY t1.number ASC
        ";

        $query = $this->db->query($sql);

        return $query->result();
    }

    public function playersByTeamOrderName($season_id, $team_id){
        $sql = "SELECT t1.season_id, t1.team_id, t1.player_id, t1.number, t1.type_player, t2.first_name, t2.last_name, t2.dni
            FROM $this->table_name as t1
            LEFT JOIN co_bl_players as t2
            ON t1.player_id = t2.id
            WHERE t1.team_id = $team_id
            AND t1.season_id = $season_id
            ORDER BY t2.last_name ASC
        ";

        $query = $this->db->query($sql);

        return $query->result();
    }
    // Jugador con los datos asociados a un equipo en un torneo
    public function playerByTeam($season_id, $team_id, $player_id){
        $sql = "SELECT t1.season_id, t1.team_id, t1.player_id, t1.number, t1.type_player, t2.first_name, t2.last_name, t2.dni
            FROM $this->table_name as t1
            LEFT JOIN co_bl_players as t2
            ON t1.player_id = t2.id
            WHERE t1.team_id = $team_id
            AND t1.season_id = $season_id
            AND t1.player_id = $player_id
        ";
        $query = $this->db->query($sql);

        return $query->row();
    }
}