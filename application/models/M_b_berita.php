<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_b_berita extends CI_Model {

  public $table = 't_berita as tb';
  public $select_colums = array('tb.*','tk.nama_kategori');
  public $order_colums = array(null, null, 'tb.judul', 'tb.tgl_posting', 'tb.views', null);
  public $column_search = array('tb.judul');

  public function datatable() {
		$this->db->select($this->select_colums);
		$this->db->from($this->table);
    $this->db->join('t_kategori as tk', 'tb.fid_kategori=tk.id_kategori','left');
    if($this->session->userdata('lvl') != 'ADMIN') {
      $this->db->where('created_by', $this->session->userdata('user'));
    }
		if(!empty($search)){
			$this->db->like('tb.judul', $search);
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
			$this->db->order_by("tb.judul", "desc");
		}
  }

  public function fetch_datatable_berita() {
    $this->datatable();
    if($_POST['length'] != -1){
      $this->db->limit($_POST['length'], $_POST['start']);
    }
    $query = $this->db->get();
    return $query->result();
  }
  
  public function get_filtered_data_berita() {
    $this->datatable();
    $query = $this->db->get();
    return $query->num_rows();
  }

  public function get_all_data_berita() {
    if(!empty($_POST['search']['value'])){
			$this->db->like('tb.judul', $_POST['search']['value']);
    }
    
    $this->db->select("*");
    $this->db->from($this->table);
		$this->db->join('t_kategori as tk', 'tb.fid_kategori=tk.id_kategori','left');
    $query = $this->db->count_all_results();
    return $query;
  }

  public function ajax_list_kategori($table, $search) {
    if(isset($search)) {
      $res = $this->db->like('nama_kategori', $search)->get_where($table, array('aktif' => 'Y'));
    } else {
        $res = $this->db->order_by('id_kategori', 'desc')->get_where($table, array('aktif' => 'Y'));
    }

    return $res;
  }

  public function ajax_list_tags($table, $search) {
    if(isset($search)) {
      $res = $this->db->like('nama_tag', $search)->get($table);
    } else {
        $res = $this->db->order_by('idtag', 'desc')->get($table);
    }

    return $res;
  }

  public function add($tbl, $val)
  {
    return $this->db->insert($tbl,$val);
  }

  public function hapus_berita($tbl, $whr) 
  {
    $this->db->where($whr);
    return $this->db->delete($tbl);
  }
  public function get_judulbyid($id) {
    $q = $this->db->get_where('t_berita', array('id_berita' => $id))->row();
    return $q->judul;
  }
  public function get_beritabyid($id) {
    $q = $this->db->get_where('t_berita', array('id_berita' => $id))->row();
    return $q;
  }
  public function update($tbl, $val, $whr) {
    $this->db->where($whr);
    $this->db->update($tbl, $val);
    return;
  }
}
