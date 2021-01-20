<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_users extends CI_Controller {
	public function __construct() 
	{
    parent::__construct();
		$this->load->model('M_b_users', 'musers');
    _is_logged_in();
  }

  //==========================================//
  ## Halaman Users 
	public function index()
	{

		$data = [
				'content' => 'Backend/__Module/___Users/v_users',
				'scriptjs' => 'Backend/__ServerSideJs/Users/s_users',
        'pageinfo' => '<li>
                         Dasboard
                      </li>
                      <li class="active">
                         Manajemen Users
                      </li>',
				'css' => [
					'assets/plugins/datatable/datatables.min.css',
					'assets/plugins/datatable/inc_tablesold.css',
          'assets/plugins/multi-select/css/multi-select.css'
				],
				'js' => [
					'assets/plugins/datatable/datatables.min.js',
          'assets/plugins/multi-select/js/jquery.multi-select.js',
          'assets/plugins/multi-select/js/jquery.quicksearch.js'
				]
    ];
		$this->load->view('Backend/v_home', $data);
		
  }
  //==========================================//

  
  //==========================================//
  ## VIEW TABLE
	public function users_table() {
		$resouce = 'Backend/__module/___Users/v_table';
		$this->load->view($resouce);
	}
  //==========================================//
  
  //==========================================//
  ## VIEW ADD
	public function users_add() {
    $resouce = 'Backend/__module/___Users/v_add';
    $data['module'] = $this->musers->getmodule('t_module');
		$this->load->view($resouce, $data);
	}
  //==========================================//
  
  //==========================================//
  ## EDIT USER MODULE
	public function edit_user_module($id) {
    $resouce = 'Backend/__module/___Users/v_module_user';
    $data['module'] = $this->musers->getmodule('t_module');
    $data['users']  = $this->musers->getusers('t_users', $id);
    $data['token']  =  $this->madmin->getmodule('MANAJEMEN USER');
		$this->load->view($resouce, $data);
	}
  //==========================================//
  
  //==========================================//
  ## EDIT USER
	public function edit_user() {
    $id = $this->input->get('id');
    $data = [
      'content' => 'Backend/__Module/___Users/v_edit',
      'scriptjs' => 'Backend/__ServerSideJs/Users/s_users',
      'pageinfo' => '<li>
                      <a href="#"><i class="material-icons">dashboard</i> Dasboard</a>
                    </li><li class="active">Manajemen Users</li><li class="active">Edit User</li>',
      'id' => $id,
      'x' => $this->musers->getuserbyid($id)
  ];
  $this->load->view('Backend/v_home', $data);
	}
  //==========================================//  
  
  //==========================================//
  ## PROSES UPDATE USER
	public function proses_update_users() {
    $id = $this->input->post('id');
    $nama_lengkap =$this->input->post('nama_lengkap');
    $email =$this->input->post('email');
    $level =$this->input->post('level');
    $aktif =$this->input->post('aktif');
    $fileName   = $_FILES['gravatar']['name'];

    $files = strtolower($this->input->post('username')).'.'.pathinfo($fileName, PATHINFO_EXTENSION);
		//init library upload
		$config['upload_path']      = './assets/images/users/';
		$config['allowed_types']    = 'jpg|jpeg|png';
		$config['max_size'] 				= '5120'; //maksimum besar file 5M
		// $config['max_width'] 				= '1024';
		// $config['max_height'] 			= '768';
		$config['overwrite']				= true;
		$config['file_ext_tolower'] = true;
		$config['file_name'] 				= $files; //nama yang terupload nantinya

    $this->load->library('upload', $config);
   
      if (!$this->upload->do_upload('gravatar')) {
        $this->session->set_flashdata(array('message' => $this->upload->display_errors(), 'class' => 'alert alert-danger'));
        $val = [
          'nama_lengkap' => $nama_lengkap,
          'email' => $email,
          'level' => $level,
          'aktif' => $aktif
        ];
    
        $whr = [
          'id_user' => $id
        ];
        // $this->session->set_flashdata(array('message' => '<strong>Success</strong> User updated!', 'class' => 'alert alert-success'));
        echo "Checking update akun ...<script>window.history.back(-1); </script>";
        $this->musers->proses_update_users('t_users',$whr,$val);
      } else {
        
          // if (file_exists('./assets/images/users/'.$files)) {
          //   unlink('./assets/images/users/'.$files);
          // }
          $val = [
            'nama_lengkap' => $nama_lengkap,
            'email' => $email,
            'level' => $level,
            'aktif' => $aktif,
            'gravatar' => strtolower($this->upload->data('file_name'))
          ];
      
          $whr = [
            'id_user' => $id
          ];
          
        $this->musers->proses_update_users('t_users',$whr,$val);
        $this->session->set_flashdata(array('message' => '<strong>Success</strong> User updated!', 'class' => 'alert alert-success'));
        redirect(base_url('backend/module/c_users?module='.$this->madmin->getmodule('MANAJEMEN USER').'&user='.$this->session->userdata('user_access')));
    }	

	}
	//==========================================//  

  //==========================================//
  ## AJAX LIST USERS

  public function ajax_list() {

    $getdata = $this->musers->fetch_datatable_users();
    
    $data = array();
  
    foreach($getdata as $r) {
  
    $date_login = substr($r->sesi_login,0,10);
    $time_login = substr($r->sesi_login,11,5);
    $login = longdate_indo($date_login);

    $date_logout = substr($r->sesi_logout,0,10);
    $time_logout = substr($r->sesi_logout,11,5);
    $logout = longdate_indo($date_logout);

    if($r->status == 'ONLINE') {
      $status = '<span class="badge bg-teal">Online</span>';
      $session = '<b class="badge bg-grey m-t-5 ">'.$login." - ".$time_login.'</b>';
    } else {
      $status = '<span class="badge bg-red">Offline</span>';
      $session = '<b class="badge bg-grey m-t-5">'.$logout." - ".$time_logout.'</b>';
    }

    if($r->aktif == 'Y') {
      $aktif = '<i class="material-icons col-teal">offline_pin</i>';
    } else {
      $aktif = '<i class="material-icons col-grey">remove_circle</i>';
    }

    $sub_array = array();
      $sub_array[] = "<img width='60' src='".base_url('assets/images/users/'.$r->gravatar)."'>";
      $sub_array[] = "<b class='font-12'>".strtoupper($r->nama_lengkap)."</b><br>".$status.'<b class="m-l-5 badge bg-green">'.$r->level.'</b> <b class="m-l-5 badge bg-cyan">'.$r->username.'</b><div class="clearfix"></div>'.$session;
			$sub_array[] = "<a href='mailto:".$r->email."'>".$r->email."</a>";
			$sub_array[] = $aktif;				
			$sub_array[] = "<a href='#' class='btn btn-link btn-sm waves-effect waves-float' id='user_module' data-id='".$r->id_user."'><i class='material-icons'>extension</i> <br>Pilih hakakses</a>";			
			$sub_array[] = '
                          <button type="button" id="btn-edit" data-id="'.$r->id_user.'"  class="btn btn-sm btn-link waves-effect"><span aria-hidden="true" class="glyphicon glyphicon-pencil m-r-5"></span> EDIT</button>
                          <button type="button" id="btn-delete" 
                          data-id="'.  $r->id_user .'" 
                          data-title="'. $r->nama_lengkap .'" 
                          data-gravatar="'.$r->gravatar.'" class="btn btn-sm btn-link waves-effect"><span aria-hidden="true" class="glyphicon glyphicon-trash col-red m-r-5"></span>  HAPUS</button>
                          <button type="button" id="btn-reset-password" data-user="'.$r->nama_lengkap.'" data-id="'.$r->id_user.'"  class="btn btn-sm btn-link waves-effect"><span aria-hidden="true" class="glyphicon glyphicon-lock col-black"></span></button>
                      ';
      $data[] 		 = $sub_array;

    }
  
    $output = array(
      'draw'  		  		=> intval($_POST['draw']),
      'recordsTotal' 	  => $this->musers->get_all_data_users(),
      'recordsFiltered' => $this->musers->get_filtered_data_users(),
      'data'			  		=> $data			
    );
  
    echo json_encode($output); 
  }
	//==========================================//
  
  //==========================================//
  ## Proses Tambah User
  public function add() {
    $fileName   = $_FILES['gravatar']['name'];
    $token      = $this->input->post('fid_token[]');
    $fid_token  = implode(',', $token);
    $nama_lenkap = $this->input->post('nama_lengkap', true);
    $username    = $this->input->post('username', true);
    
    $key = do_hash('27mei1999');
    $strong_key = do_hash($key, 'md5');
    $password   = $strong_key.md5($this->input->post('password'));

    $level     = $this->input->post('level');
    $email     = $this->input->post('email');
    $aktif     = $this->input->post('aktif');


		$files = strtolower($this->input->post('username')).'.'.pathinfo($fileName, PATHINFO_EXTENSION);
		//init library upload
		$config['upload_path']      = './assets/images/users/';
		$config['allowed_types']    = 'jpg|jpeg|png';
		$config['max_size'] 				= '5120'; //maksimum besar file 5M
		// $config['max_width'] 				= '1024';
		// $config['max_height'] 			= '768';
		$config['overwrite']				= true;
		$config['file_ext_tolower'] = true;
		$config['file_name'] 				= $files; //nama yang terupload nantinya

		$this->load->library('upload', $config);
		if (!$this->upload->do_upload('gravatar')) {
			$msg = array('error' => $this->upload->display_errors(), 'request' => 'false');
		} else {
				// if (file_exists('./assets/images/users/'.$files)) {
				// 	unlink('./assets/images/users/'.$files);
				// }
				$values = [
					'user_access' => generateRandomString(),
					'fid_token' => $fid_token,
					'nama_lengkap' => $nama_lenkap,
					'status' => 'OFFLINE',
					'username' => $username,
					'password' => $password,
					'gravatar' => strtolower($this->upload->data('file_name')),
					'level' => $level,
					'email' => $email,
					'aktif' => $aktif
				];
				$this->musers->add('t_users', $values);
				$msg = array(
					'request' => true, 
					'content' => 'Selamat Kepada <b>'.$nama_lenkap.'</b> Telah Terdaftar Disistem :)'
				);
		}	
		
		echo json_encode($msg);
  }

  //==========================================//
  ## Hapus User 
	public function hapus_user_list() {
    $id       = $this->input->post('id'); 
    $nama     = $this->input->post('nama'); 
    $gravatar = $this->input->post('gravatar');

		$tbl = 't_users';
		$where = [
			'id_user' => $id
		];

		$path = './assets/images/users/';
		if(file_exists($path.$gravatar)) {
			unlink($path.$gravatar);
			$this->musers->hapus_user($tbl,$where);
			$msg = ['type' => 'green', 'content' => 'Success Deleted <b>'.$nama.'</b>', 'request' => true];
		} else {
			$msg = ['type' => 'red', 'content' => 'Error Deleted', 'request' => false];
		}
		$json = json_encode($msg);
		echo $json;		
  }
  //==========================================//

  //==========================================//
  ## Reset Password 
  public function reset_password($id) {
    $new_pass = $this->input->post('new_pass', true);
    
    $key = do_hash('27mei1999');
    $strong_key = do_hash($key, 'md5');

    $val = [
      'password' => $strong_key.md5($new_pass)
    ];

    $whr = [
      'id_user' => $id
    ];

    $send = $this->musers->update_password('t_users',$val,$whr);
    if($send == false) {
      $msg['msg'] = array('title' => 'Success', 'content' => 'Password telah di reset.', 'type' => 'success');
    } else {
      $msg['msg'] = array('title' => 'Gagal', 'content' => 'Error reset password.', 'type' => 'error');
    }
    echo json_encode($msg);
  }
  //==========================================//

  public function get_user() {
    $id = $this->input->get('id');
    $getdata = $this->db->get_where('t_users', array('id_user' => $id))->result();
    echo json_encode($getdata);
  }

  public function update_module_user() {
    $id = $this->input->post('id_user');
    $token      = $this->input->post('fid_token[]');
    $fid_token  = implode(',', $token);
    
    $mod = $this->input->post('modules');
    $user = $this->session->userdata('user_access');

    $value = [
      'fid_token' => $fid_token
    ];

    $whr   = [
      'id_user' => $id
    ];

    $send = $this->musers->update_module_user($whr, $value);
    if($send == false) {
      $this->session->set_flashdata(array('message' => '<strong>Success!</strong> Hak akses user updated', 'class' => 'alert alert-success'));
      redirect(base_url('module/c_users?module='.$mod.'&user='.$user));
    } else {
      $this->session->set_flashdata(array('message' => '<strong>Gagal!</strong> Not Updated', 'class' => 'alert alert-danger'));
      redirect(base_url('module/c_users?module='.$mod.'&user='.$user));
    }
    
  }
	
}