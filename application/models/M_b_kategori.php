<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_b_kategori extends CI_Model {
  public function insert($tbl,$val)
  {
    return $this->db->insert($tbl,$val);
  }
  public function insert_tags($tbl,$val)
  {
    return $this->db->insert($tbl,$val);
  }  
  public function search($tbl,$like)
  {
    return $this->db->like('nama_kategori', $like)->get($tbl);
  }  
  public function show($tbl)
  {
    return $this->db->order_by('id_kategori', 'desc')->get($tbl);
  }
  public function show_whr_aktif($tbl)
  {
    return $this->db->order_by('id_kategori', 'desc')->get_where($tbl, ['aktif' => 'Y']);
  }
  public function show_tags($tbl)
  {
    return $this->db->order_by('id_tag', 'desc')->get($tbl);
  }   
  public function edit($tbl,$whr)
  {
    return $this->db->get_where($tbl,$whr);
  }
  public function update($tbl,$val,$whr)
  {
    $this->db->where($whr);
    $this->db->update($tbl,$val);
  }
  public function del($tbl,$whr)
  {
    $this->db->where($whr);
    $this->db->delete($tbl);
  }
  public function del_tags($tbl,$whr)
  {
    $this->db->where($whr);
    $this->db->delete($tbl);
  }    
  public function show_byid($id) {
    $q = $this->db->get_where('t_kategori', ['id_kategori' => $id])->result();
    return $q;
  }
}
