<?php defined('BASEPATH') or exit('No direct script access allowed');

class Daftar extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_template_v1/M_f_daftar', 'daftar');
        $this->load->helper('blob');
        //Check maintenance website
        if(($this->session->userdata('status') == 'ONLINE') && ($this->mf_beranda->get_identitas()->status_maintenance == '1') || ($this->mf_beranda->get_identitas()->status_maintenance == '0')) {
            // redirect(base_url('frontend/v1/beranda'),'refresh');
        } else {
            redirect(base_url('under-construction'),'refresh');
        }
    }

    public function index()
    {
        $data = [
            'mf_beranda' => $this->mf_beranda->get_identitas(),
        ];
        $this->load->view('Frontend/v1/pages/f_daftar', $data, false);
    }

    public function check_email()
    {
        $post = encrypt_url($this->input->post('email'));
        if (isset($post)) {
            $q = $this->daftar->check_email($post);
            if (($q == $post) && (!empty($q))) {
                // User name is registered on another account
                $response = array('valid' => false, 'message' => 'This email is already registered.');
            } else {
                // User name is available
                $response = array('valid' => true, 'message' => 'This email Oke.');
            }
            echo json_encode($response);
            // var_dump($q);
        }
    }

    public function send()
    {
        $captcha = $this->input->post('captcha');
        $sess_captcha = $this->session->userdata('captcha');
        $sess_register = $this->input->post('session_register');
        if (isset($captcha)
            && isset($sess_captcha)
            && isset($sess_register)
            && ('bkppd_balangan'.date('d') == decrypt_url($sess_register))
        ) {
            if ($captcha != ($sess_captcha[0] + $sess_captcha[1])) {
                $msg = array('valid' => false, 'msg' => 'Invalid captcha answer');
                $this->session->set_flashdata('msg', $msg);
            // client does not have javascript enabled
            } else {
                // Save photo pic
                // $namafile = $this->input->post('nama_pangilan');
                // $config['upload_path']          = './assets/images/users/';
                // $config['allowed_types']        = 'jpg|jpeg|png';
                // $config['file_ext_tolower'] = true;
                // $config['file_name'] = strtolower($namafile); //nama yang terupload
                // $this->load->library('upload', $config);

                // Get data post
                $photo_pic = file_get_contents($_FILES['photo_pic']['tmp_name']);
                $photo_ktp = file_get_contents($_FILES['photo_ktp']['tmp_name']);

                $tgl_full = $this->input->post('tanggal_lahir');
                $tgl_pecah = explode("/", $tgl_full);
                $tgl_lahir = $tgl_pecah[2].'-'.$tgl_pecah[1].'-'.$tgl_pecah[0];

                $data = [
                    'nama_lengkap' => encrypt_url($this->input->post('nama_lengkap')),
                    'nama_panggilan' => encrypt_url($this->input->post('nama_pangilan')),
                    'alamat' => encrypt_url($this->input->post('alamat')),
                    'pekerjaan' => encrypt_url($this->input->post('pekerjaan')),
                    'pendidikan' => encrypt_url($this->input->post('pendidikan')),
                    'nohp' => encrypt_url($this->input->post('nohp')),
                    'tanggal_lahir' => $tgl_lahir,
                    'email' => encrypt_url($this->input->post('email')),
                    'password' => "$".sha1('bkppd_balangan')."$".encrypt_url($this->input->post('password')),
                    'email_verifikasi' => 'N',
                    'photo_pic' => $photo_pic,
                    'photo_ktp' => $photo_ktp,
                    'tanggal_bergabung' => date('Y-m-d')
                ];
                // Configurasi Email
                $from_email = 'muhammadnorseputra@gmail.com';
                $to_email = $this->input->post('email');

                $config = array(
                        'protocol' => 'smtp',
                        'smtp_host' => 'ssl://smtp.gmail.com',
                        'smtp_port' => 465,
                        'smtp_user' => $from_email,
                        'smtp_pass' => '@putrabungsu6',
                        'mailtype' => 'html',
                        'charset' => 'iso-8859-1',
                );

                $this->load->library('email', $config);
                $this->email->set_newline("\r\n");

                $this->email->from($from_email, 'BKPPD Kab. Balangan'); 
                $this->email->to($to_email);
                $this->email->subject('Email Verification!');

                $message = '<p> Dear ' . decrypt_url($data['nama_lengkap']).',</p>';
                $message .= '<p> Konfirmasi email kamu untuk mengakses fitur dari web sites kami.  <a class="btn btn-warning" target="_blank" href="' . base_url().'frontend/v1/users/verify/'.$data['nohp'].'">Klik Disini</a></p>';
                $message .= '<p> Terimakasih. </p>';
                
                $this->email->message($message); 
                
                //Send mail 
                $this->daftar->send_akun('t_users_portal', $data);
                if($this->email->send()){
                    $this->session->set_flashdata("notif","Akun kamu telah aktif, untuk mendapatkan fitur lengkap kami silahakan verifikasi email kamu."); 
                    // daftarkan akun ke database
                    // Simpan gambar di website
                    // if ( ! $this->upload->do_upload('photo_pic')){
                    //     $msg = $this->upload->display_errors();
                    // }else{
                    //     $this->upload->data();
                    // }
                    // $this->session->set_flashdata('photo_msg', $msg);
                }else {
                    $this->session->set_flashdata("notif","Akun kamu telah aktif, untuk mendapatkan fitur kami silahakan verifikasi email kamu.");  
                } 
                // Message success regitered
                $msg = array('valid' => true, 'msg' => 'Register Berhasil', 'data' => $data);
                $this->session->set_flashdata('msg', $msg);
            }
        } else {
            $msg = array('valid' => false, 'msg' => 'Register is invalid');
            $this->session->set_flashdata('msg', $msg);
        }
        redirect(base_url('frontend/v1/daftar/register_status'));
    }

    public function register_status()
    {
        $data = [
            'title' => 'Portal | Status Registered',
            'mf_beranda' => $this->mf_beranda->get_identitas(),
        ];
        $this->load->view('Frontend/v1/pages/reg_status', $data, false);
    }
}

    /* End of file  Frontend\v1\Daftar.php.php */
