<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_f_ikm extends CI_Model
{
	// set table
  protected $table = 'skm AS s';
  //set column field database for datatable orderable
  protected $column_order = array(null, 's.nipnik', 's.nama_lengkap',null,null,null,null,null);
  //set column field database for datatable searchable 
  protected $column_search = array('s.nipnik','s.nama_lengkap');
  // default order 
  protected $order = array('s.id' => 'desc');
  // default select 
  protected $select_table = array('s.*','tp.tingkat_pendidikan','jp.jenis_pekerjaan');

  private function _get_datatables_query($tahun,$periode,$form,$start,$end)
  {

  	$this->db->select($this->select_table);
    $this->db->from($this->table);
    $this->db->join('skm_pekerjaan AS jp', 's.fid_pekerjaan = jp.id');
    $this->db->join('skm_pendidikan AS tp', 's.fid_pendidikan = tp.id');
    if(!empty($tahun)):
    	$this->db->where('s.tahun', $tahun);
    endif;
    if(!empty($periode)):
    	$this->db->where('s.fid_periode', $periode);
    endif;
    if(!empty($form)):
    	$this->db->where('s.card_responden', $form);
    endif;
    if(!empty($start) && !empty($end)):
		$this->db->where('s.created_at >=', $start);
		$this->db->where('s.created_at <=', $end);
    endif;
    
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

  function get_datatables($tahun,$periode,$form,$start,$end)
  {
    $this->_get_datatables_query($tahun,$periode,$form,$start,$end);
    if ($_POST['length'] != -1)
      $this->db->limit($_POST['length'], $_POST['start']);
    $query = $this->db->get();
    return $query->result();
  }

  function count_filtered($tahun,$periode,$form,$start,$end)
  {
    $this->_get_datatables_query($tahun,$periode,$form,$start,$end);
    $query = $this->db->get();
    return $query->num_rows();
  }

  public function count_all($tahun,$periode,$form,$start,$end)
  {
    $this->db->from($this->table);
    $this->db->join('skm_pekerjaan AS jp', 's.fid_pekerjaan = jp.id');
    $this->db->join('skm_pendidikan AS tp', 's.fid_pendidikan = tp.id');
    if(!empty($tahun)):
    	$this->db->where('s.tahun', $tahun);
    endif;
    if(!empty($periode)):
    	$this->db->where('s.fid_periode', $periode);
    endif;
    if(!empty($form)):
    	$this->db->where('s.card_responden', $form);
    endif;
        if(!empty($start) && !empty($end)):
		$this->db->where('s.created_at >=', $start);
		$this->db->where('s.created_at <=', $end);
    endif;

    return $this->db->count_all_results();
  }
  // -------------------------------- end-datatable --------------------------//

	  public function filter_tahun()
	  {
	  	$this->db->select('tahun');
	  	$this->db->from('skm');
	  	$this->db->group_by('tahun');
	  	$q = $this->db->get();
	  	return $q;
	  }
	  public function filter_form()
	  {
	  	$this->db->select('card_responden');
	  	$this->db->from('skm');
	  	$this->db->group_by('card_responden');
	  	$q = $this->db->get();
	  	return $q;
	  }
	  public function filter_periode()
	  {
	  	$this->db->select('id,tgl_mulai,tgl_selesai');
	  	$this->db->from('skm_periode');
	  	$q = $this->db->get();
	  	return $q;
	  }
  public function ikm_tahun()
  {
    return $this->db->select('tahun')->order_by('id','asc')->get('skm_periode');
  }
	public function ikm_periode($tahun)
	{
		return $this->db->get_where('skm_periode', ['tahun' => $tahun]);
	}
}