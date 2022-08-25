<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_b_users extends CI_Model {
  public $table = 't_users';
  public $select_colums = array('*');
  public $order_colums = array(null, null,'nama_lengkap', null, null, null, null, null, null, null, null, null);
  public $column_search = array('nama_lengkap');

  public function datatable() {
		$this->db->select($this->select_colums);
		$this->db->from($this->table);

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
			$this->db->order_by("nama_lengkap", "desc");
		}
  }

  public function fetch_datatable_users() {
    $this->datatable();
    if($_POST['length'] != -1){
      $this->db->limit($_POST['length'], $_POST['start']);
    }
    $query = $this->db->get();
    return $query->result();
  }
  
  public function get_filtered_data_users() {
    $this->datatable();
    $query = $this->db->get();
    return $query->num_rows();
  }

  public function get_all_data_users() {
    if(!empty($_POST['search']['value'])) {
			$this->db->like('nama_lengkap', $_POST['search']['value']);
    }
    $this->db->select("*");
    $this->db->from($this->table);
    $query = $this->db->count_all_results();
    return $query;
  }

  public function getusers($tbl, $id) {
    $q = $this->db->get_where($tbl, array('id_user' => $id));
    return $q->result();
  }

  public function getmodule($tbl){
    return $this->db->order_by('id_module', 'desc')->get_where($tbl, array('aktif' => 'Y'))->result();
  }


  public function add($tbl, $values) {
    return $this->db->insert($tbl, $values);
  }

  public function hapus_user($tbl, $whr) {
    $this->db->where($whr);
    $this->db->delete($tbl);
    return;
  }  

  public function update_password($tbl, $val, $whr) {
    $this->db->where($whr);
    $this->db->update($tbl, $val);
    return;
  }
  public function update_module_user($whr, $value) {
    $this->db->where($whr);
    $this->db->update('t_users', $value);
    return;
  }
  public function getnamauser($id) {
    $q = $this->db->get_where('t_users', array('id_user' => $id))->result();
    return $q[0]->nama_lengkap;
  }
  public function getuserbyid($id) {
    return $this->db->get_where('t_users', array('id_user' => $id))->result();
  }
  public function proses_update_users($tbl, $whr, $value) {
    $this->db->where($whr);
    $this->db->update($tbl, $value);
    return;
  }
}