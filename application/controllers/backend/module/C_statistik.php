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
          'https://maps.googleapis.com/maps/api/js?key=AIzaSyB3mY70TwKObZIg6_WUz0ntbbT_sGOTvVM&region=ID&language=id&callback=initMaps',
          'assets/plugins/jquery-countto/jquery.countTo.js',
          'assets/js/pages/widgets/infobox/count.js'
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
      $sub_array[] = "<a href='#' onClick='show_ip_detail(\"".$r->ip."\")'>".$r->ip."</a>";
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

  public function page_source() {
    $data = [
        'content' => 'Backend/__Module/___Statistik/v_page_source',
        'scriptjs' => 'Backend/__ServerSideJs/Statistik/s_page_source',
        'pageinfo' => '<li><a href="#"><i class="material-icons">dashboard</i> Dasboard</a></li>
              <li>Statistik</li><li class="active">Page Source</li>',
        'css' => [
          'assets/plugins/datatable/datatables.min.css',
          'assets/plugins/datatable/inc_tablesold.css',
        ],
        'js' => [
          'assets/plugins/datatable/datatables.min.js',
        ]  
    ];
    $this->load->view('Backend/v_home', $data);
  }

  protected function persentase_color($total)
  {
    if($total >= '10.00' && $total <= '24.99'):
      $color = 'progress-bar-danger';
    elseif($total >= '25.00' && $total <= '49.99'):
      $color = 'progress-bar-warning';
    elseif($total >= '50.00' && $total <= '74.99'):
      $color = 'progress-bar-info';
    elseif($total >= '75.00' && $total <= '100.00'):
      $color = 'progress-bar-success';
    else:
      $color = 'progress-bar-striped';
    endif;
    return $color;
  }

  public function ajax_list_ps()
  {
    $getdata = $this->statistik->fetch_datatable_ps();
    $data = array();
    $no = $_POST['start'];
  
    foreach($getdata as $r) {
      $total_hits = $this->statistik->total_hits_ps();
      $persentase = number_format(($r->total_hits_per_item/$total_hits) * 100, 2);
      $color = $this->persentase_color($persentase);
      $progress = '<div class="progress-bar '.$color.'" role="progressbar" aria-valuenow="'.$persentase.'" aria-valuemin="0" aria-valuemax="100" style="width: '.$persentase.'%;">
                                    '.$persentase.'%
                                </div>';
      $sub_array = array();
      $sub_array[] = character_limiter($r->url, 118);
      $sub_array[] = $progress;      
      $sub_array[] = $r->total_hits_per_item;      
      $data[]      = $sub_array;
    $no++;
    }
  
    $output = array(
      'draw'            => intval($_POST['draw']),
      'recordsTotal'    => $this->statistik->get_all_data_ps(),
      'recordsFiltered' => $this->statistik->get_filtered_data_ps(),
      'data'            => $data
    );
  
    echo json_encode($output); 
  }
  public function tabel_ip_detail($row) {
    $tbl = '<div class="table-responsive"><table class="table table-condensed table-hover table-striped">';
    $tbl .= '<thead class="bg-dark">';
      $tbl .= '<tr>
          <th>Date</th>
          <th>Url</th>
          <th>Hits</th>
      </tr>';
    $tbl .= '</thead>';
    $tbl .= '<tbody>';
      foreach($row->result() as $r):
          $tbl .= '<tr>';
            $tbl .= '<td>'.longdate_indo($r->date).'</td>';
            $tbl .= '<td>'.character_limiter($r->url,120).'</td>';
            $tbl .= '<td>'.$r->hits.'</td>';
          $tbl .= '</tr>';
      endforeach;
    $tbl .= '</tbody>';
    $tbl .= '</table></div>'; 
    return $tbl;
  }

  public function ip_detail() {
    $ip = $this->input->post('ip');
    $data = $this->statistik->get_all_ps($ip);
    if($data->num_rows() > 0)
    {
      $template = $this->tabel_ip_detail($data);
      $render = $template;
    } else {
      $render = 'No Data';
    }
    echo json_encode($render);
  }

  public function chart() {
    $data = [
        'content' => 'Backend/__Module/___Statistik/v_chart',
        'scriptjs' => 'Backend/__ServerSideJs/Statistik/s_chart',
        'pageinfo' => '<li><a href="#"><i class="material-icons">dashboard</i> Dasboard</a></li>
              <li>Statistik</li><li class="active">Chart</li>',
        'css' => [
          'assets/plugins/morrisjs/morris.css',
        ],
        'js' => [
          'assets/plugins/morrisjs/morris.js',
          'assets/plugins/raphael/raphael.min.js'
        ]  
    ];
    $this->load->view('Backend/v_home', $data);
  }
}