<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Halaman extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    //Do your magic here
    $this->load->model('M_f_users','users');
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
  
  public function survey() {
    $data = [
      'title' => 'BKPPD | Kotak Survey Kepuasan',
      'mf_beranda' => $this->mf_beranda->get_identitas()
    ];

    $this->load->view('Frontend/v1/pages/h_survey', $data);
  }

  public function saran() {
    $data = [
      'title' => 'BKPPD | Kotak Saran',
      'isi'  => 'Frontend/v1/pages/h_saran',
      'mf_beranda' => $this->mf_beranda->get_identitas(),
      'mf_menu' => $this->mf_beranda->get_menu()
    ];

    $this->load->view('Frontend/v1/layout/wrapper', $data, FALSE);
  }

  public function saran_status() {
    $data = [
      'title' => 'BKPPD | Kotak Saran',
      'isi'  => 'Frontend/v1/pages/h_saran_status',
      'mf_beranda' => $this->mf_beranda->get_identitas(),
      'mf_menu' => $this->mf_beranda->get_menu()
    ];

    $this->load->view('Frontend/v1/layout/wrapper', $data, FALSE);
  }

  public function simpan_saran() {
    $captcha = $this->input->post('captcha');
    $sess_captcha = $this->session->userdata('captcha');  
    $sess_validity = $this->session->userdata('captcha')[0] + $this->session->userdata('captcha')[1];

    if (isset($captcha) && isset($sess_captcha)):
      
      $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required|min_length[3]', ['required' => '{field} wajib diisi', 'min_length' => '{field} minimal 3 karakter']);
      $this->form_validation->set_rules('isi_saran', 'Isi Saran', 'required', ['required' => '{field} wajib diisi']);
      $this->form_validation->set_rules('captcha', 'Pertanyaan Keamanan', 'required', ['required' => '{field} dijawab']);

      if($this->form_validation->run() == FALSE):
        $this->form_validation->set_error_delimiters('<div class="text-danger my-1 py-1">', '</div>');
        return $this->saran();
      else:
        if($captcha == $sess_validity):
          $data = [
            'nama_lengkap' => $this->input->post('nama_lengkap'),
            'email' => $this->input->post('email'),
            'isi_saran' => $this->input->post('isi_saran'),
            'tgl_kirim' => date('Y-m-d h:i:s')
          ];
          // var_dump($data);
          $db = $this->halaman->simpan_saran('public_saran', $data);
          if($db) {
            $this->session->set_flashdata('msg', true);
          } else {
            $this->session->set_flashdata('msg', false);
          }
          redirect(base_url('frontend/v1/halaman/saran_status'));
        else:
          $this->session->set_flashdata('captcha_salah', '<b>Error</b>, jawaban keamanan salah, coba ulangi lagi.');
          redirect(base_url('frontend/v1/halaman/saran'));
        endif;
      endif;
    endif;
  }
}

/* End of file Halaman.php */
/* Location: ./application/controllers/frontend/v1/Halaman.php */