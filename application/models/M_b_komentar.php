<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_b_komentar extends CI_Model {
  
  public $table = 't_komentar as tk';
  public $select_colums = array('tk.*','tu.*','tb.judul');
  public $order_colums = array(null,null,null, 'tu.nama_lengkap', null, null);
  public $column_search = array('tb.judul');

  public function datatable() {
		$this->db->select($this->select_colums);
		$this->db->from($this->table);
    $this->db->join('t_berita as tb', 'tk.fid_berita=tb.id_berita','left');
		$this->db->join('t_users_portal as tu', 'tk.fid_users_portal=tu.id_user_portal');
		// if(!empty($search)){
		// 	$this->db->like('tb.judul', $search);
		// }
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
			$this->db->order_by("tk.id_komentar", "desc");
		}
  }

  public function fetch_datatable_komentar() {
    $this->datatable();
    if($_POST['length'] != -1){
      $this->db->limit($_POST['length'], $_POST['start']);
    }
    $query = $this->db->get();
    return $query->result();
  }
  
  public function get_filtered_data_komentar() {
    $this->datatable();
    $query = $this->db->get();
    return $query->num_rows();
  }

  public function get_all_data_komentar() {
    if(!empty($_POST['search']['value'])){
			$this->db->like('tb.judul', $_POST['search']['value']);
    }
    $this->db->select("*");
    $this->db->from($this->table);
    $this->db->join('t_berita as tb', 'tk.fid_berita=tb.id_berita','left');
    $query = $this->db->count_all_results();
    return $query;
  }
  public function getbyid($tbl, $id) {
    return $this->db->join('t_users_portal', 't_komentar.fid_users_portal=t_users_portal.id_user_portal')->get_where($tbl, array('id_komentar' => $id))->row();
  }
	public function getjudulberitabyidkomentar($id) {
    $this->db->select('judul');
    $this->db->from('t_berita');
    $this->db->where('id_berita', $id);
    $q = $this->db->get()->row();
    return $q->judul;
  }
  public function getreplykomentar($parent_id) {
    return $this->db->get_where('t_komentar', array('id_komentar' => $parent_id))->row();
  }
  public function proses_balas_komentar($tbl, $val) {
    return $this->db->insert($tbl, $val);
  }
  public function hapus_komentar($tbl, $id) {
    $this->db->where('id_komentar', $id);
    $this->db->delete($tbl);
    return true;
  }
  public function jml_komentarbyidberita($id) {
    $this->db->select('COUNT(id_komentar) as total');
    $this->db->where('fid_berita', $id);
    // $this->db->group_by('fid_berita'); 
    // $this->db->order_by('total', 'desc'); 
    $query = $this->db->get('t_komentar')->row();
    return $query->total;
  }
}