<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pegawai extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		//Check maintenance website
        if(($this->session->userdata('status') == 'ONLINE') && ($this->mf_beranda->get_identitas()->status_maintenance == '1') || ($this->mf_beranda->get_identitas()->status_maintenance == '0')) {
            // redirect(base_url('frontend/v1/beranda'),'refresh');
        } else {
            redirect(base_url('under-construction'),'refresh');
        }
	}
	public function report()
	{
		$data = [
			'title' => 'Report Pegawai &bull; BKPPD Kabupaten Balangan',
			'mf_beranda' => $this->mf_beranda->get_identitas(),
            'mf_menu' => $this->mf_beranda->get_menu(),
			'isi'	=> 'Frontend/v1/pages/pegawai/report',
		];

		$this->load->view('Frontend/v1/layout/wrapper', $data, FALSE);
	}
	public function search(){
		$q = $this->input->post('q');
		$url = 'http://silka.bkppd-balangankab.info/api/filternipnama';
		$api = api_client($url);
		echo json_encode($api);
	}
	public function detail()
	{
		$data = [
			'title' => 'NIP: '.$this->input->get('filter[query]').' - '.base_url(),
			'data' => [
				'nip' => $this->input->get('filter[query]') 
			],
			'mf_beranda' => $this->mf_beranda->get_identitas(),
            'mf_menu' => $this->mf_beranda->get_menu(),
			'isi'	=> 'Frontend/v1/pages/peg_detail',
		];

		$this->load->view('Frontend/v1/layout/wrapper', $data, FALSE);
	}
}