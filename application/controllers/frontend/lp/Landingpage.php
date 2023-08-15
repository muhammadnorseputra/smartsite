<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Landingpage extends CI_Controller {
	function __construct()
	{
		parent::__construct();	
 		$this->site = $this->mf_beranda->get_identitas();
	}

	public function orbit($slug)
	{
        if($slug === 'slotpulsa') 
        { 
            $v = 'satu.php';
        } else {
            $v = '404.php';
        };
		$this->load->view('Frontend/lp/'.$v);
	}
}