<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Widget extends CI_Controller {
	function __construct()
	{
		parent::__construct();	
 		$this->site = $this->mf_beranda->get_identitas();
	}

	public function gpr_widget()
	{
		$data = [
			'title' => 'GPR - Government Public Relations, BKPPD Balangan '.date('Y'),
			'isi' => 'Frontend/gpr/widget-v1',
			'mf_beranda' => $this->mf_beranda->get_identitas(),
            'mf_menu' => $this->mf_beranda->get_menu()
		];
		$this->load->view('Frontend/v1/layout/wrapper', $data);
	}
}