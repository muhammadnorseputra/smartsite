<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('mlogin', 'ml');
        $this->load->model('M_b_admin', 'madmin');
        $this->load->library('user_agent');
        $this->dashboard = $this->madmin->getmodule('DASHBOARD');
    }
    // $ip = $this->input->ip_address();
        function get_client_ip()
        {
            if (!empty($_SERVER['HTTP_CLIENT_IP'])) {   //check ip from share internet
                $ip = $_SERVER['HTTP_CLIENT_IP'];
            } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {   //to check ip is pass from proxy
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            } else {
                $ip = $_SERVER['REMOTE_ADDR'];
            }

            return $ip;
        }

    public function index()
    {
        
        $ip = $this->get_client_ip();
        $os = $this->agent->platform();
        $token = sha1($ip);
        $cek = $this->madmin->cekakses($token, $ip);

        if ($cek == true) {
            if($this->session->userdata('userkey') != null) {
               $user = $this->session->userdata('user_access');
               return redirect(base_url('backend/c_admin?module='.$this->dashboard.'&user='.$user));
            }
            redirect(base_url('login/v2/'.sha1($ip).'/'.$ip.'/'.$os.'?message=sign-in'));
        } else {
            $this->session->set_flashdata('error', 'access denied for user');
            redirect(base_url('adminpanel'));
        }
    }

    public function v2($token, $ip, $os)
    {
        $cek = $this->madmin->cekakses($this->uri->segment(3), $this->uri->segment(4));
        $data = array(
            'titlebar' => 'Login | Administrator Page',
            'title' => '<b>BKPSDM</b>.v2',
            'tagline' => 'SISTEM INFORMASI BKPSDM KAB. BALANGAN '.date('Y').'',
            'lastlogon' => $this->ml->last_logon()->result(),
            'autoload_css' => array(
                'assets/css/fonts.css',
                'assets/css/icon.css',
                'assets/plugins/bootstrap/css/bootstrap.min.css',							
                'assets/plugins/node-waves/waves.css',												
                'assets/plugins/waitme/waitMe.css',
                'assets/plugins/animate-css/animate.css',											                
                'assets/plugins/mprogres/css/mprogress.min.css',
                'assets/plugins/particles/particles.css',
                'assets/plugins/pace/themes/green/pace-theme-center-simple.css',
                'assets/css/style.css'
            ),
            'autoload_javascript' => array(
                'assets/plugins/jquery/jquery.min.js', 												// Jquery Core Js
                'assets/plugins/bootstrap/js/bootstrap.js',
                'assets/plugins/focusable/focus-element-overlay.min.js', 									// Bootstrap Core Js
                'assets/plugins/node-waves/waves.js', 												// Waves Effect Plugin Js
                'assets/plugins/bootstrap-notify/bootstrap-notify.js', 				// Bootstrap Notify Plugin Js
                'assets/plugins/jquery-validation/jquery.validate.js', 				// Jquery Validation Plugin Css Plugin Js
                'assets/plugins/waitme/waitMe.js', 														// Waitme Js
                'assets/plugins/mprogres/js/mprogress.min.js',								// Mproggres bar Js
                'assets/plugins/pace/pace.min.js',
                'assets/plugins/blockUI/jquery.blockUI.js',
                'assets/js/admin.js', 																				// Custom Js
                'assets/js/pages/ui/notifications.js', 												// Custom Js
                'assets/js/pages/ui/tooltips-popovers.js',	 									// Custom Js
                // 'assets/plugins/particles/particles.js',
                // 'assets/plugins/particles/app.js'
            ),
        );

        $data['sidejs'] = 'Backend/__ServerSideJs/Login/S_login';

        //CEK USER AKSES
        if ($this->agent->is_browser()) {
            $agent = $this->agent->browser().' '.$this->agent->version();
        } elseif ($this->agent->is_mobile()) {
            $agent = $this->agent->mobile();
        } else {
            $agent = 'Data user gagal di dapatkan';
        }

        $data['browser'] = $agent;
        $data['os'] = $this->agent->platform(); // Platform info (Windows, Linux, Mac, etc.)
        $data['ip'] = $this->input->ip_address();
        $data['date'] = longdate_indo(date('Y-m-d'));

        $this->db->insert('ref_access_loghistory', array(
            'os' => $data['os'],
            'browser' => $data['browser'], 'ip' => $this->uri->segment(4), 'date' => date('Y-m-d H:i:s'),
        ));

        if ($cek == true) {
            if($this->session->userdata('userkey') != null) {
               $user = $this->session->userdata('user_access');
               return redirect(base_url('backend/c_admin?module='.$this->dashboard.'&user='.$user));
            }
            $this->load->view('Backend/v_login', $data);
        } else {
            redirect(base_url('/'));
        }
    }

    public function cek()
    {
        $username = trim($this->security->xss_clean($this->input->post('user', true)));
        $password = trim($this->security->xss_clean($this->input->post('pass', true)));
        $key = do_hash('27mei1999');
        $strong_key = do_hash($key, 'md5');
        $where = array(
            'username' => $username,
            'password' => $strong_key.md5($password),
            'aktif' => 'Y',
        );
        $cek = $this->ml->cek_login('t_users', $where);

        if ($cek->num_rows() > 0) {
            $pars['sts'] = 1;

            //KEAMANAN USER INTERFACE
            // $access = $this->uri->segment(1)."/".$this->uri->segment(2);
            // $pars['token'] = $this->madmin->getToken('backend/c_admin');
            $pars['user_access'] = $this->madmin->getAccess($username);
            $pars['home'] = $this->dashboard;

            foreach ($cek->result() as $key) {
                $getrow = $key;
            }

            $data_session = array(
                'user_access' => $getrow->user_access,
                'userkey' => $getrow->id_user,
                'user' => $username,
                'status' => 'ONLINE',
                'namalengkap' => $getrow->nama_lengkap,
                'emailuser' => $getrow->email,
                'gravatar' => $getrow->gravatar,
                'lvl' => $getrow->level,
                'logon' => $getrow->sesi_login,
                'logout' => $getrow->sesi_logout,
            );
            $this->session->set_userdata($data_session);

            $data_sesi = array(
                'status' => 'ONLINE',
                'sesi_login' => date('Y-m-d H:i:s'),
            );

            $where_sesi = array(
                'username' => $username,
            );

            $this->ml->update_session($where_sesi, $data_sesi);
            $this->session->set_flashdata('welcome_message', '
                <div class="alert bg-teal alert-dismissible m-t-25" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <span class="badge badge-success">Sukses</span> Assalamualaikum <b>'.$username.'</b>, anda telah masuk pada sistem administrasi dan informasi BKPPD. 
                </div>');
        } else {
            $pars['sts'] = 0;
            $pars['user_access'] = '_BLANK_';
        }
        echo json_encode($pars);
    }

    public function logout()
    {
        $iduser = $this->session->userdata('userkey');
        $username = $this->session->userdata('user');
        $code = str_shuffle($this->session->userdata('user_access'));

        $data = array(
            'status' => 'OFFLINE',
            'user_access' => $code,
            'sesi_logout' => date('Y-m-d H:i:s'),
        );

        $where = array(
            'username' => $username,
            'id_user' => $iduser,
        );
        $ip = $this->input->ip_address();
        $token = sha1($ip);
        $os = $this->agent->platform();

        $login['redirect_to'] = base_url('login/v2/'.$token.'/'.$ip.'/'.$os.'?message=sign-out');
        // update status user OFFLINE
        $this->ml->update_session($where, $data);
        $this->session->unset_userdata($where);
        $this->session->sess_destroy();
        echo json_encode($login);
    }

    public function logout_automatis()
    {
        $iduser = $this->session->userdata('userkey');
        $username = $this->session->userdata('user');
        $code = str_shuffle($this->session->userdata('user_access'));

        $data = array(
            'status' => 'OFFLINE',
            'user_access' => $code,
            'sesi_logout' => date('Y-m-d H:i:s'),
        );

        $where = array(
            'username' => $username,
            'id_user' => $iduser,
        );
        $ip = $this->input->ip_address();
        $token = sha1($ip);
        $os = $this->agent->platform();

        // update status user OFFLINE
        $this->ml->update_session($where, $data);
        $this->session->unset_userdata($where);
        $this->session->sess_destroy();
        redirect(base_url('login/v2/'.$token.'/'.$ip.'/'.$os.'?message=unset'));
    }

    public function prereq()
    {
        $ip = $this->get_client_ip();
        $os = $this->agent->platform();
        $cekdb = $this->ml->cekip($ip);
        if($cekdb == 1) {
            $data_update = ['name' => generateRandomString(5), 'type' => '-', 'token' => sha1($ip)];
            $this->ml->updateip($data_update, $ip);
            $this->session->set_flashdata('prereq', 'Request Access Token Success Updated');
        } else {
            $data_insert = ['ip' => $ip, 'name' => generateRandomString(5), 'type' => '-', 'block' => 'y', 'token' => sha1($ip)];
            $this->ml->insertip($data_insert);
            $this->session->set_flashdata('prereq', 'Request Access Token Success Record');
        }
        redirect(base_url('adminpanel'));
    }
}
