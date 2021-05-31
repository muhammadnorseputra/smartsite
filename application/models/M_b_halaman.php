<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_b_halaman extends CI_Model {

  public $table = 't_halaman';
  public $select_colums = array('*');
  public $order_colums = array(null, 'title', null, null, null);
  public $column_search = array('title');

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
      $this->db->order_by("id_halaman", "desc");
    }
  }

  public function fetch_datatable_halaman() {
    $this->datatable();
    if($_POST['length'] != -1){
      $this->db->limit($_POST['length'], $_POST['start']);
    }
    $query = $this->db->get();
    return $query->result();
  }
  
  public function get_filtered_data_halaman() {
    $this->datatable();
    $query = $this->db->get();
    return $query->num_rows();
  }

  public function get_all_data_halaman() {
    if(!empty($_POST['search']['value'])){
      $this->db->like('title', $_POST['search']['value']);
    }
    $this->db->select("*");
    $this->db->from($this->table);
    $query = $this->db->count_all_results();
    return $query;
  }

  public function Medithalaman($id) 
  {
    return $this->db->select('title, content, publish, filename, token_halaman')->get_where('t_halaman', array('id_halaman' => $id))->result();
  }
  public function hapus_lampiranbyid($tbl, $val, $whr) {
    $this->db->where($whr);
    $this->db->update($tbl, $val);
    return true;
  }
  
  public function get_title_halaman($token) {
    $q = $this->db->select('title')->get_where('t_halaman', array('token_halaman' => $token));
    if($q->num_rows() > 0) { 
      $r = $q->result();
      return strtolower(str_replace(' ', '-', $r[0]->title));
    }
  }

  public function opendataeditor($token) {
	$this->db->select('id_halaman,title,content,token_halaman');
	$this->db->from('t_halaman');
	$this->db->where('token_halaman', $token);
	return $this->db->get();
  }
  public function simpantitle($tbl, $data, $whr) {
	  $this->db->where($whr);
	  $this->db->update($tbl, $data);
	  return true;
  }
  public function simpandataeditor ($tbl, $id, $data) {
	  $this->db->where($id);
	  $this->db->update($tbl, $data);
	  return true;
  }
}
