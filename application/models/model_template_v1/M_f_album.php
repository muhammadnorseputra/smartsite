<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_f_album extends CI_Model
{
	public function judul_album_by_id($id) {
		$this->db->select('judul');
		$this->db->from('t_album_foto');
		$this->db->where('id_album_foto', $id);
		$q = $this->db->get()->row();
		return $q->judul;
	}
	public function album() {
		return $this->db->get('t_album_foto', 0, 5);
	}
	public function photos($id) {
		return $this->db->order_by('id_foto', 'desc')->get_where('t_foto', ['fid_album_foto' => $id, 'publish ' => 'Y']);
	}
}