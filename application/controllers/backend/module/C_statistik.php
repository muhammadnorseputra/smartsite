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
          'assets/plugins/jquery-ui/jquery-ui.theme.min.css',
          'assets/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css',
          'assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css',
        ],
        'js' => [
          'assets/plugins/momentjs/moment.js',
          'assets/plugins/datatable/datatables.min.js',
          'assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js',
          'assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js',
          'assets/plugins/bootstrap-datepicker/locales/bootstrap-datepicker.id.min.js',
          'assets/plugins/jquery-inputmask/jquery.inputmask.bundle.js',
          'assets/js/pages/forms/input-masked.js',
          'assets/js/pages/forms/input-datetime.js',
          'https://maps.googleapis.com/maps/api/js?key=AIzaSyB3mY70TwKObZIg6_WUz0ntbbT_sGOTvVM&region=ID&language=id&callback=initMaps'
        ]  
    ];
    $this->load->view('Backend/v_home', $data);
        
  }
	//==========================================//

  //==========================================//
  ## AJAX LIST

  public function ajax_list() {
    $input = $this->input->post();
    $tgl_m = join('-',array_reverse(explode('/',$input['tgl_m'])));
    $tgl_s = join('-',array_reverse(explode('/',$input['tgl_s'])));

    $getdata = $this->statistik->fetch_datatable_statistik($tgl_m,$tgl_s);
    $data = array();
    $no = $_POST['start'];
  
    foreach($getdata as $r) {

      if(($r->latitude !== NULL) && ($r->longitude !== NULL) && ($r->latitude !== '')) {
        $btnMaps = "<button id='map-marker' role='button' class='btn btn-sm btn-link waves-effect' data-lat='{$r->latitude}' data-long='{$r->longitude}' href='javascript:void(0);'><i class='glyphicon glyphicon-map-marker'></button>";
      } else {
        $btnMaps = '';
      }

      $sub_array = array();
      $sub_array[] = $r->ip;
      $sub_array[] = $r->browser." (".substr($r->browser_version,0,4).")";
      $sub_array[] = $r->os;      
      $sub_array[] = longdate_indo($r->date);
      $sub_array[] = ceil($r->hits);      
      $sub_array[] = $r->latitude;      
      $sub_array[] = $r->longitude;      
      $sub_array[] = substr($r->time, 11,5);      
      $sub_array[] = $btnMaps;      
      $data[]      = $sub_array;
    $no++;
    }
  
    $output = array(
      'draw'            => intval($_POST['draw']),
      'recordsTotal'    => $this->statistik->get_all_data_statistik($tgl_m,$tgl_s),
      'recordsFiltered' => $this->statistik->get_filtered_data_statistik($tgl_m,$tgl_s),
      'data'            => $data,
      'filtered'        => ['tgl_mulai' => $tgl_m, 'tgl_selesai' => $tgl_s]    
    );
  
    echo json_encode($output); 
  }

  //==========================================//

  public function jml_ip()
  {
    $input = $this->input->get();
    $start = join('-',array_reverse(explode('/',$input['s'])));
    $end = join('-',array_reverse(explode('/',$input['e'])));
    $total_ip = $this->statistik->get_all_count();
    $db = $this->statistik->get_all_data_statistik($start,$end);
    $up = $this->statistik->ip_hits($start,$end,'up')[0]->hits;
    $down = $this->statistik->ip_hits($start,$end)[0]->hits;
    $hits_up = ceil($up);
    $hits_down = ceil($down);
    $ip_hits_count_up = $this->statistik->ip_hits_count($start,$end,$up);
    $ip_hits_count_down = $this->statistik->ip_hits_count($start,$end,$down);
    $location = $this->statistik->ip_loc($start,$end,'on');
    $location_off = $this->statistik->ip_loc($start,$end);
    $ip_persentase_day = number_format(($db/$total_ip) * 100,2);
    if($db>0)
    {
      $res = nominal($db);
      $max = nominal($hits_up);
      $min = nominal($hits_down);
      $loc = nominal($location);
      $loc_off = nominal($location_off);
    } else {
      $res = 0;
      $max = 0;
      $min = 0;
      $loc = 0;
    }
    echo json_encode(['total_ip' => $total_ip,
                      'jml_ip' => $res, 
                      'ip_loc' => $loc, 'ip_loc_off' => $loc_off, 
                      'hits_max' => $max, 
                      'ip_max' => $ip_hits_count_up, 
                      'hits_min' => $min, 
                      'ip_min' => $ip_hits_count_down, 
                      'ip_persentase_day' => $ip_persentase_day]);
  }

}