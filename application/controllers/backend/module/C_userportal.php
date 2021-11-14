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
      $sub_array[] = decrypt_url($r->nama_lengkap) . " (".decrypt_url($r->nama_panggilan).")";      
      $sub_array[] = $email_verify;     
      $sub_array[] = decrypt_url($r->nohp);      
      $sub_array[] = longdate_indo($r->tanggal_bergabung);
      $sub_array[] = $role;
      $sub_array[] = '<a href="'.img_blob($r->photo_ktp).'" target="_blank" class="btn btn-sm btn-link waves-effect"><i class="glyphicon glyphicon-new-window"></i></a>';
      $sub_array[] = '<a href="'.img_blob($r->photo_ktp).'" class="btn btn-sm btn-link bg-primary waves-effect"><i class="glyphicon glyphicon-pencil"></i></a>';
      $sub_array[] = '<a href="#" id="detailUserportal" data-uid="'.$r->id_user_portal.'" class="btn btn-sm btn-link bg-info waves-effect"><i class="glyphicon glyphicon-eye-open"></i></a>';
      $sub_array[] = '<a href="#" id="deleteUserportal" data-uid="'.$r->id_user_portal.'" class="btn btn-sm btn-link bg-danger waves-effect"><i class="glyphicon glyphicon-trash"></i></a>';
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

  public function hapus()
  {
    $id = $this->input->get('uid');
    $db = $this->userportal->hapus('t_users_portal', ['id_user_portal' => $id]);
    if($db) {
      $valid = true;
    } else {
      $valid = false;
    } 
    echo json_encode($valid);
  }

  public function detail()
  {
    $id = $this->input->post('uid');
    $db = $this->userportal->detail('t_users_portal', ['id_user_portal' => $id]);
    $result = $db->row();
    $pwd = explode("$", $result->password);
    $pwd_show = $pwd[2];
    $template = "
      <table class='table table-responsive table-condensed'>
        <tbody>
          <tr>
            <td><b>Role</b></td>
            <td>{$result->role}</td>
          </tr>
          <tr>
            <td><b>Status</b></td>
            <td>{$result->online}</td>
          </tr>
          <tr>
            <td><b>Email</b></td>
            <td>".decrypt_url($result->email)."</td>
          </tr>
          <tr>
            <td><b>Email Verify</b></td>
            <td>{$result->email_verifikasi}</td>
          </tr>
          <tr>
            <td><b>Token Verify</b></td>
            <td>{$result->token_verifikasi}</td>
          </tr>
          <tr>
            <td class='text-danger'><b>Pwd</b></td>
            <td>".decrypt_url($pwd_show)."</td>
          </tr>
          <tr>
            <td><b>Nama Lengkap</b></td>
            <td>".decrypt_url($result->nama_lengkap)."</td>
          </tr>
          <tr>
            <td><b>Nama Panggilan</b></td>
            <td>".decrypt_url($result->nama_panggilan)."</td>
          </tr>
          <tr>
            <td><b>Deskripsi</b></td>
            <td>{$result->deskripsi}</td>
          </tr>
          <tr>
            <td><b>Deskripsi</b></td>
            <td>{$result->tanggal_lahir}</td>
          </tr>
          <tr>
            <td><b>Alamat</b></td>
            <td>".decrypt_url($result->alamat)."</td>
          </tr>
          <tr>
            <td><b>Pekerjaan</b></td>
            <td>".decrypt_url($result->pekerjaan)."</td>
          </tr>
          <tr>
            <td><b>Pedidikan</b></td>
            <td>".decrypt_url($result->pendidikan)."</td>
          </tr>
        </tbody>
      </table>
    ";
    echo json_encode($template);
  }
  //==========================================//

}