<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_f_saran extends CI_Model {
	// set table
  protected $table = 'public_saran';
  //set column field database for datatable orderable
  protected $column_order = array(null, null, null, null);
  //set column field database for datatable searchable 
  protected $column_search = array('nama_lengkap');
  // default order 
  protected $order = array('id_saran' => 'desc');
  // default select
  protected $select = array('*');

  private function _get_datatables_query($whr)
  {
    $this->db->select($this->select);
    $this->db->from($this->table);
    if(!empty($whr['kategori'])){
    	$this->db->where('kategori', $whr['kategori']);
    }
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

  public function get_datatables($whr)
  {
    $this->_get_datatables_query($whr);
    if ($_POST['length'] != -1)
      $this->db->limit($_POST['length'], $_POST['start']);
    $query = $this->db->get();
    return $query->result();
  }

  public function count_filtered($whr)
  {
    $this->_get_datatables_query($whr);
    $query = $this->db->get();
    return $query->num_rows();
  }

  public function count_all($whr)
  {
    $this->db->select($this->select);
    $this->db->from($this->table);
    if(!empty($whr['kategori'])){
    	$this->db->where('kategori', $whr['kategori']);
    }
    return $this->db->count_all_results();
  }

  public function detail($tbl, $whr) {
  	return $this->db->get_where($tbl, $whr);
  }
}