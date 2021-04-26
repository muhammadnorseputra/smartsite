<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Video extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_template_v1/M_f_video', 'video');
		if(($this->session->userdata('status') == 'ONLINE') && ($this->mf_beranda->get_identitas()->status_maintenance == '1') || ($this->mf_beranda->get_identitas()->status_maintenance == '0')) {
            // redirect(base_url('frontend/v1/mf_berandaa'),'refresh');
        } else {
            redirect(base_url('under-construction'),'refresh');
        }
	}

	public function index() 
	{
		$data = [
			'title' => 'BKPPD &bull; Video',
			'mf_beranda' => $this->mf_beranda->get_identitas(),
            'mf_menu' => $this->mf_beranda->get_menu(),
			'isi'	=> 'Frontend/v1/pages/video/video_list',
		];

		$this->load->view('Frontend/v1/layout/wrapper', $data, FALSE);
	}
}