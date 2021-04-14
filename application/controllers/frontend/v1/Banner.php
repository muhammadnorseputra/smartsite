<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Banner extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->model('model_template_v1/M_f_banner', 'banner');
		//Check maintenance website
        if(($this->session->userdata('status') == 'ONLINE') && ($this->mf_beranda->get_identitas()->status_maintenance == '1') || ($this->mf_beranda->get_identitas()->status_maintenance == '0')) {
            // redirect(base_url('frontend/v1/beranda'),'refresh');
        } else {
            redirect(base_url('under-construction'),'refresh');
        }
	}
	public function index()
	{
		
	}
	public function detail($id, $judul) 
	{
		$data = [
			'title' => 'views: '.$this->banner->get_namabanner(decrypt_url($id)),
			'isi'	=> 'Frontend/v1/pages/b_detail',
			'uri_id' => decrypt_url($id),
            'mf_beranda' => $this->mf_beranda->get_identitas(),
            'mf_menu' => $this->mf_beranda->get_menu(),
            'banner' => $this->banner->get_detail_banner(decrypt_url($id))->row(),
            'banner_all' => $this->banner->get_all_banner(decrypt_url($id))->result(),
		];

		$this->load->view('Frontend/v1/layout/wrapper', $data, FALSE);
	}
	public function new_banner($id_jns_banner) 
	{
		if(empty($this->session->userdata('user_portal_log')['id'])):
		return	redirect(base_url('login_web'),'refresh');
		endif;

			$idjns = decrypt_url($id_jns_banner);
			$data = [
				'title' => 'Tambah Banner',
				'idjns' => $idjns,
				'mf_beranda' => $this->mf_beranda->get_identitas(),
	            'mf_menu' => $this->mf_beranda->get_menu(),
				'isi'	=> 'Frontend/v1/pages/b_baru',
			];

			$this->load->view('Frontend/v1/layout/wrapper', $data, FALSE);
	}

	public function hapus_banner($id) 
	{
		$d = $this->banner->get_detail_banner(decrypt_url($id))->row();
		$file = $d->gambar;
		$tbl = 't_banner';
		$where = [
			'id_banner' => decrypt_url($id),
			'gambar' => $file
		];

		$path = './files/file_banner/';
		if(file_exists($path.$file)) {
			unlink($path.$file);
			$this->banner->hapus_banner($tbl,$where);
			$this->session->set_flashdata(['message' => 'Banner berhasil dihapus', 'class' => 'alert-success']);
		} else {
			$this->session->set_flashdata(['message' => 'Banner Gagal dihapus', 'class' => 'alert-danger']);
		}
		redirect(base_url('frontend/v1/album/alert'),'refresh');
	}
}

/* End of file Banner.php */
/* Location: ./application/controllers/frontend/v1/Banner.php */