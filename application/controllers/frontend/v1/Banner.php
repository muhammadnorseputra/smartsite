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

}

/* End of file Banner.php */
/* Location: ./application/controllers/frontend/v1/Banner.php */