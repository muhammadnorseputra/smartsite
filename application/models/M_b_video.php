<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_b_video extends CI_Model {
  public function add($tbl, $val) 
  {
    return $this->db->insert($tbl,$val);
  }


  public function update($tbl, $val, $id) 
  {
    $this->db->where($id);
    $this->db->update($tbl, $val);
  }


  public function sel_album() 
  {
    return $this->db->select('id_album_video,judul,publish')
                    ->from('t_album_video')
                    ->where('upload_by', $this->session->userdata('user'))
                    ->order_by('id_album_video','desc')
                    ->get();
  }
  
  
  public function sc_album($tbl, $id) 
  {
    return $this->db->get_where($tbl, ['id_album_video' => $id]);
  }
  
  
  public function hapus_album($tbl, $whr) 
  {
    $this->db->where($whr);
    $this->db->delete($tbl);
  }


  public function hapus_video($tbl, $whr) 
  {
    $this->db->where($whr);
    $this->db->delete($tbl);
  }
  
  
  public function list_video($tbl, $id) 
  {
    return $this->db->select('t.*, a.id_album_video, a.judul AS jdl_album')
                    ->from($tbl.' AS t')
                    ->join('t_album_video AS a', 't.fid_album_video = a.id_album_video', 'left')
                    ->where('t.fid_album_video', $id)
                    ->get();
  }

  public function updatevideo($tbl, $val, $id) 
  {
    $this->db->where($id);
    $this->db->update($tbl, $val);
  }

}
?>