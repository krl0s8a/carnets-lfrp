<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Price_model extends MY_Model {
	/** @var string Name of the passengers_schools table. */
	protected $table_name = 'prices';

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
    /*
     * Constructor
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * return id of row
     parameters:
     t : identiifcador tarifa
     f : origen del viaje
     t : destino del viaje
     */
	
	public function getIdRow($ta, $f, $to){
		$this->db->from($this->table_name);
		$this->db->where('tariff_id', $ta);
		$this->db->where('from', $f);
		$this->db->where('to',$to);
		$row = $this->db->get()->row();

		return isset($row->id) ? $row->id : 0;
	}
	
    public function existPrice($data){
        $this->db->from($this->table_name);
        $this->db->where('tariff_id', $data['tariff_id']);
        $this->db->where('route_id', $data['route_id']);
        $this->db->where('from', $data['from']);
        $this->db->where('to', $data['to']);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getPrice($t,$f,$to){
        $this->db->from($this->table_name);
        $this->db->where('tariff_id',$t);
        $this->db->where('from',$f);
        $this->db->where('to',$to);
        $query = $this->db->get();

        if ($query->num_rows() == 1 ) {
            return $query->row()->price;
        } else {
            return false;
        }
    }

}

/* End of file Price_model.php */
/* Location: .//home/carlos/public_html/futuroSRL/app/modules/tariffs/models/Price_model.php */