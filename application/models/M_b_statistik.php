<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_b_statistik extends CI_Model {

  public $table = 'public_visitor';
  public $select_colums = array('*');
  public $order_colums = array('ip', null, null, 'date', 'hits', null, null, 'time');
  public $column_search = array('ip');

  public function datatable($tgl_m,$tgl_s) {
		$this->db->select($this->select_colums);
		$this->db->from($this->table);
    if(!empty($tgl_m) && !empty($tgl_s)) {
      $this->db->where('date BETWEEN "'.$tgl_m.'" AND "'.$tgl_s.'"');
    }
    $i=0;
		foreach ($this->column_search as $item) { // loop column 
            if (!empty($_POST['search']['value'])) { // if datatable send POST for search
            if ($i === 0) { // first loop
                $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                $this->db->like($item, $_POST['search']['value']);
            } else {
                $this->db->or_like($item, $_POST['search']['value']);
            }

            if (count($this->column_search) - 1 == $i) //last loop
                $this->db->group_end(); //close bracket
        }
        $i++;
    }
		
		if(isset($_POST["order"])){
			$this->db->order_by($this->order_colums[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} else {
			$this->db->order_by("time", "desc");
		}
  }

  public function fetch_datatable_statistik($tgl_m,$tgl_s) {
    $this->datatable($tgl_m,$tgl_s);
    if($_POST['length'] != -1){
      $this->db->limit($_POST['length'], $_POST['start']);
    }
    $query = $this->db->get();
    return $query->result();
  }
  
  public function get_filtered_data_statistik($tgl_m,$tgl_s) {
    $this->datatable($tgl_m,$tgl_s);
    $query = $this->db->get();
    return $query->num_rows();
  }

  public function get_all_data_statistik($tgl_m,$tgl_s) {
    $this->db->select("*");
    $this->db->from($this->table);
    if(!empty($tgl_m) && !empty($tgl_s)) {
      $this->db->where('date BETWEEN "'.$tgl_m.'" AND "'.$tgl_s.'"');
    }
    $query = $this->db->count_all_results();
    return $query;
  }

  public function ip_hits($tgl_m,$tgl_s,$lvl=null)
  {
    if($lvl == 'up'):
      $this->db->select_max('ip');
      $this->db->select_max('hits');
    else:
      $this->db->select_min('ip');
      $this->db->select_min('hits');
    endif;
    $this->db->from($this->table);
    if(!empty($tgl_m) && !empty($tgl_s)) {
      $this->db->where('date BETWEEN "'.$tgl_m.'" AND "'.$tgl_s.'"');
    }
    $query = $this->db->get()->result();
    return $query;
  }

  public function ip_loc($tgl_m,$tgl_s)
  {
    $this->db->select('latitude,longitude');
    $this->db->from($this->table);
    $this->db->where('latitude !=', NULL);
    $this->db->where('longitude !=', NULL);
    $this->db->or_where('latitude !=', '');
    $this->db->or_where('longitude !=', '');
    if(!empty($tgl_m) && !empty($tgl_s)) {
      $this->db->where('date BETWEEN "'.$tgl_m.'" AND "'.$tgl_s.'"');
    }
    $query = $this->db->count_all_results();
    return $query;
  }

  
}