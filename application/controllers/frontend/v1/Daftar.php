<?php defined('BASEPATH') or exit('No direct script access allowed');

class Daftar extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_template_v1/M_f_daftar', 'daftar');
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
        $i = $this->input->post();
        $sess_register = $i['tokenRegister'];
        $validKey = decrypt_url($sess_register);
        $isKey = 'bkppd_balangan@'.date('dmY');
        // var_dump($i);die();
        if($validKey === $isKey) {
                // Get data post
                $tgl_full = $this->input->post('tanggal_lahir');
                $tgl_pecah = explode("/", $tgl_full);
                $tgl_lahir = $tgl_pecah[2].'-'.$tgl_pecah[1].'-'.$tgl_pecah[0];

                $p_name = $this->input->post('nama_lengkap');
                $result_name = str_replace(['hacked','hacker','hack'], ['wkwk','hihi','blee'], $p_name);
                $data = [
                    'nama_lengkap' => encrypt_url($result_name),
                    'nama_panggilan' => encrypt_url($this->input->post('nama_pangilan')),
                    'alamat' => encrypt_url($this->input->post('alamat')),
                    'pekerjaan' => encrypt_url($this->input->post('pekerjaan')),
                    'pendidikan' => encrypt_url($this->input->post('pendidikan')),
                    'nohp' => encrypt_url($this->input->post('nohp')),
                    'tanggal_lahir' => $tgl_lahir,
                    'email' => encrypt_url($this->input->post('email')),
                    'password' => "$".sha1('bkppd_balangan')."$".encrypt_url($this->input->post('password')),
                    'email_verifikasi' => 'N',
                    'tanggal_bergabung' => date('Y-m-d')
                ];
                // Configurasi Email
                // $from_email = 'bkppdbalangan@gmail.com';
                // $to_email = $this->input->post('email');

                // $config = array(
                //         'protocol' => 'smtp',
                //         'smtp_host' => 'ssl://smtp.googlemail.com',
                //         'smtp_port' => 465,
                //         'smtp_user' => $from_email,
                //         'smtp_pass' => 'rembulan123',
                //         'mailtype' => 'html',
                //         'charset' => 'iso-8859-1',
                // );

                // $this->load->library('email', $config);
                // $this->email->set_newline("\r\n");

                // $this->email->from($from_email, 'BKPPD Kab. Balangan'); 
                // $this->email->to($to_email);
                // $this->email->subject('Email Verification!');

                // $message = '<p> Dear ' . decrypt_url($data['nama_lengkap']).',</p>';
                // $message .= '<p> Konfirmasi email kamu untuk mengakses fitur dari web sites kami.  <a class="btn btn-warning" target="_blank" href="' . base_url().'frontend/v1/users/verify/'.$data['nohp'].'">Klik Disini</a></p>';
                // $message .= '<p> Terimakasih. </p>';
                
                // $this->email->message($message); 
                
                //Send mail 
                $db = $this->daftar->send_akun('t_users_portal', $this->security->xss_clean($data));
                if($db){
                    // Message success regitered
                    $msg = ['valid' => true, 'msg' => 'Akun telah diproses'];
                    $msg = array('valid' => true, 'msg' => 'Register berhasil, silahkan validasi identitas anda!', 'data' => $data, 'redirect' => base_url('register-status'));
                    $this->session->set_flashdata('msg', $msg);
                    
                    $img_pic = base_url('assets/images/no-profile-picture.jpg');
                    $img_ktp = base_url('assets/images/noimage.gif');

                    $photo_pic = @file_get_contents($img_pic);
                    $photo_ktp = @file_get_contents($img_ktp);

                    $data_indentity = [
                            'photo_pic' => $photo_pic,
                            'photo_ktp' => $photo_ktp,
                        ];
                    $whr = [
                        'email' => encrypt_url($this->input->post('email'))
                    ];
                    $this->daftar->update_akun('t_users_portal', $data_indentity, $whr);
                } else {
                    $msg = ['valid' => false, 'msg' => 'Galat, terjadi kesalahan saat pengiriman data'];
                    $this->session->set_flashdata('msg', $msg);
                } 
        } else {
            $msg = array('valid' => false, 'msg' => 'Register is invalid');
            $this->session->set_flashdata('msg', $msg);
        }
        echo json_encode($msg);
    }

    public function register_update()
    {
        $id = $this->input->post('emailId');
        if(!empty($id)):
            $photo_pic = file_get_contents($_FILES['photo_pic']['tmp_name']);
            $photo_ktp = file_get_contents($_FILES['photo_ktp']['tmp_name']);
            $data = [
                    'photo_pic' => $photo_pic,
                    'photo_ktp' => $photo_ktp,
                ];
            $whr = [
                'email' => $id
            ];
            $db = $this->daftar->update_akun('t_users_portal', $data, $whr);
            if($db):
                $msg = ['valid' => true, 'msg' => 'Success Updated', 'redirect' => base_url('login_web?msg=sukses')];
            else:
                $msg = ['valid' => false, 'msg' => 'Gagal Updated, silahkan upload ulang'];
            endif;
            echo json_encode($msg);
        endif;
    }

    public function register_status()
    {
        $data = [
            'mf_beranda' => $this->mf_beranda->get_identitas(),
        ];
        $this->load->view('Frontend/v1/pages/f_daftar_status', $data);
    }
}

    /* End of file  Frontend\v1\Daftar.php.php */
