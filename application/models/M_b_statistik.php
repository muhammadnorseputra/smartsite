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

  public function get_all_count()
  {
    return $this->db->select('*')->from($this->table)->get()->num_rows();
  }

  public function ip_hits($tgl_m,$tgl_s,$lvl=null)
  {
    $this->db->select('ip');
    if($lvl == 'up'):
      $this->db->select_max('hits');
    else:
      $this->db->select_min('hits');
    endif;
    $this->db->from($this->table);
    if(!empty($tgl_m) && !empty($tgl_s)) {
      $this->db->where('date BETWEEN "'.$tgl_m.'" AND "'.$tgl_s.'"');
    }
    $query = $this->db->get()->result();
    return $query;
  }

  public function ip_loc($tgl_m,$tgl_s,$type=null)
  {
    $this->db->select('latitude,longitude');
    $this->db->from($this->table);
    
    if($type == 'on'):
      $this->db->where('latitude !=', NULL);
      $this->db->where('longitude !=', NULL);
    else:
      $this->db->where('latitude', NULL);
      $this->db->where('longitude', NULL);
    endif;

    if(!empty($tgl_m) && !empty($tgl_s)) {
      $this->db->where('date BETWEEN "'.$tgl_m.'" AND "'.$tgl_s.'"');
    }
    $query = $this->db->count_all_results();
    return $query;
  }

  public function ip_hits_count($tgl_m,$tgl_s,$count) {
    if(!empty($tgl_m) && !empty($tgl_s)) {
      $this->db->where('date BETWEEN "'.$tgl_m.'" AND "'.$tgl_s.'"');
    }
    $q = $this->db->get_where($this->table, ['hits' => $count]);
    if($q->num_rows() > 0) {
      $r = $q->row()->ip;
      $query = $r;
    } else {
      $query = '-';
    }
    return $query;
  }

  // Datatable Pagesource
  public $table_ps = 'public_visitor_source';
  public $select_colums_ps = array('id','ip','url','date','time');
  public $order_colums_ps = array(null, null, 'total_hits_per_item');
  public $column_search_ps = array('hits');

  public function datatable_ps() {
    $this->db->select_sum('hits', 'total_hits_per_item');
    $this->db->select($this->select_colums_ps);
    $this->db->from($this->table_ps);
    $this->db->group_by('url');
    $i=0;
    foreach ($this->column_search_ps as $item) { // loop column 
            if (!empty($_POST['search']['value'])) { // if datatable send POST for search
            if ($i === 0) { // first loop
                $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                $this->db->like($item, $_POST['search']['value']);
            } else {
                $this->db->or_like($item, $_POST['search']['value']);
            }

            if (count($this->column_search_ps) - 1 == $i) //last loop
                $this->db->group_end(); //close bracket
        }
        $i++;
    }
    
    if(isset($_POST["order"])){
      $this->db->order_by($this->order_colums_ps[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
    } else {
      $this->db->order_by("total_hits_per_item", "desc");
    }
  }

  public function fetch_datatable_ps() {
    $this->datatable_ps();
    if($_POST['length'] != -1){
      $this->db->limit($_POST['length'], $_POST['start']);
    }
    $query = $this->db->get();
    return $query->result();
  }
  
  public function get_filtered_data_ps() {
    $this->datatable_ps();
    $query = $this->db->get();
    return $query->num_rows();
  }

  public function get_all_data_ps() {
    $this->db->select("*");
    $this->db->from($this->table_ps);
    $query = $this->db->count_all_results();
    return $query;
  }
  
  public function total_hits_ps()
  {
    $this->db->select_sum('hits', 'total_hits');
    $this->db->from($this->table_ps);
    $r = $this->db->get();
    $query = $r->row();
    return $query->total_hits;
  }

  public function get_all_ps($ip) {
    $this->db->select('*');
    $this->db->from('public_visitor_source');
    $this->db->where('ip', $ip);
    $this->db->order_by('date', 'desc');
    $q = $this->db->get();
    return $q;
  }

  public function v_year($tahun)
  {
    $this->db->select('date');
    $this->db->from('public_visitor');
    $this->db->like('date', $tahun);
    $q = $this->db->get();
    return $q->num_rows();
  }

  public function v_year_hits($tahun) {
    $this->db->select_sum('hits', 'total_hits');
    $this->db->from('public_visitor');
    $this->db->like('date', $tahun);
    $q = $this->db->get()->row();
    return $q->total_hits;
  }

  public function v_month($month)
  {
    // $q = $this->db->query("select date from public_visitor where month({$month}) = $month group_by date")
    $this->db->select('date');
    $this->db->from('public_visitor');
    $this->db->where("DATE_FORMAT(date,'%m')", $month);
    $q = $this->db->get();
    return $q->num_rows();
  }
  public function v_month_hits($month) {
    $this->db->select_sum('hits', 'total_hits');
    $this->db->from('public_visitor');
    $this->db->where("DATE_FORMAT(date,'%m')", $month);
    $q = $this->db->get()->row();
    return $q->total_hits;
  }
  public function get_day($yearmonth) {
    $this->db->select('date');
    $this->db->from('public_visitor');
    $this->db->where("DATE_FORMAT(date,'%Y-%m')", $yearmonth);
    $this->db->order_by('date', 'desc');
    $this->db->limit(7);
    $q = $this->db->get()->result();
    return $q;
  }
  public function v_day($day)
  {
    $this->db->select('date');
    $this->db->from('public_visitor');
    $this->db->where("DATE_FORMAT(date,'%d')", $day);
    $q = $this->db->get();
    return $q->num_rows();
  }
  public function v_day_hits($day) {
    $this->db->select_sum('hits', 'total_hits');
    $this->db->from('public_visitor');
    $this->db->where("DATE_FORMAT(date,'%d')", $day);
    $q = $this->db->get()->row();
    return $q->total_hits;
  }
}