<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_b_download extends CI_Model {



  public function eks_upload($tbl,$data) 
  {
    return $this->db->insert($tbl,$data);
  }



  public function in_upload($tbl,$data) 
  {
    return $this->db->insert($tbl,$data);
  }

  public function edit_linkekseternal($tbl, $id) {
    return $this->db->get_where($tbl, array('id_download' => $id));
  }

  public function addByLink($tbl,$data) 
  {
    return $this->db->insert($tbl,$data);
  }

  public function list_internal($tbl) 
  {
    return $this->db->select('id_download, keterangan, d_key, judul, file, type, path, ukuran, publish, tgl_publish, count')
                    ->from($tbl)
                    ->where('link', '')
                    ->order_by('id_download','desc')
                    ->get();
  }

  public function list_eksternal($tbl) 
  {
    return $this->db->select('id_download, keterangan, d_key, judul, link, publish, tgl_publish, count')
                    ->from($tbl)
                    ->where('link !=', '')
                    ->order_by('id_download','desc')
                    ->get();
  }
  


  public function edit($tbl, $id) 
  {
    return $this->db->get_where($tbl, ['id_download' => $id]);
  }

  public function updateElse($tbl, $set, $whr) {
    $this->db->where($whr);
    $this->db->update($tbl,$set);
  }

  public function delete($tbl, $whr) 
  {
    $this->db->where($whr);
    $this->db->delete($tbl);
    return;
  }
  
  

  public function delete_eks_link($tbl, $whr) 
  {
    $this->db->where($whr);
    $this->db->delete($tbl);
    return;
  }   

  
}
?>