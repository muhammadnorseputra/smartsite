<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_statistik extends CI_Controller {
	public function __construct() 
	{
    parent::__construct();
    $this->load->model('M_b_statistik', 'statistik');
    if(($this->session->userdata('status') != "ONLINE") && ($this->session->userdata('user_access') == '')){
			redirect("login");
    }
  }

  //==========================================//
  ## Halaman Statistik 
	public function index()
	{
    $data = [
        'content' => 'Backend/__Module/___Statistik/v_table',
        'scriptjs' => 'Backend/__ServerSideJs/Statistik/s_index',
        'pageinfo' => '<li><a href="#"><i class="material-icons">dashboard</i> Dasboard</a></li>
              <li class="active">Statistik</li>',
        'css' => [
          'assets/plugins/datatable/datatables.min.css',
          'assets/plugins/datatable/inc_tablesold.css',
          'assets/plugins/jquery-ui/jquery-ui.min.css',
          'assets/plugins/jquery-ui/jquery-ui.theme.min.css'
        ],
        'js' => [
          'assets/plugins/datatable/datatables.min.js',
          'https://maps.googleapis.com/maps/api/js?sensor=false'
        ]  
    ];
    $this->load->view('Backend/v_home', $data);
        
  }
	//==========================================//

  //==========================================//
  ## AJAX LIST

  public function ajax_list() {

    $getdata = $this->statistik->fetch_datatable_statistik();
    $data = array();
    $no = $_POST['start'];
  
    foreach($getdata as $r) {

      if(($r->latitude !== NULL) && ($r->longitude !== NULL)) {
        $btnMaps = "<button id='map-marker' role='button' class='btn btn-sm btn-link waves-effect' data-lat='{$r->latitude}' data-long='{$r->longitude}' href='javascript:void(0);'><i class='glyphicon glyphicon-map-marker'></button>";
      } else {
        $btnMaps = '';
      }

      $sub_array = array();
      $sub_array[] = $r->ip;
      $sub_array[] = $r->browser." (".substr($r->browser_version,0,4).")";
      $sub_array[] = $r->os;      
      $sub_array[] = longdate_indo($r->date);
      $sub_array[] = round($r->hits/3);      
      $sub_array[] = $r->latitude;      
      $sub_array[] = $r->longitude;      
      $sub_array[] = substr($r->time, 11,5);      
      $sub_array[] = $btnMaps;      
      $data[]      = $sub_array;
    $no++;
    }
  
    $output = array(
      'draw'            => intval($_POST['draw']),
      'recordsTotal'    => $this->statistik->get_all_data_statistik(),
      'recordsFiltered' => $this->statistik->get_filtered_data_statistik(),
      'data'            => $data      
    );
  
    echo json_encode($output); 
  }

  //==========================================//

}