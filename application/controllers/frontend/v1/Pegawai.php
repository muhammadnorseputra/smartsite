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
            redirect(base_url('theme/maintenance_site'),'refresh');
        }
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