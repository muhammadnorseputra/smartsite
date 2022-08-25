<?php defined('BASEPATH') or exit('No direct script access allowed');

class C_admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_b_admin', 'madmin');
        _is_logged_in();
    }

    /* -------------------------------------------------------------------------- */
    /*                           HALAMAN DASBOARD ADMIN                           */
    /* -------------------------------------------------------------------------- */

    public function index()
    {
        $data = [
                'content'  => 'Backend/v_dasboard',
                'scriptjs' => 'Backend/__ServerSideJs/Dasboard/s_dasboard',
                'pageinfo' => '<li class="active">Dasboard</li>',
                'js'       => [
                'assets/plugins/jquery-countto/jquery.countTo.js',
                'assets/js/pages/widgets/infobox/count.js',
                ],
        ];
        $this->load->view('Backend/v_home', $data);
        
    }

    /* -------------------------------------------------------------------------- */

    /* -------------------------------------------------------------------------- */
    /*                          PROSES UPDATE SKIN / TEMA                         */
    /* -------------------------------------------------------------------------- */

    public function update_skin()
    {
        $id  = $this->input->get('idskin');
        
        $whr = array('idskin' => $id);
        $data = array(
            'aktif' => 'Y',
        );
        $oke = $this->madmin->updateskin($whr, $data, 't_skin');
        echo json_encode($oke);
    }

    /* -------------------------------------------------------------------------- */

    /* -------------------------------------------------------------------------- */
    /*             PROSES UPDATE SKIN TERPILIH / YANG SUDAH DIGUNAKAN             */
    /* -------------------------------------------------------------------------- */

    public function update_skin_n()
    {
        $id = $this->input->get('idskin_now');
        $whr = array('idskin' => $id);
        $data = array(
            'aktif' => 'N',
        );
        $oke = $this->madmin->updateskin_n($whr, $data, 't_skin');
        echo json_encode($oke);
    }

    /* -------------------------------------------------------------------------- */

    /* -------------------------------------------------------------------------- */
    /*                           HALAMAN UPDATE PROFILE                           */
    /* -------------------------------------------------------------------------- */

    public function profile()
    {
        $data = [
            'content' => 'Backend/v_profile',
            'pagainfo' => '<li class="active"><a href="admin"><i class="material-icons">dashboard</i> Dasboard</a></li> <li class="active"><i class="material-icons">person</i> Profile</li>',
        ];

        $this->load->view('Backend/v_home', $data);
    }

    /* -------------------------------------------------------------------------- */

    /* -------------------------------------------------------------------------- */
    /*                            HALAMAN LIAT PROFILE                            */
    /* -------------------------------------------------------------------------- */

    public function viewprofile()
    {
        $id = $this->input->get('userkey');
        $whr = array('id_user' => $id);
        $data = $this->madmin->get_v_user('t_users', $whr)->result();
        echo json_encode($data);
    }

    /* -------------------------------------------------------------------------- */

    /* -------------------------------------------------------------------------- */
    /*                            PROSES GANTI PASSWORD                           */
    /* -------------------------------------------------------------------------- */

    public function gantipass()
    {
        $pass = $this->input->post('pass');
        $key = sha1('27mei1999');
        $strong_key = md5($key);

        $val = array('password' => $strong_key.md5($pass));
        $whr = array('id_user' => $this->session->userdata('userkey'));
        if (count($whr) > 0) {
            $msg['type'] = 'success';
            $this->madmin->updatepass('t_users', $whr, $val);
        } else {
            $msg['type'] = 'error';
        }

        $responses = [
            'result' => $msg,
        ];
        echo json_encode($responses);
    }

    /* -------------------------------------------------------------------------- */

    /* -------------------------------------------------------------------------- */
    /*                            PROSES UPDATE PROFILE                           */
    /* -------------------------------------------------------------------------- */

    public function updateprofile()
    {
        $surname     = $this->input->post('NameSurname');
        $mail        = $this->input->post('Email');
        $user        = $this->input->post('Username');
        $user_access = generateRandomString(10);
        $val         = array('user_access' 
                            => $user_access, 'nama_lengkap' 
                            => $surname, 'email' 
                            => $mail, 'username' 
                            => $user
                        );
        $whr         = array('id_user' => $this->session->userdata('userkey'));
        $modses      = $this->madmin->updateprofileuser('t_users', $whr, $val);
        $responses   = [
            'result' => $modses,
            'surname' => $surname,
        ];
        echo json_encode($responses);
    }

    /* -------------------------------------------------------------------------- */

    /* -------------------------------------------------------------------------- */
    /*            APABILA MODULE TIDAK DITEMUKAN ATAU TIDAK DIBERI IJIN           */
    /* -------------------------------------------------------------------------- */

    public function module_not_found()
    {
        $data = [
            'content'  => 'Backend/v_module_404',
            'scriptjs' => 'Backend/__ServerSideJs/Dasboard/s_dasboard',
            'pageinfo' => '<li class="active"><a href="admin"><i class="material-icons">dashboard</i> Dasboard</a></li> <li class="active"><i class="material-icons">apps</i> Module 404</li>',
        ];

        $this->load->view('Backend/v_home', $data);
    }

    /* -------------------------------------------------------------------------- */

    /* -------------------------------------------------------------------------- */
    /*               HALAMAN DIPRIVASI OLEH ADMIN DILARANG MENGAKSES              */
    /* -------------------------------------------------------------------------- */

    public function dilarang_akses()
    {
        $data = [
            'content'  => 'Backend/v_dilarang_akses',
            'scriptjs' => 'Backend/__ServerSideJs/Dasboard/s_dasboard',
            'pageinfo' => '<li class="active"><a href="admin"><i class="material-icons">dashboard</i> Dasboard</a></li> <li class="active"><i class="material-icons">apps</i> Dilarang Akses Halaman 404</li>',
        ];

        $this->load->view('Backend/v_home', $data);
    }

    /* -------------------------------------------------------------------------- */
}
