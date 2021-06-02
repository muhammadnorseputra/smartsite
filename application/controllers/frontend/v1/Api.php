<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		//Check maintenance website
        $this->load->model('model_template_v1/M_f_post', 'post');
        if(($this->session->userdata('status') == 'ONLINE') && ($this->mf_beranda->get_identitas()->status_maintenance == '1') || ($this->mf_beranda->get_identitas()->status_maintenance == '0')) {
            // redirect(base_url('frontend/v1/beranda'),'refresh');
        } else {
            redirect(base_url('under-construction'),'refresh');
        }
	}
	public function news()
	{
		$data = [
			'title' => 'BKPPD &bull; News',
			'mf_beranda' => $this->mf_beranda->get_identitas(),
            'mf_menu' => $this->mf_beranda->get_menu(),
			'isi'	=> 'Frontend/v1/pages/news/index',
		];

		$this->load->view('Frontend/v1/layout/wrapper', $data, FALSE);
	}
	public function leave()
	{
		$go = $_GET['go']; //encrypt_url
		$url = decrypt_url($go);
        $dataLink = getSiteOG($url);
		$data = [
			'title' => 'BKPPD &bull; Lanjutkan Link',
			'mf_beranda' => $this->mf_beranda->get_identitas(),
            'mf_menu' => $this->mf_beranda->get_menu(),
			'isi'	=> 'Frontend/v1/pages/leave',
			'url_encode'	=> $go,
			'url_decode'	=> decrypt_url($go),
			'd' => $dataLink
		];

		// Update count view
		$p = $this->post->getDetailByUrl($url);
		if(!empty($p) && $p->type === 'LINK'):
			$count_v = $p->views;
			$count = $count_v + 1;
			$this->post->update_count_post($p->id_berita, $count);
		endif;
		$this->load->view('Frontend/v1/layout/wrapper', $data, FALSE);
	}
	public function grafik()
	{
		$data = [
			'title' => 'Grafik Pegawai &bull; BKPPD Kabupaten Balangan',
			'mf_beranda' => $this->mf_beranda->get_identitas(),
            'mf_menu' => $this->mf_beranda->get_menu(),
			'isi'	=> 'Frontend/v1/pages/pegawai/index',
		];

		$this->load->view('Frontend/v1/layout/wrapper', $data, FALSE);
	}
}