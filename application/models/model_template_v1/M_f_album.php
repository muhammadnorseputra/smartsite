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
	public function detail_album($id) {
		$q = $this->db->get_where('t_album_foto', ['id_album_foto' => $id]);
		return $q->row();
	}
	public function detail_photo($id) {
		$q = $this->db->get_where('t_foto', ['id_foto' => $id]);
		return $q->row();
	}
	public function album() {
		return $this->db->get('t_album_foto', 0, 8);
	}
	public function ajax_list_album($val)
	{
		$this->db->select('id_album_foto, judul');
		$this->db->from('t_album_foto');
		$this->db->where('publish', 'Y');
		$this->db->like('judul', $val);
		$q = $this->db->get();
		return $q;
	}
	public function photos($id) {
		return $this->db->order_by('id_foto', 'desc')->get_where('t_foto', ['fid_album_foto' => $id, 'publish ' => 'Y']);
	}
	public function jml_photo_in_album($idalbum) {
		$q = $this->db->get_where('t_foto', ['fid_album_foto' => $idalbum, 'publish ' => 'Y']);
		return $q->num_rows();
	}
	public function get_all_album() {
		return $this->db->order_by('id_album_foto','desc')->get_where('t_album_foto', array('publish' => 'Y'));
	}
}