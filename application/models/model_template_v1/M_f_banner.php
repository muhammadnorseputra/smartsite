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
	
	public function get_all_banner($id) {
		return $this->db->get_where('t_banner', ['publish' => 'Y', 'id_banner !=' => $id]);
	}

	public function get_detail_banner($id)
	{
		return $this->db->get_where('t_banner', ['id_banner' => $id]);
	}
}

/* End of file M_f_banner.php */
/* Location: ./application/models/model_template_v1/M_f_banner.php */