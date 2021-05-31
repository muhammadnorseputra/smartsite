<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_b_menu extends CI_Model {

  public $table = 't_menu AS tmenu';
  public $select_colums = array('tmenu.*', 'tmod.id_module', 'tmod.nama_module', 'tmod.token', 'tcon.id_icon', 'tcon.nama_icon', 'tbel.id_label', 'tbel.nama_label');
  public $order_colums = array(null, null,null, 'tmenu.nama_menu', null, null, null, null);
  public $column_search = array('tmenu.nama_menu');

  public function datatable() {
	$this->db->select($this->select_colums);
    $this->db->from($this->table);
    $this->db->join('t_module AS tmod', 'tmenu.fid_module = tmod.id_module', 'left');
    $this->db->join('ref_icon AS tcon', 'tmenu.fid_icon = tcon.id_icon', 'left');
    $this->db->join('ref_label_menu AS tbel', 'tmenu.fid_label = tbel.id_label', 'left');
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
			$this->db->order_by("tmenu.id_menu", "desc");
		}
  }

  public function fetch_datatable_menu() {
    $this->datatable();
    if($_POST['length'] != -1){
      $this->db->limit($_POST['length'], $_POST['start']);
    }
    $query = $this->db->get();
    return $query->result();
  }
  
  public function get_filtered_data_menu() {
    $this->datatable();
    $query = $this->db->get();
    return $query->num_rows();
  }

  public function get_all_data_menu() {
    if(!empty($_POST['search']['value'])){
			$this->db->like('tmenu.nama_menu', $_POST['search']['value']);
    }
    $this->db->select("*");
    $this->db->from($this->table);
    $this->db->join('t_module AS tmod', 'tmenu.fid_module = tmod.id_module');
    $this->db->join('ref_icon AS tcon', 'tmenu.fid_icon   = tcon.id_icon');
    $this->db->join('ref_label_menu AS tbel', 'tmenu.fid_label   = tbel.id_label');
    $query = $this->db->count_all_results();
    return $query;
  }

  public function get_label($tbl) {
    return $this->db->order_by('order', 'asc')->get($tbl)->result();
  }

  public function get_icon($tbl, $search)
    {
        if(isset($search)) {
            $res = $this->db->like('nama_icon', $search)->get($tbl);
        } else {
            $res = $this->db->order_by('id_icon', 'desc')->get($tbl);
        }
        return $res;
    } 

  public function insert_menu($val) {
    return $this->db->insert('t_menu', $val);
  }
  public function update_label($val, $whr) {
    $this->db->where($whr);
    $this->db->update('ref_label_menu', $val);
    return TRUE;
  }
  public function delete_menu($table, $where){
    $this->db->where($where);
    $this->db->delete($table);
    return TRUE;
  } 
  public function proses_update_menu($tbl, $val, $whr) {
    $this->db->where($whr);
    $this->db->update($tbl, $val);
    return;
  }
  public function getnamamenu($id) {
    $q = $this->db->get_where('t_menu',array('id_menu' => $id))->row();
    return $q->nama_menu;
  }
  public function getmenubyid($id) {
    $q = $this->db->get_where('t_menu',array('id_menu' => $id))->row();
    return $q;
  }
  public function proses_input_icon($val) {
    return $this->db->insert('ref_icon', array('nama_icon' => $val));
  }
}