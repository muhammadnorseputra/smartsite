<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_f_halaman extends CI_Model
{
  // set table
  protected $table = 't_halaman';
  //set column field database for datatable orderable
  protected $column_order = array('id_halaman', null, 'title');
  //set column field database for datatable searchable 
  protected $column_search = array('title');
  // default order 
  protected $order = array('id_halaman' => 'desc');

  private function _get_datatables_query($idAkun)
  {

    $this->db->from($this->table);
    $this->db->where('fid_users_portal', $idAkun);

    $i = 0;

    foreach ($this->column_search as $item) // loop column 
    {
      if ($_POST['search']['value']) // if datatable send POST for search
      {

        if ($i === 0) // first loop
        {
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

    if (isset($_POST['order'])) // here order processing
    {
      $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
    } else if (isset($this->order)) {
      $order = $this->order;
      $this->db->order_by(key($order), $order[key($order)]);
    }
  }

  function get_datatables($idAkun)
  {
    $this->_get_datatables_query($idAkun);
    if ($_POST['length'] != -1)
      $this->db->limit($_POST['length'], $_POST['start']);
    $query = $this->db->get();
    return $query->result();
  }

  function count_filtered($idAkun)
  {
    $this->_get_datatables_query($idAkun);
    $query = $this->db->get();
    return $query->num_rows();
  }

  public function count_all($idAkun)
  {
    $this->db->from($this->table);
    $this->db->where('fid_users_portal', $idAkun);
    return $this->db->count_all_results();
  }
  // -------------------------------- end-datatable --------------------------//

  public function get_namahalaman($token)
  {
    $this->db->select('title');
    $this->db->from('t_halaman');
    $this->db->where('token_halaman', $token);
    $q = $this->db->get();
    if($q->num_rows() > 0) {
      $r = $q->row();
      $result = ucwords($r->title);
    } else {
      $result = "404 Not Found";
    }
    return $result; 
  }

  public function doAdd($tbl, $data)
  {
    return $this->db->insert($tbl, $data);
  }
  
  public function doUpdate($tbl, $data, $token)
  {
    $this->db->where('token_halaman', $token);
    $this->db->update($tbl, $data);
    return true;
  }

  public function get_detail_halaman($token)
  {
    return $this->db->get_where('t_halaman', ['token_halaman' => $token]);
  }

  public function doDeleteHalaman($tbl, $id)
  {
    $this->db->where('token_halaman', $id);
    $this->db->delete($tbl);
    return true;
  }

  public function simpan_saran($tbl, $data) 
  {
    return $this->db->insert($tbl, $data);
  }

  public function hapus_lampiran($tbl, $whr, $data)
  {
    $this->db->where($whr);
    $this->db->update($tbl, $data);
    return true;
  }
  public function get_viewshalaman($id) {
    $this->db->select('views');
    $this->db->from('t_halaman');
    $this->db->where('token_halaman', $id);
    $q = $this->db->get();
    if($q->num_rows() > 0) {
      $r = $q->row();
      return $r->views;
    }
  }
  public function diakses($tbl, $id, $views) {
    $this->db->where('token_halaman', $id);
    $this->db->update($tbl, ['views' => $views+1]);
    return true; 
  } 
}

/* End of file M_f_halaman.php */
/* Location: ./application/models/model_template_v1/M_f_halaman.php */