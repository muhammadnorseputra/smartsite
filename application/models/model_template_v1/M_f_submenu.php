<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_f_submenu extends CI_Model {
  // set table
  protected $table = 't_submenu';
  //set column field database for datatable orderable
  protected $column_order = array(null, null, 'nama_sub', null, null, null);
  //set column field database for datatable searchable 
  protected $column_search = array('nama_sub');
  // default order 
  protected $order = array('idsub' => 'desc');
  // default select
  protected $select = array('t_submenu.*','t_menu.sts');

  private function _get_datatables_query()
  {
    $this->db->select($this->select);
    $this->db->from($this->table);
    $this->db->join('t_menu', 't_submenu.idmain = t_menu.id_menu');
    $this->db->where('t_menu.sts', 'FRONTEND');
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
    $this->db->join('t_menu', 't_submenu.idmain = t_menu.id_menu');
    $this->db->where('t_menu.sts', 'FRONTEND');
    return $this->db->count_all_results();
  }

  public function insert($tbl, $value) 
  {
  	return $this->db->insert($tbl, $value);
  }
  public function detail($id) 
  {
  	return $this->db->get_where('t_submenu', ['idsub' => $id]);
  }
  public function update($tbl, $data, $whr) 
  {
    $this->db->where($whr);
    $this->db->update($tbl, $data);
    return true;
  }
  public function hapus($whr, $tbl)
  {
  	$this->db->where($whr);
  	$this->db->delete($tbl);
  	return true;
  }
}