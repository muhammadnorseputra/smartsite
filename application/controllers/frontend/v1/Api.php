<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		header('Access-Control-Allow-Origin: *');
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
	public function slider()
	{
		$banners = $this->mf_beranda->list_banner('BANNER', 'Aside', 0, 8)->result();
		$data = [];
		$no=1;
		foreach($banners as $banner):
			$namapanggilan = decrypt_url($this->mf_users->get_userportal_namapanggilan($banner->upload_by)->nama_panggilan);
			$row['uuid'] = $no;
			$row['title'] = $banner->judul;
			$row['image'] = $banner->gambar;
			$row['path'] = $banner->path;
			// $row['user'] = $banner->upload_by;
			$row['user'] = 'data:image/jpeg;base64,'.base64_encode($this->mf_users->get_userportal_byid($banner->upload_by)->photo_pic).'';
			$row['user_nama'] = ucwords($namapanggilan);
			$data[] = $row;
			$no++;
		endforeach;
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
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
	public function silka_file_json()
	{
		$url = $this->config->item('SILKA_URI');
		$type = ['asn','pns','nonpns','pensiun'];
		$asn = api_curl_get($url.'/api/get_grap/'.$type[0]);
		$pns = api_curl_get($url.'/api/get_grap/'.$type[1]);
		$nonpns = api_curl_get($url.'/api/get_grap/'.$type[2]);
		$pensiun = api_curl_get($url.'/api/get_grap/'.$type[3]);

		$data = [
			'jml_asn' => nominal($asn),
			'jml_pns' => nominal($pns),
			'jml_nonpns' => nominal($nonpns),
			'jml_pensiun' => nominal($pensiun)
		];
		// $this->output->set_content_type('application/json');
		// $json = json_encode($data);
		// if (@$_GET['callback'])
		//   echo @$_GET['callback'] . '(' . $json . ')';
		// else
		//   echo $json;
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
		// $jsonfile = json_encode($data, JSON_PRETTY_PRINT);
		// @file_put_contents('statistik-pegawai.json', $jsonfile);
	}
	public function silka_get_grap($type) {
		$url = $this->config->item('SILKA_URI');
		$api = api_curl_get($url.'/api/get_grap/'.$type);
		$this->output->set_content_type('application/json');
		echo json_encode($api);
	}
	public function silka_get_grap_pns($type)
	{
		$url = $this->config->item('SILKA_URI');
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