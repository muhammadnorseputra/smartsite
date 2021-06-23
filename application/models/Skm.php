<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Skm extends CI_Model {
	public function skm_pertanyaan()
	{
		return $this->db->get('skm_pertanyaan');
	}
	public function skm_jawaban_pertanyaan($id)
	{
		return $this->db->get_where('skm_jawaban', ['fid_pertanyaan' => $id]);
	}
	public function skm_jenis_layanan()
	{
		return $this->db->get('skm_jenis_layanan');
	}
	public function skm_pendidikan()
	{
		return $this->db->get('skm_pendidikan');
	}
	public function skm_pekerjaan()
	{
		return $this->db->get('skm_pekerjaan');
	}	
	public function ceknomor($nomor)
	{
		return $this->db->get_where('skm', ['nomor' => $nomor]);
	}
}