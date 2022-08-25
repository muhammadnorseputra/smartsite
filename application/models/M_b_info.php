<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_b_info extends CI_Model {

  public function list_info($tbl, $search) 
  {
    if((isset($search)) && (!empty($search))) {
      $q = $this->db->like('judul', $search)->order_by('id_info','desc')->get($tbl);
    } else {
      $q = $this->db->order_by('id_info','desc')->get($tbl);
    }   
    return $q;
  }


  public function insert($tbl, $values) {
    return $this->db->insert($tbl, $values);
  }


  public function edit($tbl,$id) 
  {
    return $this->db->where($id)->get($tbl)->result();
  }

  
  public function update($tbl,$val,$whr)
  {
    $this->db->where($whr);
    $this->db->update($tbl,$val);
  }


  public function hapus($tbl,$whr)
  {
    $this->db->where($whr);
    $this->db->delete($tbl);
  }   


}
?>