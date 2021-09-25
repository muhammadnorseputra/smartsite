<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_userportal extends CI_Controller {
	public function __construct() 
	{
    parent::__construct();
    $this->load->model('M_b_userportal', 'userportal');
    if(($this->session->userdata('status') != "ONLINE") && ($this->session->userdata('user_access') == '')){
			redirect("login");
    }
  }

  //==========================================//
  ## Halaman Userportal 
	public function index()
	{
    $data = [
        'content' => 'Backend/__Module/___Userportal/v_table',
        'scriptjs' => 'Backend/__ServerSideJs/Userportal/s_index',
        'pageinfo' => '<li><a href="#"><i class="material-icons">dashboard</i> Dasboard</a></li>
              <li class="active">Userportal</li>',
        'css' => [
          'assets/plugins/datatable/datatables.min.css',
          'assets/plugins/datatable/inc_tablesold.css',
        ],
        'js' => [
          'assets/plugins/datatable/datatables.min.js'
        ]  
    ];
    $this->load->view('Backend/v_home', $data);
        
  }
	//==========================================//

  //==========================================//
  ## AJAX LIST

  public function ajax_list() {

    $getdata = $this->userportal->fetch_datatable_userportal();
    $data = array();
    $no = $_POST['start'];
  
    foreach($getdata as $r) {
      $email = decrypt_url($r->email);
      $email_verify = $r->email_verifikasi === 'Y' ? '<span class="badge bg-green badge-pill"><i class="glyphicon glyphicon-ok"></i></span>' : '<span class="badge bg-red badge-pill"><i class="glyphicon glyphicon-time"></i></span>';
      
      if($r->role == 'EDITOR'):
        $role = '<span class="badge bg-green badge-pill">EDITOR</span>';
      elseif($r->role == 'KONTRIBUTOR'):
        $role = '<span class="badge bg-grey badge-pill">KONTRIBUTOR</span>';
      elseif($r->role == 'MUTASI'):
        $role = '<span class="badge bg-purple badge-pill">MUTASI</span>';
      else:
        $role = '<span class="badge bg-light badge-pill">TAMU</span>';
      endif;

      $sub_array = array();
      $sub_array[] = $r->id_user_portal;
      $sub_array[] = "<img src='".img_blob($r->photo_pic)."' class='img-fluid' width='40'>";
      $sub_array[] = decrypt_url(ucwords($r->nama_lengkap)) . " (".decrypt_url($r->nama_panggilan).")";      
      $sub_array[] = "<a href='mailto:".$email."' target='_blank'>".$email."</a> ".$email_verify;     
      $sub_array[] = decrypt_url($r->nohp);      
      $sub_array[] = longdate_indo($r->tanggal_bergabung);
      $sub_array[] = $role;
      $sub_array[] = '<a href="'.img_blob($r->photo_ktp).'" target="_blank" class="btn btn-sm btn-link waves-effect"><i class="glyphicon glyphicon-new-window"></i></a>';
      $sub_array[] = '<a href="'.img_blob($r->photo_ktp).'" class="btn btn-sm btn-link bg-blue waves-effect"><i class="glyphicon glyphicon-pencil"></i></a>';
      $data[]      = $sub_array;
    $no++;
    }
  
    $output = array(
      'draw'            => intval($_POST['draw']),
      'recordsTotal'    => $this->userportal->get_all_data_userportal(),
      'recordsFiltered' => $this->userportal->get_filtered_data_userportal(),
      'data'            => $data    
    );
  
    echo json_encode($output); 
  }

  //==========================================//

}