<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_statistik extends CI_Controller {
	public function __construct() 
	{
    parent::__construct();
    if(($this->session->userdata('status') != "ONLINE") && ($this->session->userdata('user_access') == '')){
			redirect("login");
    }
  }

  //==========================================//
  ## Halaman Poling 
	public function index()
	{

    $data = [
        'content' => 'Backend/__Module/___Poling/v_table',
        'scriptjs' => 'Backend/__ServerSideJs/Poling/s_poling',
        'pageinfo' => '<li><a href="#"><i class="material-icons">dashboard</i> Dasboard</a></li>
              <li class="active">Poling</li>',
        'css' => [
          'assets/plugins/morrisjs/morris.css'
        ],
        'js' => [
          'assets/plugins/raphael/raphael.min.js',
          'assets/plugins/morrisjs/morris.js'
        ]
    ];
    $this->load->view('Backend/v_home', $data);
        
  }
	//==========================================//
}