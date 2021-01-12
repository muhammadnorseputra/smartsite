<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_b_banner extends CI_Model {
  public function list_jenisbanner($tbl) 
  {
    return $this->db->get($tbl);
  }

  public function add_jenis_banner($tbl, $val)
  {
    return $this->db->insert($tbl, $val);
  }

  public function add($tbl, $val)
  {
    return $this->db->insert($tbl,$val);
  }

  public function hapus_jenisbanner($tbl, $id) 
  {
    $this->db->where($id);
    $this->db->delete($tbl);
    return;
  }

  public function hapus_banner($tbl, $whr)
  {
    $this->db->where($whr);
    $this->db->delete($tbl);
    
  }

  public function list_banner($tbl)
  {
    // return $this->db->get($tbl);
    return  $this->db->select('t.*, j.jenis, j.posisi')
    ->from($tbl.' AS t')
    ->join('ref_jns_banner AS j', 't.fid_jns_banner = j.id_jns_banner', 'left')
    ->where('t.upload_by', $this->session->userdata('user'))
    ->get();
  }

  public function edit_banner($tbl, $id)
  {
    return $this->db->get_where($tbl, $id);
  }

  public function update_banner($tbl, $set, $unix) 
  {
    $this->db->where($unix);
    $this->db->update($tbl,$set);
  } 
    
}
?>