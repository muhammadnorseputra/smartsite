<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_b_poling extends CI_Model {
  
  public function list_pertanyaan_or_jawaban($tbl,$jenis) 
  {
    return $this->db->where('status', $jenis)->order_by('id_poling','desc')->get($tbl);
  }


  public function insert($tbl, $val) 
  {
    return $this->db->insert($tbl, $val);
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


  public function grafik($tbl)
  {
    return $this->db->select('label, value')
             ->from($tbl)
             ->where('status','JAWABAN')
             ->where('aktif','Y')
             ->get()->result();
  }


  public function hapus($tbl,$whr)
  {
    $this->db->where($whr);
    $this->db->delete($tbl);
  } 
  

  public function preview_pertanyaan() 
  {
    $p = $this->db->select('label')->from('t_poling')->where('status','PERTANYAAN')->where('aktif','Y')->order_by('id_poling','desc')->get()->result();
    echo json_encode($p);
  }

  public function preview_jawaban() 
  {
    $p = $this->db->select('label')->from('t_poling')->where('status','JAWABAN')->where('aktif','Y')->get()->result();
    if(count($p) > 0) {
      $br = '';
      foreach($p as $r) {
        $br .= '<div class="font-14 m-t-5">'.$r->label.'</div>';
      }
    }
    echo json_encode($br);
  }  

  public function countPartisipasi() {
    
    $q = $this->db->query('select SUM(value) as total, status from t_poling where status != "PERTANYAAN"');
    if($q->num_rows() > 0) {
      $r = $q->result();
      return $r[0]->total;
    }
  }
  
}
?>