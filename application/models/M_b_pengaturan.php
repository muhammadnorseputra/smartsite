<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_b_pengaturan extends CI_Model {
  
  public function registered_ip($tbl, $data) 
  {
    $this->db->insert($tbl, $data);
    return true;
  }

  public function get_datas($tbl) 
  {
    return $this->db->get($tbl);
  }

  public function get_datas_byid($tbl,$id) 
  {
    return $this->db->get_where($tbl, ['id_access_logregistered' => $id]);
  }
  public function update_datas_byid($tbl, $data, $whr) {
    $this->db->where($whr);
    $this->db->update($tbl, $data);
    return true;
  }

  public function getIdentitas() {
    return $this->db->get('t_pengaturan');
  }
    public function doPostIdentitas($tbl, $post) {
      $this->db->update($tbl, $post);
      return true;
    }
    public function doPostKontak($tbl, $post) {
      $this->db->update($tbl, $post);
      return true;
    }
  public function getMaintenance() {
    $this->db->select('status_maintenance');
    return $this->db->get('t_pengaturan');
  }
    public function doPostMaintenance($tbl, $post) {
      $this->db->update($tbl, $post);
      return true;
    }
  
  public function getWidgetData() {
    $q = $this->db->get('t_widget');
    if($q->num_rows() > 0) {
      return $q;
    }
  }
    public function doUpdateWidget($tbl, $post, $whr) {
      $this->db->where($whr);
      $this->db->update($tbl, $post);
      return true;
    }
    public function doAddWidgetToDb($tbl, $post) {
      $this->db->insert($tbl, $post);
      return true;
    }

    public function hapusWidget($tbl, $whr) {
      $this->db->where($whr);
      $this->db->delete($tbl);
      return true;
    }

    public function getWidgetEdit($id) {
      return $this->db->get_where('t_widget', ['id_widget' => $id]);
    }

    public function doPutWidget($tbl, $val, $whr) {
      $this->db->where($whr);
      $this->db->update($tbl, $val);
      return true;
    }
}
?>