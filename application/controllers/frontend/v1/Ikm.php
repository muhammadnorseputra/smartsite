<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Ikm extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_template_v1/M_f_ikm', 'ikm');
		//Check maintenance website
        if(($this->session->userdata('status') == 'ONLINE') && ($this->mf_beranda->get_identitas()->status_maintenance == '1') || ($this->mf_beranda->get_identitas()->status_maintenance == '0')) {
            // redirect(base_url('frontend/v1/beranda'),'refresh');
        } else {
            redirect(base_url('under-construction'),'refresh');
        }
	}

}