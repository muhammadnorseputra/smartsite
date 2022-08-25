<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_paketmanager extends CI_Controller {
  public function __construct() 
    {
		parent::__construct();
    _is_logged_in();
    
  }       

  public function cloud($paket) {
    $data = [
      'content' => 'Backend/__Paketmanager/'.$paket.'/default',
      'scriptjs' => 'Backend/__Paketmanager/'.$paket.'/js/script',
      'pageinfo' => '<li>Dasboard</li> <li>Paket</li>
                      <li class="active">'.$paket.'</li>'
    ];

    $page = $this->load->view('Backend/v_home', $data);
    return $page;

  }

  
}