<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Card_model extends MY_Model {
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
    // Validations
    protected $validation_rules = [];
    protected $insert_validation_rules = [];
    protected $updateValidationRules = [];

    function __construct() {
        $this->db_con = 'joomla';
        parent::__construct();
    }

    public function prep_data($post){
        if (!empty($post['location_photo'])) {
            $arr = explode('/', $post['location_photo']);
            $c = count($arr);
            $file = $arr[$c-1];
        } else {
            $file = '';
        }

        $data = array(
            'player_id' => $post['player'],
            'team_id' => $post['team_id'],
            'season_id' => $post['season_id'],
            'number' => $post['number'],
            'type_player' => $post['type_player'],
            'datetime' => formatDate($post['date'],'d/m/Y','Y-m-d').' '.date('H:i:s'),
            'photo' => $file,
            'category' => $post['category'],
            'card' => 1
        );
        return $data; 
    }

    public function find_data_card($team_id, $player_id, $season_id){
        $sql = "SELECT t1.*, t2.t_name as team_name, t2.short_name, t2.t_emblem as emblem, t3.last_name, t3.first_name, t3.birth, t3.photo as photo_player 
                FROM co_bl_players_team as t1
                LEFT JOIN co_bl_teams as t2
                ON t2.id = t1.team_id
                LEFT JOIN co_bl_players as t3
                ON t3.id = t1.player_id
                LEFT JOIN co_bl_seasons as t4
                ON t4.s_id = t1.season_id
                WHERE t1.team_id = $team_id
                AND t1.player_id = $player_id
                AND t1.season_id = $season_id";
        $query = $this->db->query($sql);

        return $query->row();
    }

}