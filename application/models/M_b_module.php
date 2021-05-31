<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_b_module extends CI_Model {

  public $table = 't_module';
  public $select_colums = array('*');
  public $order_colums = array('id_module', 'nama_module', null, null);
  public $column_search = array('nama_module');

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
			$this->db->order_by("id_module", "desc");
		}
  }

  public function fetch_datatable_module() {
    $this->datatable();
    if($_POST['length'] != -1){
      $this->db->limit($_POST['length'], $_POST['start']);
    }
    $query = $this->db->get();
    return $query->result();
  }
  
  public function get_filtered_data_module() {
    $this->datatable();
    $query = $this->db->get();
    return $query->num_rows();
  }

  public function get_all_data_module() {
    if(!empty($_POST['search']['value'])){
			$this->db->like('nama_module', $_POST['search']['value']);
    }
    $this->db->select("*");
    $this->db->from($this->table);
    $query = $this->db->count_all_results();
    return $query;
  }

  public function get_module_list() {
    return $this->db->get_where('t_module', array('aktif' => 'Y'))->result();
  }

  public function insert_module($tbl, $vls) {
    return $this->db->insert($tbl, $vls);
  }
  
  public function edit($tbl, $id) {
    return $this->db->get_where($tbl, array('id_module' => $id));
  }
  
  public function update($tbl,$val,$whr)
  {
    $this->db->where($whr);
    $this->db->update($tbl,$val);
  }

  public function hapus($tbl, $whr) {
    $this->db->where($whr);
    $this->db->delete($tbl);
  }  

  


	
}