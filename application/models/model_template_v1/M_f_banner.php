<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_f_banner extends CI_Model {

	public function get_namabanner($id)
	{
		$this->db->select('judul');
		$this->db->from('t_banner');
		$this->db->where('id_banner', $id);
		$q = $this->db->get();
		$r = $q->row();
		return ucwords($r->judul);
	}
	public function get_list_jns_banner()
	{
		return $this->db->get('ref_jns_banner');
	}
	public function get_list_banner($whr) 
	{
		$arr = ['fid_jns_banner' => $whr];
		$this->db->join('ref_jns_banner', 't_banner.fid_jns_banner  = ref_jns_banner.id_jns_banner', 'left');
		$q=$this->db->get_where('t_banner', $arr);
		return $q->result();
	}
	public function get_all_banner($id) {
		return $this->db->get_where('t_banner', ['publish' => 'Y', 'id_banner !=' => $id]);
	}

	public function get_detail_banner($id)
	{
		return $this->db->get_where('t_banner', ['id_banner' => $id]);
	}

	public function hapus_banner($tbl, $whr)
	  {
	    $this->db->where($whr);
	    $this->db->delete($tbl);
	    
	  }
}

/* End of file M_f_banner.php */
/* Location: ./application/models/model_template_v1/M_f_banner.php */