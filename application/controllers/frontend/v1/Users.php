<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_f_users','users');
		$this->load->model('model_template_v1/M_f_post','posts');
		$this->load->model('model_template_v1/M_f_halaman', 'halaman');
		$this->load->model('M_b_komentar', 'komentar');
		//Check maintenance website
        if(($this->session->userdata('status') == 'ONLINE') && ($this->mf_beranda->get_identitas()->status_maintenance == '1') || ($this->mf_beranda->get_identitas()->status_maintenance == '0')) {
            // redirect(base_url('frontend/v1/beranda'),'refresh');
        } else {
            redirect(base_url('theme/maintenance_site'),'refresh');
        }
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
        if($this->session->userdata('online') == 'OFF' || empty($this->session->userdata('online'))) {
        	$this->load->view('Frontend/v1/pages/f_login', $data);
        } else {
    		redirect(base_url("frontend/v1/users/akun/".$this->session->userdata('nama_panggilan').'/'.encrypt_url($this->session->userdata('nohp'))),'refresh');
    	}
	}
    public function cek_akun() {
    		$captcha = $this->input->post('captcha');
	        $sess_captcha = $this->session->userdata('captcha');
	        $sess_login = $this->input->post('session_login');
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
				$q = $cek->row();
				$data_session = array(
					'nama_lengkap' => decrypt_url($q->nama_lengkap),
					'nama_panggilan' => decrypt_url($q->nama_panggilan),
					'email' => decrypt_url($q->email),
					'nohp' => decrypt_url($q->nohp),
					'online' => 'ON',
					'id' => $q->id_user_portal
					);
				$this->session->set_userdata($data_session);
				$this->users->status_online('t_users_portal', 
											['email' => encrypt_url($email)],
											['online' => 'ON']);
				$msg = array('valid' => true, 
					'pesan' => "<div class='d-block mx-auto text-center'>Login berhasil, akun ditemukan ...</div>", 
					'redirect' => base_url("frontend/v1/users/akun/".decrypt_url($q->nama_panggilan)).'/'.$q->nohp);
			}else{
				$msg = array('valid' => false, 'pesan' => "Username dan password tidak terdaftar");
			}
			echo json_encode($msg);
			}
    }

    public function akun($nama_panggilan, $nohp) 
    {
    	$ses_nohp = encrypt_url($this->session->userdata('nohp'));
    	$ses_nama = $this->session->userdata('nama_panggilan');

    	if(($nohp == $ses_nohp) && ($nama_panggilan == $ses_nama) && ($this->session->userdata('online') == 'ON')) {
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

		public function halamanstatis($id)
		{
			$data = [
				'id_user' => $id
			];

			return $this->load->view('Frontend/v1/pages/u_akun_halaman', $data);
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
								  <button id="dLabel" class="btn btn-sm border-0 btn-light bg-white p-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								    <i class="material-icons m-0 py-1">more_vert</i>
								  </button>
								  <div class="dropdown-menu" aria-labelledby="dLabel">
								    <a class="dropdown-item text-muted" href="'.base_url('frontend/v1/halaman/halamanstatis/edit?token='.$h->token_halaman).'"><i class="fas fa-edit mr-2"></i> Edit</a>
									<a id="btn-hapus" data-id="' . $h->token_halaman . '" class="dropdown-item text-muted" href="#"><i class="fas fa-trash mr-2 text-danger"></i> Hapus</a>
								  </div>
								</div>';

			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $btnAksi;
			$row[] = $h->title;

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

				$list = $this->posts->get_datatables($idAkun);
		        $data = array();
		        $no = $_POST['start'];
		        foreach ($list as $p) {

		        	$btnAksi = $p->publish != 0 ? '<div class="dropdown dropright">
								  <button id="dLabel" class="btn btn-sm border-0 btn-light bg-white p-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								    <i class="material-icons m-0 py-1">more_vert</i>
								  </button>
								  <div class="dropdown-menu" aria-labelledby="dLabel">
								    <a class="dropdown-item text-muted" href="'.base_url('frontend/v1/post/postDetail/'.encrypt_url($p->id_berita)).'"><i class="fas fa-edit mr-2"></i> Edit</a>
									<a id="btn-hapus" data-id="' . $p->id_berita . '" class="dropdown-item text-muted" href="#"><i class="fas fa-trash mr-2 text-danger"></i> Hapus</a>
								  </div>
								</div>' : '<button title="Draf" class="btn btn-dark p-1 text-warning" disabled>D</button>';

					$countKomentar = $this->komentar->jml_komentarbyidberita($p->id_berita);
					$komentar = $countKomentar != 0 ? '<b>'.$countKomentar.'</button>' : $countKomentar;

					$btnPublish = $p->publish == 0 ? '<a href="' . base_url('frontend/v1/post/postDetail/' . encrypt_url($p->id_berita)) . '" title="Belum Dipublish" class="btn btn-default border-left ml-4 px-3 py-0"><i class="material-icons text-warning py-1 m-0">publish</i></a>' : '';
					$btnHapus = $p->publish == 0 ? '<a id="btn-hapus" data-id="'.$p->id_berita.'" href="#" title="Hapus Postingan" class="btn btn-default ml-2 px-2 py-0"><i class="fas fa-trash text-danger"></i></a>' : '';

		            $no++;
		            $row = array();
		            $row[] = $no;
		            $row[] = $btnAksi;
		            $row[] = $p->judul.'<i class="far fa-comment-alt mx-2"></i>'.$komentar. $btnPublish.$btnHapus;
		 
		            $data[] = $row;
		        }
		 
		        $output = array(
		                        "draw" => $_POST['draw'],
		                        "recordsTotal" => $this->posts->count_all($idAkun),
		                        "recordsFiltered" => $this->posts->count_filtered($idAkun),
		                        "data" => $data,
		                );
		        //output to json format
		        echo json_encode($output);
			}
		
	public function profile($nama_panggilan,$id) {
		$data = [
				'title' => 'ID: '.ucfirst($nama_panggilan),
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
				$link_profile_public = 'javascript:void(0);';
				$namalengkap = $this->mf_users->get_namalengkap($by);
				$namapanggilan = $by;
				$gravatar = base_url('assets/images/users/' . $this->mf_users->get_gravatar($by));
			} else {
				$link_profile_public =
				base_url("frontend/v1/users/profile/@" . decrypt_url($this->mf_users->get_userportal_namapanggilan($by)->nama_panggilan) . "/" . encrypt_url($by));
				$namalengkap = decrypt_url($this->mf_users->get_userportal_namalengkap($by));
				$namapanggilan = decrypt_url($this->mf_users->get_userportal_namapanggilan($by)->nama_panggilan);
				$gravatar = 'data:image/jpeg;base64,' . base64_encode($this->mf_users->get_userportal_byid($by)->photo_pic) . '';
			}

			// Link detail berita
			$id = encrypt_url($field->id_berita);
			$postby = strtolower($namalengkap);
			$judul = strtolower($field->judul);
			$posturl = "frontend/v1/post/detail/{$postby}/{$id}/" . url_title($judul) . '';

			$btn_bookmark = $this->mf_beranda->get_status_bookmark($this->session->userdata('id'), $field->id_berita) == 'on' ? 'btn-bookmark' : '';
			$status_bookmark = $this->mf_beranda->get_status_bookmark($this->session->userdata('id'), $field->id_berita) == 'on' ? 'fas text-primary' : 'far';

			$btn_like = $this->mf_beranda->get_status_like($this->session->userdata('id'), $field->id_berita) == true ? 'btn-like' : '';
			$status_like = $this->mf_beranda->get_status_like($this->session->userdata('id'), $field->id_berita) == true ? 'fas text-danger' : 'far';

			$no++;
			$row = array();
			$row[] = '
				<div class="container">
					<div class="row">
					<div class="col-md-1 p-0 text-left">
						<a href="' . $link_profile_public . '">
							<img data-toggle="tooltip" data-placement="bottom" title="' . $namalengkap . '" class="img-fluid w-75 rounded-circle border" src="' . $gravatar . '">
						</a>
							</div>
						
						<div class="col-md-8">
							<a href="'. base_url($posturl).'">'.$field->judul. '</a> 
							<p>'. $isi. '</p>
							<button type="button" data-toggle="tooltip" data-placement="bottom" title="Dilihat" class="btn btn-transparent border-light rounded-0 pl-3 pr-3 float-left"><i class="far fa-eye mr-2"></i> ' . $field->views . '</button>

							<button type="button" data-toggle="tooltip" data-placement="bottom" title="Komentar" class="btn btn-transparent  border-light rounded-0 pl-3 pr-3 float-left"><i class="far fa-comment-alt mr-2"></i> ' . $this->komentar->jml_komentarbyidberita($field->id_berita) . '</button>

							<button type="button" data-toggle="tooltip" data-placement="bottom" title="Bagikan postingan ini" id="btn-share" data-row-id="' . $field->id_berita . '" class="btn btn-transparent border-light rounded-0 pl-3 pr-3 float-left"><i class="fas fa-share-alt mr-2"></i> <span class="share_count">' . $field->share_count . '</span></button>
							
							<button type="button" onclick="like_toggle(this)" data-toggle="tooltip" data-placement="bottom" class="btn btn-transparent border-secondary rounded-0 pl-3 pr-3 ' . $btn_like . '" title="Suka / Tidak suka" data-id-berita="' . $field->id_berita . '" data-id-user="' . $this->session->userdata('id') . '"><i  class="' . $status_like . ' fa-heart mr-2"></i> <span class="count_like">' . $field->like_count . '</span> </button>

							<button type="button" onclick="bookmark_toggle(this)" data-toggle="tooltip" data-placement="bottom" class="btn btn-transparent border-left border-light rounded-0  pt-1 pb-1 pr-4 pl-4 float-right ' . $btn_bookmark . '" title="Simpan Postingan" data-id-berita="' . $field->id_berita . '" data-id-user="' . $this->session->userdata('id') . '"><i  class="' . $status_bookmark . ' fa-bookmark"></i> </button>
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
			'title' => 'Halaman: ' . ucfirst($nama_panggilan),
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
		if($this->session->userdata('online') == 'ON') {
		$data = [
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
		$id = decrypt_url($this->input->post('id'));
		$namalengkap = encrypt_url($this->input->post('nama_lengkap'));
		$namapanggilan = encrypt_url($this->input->post('nama_panggilan'));
		$alamat = encrypt_url($this->input->post('alamat'));
		$pekerjaan = encrypt_url($this->input->post('pekerjaan'));
		$nohp = encrypt_url($this->input->post('nohp'));
		$tgllahir = $this->input->post('tanggal_lahir');
		$pendidikan = encrypt_url($this->input->post('pendidikan'));
		$deskripsi = $this->input->post('deskripsi');
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
    	$this->users->status_online('t_users_portal', 
    		['email' => encrypt_url($this->session->userdata('email'))],['online' => 'OFF']);
    	$this->session->sess_destroy();
		redirect(base_url('frontend/v1/beranda'));
    }
}

/* End of file Users.php */
/* Location: ./application/controllers/frontend/v1/Users.php */