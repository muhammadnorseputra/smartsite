<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_b_foto extends CI_Model {
  public function addphoto($tbl, $val) 
  {
    return $this->db->insert($tbl,$val);
  }


  public function addgaleri($tbl, $val) 
  {
    return $this->db->insert($tbl,$val);
  }
  
  
  public function sel_album() 
  {
    return $this->db->select('id_album_foto,judul,publish')->from('t_album_foto')->where('upload_by', $this->session->userdata('user'))->order_by('id_album_foto','desc')->get();
  }


  public function sc_album($tbl, $id) 
  {
    return $this->db->get_where($tbl, ['id_album_foto' => $id]);
  }


  public function hapus_album($tbl, $whr) 
  {
    $this->db->where($whr);
    $this->db->delete($tbl);
    return;
  }


  public function updatepindah($tbl, $set, $unix) 
  {
    $this->db->where($unix);
    $this->db->update($tbl,$set);
    return TRUE;
  }

  public function updatefoto($tbl, $set, $unix) 
  {
    $this->db->where($unix);
    $this->db->update($tbl,$set);
  }


  public function updategaleri($tbl, $set, $unix) 
  {
    $this->db->where($unix);
    $this->db->update($tbl,$set);
  }
  
  
  public function list_galeri($tbl, $albumid) 
  {
    return $this->db->order_by('tgl_publish','desc')->get_where($tbl, $albumid)->result();
  }
  
  
  public function list_album() 
  {
    return $this->db->select('t.*, COUNT(g.fid_album_foto) AS jml_galeri_in_album')
             ->from('t_album_foto AS t')
             ->join('t_foto AS g', 'g.fid_album_foto = t.id_album_foto', 'left')
             ->where('t.upload_by', $this->session->userdata('user'))
             ->group_by('t.id_album_foto')
             ->order_by('t.id_album_foto', 'desc')
             ->get();
  }


  public function listGaleriByUser($values, $user)
  {
    return $this->db->select('t.judul, t.gambar, t.path, t.tgl_publish, g.judul AS jdl_album,')
                    ->from('t_foto AS t')
                    ->join('t_album_foto AS g', 't.fid_album_foto = g.id_album_foto')
                    ->like('t.judul', $values)
                    ->where(array('t.upload_by' => $user))
                    ->order_by('t.tgl_publish', 'asc')
                    ->get();
  }

  public function getAlbumById($tbl, $id)
  {
    return $this->db->select('id_album_foto,judul,keterangan,gambar,path,publish,tgl_publish,upload_by,upload_at,update_by,update_at')->get_where($tbl, $id);
  }


  public function getGaleriById($tbl,$id)
  {
    return $this->db->select('id_foto,fid_album_foto,judul,keterangan,gambar,path,publish,tgl_publish,upload_by,created_at,update_by,update_at')->get_where($tbl, $id);
  }


  public function hapus_galeri($tbl, $whr) {
    $this->db->where($whr);
    $this->db->delete($tbl);
    return;
  }  

  public function hapus_galeri_depan($tbl, $whr) {
    $this->db->where($whr);
    $this->db->delete($tbl);
    return;
  }  

}
?>