<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_video extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_b_video', 'mvideo');
		if ($this->session->userdata('status') != "ONLINE") {
			redirect("login");
		}
	}

	//==========================================//
	## Halaman Galeri Video 
	public function index()
	{
		$data = [
			'content' => 'Backend/__module/___Video/v_table',
			'scriptjs' => 'Backend/__ServerSideJs/Video/s_video',
			'pageinfo' => '<li> Dasboard</li> <li> Media</li> <li class="active">Galeri Video</li>',
			'css' => [
				'assets/plugins/waitme/waitMe.css',
				'assets/plugins/select2/css/select2.css',
				'assets/plugins/lightbox/ekko-lightbox.css'
			],
			'js' => [
				'assets/plugins/waitme/waitMe.js',
				'assets/plugins/jquery-validation/jquery.validate.js',
				'assets/plugins/jquery-validation/additional-methods.js',
				'assets/plugins/select2/js/select2.min.js',
				'assets/plugins/lightbox/ekko-lightbox.min.js'
			]
		];
		$this->load->view('Backend/v_home', $data);
	}
	//==========================================//

	//==========================================//
	## Halaman Tambah Video
	public function addvideo($source)
	{
		if ($source == "youtube") {
			$serverSide = 'Backend/__module/___Video/v_addByYotube';
		} else {
			$serverSide = 'Backend/__module/___Video/v_addByLocal';
		}

		$data = [
			'content' => $serverSide,
			'scriptjs' => 'Backend/__ServerSideJs/Video/s_video',
			'pageinfo' => '<li> Dasboard</li> <li> Media</li> <li> Video </li> <li>' . ucwords($source) . '</li> <li class="active">Add Video</li>',
			'css' => [
				'assets/plugins/waitme/waitMe.css',
			],
			'js' => [
				'assets/plugins/waitme/waitMe.js',
				'assets/plugins/jquery-validation/jquery.validate.js',
				'assets/plugins/jquery-validation/additional-methods.js',
				'assets/plugins/autosize/autosize.min.js'
			]
		];
		$this->load->view('Backend/v_home', $data);
	}
	//==========================================//

	//==========================================//
	## Tambahkan  Album Video
	public function add()
	{

		$fileName  = $_FILES['poster']['name'];
		$judul = $this->input->post('judul');
		$keterangan = $this->input->post('keterangan');
		$publish = $this->input->post('publish');

		$config_validation = array(
			array(
				'field' => 'judul',
				'label' => 'Judul',
				'rules' => 'required|trim|min_length[5]|max_length[35]'
			),
			array(
				'field' => 'publish',
				'label' => 'Publish',
				'rules' => 'required'
			)
		);
		$this->form_validation->set_rules($config_validation);
		$acak27 = generateRandomString(27);
		$date = date('Y-m-d');

		$files = shortdate_indo($date) . "_" . $acak27 . "_" . str_replace(" ", "_", $judul);
		//init library upload
		$config['upload_path']      = './files/file_albumvideo/';
		$path_now 								  = site_url('/files/file_albumvideo/' . strtoupper(str_replace("/", "", $files)) . '.' . pathinfo($fileName, PATHINFO_EXTENSION));
		$config['allowed_types']    = 'jpg|jpeg|png';
		$config['max_size'] 				= '5120'; //maksimum besar file 5M
		$config['max_width'] 				= '360';
		$config['max_height'] 			= '240';
		$config['overwrite']				= true;
		$config['file_ext_tolower'] = true;
		$config['file_name'] 				= strtoupper($files); //nama yang terupload nantinya

		$this->load->library('upload', $config);
		if ($this->form_validation->run() == FALSE) {
			$msg['pesan'] = array('content' => validation_errors(), 'colmsg' => 'bg-red');
		} else {
			if (!$this->upload->do_upload('poster')) {
				$msg['pesan'] = array('content' => $this->upload->display_errors(), 'colmsg' => 'bg-red');
			} else {
				if (file_exists('./files/file_albumvideo/' . $files)) {
					unlink('./files/file_albumvideo/' . $files);
				}
				$values = [
					'judul' => $judul,
					'keterangan' => $keterangan,
					'poster' => strtoupper($this->upload->data('file_name')),
					'path' => $path_now,
					'publish' => $publish,
					'tgl_publish' => date('Y-m-d'),
					'upload_by' => $this->session->userdata('user')
				];
				$this->mvideo->add('t_album_video', $values);
				$msg['pesan'] = array('file' => $path_now, 'content' => 'Album <b>' . $judul . '</b> Added', 'colmsg' => 'bg-teal');
			}
		}
		echo json_encode($msg);
	}
	//==========================================//

	//==========================================//
	## Pilihan Album 
	public function select_album()
	{
		$album = $this->mvideo->sel_album()->result();
		if (count($album)) {
			$row = '<option value="0">Pilih Album</option>';
			foreach ($album as $v) {

				if ($v->publish == 'N' ? $dis = 'col-red' : $dis = '');

				$row .= '<option value="' . $v->id_album_video . '" class="' . $dis . '">' . strtoupper($v->judul) . '</option>';
			}
		} else {
			$row = '<option value="0">Album Kosong</option>';
		}

		echo json_encode($row);
	}
	//==========================================//

	//==========================================//
	## Pilihan Album Terpilih 	
	public function select_curent_album($id)
	{
		$data = $this->mvideo->sc_album('t_album_video', $id)->result();
		echo json_encode(['responses' => $data]);
	}
	//==========================================//

	//==========================================//
	## Pilihan Album Terpilih 	
	public function list_video()
	{
		$id = $this->input->get('idalbum');
		$data = $this->mvideo->list_video('t_video', $id);

		if ($data->num_rows() > 0) {
			$row = '';
			foreach ($data->result() as $v) {
				$jenis = $v->file_video == '' ? 'Youtube' : 'Local';
				$ak 	 = $v->publish == 'N' ? 'bg-red' : '';
				$ac 	 = $v->publish == 'N' ? '<span class="col-red m-l-5"><em class="glyphicon glyphicon-eye-close"></em>Tidak aktif</span>' : '';

				if ($v->file_video != '') {
					$show = '<video controls="false" class="video-responsive media-object m-b-5" width="140">
										<source src="' . $v->path . '" type="video/mp4">
										</video>
										<a href="' . $v->path . '" data-toggle="lightbox">
										Views
										</a>
										';
					$idget 	= "hapusvideo(" . $v->id_video . ",'" . $v->file_video . "','local')";
					$edit   = "editvideo(" . $v->id_video . ",'local')";
				} else {
					$show = '<a href="https://www.youtube.com/watch?v=' . $v->link_youtube . '" data-toggle="lightbox" data-type="youtube" data-width="800">
										<img class="' . $ak . ' media-object m-b-10" src="' . $v->path . '" width="140" height="100">
									</a>';
					$edit   = "editvideo(" . $v->id_video . ",'youtube')";
					$idget 	= "hapusvideo(" . $v->id_video . ",'" . $v->poster . "','youtube')";
				}

				$updated = $v->update_by != '' ? 'col-grey' : '';

				$row .= '<ul class="header-dropdown list-unstyled pull-right">
									
										<li class="dropdown">
												<a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
														<i class="material-icons font-18">more_vert</i>
												</a>
												<ul class="dropdown-menu pull-right">
														<li><a onclick="pidahvideo(' . $v->id_video . ',' . $v->fid_album_video . ')" href="javascript:void(0);"  class=" waves-effect waves-block"><span class="glyphicon glyphicon-move"></span>Pindah Album</a></li>
														<li><a onclick="' . $edit . '" href="javascript:void(0);" class=" waves-effect waves-block"><span class="glyphicon glyphicon-pencil"></span> Edit</a></li>
														<li><a onclick="' . $idget . '" href="javascript:void(0);" class=" waves-effect waves-block"><span class="glyphicon glyphicon-trash"></span> Hapus</a></li>
												</ul>
										</li>
								</ul>
								<div class="media">
									<div class="media-left">
										' . $show . '
									</div>

									<div class="media-body">
										
										<h4 class="media-heading ' . $updated . '">' . $v->judul . '</h4>
										<div class="col-teal font-12"><em class="glyphicon glyphicon-calendar"></em> ' . longdate_indo($v->tgl_publish) . ' <b class="col-red">|</b> <em class="glyphicon glyphicon-user"></em> by ' . $v->upload_by . ' <b class="col-red">@</b><b class="col-grey font-12">' . $jenis . '</b> ' . $ac . '
										</div>	
										<p class="m-t-10 d-block">
											' . $v->keterangan . '
										</p>
									</div>
									

								</div>';
			}
		} else {
			$row = '<p class="text-center">
						<img class="img-rounded" width="35%" src="' . base_url("assets/images/fitur/video-camera.png") . '" alt="video-camera">
						<h4 class="text-center">Video Studio BKPPD</h4>
						<p class="text-mutted text-center">Pilih album untuk menampilkan beberapa video</p>
					</p>';
		}

		echo json_encode($row);
	}
	//==========================================//	



	//==========================================//
	## Update Album 	
	public function update()
	{
		$fileName  = $_FILES['poster_e']['name'];
		$id = $this->input->post('id_albumvideo_e');
		$judul = $this->input->post('judul_e');
		$keterangan = $this->input->post('keterangan_e');
		$imgbefore  = $this->input->post('poster_video_e');
		$publish = $this->input->post('publish_e');

		$validate = array(
			array(
				'field' => 'judul_e',
				'label' => 'Judul',
				'rules' => 'required|trim|min_length[5]|max_length[35]'
			),
			array(
				'field' => 'publish_e',
				'label' => 'Publish',
				'rules' => 'required'
			)
		);
		$this->form_validation->set_rules($validate);

		$acak27 = generateRandomString(27);
		$date = date('Y-m-d');

		$files = $acak27;
		//init library upload
		$config['upload_path']      = './files/file_albumvideo/';
		$path_now 								  = site_url('/files/file_albumvideo/' . strtoupper(str_replace("/", "", $files)) . '.' . pathinfo($fileName, PATHINFO_EXTENSION));
		$config['allowed_types']    = 'jpg|jpeg|png';
		$config['max_size'] 				= '5120'; //maksimum besar file 5M
		$config['max_width'] 				= '360';
		$config['max_height'] 			= '240';
		$config['overwrite']				= true;
		$config['file_ext_tolower'] = true;
		$config['file_name'] 				= strtoupper($files); //nama yang terupload nantinya

		$this->load->library('upload', $config);
		if ($this->form_validation->run() == FALSE) {
			$msg['pesan'] = array('content' => validation_errors(), 'colmsg' => 'bg-red');
		} else {
			if (!empty($fileName)) {

				if (!$this->upload->do_upload('poster_e')) {
					$msg['pesan'] = array('content' => $this->upload->display_errors(), 'colmsg' => 'bg-red');
				} else {
					if (file_exists('./files/file_albumvideo/' . $imgbefore)) {
						unlink('./files/file_albumvideo/' . $imgbefore);
					}
					$values = [
						'judul' => $judul,
						'keterangan' => $keterangan,
						'poster' => strtoupper($this->upload->data('file_name')),
						'path' => $path_now,
						'publish' => $publish
					];
					$this->mvideo->update('t_album_video', $values, ['id_album_video' => $id]);
					$msg['pesan'] = array('file' => $path_now, 'content' => 'Album <b>' . $judul . '</b> Updated', 'colmsg' => 'bg-teal');
				}
			} else {
				$values = [
					'judul' => $judul,
					'keterangan' => $keterangan,
					'publish' => $publish
				];
				$this->mvideo->update('t_album_video', $values, ['id_album_video' => $id]);
				$msg['pesan'] = array('content' => 'Album <b>' . $judul . '</b> Updated', 'colmsg' => 'bg-teal');
			}
		}

		echo json_encode($msg);
	}
	//==========================================//	


	//==========================================//
	## Tambahkan  Album Video
	public function addByYoutube()
	{

		$fileName   = $_FILES['postervideo']['name'];
		$id 			  = $this->input->post('id_albumvideo');
		$judul 			= $this->input->post('judul');
		$keterangan = $this->input->post('keterangan_video');
		$link 			= $this->input->post('link_youtube');
		$pilihan 		= $this->input->post('pilihan');
		$publish 		= $this->input->post('publish');

		$config_validation = array(
			array(
				'field' => 'id_albumvideo',
				'label' => 'Album',
				'rules' => 'required'
			),
			array(
				'field' => 'judul',
				'label' => 'Judul Video',
				'rules' => 'required'
			),
			array(
				'field' => 'link_youtube',
				'label' => 'Youtube URL',
				'rules' => 'required'
			),
			array(
				'field' => 'publish',
				'label' => 'Publish',
				'rules' => 'required'
			),
			array(
				'field' => 'pilihan',
				'label' => 'Video Pilihan',
				'rules' => 'required'
			)
		);

		$this->form_validation->set_rules($config_validation);
		$acak27 = generateRandomString(27);
		$date = date('Y-m-d');

		$files = $acak27;
		//init library upload
		$path_now 								  = site_url('/files/file_poster/poster_video/youtube/' . strtoupper(str_replace("/", "", $files)) . '.' . pathinfo($fileName, PATHINFO_EXTENSION));
		$config['upload_path']      = './files/file_poster/poster_video/youtube/';
		$config['allowed_types']        = "png|jpg|jpeg|gif|PNG|JPG|JPEG";
		$config['max_size'] 				= '20048'; //maksimum besar file 2M
		$config['max_width'] 				= '1366';
		$config['max_height'] 			= '768';
		// $config['file_ext_tolower'] = true;
		$config['file_name'] 				= strtoupper($files); //nama yang terupload nantinya

		$this->load->library('upload', $config);
		if (!empty($id)) {
			if ($this->form_validation->run() == FALSE) {
				$msg['pesan'] = array('content' => validation_errors(), 'colmsg' => 'bg-red');
			} else {
				if (!$this->upload->do_upload('postervideo')) {
					$msg['pesan'] = array('content' => $this->upload->display_errors(), 'colmsg' => 'bg-red');
				} else {
					if (file_exists('./files/file_poster/poster_video/youtube/' . $files)) {
						unlink('./files/file_poster/poster_video/youtube/' . $files);
					}
					$values = [
						'fid_album_video' => $id,
						'judul' => $judul,
						'link_youtube' => $link,
						'poster' => strtoupper($this->upload->data('file_name')),
						'path' => $path_now,
						'keterangan' => $keterangan,
						'tgl_publish' => date('Y-m-d'),
						'publish' => $publish,
						'pilihan' => $pilihan,
						'upload_by' => $this->session->userdata('namalengkap')
					];
					$this->mvideo->add('t_video', $values);
					$msg['pesan'] = array('file' => $path_now, 'content' => 'Video <b>' . $judul . '</b> Added', 'colmsg' => 'bg-teal');
				}
			}
		} else {
			$msg['pesan'] = array('content' => 'Album belum dipilih', 'colmsg' => 'bg-red');
		}
		echo json_encode($msg);
	}
	//==========================================//	


	//==========================================//
	## Tambahkan  Album Video
	public function addByLocal()
	{

		$fileName  = $_FILES['file_video_local']['name'];
		$id = $this->input->post('idalbum');
		$judul = $this->input->post('judul');
		$keterangan = $this->input->post('keterangan');
		$pilihan = $this->input->post('pilihan');
		$publish = $this->input->post('publish');

		$config_validation = array(
			array(
				'field' => 'id_albumvideo',
				'label' => 'Album',
				'rules' => 'required'
			),
			array(
				'field' => 'judul',
				'label' => 'Judul Video',
				'rules' => 'required'
			),
			array(
				'field' => 'publish',
				'label' => 'Publish',
				'rules' => 'required'
			),
			array(
				'field' => 'pilihan',
				'label' => 'Video Pilihan',
				'rules' => 'required'
			)
		);
		$this->form_validation->set_rules($config_validation);
		$acak27 = generateRandomString(27);
		$date = date('Y-m-d');

		$files = $acak27;
		//init library upload
		set_time_limit(0);
		ini_set("upload_max_filesize", 25);
		$config['upload_path']      = './files/file_video/';
		$path_now 								  = site_url('/files/file_video/' . strtoupper(str_replace("/", "", $files)) . '.' . pathinfo($fileName, PATHINFO_EXTENSION));
		$config['allowed_types']    = 'mp4|mkv|flv';
		$config['max_size'] 				= '5456789'; //maksimum besar file 3.3 MB
		$config['file_ext_tolower'] = true;
		$config['file_name'] 				= strtoupper($files); //nama yang terupload nantinya

		$this->load->library('upload', $config);
		if (!empty($id)) {
			if ($this->form_validation->run() == FALSE) {
				$msg['pesan'] = array('content' => validation_errors(), 'colmsg' => 'bg-red');
			} else {
				if (!$this->upload->do_upload('file_video_local')) {
					$msg['pesan'] = array('content' => $this->upload->display_errors(), 'colmsg' => 'bg-red');
				} else {
					if (file_exists('./files/file_video/' . $files)) {
						unlink('./files/file_video/' . $files);
					}
					$values = [
						'judul' => $judul,
						'fid_album_video' => $this->input->post('id_albumvideo'),
						'file_video' => strtoupper($this->upload->data('file_name')),
						'path' => $path_now,
						'keterangan' => $keterangan,
						'publish' => $publish,
						'tgl_publish' => date('Y-m-d'),
						'pilihan' => $pilihan,
						'upload_by' => $this->session->userdata('namalengkap')
					];
					$this->mvideo->add('t_video', $values);
					$msg['pesan'] = array('content' => 'Video <b>' . $judul . '</b> Added', 'colmsg' => 'bg-teal');
				}
			}
		} else {
			$msg['pesan'] = array('content' => 'Album belum dipilih', 'colmsg' => 'bg-red');
		}
		echo json_encode($msg);
	}
	//==========================================//	


	//==========================================//
	## Hapus Album Video
	public function hapus()
	{
		$tbl = 't_album_video';
		$where = [
			'id_album_video' => $this->input->post('id'),
			'poster' => $this->input->post('file')
		];

		$path = './files/file_albumvideo/';
		if (file_exists($path . $this->input->post('file'))) {
			unlink($path . $this->input->post('file'));
			$this->mvideo->hapus_album($tbl, $where);
			$msg['pesan'] = ['type' => 'bg-teal', 'content' => 'Success Deleted', 'stsText' => true];
		} else {
			$msg['pesan'] = ['type' => 'bg-pink', 'content' => 'Error Deleted', 'stsText' => false];
		}
		$json = json_encode($msg);
		echo $json;
	}
	//==========================================//


	//==========================================//
	## Hapus Video
	public function hapusvideo($id, $file, $jenis)
	{
		$tbl = 't_video';
		$where = [
			'id_video' => $id
		];

		if ($jenis === 'local') {
			$path = './files/file_video/';
		} else {
			$path = './files/file_poster/poster_video/youtube/';
		}

		if (file_exists($path . $file)) {
			unlink($path . $file);
			$this->mvideo->hapus_video($tbl, $where);
			$msg['pesan'] = ['type' => 'bg-teal', 'content' => 'Success Deleted', 'stsText' => true];
		} else {
			$msg['pesan'] = ['type' => 'bg-pink', 'content' => 'Error Deleted', 'stsText' => false];
		}
		$json = json_encode($msg);
		echo $json;
	}
	//==========================================//

	//==========================================//
	## Pindah Video Ke Album Lain
	public function pindah_video()
	{
		$id = $this->input->get('id');
		$album = $this->input->get('albumid');

		$whr = [
			'id_video' => $id
		];

		$set = [
			'fid_album_video' => $album
		];

		$send = $this->db->update('t_video', $set, $whr);
		if ($send) {
			$msg[] = array('type' => 'bg-teal', 'content' => 'Video Terpindah');
		} else {
			$msg[] = array('type' => 'bg-red', 'content' => 'Video Gagal Dipindah');
		}

		echo json_encode($msg);
	}
	//==========================================//


	//==========================================//
	## EDIT VIDEO YOUTUBE 	
	public function edit_youtubevideo($id)
	{
		$data = $this->db->get_where('t_video', array('id_video' => $id))->result();
		echo json_encode($data);
	}
	//==========================================//

	//==========================================//
	## EDIT VIDEO LOCAL 	
	public function edit_localvideo($id)
	{
		$data = $this->db->get_where('t_video', array('id_video' => $id))->result();
		echo json_encode($data);
	}
	//==========================================//	


	//==========================================//
	## Update Video Youtube 	
	public function update_videoyoutube()
	{
		$fileName  	= $_FILES['poster_videoyoutube']['name'];
		$imgbefore  = $this->input->post('imgBeforeYoutube');

		$id 				= $this->input->post('videoidYoutube');
		$judul 			= $this->input->post('judul_videoyoutube');
		$keterangan = $this->input->post('keterangan_videoyoutube');
		$publish 		= $this->input->post('publish_videoyoutube');
		$pilihan 		= $this->input->post('pilihan_videoyoutube');
		$url		 		= $this->input->post('url_videoyoutube');

		$acak27 		= generateRandomString(27);
		$date 			= date('Y-m-d');

		$files 			= $acak27;

		//init library upload
		$config['upload_path']      = './files/file_poster/poster_video/youtube/';
		$path_now 								  = site_url('/files/file_poster/poster_video/youtube/' . strtoupper(str_replace("/", "", $files)) . '.' . pathinfo($fileName, PATHINFO_EXTENSION));
		$config['allowed_types']    = 'png|jpg|jpeg|gif|PNG|JPG|JPEG';
		$config['max_size'] 				= '5120'; //maksimum besar file 5M
		$config['max_width'] 				= '1366';
		$config['max_height'] 			= '768';
		$config['overwrite']				= false;
		$config['file_ext_tolower'] = true;
		$config['file_name'] 				= strtoupper($files); //nama yang terupload nantinya

		$this->load->library('upload', $config);

		if (!empty($fileName)) {
			if (!$this->upload->do_upload('poster_videoyoutube')) {
				$msg['data'] = array(
					'message' => $this->upload->display_errors(),
					'colmsg' => 'red',
					'iconmsg' => 'info'
				);
			} else {
				if (file_exists('./files/file_poster/poster_video/youtube/' . $imgbefore)) {
					unlink('./files/file_poster/poster_video/youtube/' . $imgbefore);
				}
				$values = [
					'judul' => $judul,
					'link_youtube' => $url,
					'poster' => strtoupper($this->upload->data('file_name')),
					'path' => $path_now,
					'keterangan' => $keterangan,
					'publish' => $publish,
					'pilihan' => $pilihan,
					'update_by' => $this->session->userdata('namalengkap')
				];
				$this->mvideo->updatevideo('t_video', $values, ['id_video' => $id]);
				$msg['data'] = array(
					'file' => $path_now,
					'iconmsg' => 'done_all',
					'message' => 'Video <b>' . $judul . '</b> Updated',
					'colmsg' => 'teal',
					'id_youtube_url' => $url
				);
			}
		} else {
			$values = [
				'judul' => $judul,
				'link_youtube' => $url,
				'keterangan' => $keterangan,
				'publish' => $publish,
				'pilihan' => $pilihan,
				'update_by' => $this->session->userdata('namalengkap')
			];

			$this->mvideo->updatevideo('t_video', $values, ['id_video' => $id]);
			$msg['data'] = array(
				'message' => 'Video <b>' . $judul . '</b> Updated',
				'file' => site_url('/files/file_poster/poster_video/youtube/' . $imgbefore),
				'iconmsg' => 'done',
				'colmsg' => 'teal',
				'id_youtube_url' => $url
			);
		}
		echo json_encode($msg);
	}
	//==========================================//	


	//==========================================//
	## Update Video Local 	
	public function update_videolocal()
	{
		$fileName  	= $_FILES['file_videolocal']['name'];
		$filebefore  = $this->input->post('fileBeforeLocal');

		$id 				= $this->input->post('videoidLocal');
		$judul 			= $this->input->post('judul_videolocal');
		$keterangan = $this->input->post('keterangan_videolocal');
		$publish 		= $this->input->post('publish_videolocal');
		$pilihan 		= $this->input->post('pilihan_videolocal');

		$acak27 		= generateRandomString(27);
		$date 			= date('Y-m-d');

		$files 			= $acak27;

		//init library upload
		$config['upload_path']      = './files/file_video/';
		$path_now 								  = site_url('/files/file_video/' . strtoupper(str_replace("/", "", $files)) . '.' . pathinfo($fileName, PATHINFO_EXTENSION));
		$config['allowed_types']    = 'mp4|mkv|flv';
		$config['max_size'] 				= '3456789'; //maksimum besar file 3.3 MB
		$config['file_ext_tolower'] = true;
		$config['file_name'] 				= strtoupper($files); //nama yang terupload nantinya

		$this->load->library('upload', $config);

		if (!empty($fileName)) {
			if (!$this->upload->do_upload('file_videolocal')) {
				$msg['data'] = array(
					'message' => $this->upload->display_errors(),
					'colmsg' => 'red',
					'iconmsg' => 'info'
				);
			} else {
				if (file_exists('./files/file_video/' . $filebefore)) {
					unlink('./files/file_video/' . $filebefore);
				}
				$values = [
					'judul' => $judul,
					'file_video' => strtoupper($this->upload->data('file_name')),
					'path' => $path_now,
					'keterangan' => $keterangan,
					'publish' => $publish,
					'pilihan' => $pilihan,
					'update_by' => $this->session->userdata('namalengkap')
				];
				$this->mvideo->updatevideo('t_video', $values, ['id_video' => $id]);
				$msg['data'] = array(
					'file' => $path_now,
					'iconmsg' => 'done_all',
					'message' => 'Video <b>' . $judul . '</b> Updated',
					'colmsg' => 'teal'
				);
			}
		} else {
			$values = [
				'judul' => $judul,
				'keterangan' => $keterangan,
				'publish' => $publish,
				'pilihan' => $pilihan,
				'update_by' => $this->session->userdata('namalengkap')
			];

			$this->mvideo->updatevideo('t_video', $values, ['id_video' => $id]);
			$msg['data'] = array(
				'message' => 'Video <b>' . $judul . '</b> Updated',
				'file' => site_url('/files/file_video/' . $filebefore),
				'iconmsg' => 'done',
				'colmsg' => 'teal'
			);
		}
		echo json_encode($msg);
	}
	//==========================================//	

}
