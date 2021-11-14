<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Users extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_f_users','users');
		$this->load->model('model_template_v1/M_f_post','post');
		$this->load->model('model_template_v1/M_f_halaman', 'halaman');
		$this->load->model('model_template_v1/M_f_ikm', 'ikm');
		$this->load->model('model_template_v1/M_f_album', 'album');
		$this->load->model('model_template_v1/M_f_banner', 'banner');
		$this->load->model('M_b_komentar', 'komentar');
		//Check maintenance website
        if(($this->session->userdata('status') == 'ONLINE') && ($this->mf_beranda->get_identitas()->status_maintenance == '1') || ($this->mf_beranda->get_identitas()->status_maintenance == '0')) {
            // redirect(base_url('frontend/v1/beranda'),'refresh');
        } else {
            redirect(base_url('under-construction'),'refresh');
        }

	}
	public function user_terdaftar()
	{
		$data = [
            'title' => 'Userportal - BKPPD Balangan',
            'isi' => 'Frontend/v1/pages/user_list',
            'mf_beranda' => $this->mf_beranda->get_identitas(),
            'mf_menu' => $this->mf_beranda->get_menu(),
            'total_userlist' => $this->users->userlist()->num_rows(),
            'user_populer' => $this->users->userpopuler(),
        ];
        $this->load->view('Frontend/v1/layout/wrapper', $data);
	}
	
	public function ajax_user_terdaftar() 
	{
		$list = $this->users->get_datatables_userlist();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $u):
			$role = $u->role === 'EDITOR' ? '<span class="badge badge-primary">EDITOR</span>' : '<span class="badge badge-light">TAMU</span>'; 
			$online = $u->online === 'ON' ? '<span class="text-success animated fadeIn infinite"> Online</span> ' : '<span class="text-secondary"> Offline</span>';
			$pic = !empty($u->photo_pic) ? img_blob($u->photo_pic) : base_url('assets/images/no-profile-picture.jpg');
			$no++;
			$row = array();
			$row[] = '<tr>
							<td>
								<div class="small text-muted">Tanggal Bergabung</div> 
								'.longdate_indo($u->tanggal_bergabung).'
								<br>
								<div class="small text-muted">Nama</div> 
								'.decrypt_url($u->nama_lengkap).'
								<div class="small text-muted">Status</div> 
								'.$online.'
							</td>
							</tr>
						';
			$row[] = '<tr>
						<td><img width="90" src="'.$pic.'" alt="'.$u->nama_lengkap.'"></td>
							<td colspan="2">
								<a href="'.base_url("user/".decrypt_url($u->nama_panggilan)."/".encrypt_url($u->id_user_portal)).'" class="btn btn-outline-primary btn-sm btn-block mt-2">View profile</a>
							</td>
						</tr>';
			$data[] = $row;
		endforeach;
		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->users->count_all_userlist(),
			"recordsFiltered" => $this->users->count_filtered_userlist(),
			"data" => $data,
		);
		//output dalam format JSON
		echo json_encode($output);
	}
	
	public function verify($nohp) {
		if(isset($nohp)) {
			$db = $this->users->verify_email($nohp);
			if($db == true) {
				redirect(base_url('frontend/v1/users/verify_status/'.$nohp));
			} else {
				redirect(base_url('frontend/v1/daftar/'),'refresh');
			}
		} else {
			redirect(base_url('frontend/v1/daftar/'),'refresh');
		}
	}

	public function verify_status($nohp)
    {
        $data = [
            'title' => 'Email Verify.',
            'isi' => 'Frontend/v1/pages/f_daftar_verify',
            'mf_beranda' => $this->mf_beranda->get_identitas(),
            'mf_menu' => $this->mf_beranda->get_menu(),
            'check_verify' => $this->users->check_verify($nohp),
        ];
        $this->load->view('Frontend/v1/layout/wrapper', $data);
    }
	public function login()
	{
		$data = [
            'mf_beranda' => $this->mf_beranda->get_identitas()
		];
        if($this->session->userdata('user_portal_log')['online'] == 'OFF' || empty($this->session->userdata('user_portal_log')['online'])) {
        	$this->load->view('Frontend/v1/pages/f_login', $data);
        	$this->users->status_online('t_users_portal', 
    		['email' => encrypt_url($this->session->userdata('user_portal_log')['email'])],['online' => 'OFF']);
        } else {
    		redirect(base_url("frontend/v1/users/akun/".$this->session->userdata('user_portal_log')['nama_panggilan'].'/'.encrypt_url($this->session->userdata('user_portal_log')['nohp'])),'refresh');
    	}
	}
	public function userguide()
	{
		$data = [
            'mf_beranda' => $this->mf_beranda->get_identitas()
		];
		$this->load->view('Frontend/v1/pages/userguide', $data);
	}

	public function kebijakan()
	{
		$data = [
            'title' => 'Kebijakan Privacy & Policy - BKPPD Balangan',
            'isi' => 'Frontend/v1/kebijakan_privacy_policy',
            'mf_beranda' => $this->mf_beranda->get_identitas(),
            'mf_menu' => $this->mf_beranda->get_menu()
		];
		// 
		$this->load->view('Frontend/v1/layout/wrapper', $data);
		
	}

	public function lupa_password() {
		$data = [
            'mf_beranda' => $this->mf_beranda->get_identitas()
		];
		if($this->session->userdata('user_portal_log')['online'] == 'OFF' || empty($this->session->userdata('user_portal_log')['online'])) {
        	$this->load->view('Frontend/v1/pages/f_lupa_password', $data);
        } else {
    		redirect(base_url("frontend/v1/users/akun/".$this->session->userdata('user_portal_log')['nama_panggilan'].'/'.encrypt_url($this->session->userdata('user_portal_log')['nohp'])),'refresh');
    	}
	}
	public function reset_password() {
		$email = encrypt_url($this->input->post('email'));
		$data  = $this->users->getuserportalbyemail($email)->row_array();
		$num = rand(10000000,99999999);
		$db = $this->users->update_token('t_users_portal', ['token_verifikasi' => $num], ['email' => $email]);
		// var_dump($data);
		// Configurasi Email
        $from_email = 'bkppdbalangan@gmail.com';
        $to_email = decrypt_url($email);

        $config = array(
                'protocol' => 'smtp',
                'smtp_host' => 'ssl://smtp.googlemail.com',
                'smtp_port' => 465,
                'smtp_user' => $from_email,
                'smtp_pass' => 'rembulan123',
                'mailtype' => 'html',
                'charset' => 'iso-8859-1',
        );
        if(($db) && (decrypt_url($data['email']) == $to_email)) {
	        $this->load->library('email', $config);
	        $this->email->set_newline("\r\n");

	        $this->email->from($from_email, 'BKPPD Kab. Balangan'); 
	        $this->email->to($to_email);
	        $this->email->subject('Reset Password!');

	        $url = base_url().'frontend/v1/users/reset_pass/'.$data['nohp'].'/'.encrypt_url(date('Ymd'));
	        $message = '<p> Dear ' . decrypt_url($data['nama_lengkap']).',</p>';
	        $message .= '<h1>'.$num.'</h1>';
	        $message .= '<p> Terimakasih. </p>';
	        
	        $this->email->message($message); 
	        if($this->email->send()){
	        	$this->session->set_flashdata("notif","TOKEN telah dikirm ke email anda.");
        		redirect(base_url('cek-token/'.encrypt_url($data['id_user_portal'])));
	        }else {
	            $this->session->set_flashdata("notif","TOKEN gagal dikirim.");  
	        } 
        } else {
        	$this->session->set_flashdata("notif","Email tidak terdaftar.");
        }
        redirect(base_url('lupa_password'));
	}

	public function cek_token($iduserportal)
	{
		$id = decrypt_url($iduserportal);
		$user  = $this->users->get_userportal_byid($id);
		$data = [
            'mf_beranda' => $this->mf_beranda->get_identitas(),
            'iduserportal' => $iduserportal
		];
		// var_dump($user);
		if(($user->id_user_portal != $id) || ($user->token_verifikasi == null)) {
        	$this->load->view('Frontend/v1/pages/f_lupa_password', $data);
        } else {
    		$this->load->view('Frontend/v1/pages/f_cek_token', $data);
    	}
	}

	public function verify_token($iduserportal) {
		$p = $this->input->post();
		$id = decrypt_url($iduserportal);
		$user  = $this->users->get_userportal_byid($id);
		if($p['token'] === $user->token_verifikasi) {
			redirect(base_url('reset-pass/'.$iduserportal.'/'.encrypt_url(date('YmdH'))),'refresh');
		} else {
			$data = [
	            'mf_beranda' => $this->mf_beranda->get_identitas()
			];
			$this->session->set_flashdata("notif","TOKEN yang anda masukan salah");
			redirect(base_url('cek-token/'.$iduserportal),'refresh');
		}
	}

	public function reset_pass($iduserportal,$tglnow) {
		$data = [
            'mf_beranda' => $this->mf_beranda->get_identitas(),
            'data' => ['id_user' => $iduserportal, 'token' => decrypt_url($tglnow)]
		];
		if($this->session->userdata('user_portal_log')['online'] == 'OFF' || empty($this->session->userdata('user_portal_log')['online'])) {
        	$this->load->view('Frontend/v1/pages/f_reset_password', $data);
        } else {
    		redirect(base_url("frontend/v1/users/akun/".$this->session->userdata('user_portal_log')['nama_panggilan'].'/'.encrypt_url($this->session->userdata('user_portal_log')['nohp'])),'refresh');
    	}
	}

	public function resetpasswordnow() {
		$id = decrypt_url($this->input->post('id'));
		$new_password = $this->input->post('password');
		if(!empty($new_password)) {
			$whr = ['id_user_portal' => $id];
			$data = ['password' => "$".sha1('bkppd_balangan')."$".encrypt_url($new_password)];
			$db = $this->users->do_reset_password('t_users_portal', $data, $whr);
			if($db) {
				$this->session->set_flashdata("notif","Password telah berhasil diganti");
			} else {
				$this->session->set_flashdata("notif","Gagal mengganti password");
			}
			redirect(base_url('login_web'),'refresh');
		}
	}

    public function cek_akun() {

    		$true_token = $this->session->csrf_token;
	        if($this->input->post('xtoken') != $true_token):
	            $this->output->set_status_header('403');
	            $this->session->unset_userdata('csrf_token');
	            show_error('This request rejected');
	            return false;
	        endif;

    		$captcha = $this->input->post('captcha');
	        $sess_captcha = $this->session->userdata('captcha');
	        $sess_login = $this->input->post('session_login');
			$urlRef = !empty($this->input->post('urlRef')) ? $this->input->post('urlRef') : '';
	        if (isset($captcha)
            && isset($sess_captcha)
            && isset($sess_login)
            && ('bkppd_balangan'.date('d') == decrypt_url($sess_login))
        	) {

    		$email = $this->input->post('email');
    		$pass  = $this->input->post('password');
    		$where = array(
				'email' => encrypt_url($email),
				'password' => "$".sha1('bkppd_balangan')."$".encrypt_url($pass)
			);
			$cek = $this->users->cek_login("t_users_portal", $where);
			if($cek->num_rows() > 0){
				// if($this->users->getuserportalbyemail($where['email'])->row()->online === 'OFF' && empty($this->session->userdata('user_portal_log')['email'])) {
				$q = $cek->row();
				$data_session = array(
					'nama_lengkap' => decrypt_url($q->nama_lengkap),
					'nama_panggilan' => decrypt_url($q->nama_panggilan),
					'email' => decrypt_url($q->email),
					'nohp' => decrypt_url($q->nohp),
					'online' => 'ON',
					'time' => $this->config->item('sess_expiration'),
					'id' => $q->id_user_portal
					);
				$this->session->set_userdata('user_portal_log', $data_session);
				$this->users->status_online('t_users_portal', 
											['email' => encrypt_url($email)],
											['online' => 'ON']);
					$msg = array('valid' => true, 
					'pesan' => "<div class='d-block mx-auto text-center'>Login berhasil, akun ditemukan ...</div>", 
					'redirect' => $urlRef);
				// } else {
					// $msg = array('valid' => true, 'pesan' => 'Login Berhasil, akun juga login di device lain.', 'debug' => $this->users->getuserportalbyemail($where['email'])->row()->online);
					// $this->users->status_online('t_users_portal', ['email' => $where['email']], ['online' => 'OFF']);
					// $this->session->unset_userdata('user_portal_log');
				// }
			}else{
				$msg = array('valid' => false, 'pesan' => "Username dan password tidak terdaftar");
			}
			echo json_encode($msg);
			}
    }

    public function akun($nama_panggilan, $nohp) 
    {
    	$ses_nohp = encrypt_url($this->session->userdata('user_portal_log')['nohp']);
    	$ses_nama = $this->session->userdata('user_portal_log')['nama_panggilan'];

    	if(($nohp == $ses_nohp) && ($nama_panggilan == $ses_nama) && ($this->session->userdata('user_portal_log')['online'] == 'ON')) {
    		$data = [
	            'title' => 'Halo, '.ucfirst($ses_nama),
	            'isi' => 'Frontend/v1/pages/u_akun',
	            'mf_beranda' => $this->mf_beranda->get_identitas(),
	            'mf_menu' => $this->mf_beranda->get_menu(),
	        ];
	        $this->load->view('Frontend/v1/layout/wrapper', $data);
    	} else {
					redirect(base_url('frontend/v1/beranda'));
    	}
	}	
		public function akunProfile() 
		{
			return $this->load->view('Frontend/v1/pages/u_akun_user');
		}

		public function postDisukai($iduserportal) 
		{
			$id 	= decrypt_url($iduserportal);
			$data 	= $this->post->disukai($id)->result();
			return $this->load->view('Frontend/v1/pages/u_akun_postingan_disukai', ['id' => $id, 'datas' => $data]);
		}

		public function postDisimpan($iduserportal) 
		{
			$id 	= decrypt_url($iduserportal);
			$data 	= $this->post->disimpan($id)->result();
			return $this->load->view('Frontend/v1/pages/u_akun_postingan_disimpan', ['id' => $id, 'datas' => $data]);
		}

		public function halamanstatis($id)
		{
			$data = [
				'id_user' => $id
			];

			return $this->load->view('Frontend/v1/pages/u_akun_halaman', $data);
		}

		public function halamanlink() {
			$data = [
				'data_submenu' => $this->users->getsubmenu()->result()
			];

			return $this->load->view('Frontend/v1/pages/u_akun_halaman_link', $data);
		}

		public function kotak_saran() {
			$data = [
				'kategori_saran' => $this->users->karegori_saran()->result()
			];
			return $this->load->view('Frontend/v1/pages/u_akun_kotak_saran', $data);
		}

		public function ikm_periode() {
			$data = [
				'ikm_tahun' => $this->ikm->ikm_tahun()->result()
			];
			return $this->load->view('Frontend/v1/pages/ikm/ikm_periode', $data);
		}
		public function ikm_responden() {
			$data = [
				'ikm_tahun' => $this->ikm->filter_tahun()->result(),
				'ikm_periode' => $this->ikm->filter_periode()->result(),
				'ikm_form' => $this->ikm->filter_form()->result()
			];
			return $this->load->view('Frontend/v1/pages/ikm/ikm_responden', $data);
		}

		public function submenu() {
			$data = [
				'data_submenu' => $this->users->getsubmenu()->result(),
				'data_mainmenu' => $this->users->get_mainmenu()->result(),
			];

			return $this->load->view('Frontend/v1/pages/u_akun_submenu', $data);
		}

		public function komentar() {
			return $this->load->view('Frontend/v1/pages/u_akun_komentar');
		}

		public function updatelinkhalaman($id) {
			$token = $this->input->post('txt');
			
			if(!empty($token)) {
				$getjudulhalamanbytoken = $this->users->getjudulhalamanbytoken($token)->row();
				$title = url_title($getjudulhalamanbytoken->title,'-', TRUE);
				$getlinkbyid = $this->users->getlinkbyid($id)->row();
				$pecah = explode("/", $getlinkbyid->link_sub);
				// $getTokenLink = $pecah[2];
				$newLink = $pecah[0].'/'.strtolower($title);
				$msg = ['newtoken' => $token, 'newlink' => $newLink];
				$this->users->updatelinkhalaman('t_submenu', ['link_sub' => $newLink], ['idsub' => $id]);
			} else {
				$msg = false;
			}
			echo json_encode($msg);
		}

		public function getsubmenubyid() {
			$id = $this->input->get('id');
			$q = $this->db->get_where('t_submenu', ['idsub' => $id])->row();
			echo json_encode($q);
		}
		public function get_all_halamanstatis()
		{
		// parameter
		$idAkun = decrypt_url($this->input->post('id_a'));
		$list = $this->halaman->get_datatables($idAkun);
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $h) {

			$btnAksi = '<div class="dropdown dropright">
								  <button id="dLabel" class="btn btn-lg border-0 btn-light bg-white p-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								    <i class="fas fa-ellipsis-h p-2"></i>
								  </button>
								  <div class="dropdown-menu" aria-labelledby="dLabel">
								    <a class="dropdown-item rounded-pill text-primary" href="'.base_url('frontend/v1/halaman/halamanstatis/edit?token='.$h->token_halaman).'"><i class="fas fa-edit mr-2"></i> Edit</a>
									<a id="btn-hapus-halaman" data-id="' . $h->token_halaman . '" class="dropdown-item  rounded-pill text-danger" href="#"><i class="fas fa-trash mr-2 text-danger"></i> Hapus</a>
								  </div>
								</div>';

			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $btnAksi;
			$row[] = $h->title;
			$row[] = "<code>".$h->token_halaman."</code>";
			$row[] = "<i class='mr-2 fas fa-eye'></i>".nominal($h->views);

			$data[] = $row;
		}

		$output = array(
				"draw" => $_POST['draw'],
				"recordsTotal" => $this->halaman->count_all($idAkun),
				"recordsFiltered" => $this->halaman->count_filtered($idAkun),
				"data" => $data,
			);
		//output to json format
		echo json_encode($output);
		}

		public function post($id) 
		{
			$data = [
				'id_user' => $id
			];

			return $this->load->view('Frontend/v1/pages/u_akun_postingan', $data);
		}

			public function get_all_post()
			{
				// parameter
				$idAkun = decrypt_url($this->input->post('id_a'));

				$list = $this->post->get_datatables($idAkun);
		        $data = array();
		        $no = $_POST['start'];
		        foreach ($list as $p) {

		        	if($p->type === 'BERITA' || $p->type === 'SLIDE'):
		        		$type = 'postDetail';
		        	elseif($p->type === 'LINK'):
		        		$type = 'postDetailLink';
		        	elseif($p->type === 'YOUTUBE'):
		        		$type = 'postDetailYoutube';
		        	else:
		        		$type = 'postDetail';
		        	endif;
		        	
		        	$btnAksi = $p->publish != 0 ? '<div class="dropdown dropright">
								  <button id="dLabel" class="btn btn-lg border-0 btn-light bg-white p-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								    <i class="fas fa-ellipsis-h p-2"></i>
								  </button>
								  <div class="dropdown-menu" aria-labelledby="dLabel">
								    <a class="dropdown-item text-muted rounded-pill" href="'.base_url('frontend/v1/post/'.$type.'/'.encrypt_url($p->id_berita)).'"><i class="fas fa-edit mr-2"></i> Edit</a>
									<a id="btn-hapus" data-id="' . $p->id_berita . '" class="dropdown-item text-muted rounded-pill" href="#"><i class="fas fa-trash mr-2 text-danger"></i> Hapus</a>
								  </div>
								</div>' : '<button title="Draf" class="btn btn-dark p-1 text-warning" disabled>D</button>';

					$countKomentar = $this->komentar->jml_komentarbyidberita($p->id_berita);
					$komentar = $countKomentar != 0 ? '<b>'.$countKomentar.'</b>' : $countKomentar;
					$views = nominal($p->views);

					if($p->type === 'BERITA' || $p->type === 'SLIDE'):
					$btnPublish = $p->publish == 0 ? '<a href="' . base_url('frontend/v1/post/postDetail/' . encrypt_url($p->id_berita)) . '" title="Belum Dipublish" class="btn btn-default border-left ml-4 px-3">Publish</a>' : '';
					else:
					$btnPublish = $p->publish == 0 ? '<a href="' . base_url('frontend/v1/post/postDetailYoutube/' . encrypt_url($p->id_berita)) . '" title="Belum Dipublish" class="btn btn-dark border-left ml-4 px-3">Publish</a>' : '';	
					endif;
					$btnHapus = $p->publish == 0 ? '<a id="btn-hapus" data-id="'.$p->id_berita.'" href="#" title="Hapus Postingan" class="btn btn-default ml-2 px-2 py-0"><i class="fas fa-trash text-danger"></i></a>' : '';

		            $no++;
		            $row = array();
		            $row[] = $no;
		            $row[] = $btnAksi;
		            $row[] = $p->judul. $btnPublish.$btnHapus;
		            $row[] = '<i class="far fa-comment-alt mx-2"></i>'.$komentar;
		            $row[] = '<i class="fas fa-eye mx-2"></i>'.$views;
		            $data[] = $row;
		        }
		 
		        $output = array(
		                        "draw" => $_POST['draw'],
		                        "recordsTotal" => $this->post->count_all($idAkun),
		                        "recordsFiltered" => $this->post->count_filtered($idAkun),
		                        "data" => $data,
		                );
		        //output to json format
		        echo json_encode($output);
			}
	public function galeri() {
		$username = $this->session->userdata('user_portal_log')['nama_panggilan'];
		$data = [
				'username' => $username,
				'fotos' => $this->album->get_all_album()
			];

			return $this->load->view('Frontend/v1/pages/u_akun_galeri', $data);
	}
	public function banner() {
		$data = [
				'jns_banner' => $this->banner->get_list_jns_banner()->result()
			];
			return $this->load->view('Frontend/v1/pages/b_list', $data);
	}
	public function profile($nama_panggilan, $id) {
		$data = [
				'title' => 'Profile &dash; '.ucfirst($nama_panggilan),
				'isi' => 'Frontend/v1/pages/u_profile',
				'mf_beranda' => $this->mf_beranda->get_identitas(),
				'mf_menu' => $this->mf_beranda->get_menu(),
                'mf_kategori' => $this->mf_beranda->get_kategori_listing(),
                'mf_berita_populer' => $this->mf_beranda->berita_populer(),
				'public_profile' => $this->users->get_userportal_byid(decrypt_url($id))
		];
		$this->load->view('Frontend/v1/layout/wrapper', $data);
	}

	public function disukai($nama_panggilan, $id)
	{
		$data = [
			'title' => 'Disukai: ' . ucfirst($nama_panggilan),
			'isi' => 'Frontend/v1/pages/u_profile_likes',
			'mf_beranda' => $this->mf_beranda->get_identitas(),
			'mf_menu' => $this->mf_beranda->get_menu(),
			'public_profile' => $this->users->get_userportal_byid(decrypt_url($id))
		];
		$this->load->view('Frontend/v1/layout/wrapper', $data);
	}

	public function get_all_disukai()
	{
		$id = $this->input->post('id_a');
		$list = $this->users->get_datatables($id);
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $field) {

			// Limit isi berita
			if ($field->headline == '1') {
				$isi_berita = strip_tags($field->content); // membuat paragraf pada isi berita dan mengabaikan tag html
				$isi = substr($isi_berita, 0, 100); // ambil sebanyak 80 karakter
				$isi = substr($isi_berita, 0, strrpos($isi, ' ')); // potong per spasi kalimat
			} else {
				$isi = $field->content;
			}

			$by = $field->created_by;
			if ($by == 'admin') {
				$namalengkap = $this->mf_users->get_namalengkap($by);
			} else {
				$namalengkap = decrypt_url($this->mf_users->get_userportal_namalengkap($by));
			}

			// Link detail berita
			$id = encrypt_url($field->id_berita);
			$postby = strtolower(url_title($namalengkap));
			$judul = strtolower($field->judul);
			$posturl = "post/{$postby}/{$id}/" . url_title($judul) . '';

			$btn_bookmark = $this->mf_beranda->get_status_bookmark($this->session->userdata('user_portal_log')['id'], $field->id_berita) == 'on' ? 'btn-bookmark' : '';
			$status_bookmark = $this->mf_beranda->get_status_bookmark($this->session->userdata('user_portal_log')['id'], $field->id_berita) == 'on' ? 'fas text-primary' : 'far';

			$btn_like = $this->mf_beranda->get_status_like($this->session->userdata('user_portal_log')['id'], $field->id_berita) == true ? 'btn-like' : '';
			$status_like = $this->mf_beranda->get_status_like($this->session->userdata('user_portal_log')['id'], $field->id_berita) == true ? 'fas text-danger' : 'far';

			$no++;
			$row = array();
			$row[] = '
				<div class="container">
					<div class="row">
						<div class="col-md-1 p-0 text-left display-4 bg-light text-center">
							'.$no.'
						</div>
						
						<div class="col-md-8">
							<a href="'. base_url($posturl).'">'.$field->judul. '</a> 
							<p>'. $isi. '</p>
							<button type="button" data-toggle="tooltip" data-placement="bottom" title="Dilihat" class="btn btn-transparent border-light rounded-0 pl-3 pr-3 float-left"><i class="far fa-eye mr-2"></i> ' . $field->views . '</button>

							<button type="button" data-toggle="tooltip" data-placement="bottom" title="Komentar" class="btn btn-transparent  border-light rounded-0 pl-3 pr-3 float-left"><i class="far fa-comment-alt mr-2"></i> ' . $this->komentar->jml_komentarbyidberita($field->id_berita) . '</button>

							<button type="button" data-toggle="tooltip" data-placement="bottom" title="Bagikan postingan ini" id="btn-share" data-row-id="' . $field->id_berita . '" class="btn btn-transparent border-light rounded-0 pl-3 pr-3 float-left"><i class="fas fa-share-alt mr-2"></i> <span class="share_count">' . $field->share_count . '</span></button>
							
							<button type="button" onclick="like_toggle(this)" data-toggle="tooltip" data-placement="bottom" class="btn btn-transparent border-secondary rounded-0 pl-3 pr-3 ' . $btn_like . '" title="Suka / Tidak suka" data-id-berita="' . $field->id_berita . '" data-id-user="' . $this->session->userdata('user_portal_log')['id'] . '"><i  class="' . $status_like . ' fa-heart mr-2"></i> <span class="count_like">' . $field->like_count . '</span> </button>

							<button type="button" onclick="bookmark_toggle(this)" data-toggle="tooltip" data-placement="bottom" class="btn btn-transparent border-left border-light rounded-0  pt-1 pb-1 pr-4 pl-4 float-right ' . $btn_bookmark . '" title="Simpan Postingan" data-id-berita="' . $field->id_berita . '" data-id-user="' . $this->session->userdata('user_portal_log')['id'] . '"><i  class="' . $status_bookmark . ' fa-bookmark"></i> </button>
						</div>
						<div class="col-md-3 p-0">
							<img class="img-fluid rounded shadow-sm border" src="' . $field->path . '">
						</div>
					</div>
				</div>
				';

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->users->count_all($id),
			"recordsFiltered" => $this->users->count_filtered($id),
			"data" => $data,
		);
		//output dalam format JSON
		echo json_encode($output);
	}

	public function halaman($nama_panggilan, $id)
	{
		$data = [
			'title' => 'Halaman &bull; ' . ucfirst($nama_panggilan) . ' - BKPPD Balangan',
			'isi' => 'Frontend/v1/pages/u_profile_halaman',
			'mf_beranda' => $this->mf_beranda->get_identitas(),
			'mf_menu' => $this->mf_beranda->get_menu(),
			'public_profile' => $this->users->get_userportal_byid(decrypt_url($id)),
			'halaman' => $this->users->get_halaman_byid(decrypt_url($id))
		];
		$this->load->view('Frontend/v1/layout/wrapper', $data);
	}


	public function edit($id)
	{
		$d = $this->users->get_userportal_byid(decrypt_url($id));
		if($this->session->userdata('user_portal_log')['online'] == 'ON') {
		$data = [
			'id' => $id,
            'title' => 'Edit: @'.ucfirst(decrypt_url($d->nama_panggilan)),
            'isi' => 'Frontend/v1/pages/u_akun_edit',
            'mf_beranda' => $this->mf_beranda->get_identitas(),
			'mf_menu' => $this->mf_beranda->get_menu(),
			'profile' => $d
        ];
        $this->load->view('Frontend/v1/layout/wrapper', $data);
    	} else {
			redirect(base_url('frontend/v1/beranda'));
    	}
	}

	public function hapus_akun($id)
	{
		$akundb = $this->users->get_userportal_byid(decrypt_url($id));
		// var_dump($akundb);
		$tbl = 't_users_portal';
		$whr = ['id_user_portal' => decrypt_url($id)];
		if(decrypt_url($id) == $akundb->id_user_portal) {
			$db = $this->users->hapus_akun($tbl, $whr);
			if($db) {
				$this->session->unset_userdata('user_portal_log');
				$this->session->set_flashdata(['message' => 'Akun berhasil dihapus', 'class' => 'alert-success']);
			} else {
				$this->session->set_flashdata(['message' => 'Akun gagal dihapus', 'class' => 'alert-danger']);
			}
			redirect(base_url('beranda'),'refresh');
		}
			
	}

	public function upload_photo() 
	{
		$type = $this->input->get('jenis');
		$id = decrypt_url($this->input->get('id'));
		if($type == 'pic') {
			$pic = file_get_contents($_FILES['file']['tmp_name']);
			$update = [
				'photo_pic' => $pic
			];
			$whr = [
				'id_user_portal' => $id
			];
			$send = $this->users->upload_photo('t_users_portal', $whr, $update);
			if($send == true) 
			{
				$msg = '<span class="text-success">Sukses upload photo pic <i class="fas fa-check-circle"></i></span>';
			} else {
				$msg = 'Gagal Upload';
			}
			echo json_encode($msg);
		} else {
			$ktp = file_get_contents($_FILES['file']['tmp_name']);
			$update = [
				'photo_ktp' => $ktp
			];
			$whr = [
				'id_user_portal' => $id
			];
			$send = $this->users->upload_photo('t_users_portal', $whr, $update);
			if($send == true) 
			{
				$msg = '<span class="text-success">Sukses upload gambar ktp <i class="fas fa-check-circle"></i></span>';
			} else {
				$msg = 'Gagal Upload';
			}
			echo json_encode($msg);
		}
	}

	public function update()
	{
		$true_token = $this->session->csrf_token;
        if($this->input->post('xtoken') != $true_token):
            $this->output->set_status_header('403');
            $this->session->unset_userdata('csrf_token');
            show_error('This request rejected');
            return false;
        endif;

		$id = decrypt_url($this->input->post('id'));
		$namalengkap = encrypt_url($this->input->post('nama_lengkap'));
		$namapanggilan = encrypt_url($this->input->post('nama_panggilan'));
		$alamat = encrypt_url($this->input->post('alamat'));
		$pekerjaan = encrypt_url($this->input->post('pekerjaan'));
		$nohp = encrypt_url($this->input->post('nohp'));
		$tgllahir = $this->input->post('tanggal_lahir');
		$pendidikan = encrypt_url($this->input->post('pendidikan'));
		$deskripsi = htmlentities($this->input->post('deskripsi'), ENT_QUOTES);
		$pass = "$".sha1('bkppd_balangan')."$".encrypt_url($this->input->post('password'));

		$whr = [
			'id_user_portal' => $id
		];
		if(!empty($this->input->post('password')))
		{
			$post = [
				'password' => $pass,
				'nama_panggilan' => $namapanggilan,
				'nama_lengkap' => $namalengkap,
				'deskripsi' => $deskripsi,
				'tanggal_lahir' => $tgllahir,
				'alamat' => $alamat,
				'pekerjaan' => $pekerjaan,
				'pendidikan' => $pendidikan,
				'nohp' => $nohp
			];
		} else {
			$post = [
				'nama_panggilan' => $namapanggilan,
				'nama_lengkap' => $namalengkap,
				'deskripsi' => $deskripsi,
				'tanggal_lahir' => $tgllahir,
				'alamat' => $alamat,
				'pekerjaan' => $pekerjaan,
				'pendidikan' => $pendidikan,
				'nohp' => $nohp
			];
		}
		$tbl = 't_users_portal';
		$send = $this->users->update_profile($tbl, $post, $whr);
		if($send == true)
		{
			$msg = ['valid' => true, 'type' => 'success', 'msg' => "<b>Sukses,</b> Profile updated <i class='fas fa-check-circle ml-2'></i>"];
		} else {
			$msg = ['valid' => false, 'type' => 'warning', 'msg' => '<b>Gagal:</b> Update Gagal'];
		}

		echo json_encode($msg);
	}

    public function logout()
    {
    	$uri_frontend = $this->uri->segment(1);
    	$urlRef = isset($_GET['urlRef']) && $uri_frontend != 'frontend' ? $_GET['urlRef'] : base_url('login_web'); 
    	$this->users->status_online('t_users_portal', 
    		['email' => encrypt_url($this->session->userdata('user_portal_log')['email'])],['online' => 'OFF']);
		$this->session->unset_userdata('user_portal_log');
    	// $this->session->sess_destroy('user_portal_log');
		redirect($urlRef);
    }
}

/* End of file Users.php */
/* Location: ./application/controllers/frontend/v1/Users.php */