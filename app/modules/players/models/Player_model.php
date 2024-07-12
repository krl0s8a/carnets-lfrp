<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Player_model extends MY_Model {

	// others fields

	/** @var string Name of the table. */
    protected $table_name = 'co_bl_players';

    /** @var string Name of the primary key. */
    protected $key = 'id';

    /** @var bool Use soft deletes (if true). */
    protected $soft_deletes = false;

    /** @var string The date format to use. */
    protected $date_format = 'datetime';

    /** @var bool Set the created time automatically (if true). */
    protected $set_created = true;

    /** @var bool Set the modified time automatically (if true). */
    protected $set_modified = true;



	function __construct(){
		$this->db_con = 'joomla';
		parent::__construct();
	}

    public function prep_data($post){
        $data['birth'] = formatDate($post['birth'],'d/m/Y');
        $data['dni'] = $post['dni'];
        $data['last_name'] = $post['last_name'];
        $data['first_name'] = $post['first_name'];
        $data['status'] = isset($post['status']) ? $post['status'] : 'Activo';
        $data['note'] = isset($post['note']) ? $post['note'] : '';
        return $data;
    }

    public function get_player_suggestions($term, $limit = 10) {
        $this->db->select("t1.id, CONCAT_WS(' ',t1.last_name, t1.first_name, '-' , t1.dni) as text", false);
        //$this->db->join('people as t2','t2.id = t1.people_id','left');
        $this->db->where(" (t1.id LIKE '%" . $term . "%' OR t1.last_name LIKE '%" . $term . "%' OR t1.first_name LIKE '%" . $term . "%' OR t1.dni LIKE '%" . $term . "%') ");
        //$this->db->order_by('t2.first_name','asc');
        $q = $this->db->get($this->table_name.' as t1', $limit);
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }

            return $data;
        }
    }

    public function getPlayersDropdown(){
        $this->db->select('t1.*');
        $this->db->from($this->table_name.' as t1');
        $this->db->order_by('t1.last_name','asc');
        $query = $this->db->get();

        $players = $query->result();
        $arr = [];
        foreach ($players as $k => $v) {
            $dni = !empty($v->dni) ? ' ['.$v->dni.']' : '';
            $arr[$v->id] = $v->last_name.' '.$v->first_name.$dni;  
        }

        return $arr;
    }
}