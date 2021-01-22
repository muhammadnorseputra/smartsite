<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Halaman extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    //Do your magic here
    $this->load->model('model_template_v1/M_f_halaman', 'halaman');
    //Check maintenance website
    if(($this->session->userdata('status') == 'ONLINE') && ($this->mf_beranda->get_identitas()->status_maintenance == '1') || ($this->mf_beranda->get_identitas()->status_maintenance == '0')) {
          // redirect(base_url('frontend/v1/beranda'),'refresh');
      } else {
          redirect(base_url('theme/maintenance_site'),'refresh');
      }
  }
  public function index()
  {
  }
  public function statis($token_halaman, $judul)
  {
    $data = [
      'title' => 'BKPPD Kab. Balangan, ' . $this->halaman->get_namahalaman($token_halaman),
      'isi'  => 'Frontend/v1/pages/h_statis',
      'uri_token_halaman' => $token_halaman,
      'mf_beranda' => $this->mf_beranda->get_identitas(),
      'mf_menu' => $this->mf_beranda->get_menu(),
      'detail' => $this->halaman->get_detail_halaman($token_halaman)
    ];

    $this->load->view('Frontend/v1/layout/wrapper', $data, FALSE);
  }

  public function halamanstatis($type)
  {

    if($type == 'add'):
      $data = [
        'title' => 'Buat Halaman Baru',
        'isi'  => 'Frontend/v1/pages/h_statis_baru',
        'mf_beranda' => $this->mf_beranda->get_identitas(),
        'mf_menu' => $this->mf_beranda->get_menu(),
      ];
    else :
      $token = $_GET['token'];
      $data = [
        'title' => 'Halaman: '.$this->halaman->get_namahalaman($token),
        'isi'  => 'Frontend/v1/pages/h_statis_edit',
        'mf_beranda' => $this->mf_beranda->get_identitas(),
        'mf_menu' => $this->mf_beranda->get_menu(),
        'h' => $this->halaman->get_detail_halaman($token)->row()
      ];
    endif;

    $this->load->view('Frontend/v1/layout/wrapper', $data, FALSE);
  }
  
  public function doAdd()
  {
    $title = $this->input->post('title');
    $filename  = $_FILES['lampiran']['name'];
    $isi   = $this->input->post('content');
    $token    = mt_rand(100000000,999999999);

    if(!empty($filename)) 
    {
      $file  = file_get_contents($_FILES['lampiran']['tmp_name']);
      $data = [
        'fid_users_portal' => $this->session->userdata('user_portal_log')['id'],
        'token_halaman' => $token,
        'tgl_created' => date('Y-m-d'),
        'title' => $title,
        'content' => $isi,
        'filename' => $filename,
        'file' => $file,
        'publish' => 'Y' 
      ];
    } else {
      $data = [
        'fid_users_portal' => $this->session->userdata('user_portal_log')['id'],
        'token_halaman' => $token,
        'tgl_created' => date('Y-m-d'),
        'title' => $title,
        'content' => $isi,
        'publish' => 'Y' 
      ];
    }

    $db = $this->halaman->doAdd('t_halaman', $data);

    if($db == true)
    {
      $msg = ['valid' => true];
    } else {
      $msg = ['valid' => false];
    }
    echo json_encode($msg);
  }

  public function update($token)
  {
    $title = $this->input->post('title');
    $filename  = $_FILES['lampiran']['name'];
    $isi   = $this->input->post('content');
    $etoken    = $this->input->post('etoken');
    $newtoken    = mt_rand(100000000,999999999);
    
    if($etoken == 'on')
    {
      $token_halaman = $newtoken;
      if(!empty($_FILES['lampiran']['tmp_name']) 
       && file_exists($_FILES['lampiran']['tmp_name'])) {
        $file  = file_get_contents($_FILES['lampiran']['tmp_name']);
        $data = [
          'token_halaman' => $newtoken,
          'title' => $title,
          'content' => $isi,
          'filename' => $filename,
          'file' => $file,
          'publish' => 'Y' 
        ];
      } else {
        $data = [
          'token_halaman' => $newtoken,
          'title' => $title,
          'content' => $isi,
          'publish' => 'Y' 
        ];
      }
      
    } else {
      $token_halaman = intval($token);
      if(!empty($_FILES['lampiran']['tmp_name']) 
       && file_exists($_FILES['lampiran']['tmp_name'])) {
        $file  = file_get_contents($_FILES['lampiran']['tmp_name']);
        $data = [
          'title' => $title,
          'content' => $isi,
          'filename' => $filename,
          'file' => $file,
          'publish' => 'Y' 
        ];
      } else {
        $data = [
          'title' => $title,
          'content' => $isi,
          'publish' => 'Y' 
        ];
      }
      
    }

    $db = $this->halaman->doUpdate('t_halaman', $data, $token);

    if($db)
    {
      $msg = $token_halaman;
    } else {
      $msg = false;
    }
    echo json_encode($msg);
  }
  
  public function deleteHalaman()
  {
    $table = 't_halaman';
    $id = $this->input->post('id');
    $delete = $this->halaman->doDeleteHalaman($table, $id);

    if ($delete == true) {
      $msg = ['valid' => true];
    } else {
      $msg = ['valid' => false];
    }
    echo json_encode($msg);
  }
}

/* End of file Banner.php */
/* Location: ./application/controllers/frontend/v1/Banner.php */