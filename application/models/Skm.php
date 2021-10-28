<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Skm extends CI_Model {
	public function skm_unsur_layanan()
	{
		return $this->db->get('skm_unsur');
	}
	public function skm_all_tahun()
	{
		return $this->db->order_by('id','desc')->group_by('tahun')->get('skm_periode');
	}
	public function skm_all_periode()
	{
		return $this->db->order_by('id','desc')->get('skm_periode');
	}
	public function skm_periode()
	{
		return $this->db->order_by('id','desc')->get('skm_periode', 1);
	}
	public function skm_periode_by_id($id)
	{
		return $this->db->get_where('skm_periode', ['id'=>$id])->row();
	}
	public function skm_pertanyaan()
	{
		return $this->db->get_where('skm_pertanyaan', ['status' => 'Y']);
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
	public function skm_total_responden_all()
	{
		return $this->db->get_where('skm')->num_rows();
	}
	public function get_responden($periode=null)
	{
		return $this->db->get_where('skm', ['fid_periode' => $periode]);
	}
	public function responden_by_nipnik($nipnik)
	{
		return $this->db->get_where('skm', ['nipnik' => $nipnik]);
	}
	public function skm_total_responden($periode=null)
	{
		return $this->db->get_where('skm',  ['fid_periode' => $periode])->num_rows();
	}
	public function skm_total_responden_l($periode=null)
	{
		// return $this->db->get_where('skm', ['jns_kelamin' => 'L', 'fid_periode' => $periode]); //Laki-laki
		if(!empty($periode)):
			$this->db->where('fid_periode', $periode);
		endif;
		$this->db->where('jns_kelamin', 'L');
		return $this->db->get('skm');
	}
	public function skm_total_responden_p($periode=null)
	{
		// return $this->db->get_where('skm', ['jns_kelamin' => 'P', 'fid_periode' => $periode]); //Perempuan
		if(!empty($periode)):
			$this->db->where('fid_periode', $periode);
		endif;
		$this->db->where('jns_kelamin', 'P');
		return $this->db->get('skm');
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

	public function ceknipnik($n,$periode_id)
	{
		return $this->db->get_where('skm', ['nipnik' => $n, 'fid_periode' => $periode_id]);
	}

	public function predikat($ikm) {
        if($ikm >= '1.00' && $ikm <= '2.5996'):
            $c = 'danger';
            $x = 'D';
            $y = 'TIDAK BAIK';
        elseif($ikm >= '2.60' && $ikm <= '3.064'):
            $c = 'warning';
            $x = 'C';
            $y = 'KURANG BAIK';
        elseif($ikm >= '3.0644' && $ikm <= '3.532'):
            $c = 'info';
            $x = 'B';
            $y = 'BAIK';
        elseif($ikm >= '3.5324' && $ikm <= '4.00'):
            $c = 'success';
            $x = 'A';
            $y = 'SANGAT BAIK';
        else:
            $c = 'muted';
            $x = '~';
            $y = 'Tidak Terdefinisi';
        endif;
        return ['x' => $x, 'y' => $y, 'c' => $c];   
    }

    public function nilai_predikat($ikm)
    {
        if($ikm >= '25.00' && $ikm <= '64.99'):
            $c = 'danger';
            $x = 'D';
            $y = 'TIDAK BAIK';
        elseif($ikm >= '65.00' && $ikm <= '76.60'):
            $c = 'warning';
            $x = 'C';
            $y = 'KURANG BAIK';
        elseif($ikm >= '76.61' && $ikm <= '88.30'):
            $c = 'info';
            $x = 'B';
            $y = 'BAIK';
        elseif($ikm >= '88.31' && $ikm <= '100.00'):
            $c = 'success';
            $x = 'A';
            $y = 'SANGAT BAIK';
        else:
            $c = 'muted';
            $x = '~';
            $y = 'Tidak Terdefinisi';
        endif;
        return ['x' => $x, 'y' => $y, 'c' => $c];
    }

}