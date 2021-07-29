<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		//Check maintenance website
        $this->load->model('model_template_v1/M_f_post', 'post');
        $this->load->model('model_template_v1/M_f_users', 'mf_users');
        $this->load->model('M_b_komentar', 'komentar');
        if(($this->session->userdata('status') == 'ONLINE') && ($this->mf_beranda->get_identitas()->status_maintenance == '1') || ($this->mf_beranda->get_identitas()->status_maintenance == '0')) {
            // redirect(base_url('frontend/v1/beranda'),'refresh');
        } else {
            redirect(base_url('under-construction'),'refresh');
        }
	}
	public function news()
	{
		$data = [
			'title' => 'News - BKPPD Balangan',
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
			'title' => 'Lanjutkan Link - '.$url,
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
	public function silka_get_grap($type) {
		$url = 'http://silka.bkppd-balangankab.info';
		$api = api_curl_get($url.'/api/get_grap/'.$type);
		echo json_encode($api);
	}
	public function silka_get_grap_pns($type)
	{
		$url = 'http://silka.bkppd-balangankab.info';
		$api = api_client($url.'/api/get_grap_pns/'.$type);
		echo json_encode($api);
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

	public function article_all($start='0', $limit=3, $type=null, $sort=null)
	{
		$data = $this->mf_beranda->get_all_berita($limit,$start,$type,$sort);
		if ($data->num_rows() > 0):
			$row = $data->result();
			$data_array = [];
			foreach($row as $d):
				$data_array = ['jdl_article' => $d->judul];
			endforeach;
			$json = $data_array;
		else:
			$json = ['msg' => 'Invalid Request'];
		endif;

		echo var_dump($json);
		// var_dump($json);
	}
}