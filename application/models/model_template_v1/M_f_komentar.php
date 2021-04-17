<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_f_komentar extends CI_Model {
	// set table
  protected $table = 't_komentar AS k';
  //set column field database for datatable orderable
  protected $column_order = array(null, 'k.id_komentar', null, null, null, null);
  //set column field database for datatable searchable 
  protected $column_search = array('u.nama_lengkap');
  // default order 
  protected $order = array('k.id_komentar' => 'desc');
  // default select
  protected $select = array('k.*','u.nama_lengkap','b.judul','b.id_berita');

  private function _get_datatables_query()
  {
    $this->db->select($this->select);
    $this->db->from($this->table);
    $this->db->join('t_users_portal AS u', 'k.fid_users_portal = u.id_user_portal');
    $this->db->join('t_berita AS b', 'k.fid_berita = b.id_berita');
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

  public function get_datatables()
  {
    $this->_get_datatables_query();
    if ($_POST['length'] != -1)
      $this->db->limit($_POST['length'], $_POST['start']);
    $query = $this->db->get();
    return $query->result();
  }

  public function count_filtered()
  {
    $this->_get_datatables_query();
    $query = $this->db->get();
    return $query->num_rows();
  }

  public function count_all()
  {
    $this->db->select($this->select);
    $this->db->from($this->table);
    $this->db->join('t_users_portal AS u', 'k.fid_users_portal = u.id_user_portal');
    $this->db->join('t_berita AS b', 'k.fid_berita = b.id_berita');
    return $this->db->count_all_results();
  }

  public function user_reply($parentid)
  {
  	$this->db->select('k.parent_id, k.fid_users_portal, u.nama_lengkap');
  	$this->db->from('t_komentar AS k');
  	$this->db->join('t_users_portal AS u', 'k.fid_users_portal = u.id_user_portal');
  	$this->db->where('k.id_komentar', $parentid);
  	$q = $this->db->get();
  	if($q->num_rows() > 0):
  		$r = $q->row();
  		$user = decrypt_url($r->nama_lengkap);
  	else:
  		$user = "<span class='text-light'>No Reply</span>";
  	endif;
  	return $user;
  }

  public function detail($tbl, $id_komentar)
  {
  	$this->db->select('k.*, b.judul, u.nama_lengkap');
  	$this->db->from($tbl.' AS k');
  	$this->db->join('t_berita AS b', 'k.fid_berita = b.id_berita');
  	$this->db->join('t_users_portal AS u', 'k.fid_users_portal = u.id_user_portal');
  	$this->db->where('k.id_komentar', $id_komentar);
  	$q = $this->db->get();
  	return $q;
  }

  public function reply_send($tbl, $data) {
  	return $this->db->insert($tbl, $data);
  }

  public function hapus($tbl, $id_parent, $id_komentar){
  	$this->db->where($id_parent);
  	$this->db->or_where($id_komentar);
  	$this->db->delete($tbl);
  	return true;
  }

  public function block($tbl, $whr, $status) {
  	$this->db->where($whr);
  	$this->db->update($tbl, $status);
  	return true;
  }

  public function cek_reply($id) {
  	$q = $this->db->get_where('t_komentar', ['parent_id' => $id]);
  	return $q->num_rows();
  }
}