<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Skm extends CI_Model {
	public function skm_periode()
	{
		return $this->db->order_by('id','desc')->get('skm_periode', 1);
	}
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
	public function skm_jenis_layanan_byid($id)
	{
		return $this->db->get_where('skm_jenis_layanan', ['id' => $id]);
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
	public function skm_insert($tbl, $data)
	{
		return $this->db->insert($tbl, $data);
	}
	public function get_responden()
	{
		return $this->db->get_where('skm', ['fid_periode' => 1]);
	}
	public function skm_total_responden()
	{
		return $this->db->get_where('skm',  ['fid_periode' => 1])->num_rows();
	}
	public function skm_total_responden_l()
	{
		return $this->db->get_where('skm', ['jns_kelamin' => 'L', 'fid_periode' => 1]); //Laki-laki
	}
	public function skm_total_responden_p()
	{
		return $this->db->get_where('skm', ['jns_kelamin' => 'P', 'fid_periode' => 1]); //Perempuan
	}
	public function skm_total_layanan()
	{
		return $this->db->get('skm_jenis_layanan');
	}
	public function skm_total_indikator()
	{
		return $this->db->get('skm_pertanyaan');
	}

	public function skm_bobot_nilai()
	{
		$jumlah_bobot = 1;
		$jumlah_unsur = $this->skm_pertanyaan()->num_rows();
		$bobot_nilai = $jumlah_bobot / $jumlah_unsur;
		return number_format($bobot_nilai,2);
	}

	public function _get_jawaban_responden($userId)
	{
		$responden = $this->db->get_where('skm', ['id' => $userId]);
		foreach($responden->result() as $r):
			$q = $r->jawaban_responden;
			$s = explode(',', $q);
			$d = $s;
		endforeach;
		return $d;
	}

	public function _get_poin_responden_per_unsur($id)
	{
		$this->db->select('poin');
		$this->db->from('skm_jawaban');
		$this->db->where('id', $id);
		$q = $this->db->get()->row();
		return $q->poin;
	}

	// public function get_pertanyaan($id_pertanyaan)
	// {
	// 	$this->db->select('jdl_pertanyaan');
	// 	$this->db->from('skm_pertanyaan');
	// 	$this->db->where('id', $id_pertanyaan);
	// 	$q = $this->db->get()->row();
	// 	return $q->jdl_pertanyaan;
	// }

	// public function get_poin($id_jawaban)
	// {
	// 	$this->db->select('poin');
	// 	$this->db->from('skm_jawaban');
	// 	$this->db->where('id', $id_jawaban);
	// 	$q = $this->db->get()->row();
	// 	return $q->poin;
	// }

	// public function _get_jawaban_perunsur()
	// {
	// 	$data = $this->_get_jawaban_responden();
	// 	foreach($data as $key => $value):
	// 		$r[] = $data[$key];
	// 	endforeach;
	// 	return $r;
	// }
	// public function skm_total_nilai_perunsur()
	// {

	// }

}