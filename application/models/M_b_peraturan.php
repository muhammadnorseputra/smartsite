<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_b_peraturan extends CI_Model {

  public $table = 't_peraturan as tp';
  public $select_colums = array('tp.*','tj.nama_jenis_peraturan');
  public $order_colums = array('tp.id_peraturan', 'tp.judul', null, null, null, null, null, null);
  public $column_search = array('tp.judul');

  public function datatable() {
		$this->db->select($this->select_colums);
		$this->db->from($this->table);
		$this->db->join('ref_jns_peraturan as tj', 'tp.fid_jns_peraturan=tj.id_jenis_peraturan','left');
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
			$this->db->order_by("tp.id_peraturan", "desc");
		}
  }

  public function fetch_datatable_peraturan() {
    $this->datatable();
    if($_POST['length'] != -1){
      $this->db->limit($_POST['length'], $_POST['start']);
    }
    $query = $this->db->get();
    return $query->result();
  }
  
  public function get_filtered_data_peraturan() {
    $this->datatable();
    $query = $this->db->get();
    return $query->num_rows();
  }

  public function get_all_data_peraturan() {
    if(!empty($_POST['search']['value'])){
			$this->db->like('tp.judul', $_POST['search']['value']);
    }
    $this->db->select("*");
    $this->db->from($this->table);
		$this->db->join('ref_jns_peraturan as tj', 'tp.fid_jns_peraturan=tj.id_jenis_peraturan','left');
    $query = $this->db->count_all_results();
    return $query;
  }

  public function datatable_jns_peraturan() {
		$this->db->select('*');
    $this->db->from('ref_jns_peraturan');
    
    $columnsearch = array('nama_jenis_peraturan');
    $columnorder = array(null, 'id_jenis_peraturan');
		$i=0;
		foreach ($columnsearch as $item) {  
                if (!empty($_POST['search']['value'])) { 
                if ($i === 0) { 
                    $this->db->group_start(); 
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($columnsearch) - 1 == $i) 
                    $this->db->group_end(); 
            }
            $i++;
        }
		
		if(isset($_POST["order"])){
			$this->db->order_by($columnorder[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} else {
			$this->db->order_by("id_jenis_peraturan", "desc");
    }
    
  }

  public function fetch_datatable_jns_peraturan() {
    $this->datatable_jns_peraturan();
    if($_POST['length'] != -1){
      $this->db->limit($_POST['length'], $_POST['start']);
    }
    $query = $this->db->get();
    return $query->result();
  }
  
  public function get_filtered_data_jns_peraturan() {
    $this->datatable_jns_peraturan();
    $query = $this->db->get();
    return $query->num_rows();
  }

  public function get_all_data_jns_peraturan() {
    if(!empty($_POST['search']['value'])){
			$this->db->like('nama_jenis_peraturan', $_POST['search']['value']);
    }
    $this->db->select("*");
    $this->db->from('ref_jns_peraturan');
    $query = $this->db->count_all_results();
    return $query;
  }

  public function get_select_jenisperaturan($tbl, $search)
  {
      if(isset($search)) {
          $res = $this->db->like('nama_jenis_peraturan', $search)->get($tbl);
      } else {
          $res = $this->db->order_by('id_jenis_peraturan', 'desc')->get($tbl);
      }

      return $res;
  }

  public function get_select_jenisperaturan_noajax() {
    return $this->db->get('ref_jns_peraturan')->result();
  }

  public function insert_file_peraturan($tbl, $val) 
  {
    return $this->db->insert($tbl,$val);
  }

  public function insert_jns_peraturan($tbl, $val) 
  {
    return $this->db->insert($tbl,$val);
  }

  public function update_file_peraturan($tbl, $val, $whr) {
    $this->db->where($whr);
    $this->db->update($tbl, $val);
  }

  public function update_jns_peraturan($tbl, $whr, $val) {
    $this->db->where($whr);
    $this->db->update($tbl, $val);
  }

  public function edit_by_id($tbl, $id) 
  {
    return $this->db->get_where($tbl, ['id_peraturan' => $id]);
  }

  public function hapusperaturan($tbl, $whr) {
    $this->db->where($whr);
    $this->db->delete($tbl);
    return;
  }  

  public function hapusjnsperaturan($tbl, $whr) {
    $this->db->where($whr);
    $this->db->delete($tbl);
    return;
  }  
  public function get_judulbyid($id) {
    $q = $this->db->get_where('t_peraturan', ['id_peraturan' => $id])->row();
    return $q->judul;
  }

}