<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Theme extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		
	}

	// Template Default
	public function index()
	{
		if(($this->session->userdata('status') == 'ONLINE') && ($this->mf_beranda->get_identitas()->status_maintenance == '1') || ($this->mf_beranda->get_identitas()->status_maintenance == '0')) {
			redirect(base_url('beranda'),'refresh');
		} else {
			redirect(base_url('theme/maintenance_site'),'refresh');
		}
	}

	public function maintenance_site() {
		$this->load->view('errors/html/error_maintenance');
		if(($this->mf_beranda->get_identitas()->status_maintenance == '0') || ($this->session->userdata('status') == 'ONLINE')) {
			redirect(base_url('beranda'),'refresh');
		}
	}

}

/* End of file Template.php */
/* Location: ./application/controllers/Template.php */