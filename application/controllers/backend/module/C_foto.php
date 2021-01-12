<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_foto extends CI_Controller {
	public function __construct() 
	{
    parent::__construct();
		$this->load->helper('createdimage');
		$this->load->model('M_b_foto', 'mfoto');
		$this->load->library('image_lib');
    _is_logged_in();
  }

  //==========================================//
  ## Halaman Galeri Foto 
	public function index()
	{
    $data = [
				'content' => 'Backend/__module/___Foto/v_table',
				'scriptjs' => 'Backend/__ServerSideJs/Foto/s_foto',
				'pageinfo' => '<li>Dasboard</li><li class="active">Galeri Foto</li>',
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
  ## Halaman Add Album 
	public function add()
	{
    $data = [
				'content' => 'Backend/__module/___Foto/v_tambah',
				'scriptjs' => 'Backend/__ServerSideJs/Foto/s_foto',
				'pageinfo' => '<li> Dasboard</li><li> Galeri</li><li class="active">Add Album Foto</li>',
				'css' => [
					'assets/plugins/waitme/waitMe.css',
					'assets/plugins/lightbox/ekko-lightbox.css',
					'assets/plugins/bootstrap-select/css/bootstrap-select.css'
				],
				'js' => [
					'assets/plugins/waitme/waitMe.js',
					'assets/plugins/jquery-validation/jquery.validate.js',
					'assets/plugins/jquery-validation/additional-methods.js',
					'assets/plugins/bootstrap-select/js/bootstrap-select.js',
					'assets/plugins/lightbox/ekko-lightbox.min.js'
				]
		];
		$this->load->view('Backend/v_home', $data);
  }
	//==========================================//



// ################################ START ALBUM ################################ 
  //==========================================//
  ## Pilihan Album 
	public function select_album() {
		$album = $this->mfoto->sel_album()->result();
		if(count($album) > 0) {
			$row = '<option value="0">Pilih Album</option>';
			foreach($album as $v) {
				$col = $v->publish == 'N' ? 'col-red' : '';
				$row .= '<option value="'.$v->id_album_foto.'" class="'.$col.'">'.$v->judul.'</option>';
			}
		} else {
				$row = '<option value="0">Album Kosong</option>';
		}

		echo json_encode($row);
	}
	//==========================================//

  //==========================================//
  ## Pilihan Album Terpilih 	
	public function select_curent_album($id) {
		$data = $this->mfoto->sc_album('t_album_foto', $id)->result();
		echo json_encode($data);
	}
  //==========================================//

  //==========================================//
  ## Tambah Album
	public function addphoto() {
		$fileName  = $_FILES['gbr_album']['name'];
		$fileName_blob    = file_get_contents($_FILES['gbr_album']['tmp_name']);

		$acak27 = generateRandomString(27);
		$date = date('Y-m-d');

		$jdl = $this->input->post('judul');

		$files = "bkppdbalangan_".str_replace(" ","",$jdl)."_".$acak27;
		//init library upload
		$config['upload_path']      = './files/file_album/';
		$path_now 								  = site_url('./files/file_album/'.strtoupper(str_replace("/","",$files)).'.'.pathinfo($fileName, PATHINFO_EXTENSION));
		$config['allowed_types']    = 'jpg|jpeg|png';
		$config['max_size'] 				= '5120'; //maksimum besar file 5M
		$config['max_width'] 				= '1366';
		$config['overwrite']				= true;
		$config['file_ext_tolower'] = true;
		$config['file_name'] 				= strtoupper($files); //nama yang terupload nantinya

		$this->load->library('upload', $config);
		if (!$this->upload->do_upload('gbr_album')) {
			$msg['pesan'] = array('error' => $this->upload->display_errors(), 'stsText' => false, 'stsCode' => 304);
		} else {
				if (file_exists('./files/file_album/'.$files)) {
					unlink('./files/file_album/'.$files);
				}
				$values = [
					'judul' => $jdl,
					'keterangan' => $this->input->post('keterangan'),
					'gambar' => strtoupper($this->upload->data('file_name')),
					'gambar_blob' => $fileName_blob,
					'path' => $path_now,
					'publish' => $this->input->post('publish'),
					'tgl_publish' => date('Y-m-d'),
					'upload_by' => $this->session->userdata('user'),
					'upload_at' => date('Y-m-d H:i:s')
				];

				$this->mfoto->addphoto('t_album_foto', $values);
				$msg['pesan'] = array(
					'file' => $path_now, 
					'stsText' => true, 
					'content' => 'Album <b>'.$this->input->post('judul').'</b> Added'
				);
		}	
		
		echo json_encode($msg);

	}
  //==========================================//

	//==========================================//
  ## Update Album Photo
	public function updatealbum($id) {
		$judul   = $this->input->post('judul');
		$ket     = $this->input->post('keterangan');
		$publish = $this->input->post('publish');
		$gambar  = $this->input->post('gbr_album');
		$gambarlama = $this->input->post('gbrlama');

		$fileName  		 = $_FILES['gbr_album']['name'];
		$fileName_blob = file_get_contents($_FILES['gbr_album']['tmp_name']);
		if(($fileName != '')) {
			$acak27 = generateRandomString(27);
			$date = date('Y-m-d');

			$files = "bkppdbalangan_".str_replace(" ","",$judul)."_".$acak27;	
			//init library upload
			$config['upload_path']      = './files/file_album/';
			$path_now 								  = site_url('/files/file_album/'.strtoupper(str_replace("/","",$files)).'.'.pathinfo($fileName, PATHINFO_EXTENSION));
			$config['allowed_types']    = 'jpg|jpeg|png';
			$config['max_size'] 				= '5120'; //maksimum besar file 5M
			$config['max_width'] 				= '1366';
			$config['overwrite']				= false;
			$config['file_ext_tolower'] = true;
			$config['file_name'] 				= strtoupper($files); //nama yang terupload nantinya

			$this->load->library('upload', $config);			
			if (!$this->upload->do_upload('gbr_album')) {
				$msg['pesan'] = array('error' => $this->upload->display_errors(), 'stsText' => false, 'stsCode' => 304);
			} else {
					//HAPUS FILE LAMA
					if (file_exists('./files/file_album/'.$gambarlama)) {
						unlink('./files/file_album/'.$gambarlama);
					}
					$values = [
						'judul' =>  $judul,
						'keterangan' => $ket,
						'gambar' => strtoupper($this->upload->data('file_name')),
						'gambar_blob' => $fileName_blob,
						'path' => $path_now,
						'publish' => $publish,
						'tgl_publish' => date('Y-m-d'),
						'update_by' => $this->session->userdata('user'),
						'update_at' => date('Y-m-d H:i:s')
					];
					$this->mfoto->updatefoto('t_album_foto', $values, ['id_album_foto' => $id]);
					$msg['pesan'] = array(
								'file' => $path_now, 
								'stsText' => true, 
								'content' => 'Album <b>'.$judul.'</b> Updated'
					);
			}				
		} else {
			$set = [
				'judul' => $judul,
				'keterangan' => $ket,
				'publish' => $publish,
				'tgl_publish' => date('Y-m-d'),
				'update_by' => $this->session->userdata('user'),
				'update_at' => date('Y-m-d H:i:s')
			];
			$whr = [
				'id_album_foto' => $id
			];
			$this->mfoto->updatefoto('t_album_foto', $set, $whr);
			$msg['pesan'] = array(
					'stsText' => true, 
					'stsCode' => 200, 
					'file' => site_url('files/file_album/'.$gambarlama),
					'content' => 'Album <b>'.$judul.'</b> Updated'
			);
		}
		echo json_encode($msg);
	}
	//==========================================//

	//==========================================//
  ## Update Album Depan
	public function updatealbumdepan() {
		$id   = $this->input->post('editalbumid');
		$judul   = $this->input->post('judul_album');
		$ket     = $this->input->post('keterangan_album');
		$publish = $this->input->post('publish_album');
		$gambar  = $this->input->post('fotoalbum');
		$gambarlama = $this->input->post('gbralbumbefore');

		$fileName  = $_FILES['fotoalbum']['name'];
		if(($fileName != '')) {
			$fileName_blob = file_get_contents($_FILES['fotoalbum']['tmp_name']);
			$acak27 = generateRandomString(27);
			$date = date('Y-m-d');

			$files = "bkppdbalangan_".str_replace(" ","",$judul)."_".$acak27;	
			//init library upload
			$config['upload_path']      = './files/file_album/';
			$path_now 								  = site_url('/files/file_album/'.strtoupper(str_replace("/","",$files)).'.'.pathinfo($fileName, PATHINFO_EXTENSION));
			$config['allowed_types']    = 'jpg|jpeg|png';
			$config['max_size'] 				= '5120'; //maksimum besar file 5M
			$config['max_width'] 				= '1366';
			$config['overwrite']				= false;
			$config['file_ext_tolower'] = true;
			$config['file_name'] 				= strtoupper($files); //nama yang terupload nantinya

			$this->load->library('upload', $config);			
			if (!$this->upload->do_upload('fotoalbum')) {
				$msg['pesan'] = array('bg' => 'bg-red', 'content' => $this->upload->display_errors(), 'sts' => false);
			} else {
					//HAPUS FILE LAMA
					if (file_exists('./files/file_album/'.$gambarlama)) {
						unlink('./files/file_album/'.$gambarlama);
					}
					$values = [
						'judul' =>  $judul,
						'keterangan' => $ket,
						'gambar' => strtoupper($this->upload->data('file_name')),
						'gambar_blob' => $fileName_blob,
						'path' => $path_now,
						'publish' => $publish,
						'tgl_publish' => date('Y-m-d'),
						'update_by' => $this->session->userdata('user'),
						'update_at' => date('Y-m-d H:i:s')
					];
					$this->mfoto->updatefoto('t_album_foto', $values, ['id_album_foto' => $id]);
					$msg['pesan'] = array(
								'bg' => 'bg-teal',
								'file' => $path_now, 
								'sts' => true, 
								'content' => 'Album <b>'.$judul.'</b> Updated',
								'judul' => $judul
					);
			}				
		} else {
			$set = [
				'judul' => $judul,
				'keterangan' => $ket,
				'publish' => $publish,
				'tgl_publish' => date('Y-m-d'),
				'update_by' => $this->session->userdata('user'),
				'update_at' => date('Y-m-d H:i:s')
			];
			$whr = [
				'id_album_foto' => $id
			];
			$this->mfoto->updatefoto('t_album_foto', $set, $whr);
			$msg['pesan'] = array(
					'bg' => 'bg-teal',
					'sts' => true,  
					'file' => site_url('files/file_album/'.$gambarlama),
					'content' => 'Album <b>'.$judul.'</b> Updated',
					'judul' => $judul
			);
		}
		echo json_encode($msg);
	}
	//==========================================//

	//==========================================//
  ## Hapus Album Photo
	public function hapus($id, $file) {
		$tbl = 't_album_foto';
		$where = [
			'id_album_foto' => $id,
			'gambar' => $file
		];

		$path = './files/file_album/';
		if(file_exists($path.$file)) {
			unlink($path.$file);
			$this->mfoto->hapus_album($tbl,$where);
			$msg['pesan'] = ['type' => 'bg-teal', 'content' => 'Success Deleted', 'stsText' => true];
		} else {
			$msg['pesan'] = ['type' => 'bg-pink', 'content' => 'Error Deleted', 'stsText' => false];
		}
		$json = json_encode($msg);
		echo $json;		
	}
	//==========================================//
	// ################################ END ALBUM ################################ 


	//==========================================//
  ## Tambahkan Galeri Photo
	public function addgaleri() {
		$fileName  = $_FILES['foto']['name'];
		$fileName_blob = file_get_contents($_FILES['foto']['tmp_name']);

		$judul = $this->input->post('judul_galeri');
		$acak27 = generateRandomString(27);
		$date = date('Y-m-d');

		$files = "bkppdbalangan_".str_replace(" ","",$judul)."_".$acak27;	
		//init library upload
		$config['upload_path']      = './files/file_galeri/';
		$path_now 								  = site_url('/files/file_galeri/'.strtoupper(str_replace("/","",$files)).'.'.pathinfo($fileName, PATHINFO_EXTENSION));
		$config['allowed_types']    = 'jpg|jpeg|png';
		$config['max_size'] 				= '5120'; //maksimum besar file 5M
		$config['max_width'] 				= '1366';
		$config['overwrite']				= true;
		$config['file_ext_tolower'] = true;
		$config['file_name'] 				= strtoupper($files); //nama yang terupload nantinya

		$this->load->library('upload', $config);
		if($this->input->post('idalbumadd') != 0) {
			if (!$this->upload->do_upload('foto')) {
				$msg['pesan'] = array('content' => $this->upload->display_errors(), 'stsText' => 'bg-red', 'stsCode' => 304);
			} else {
					if (file_exists('./files/file_galeri/'.$files)) {
						unlink('./files/file_galeri/'.$files);
					}
					$values = [
						'fid_album_foto' => $this->input->post('idalbumadd'),
						'judul' => $this->input->post('judul_galeri'),
						'keterangan' => $this->input->post('keterangan_galeri'),
						'gambar' => strtoupper($this->upload->data('file_name')),
						'gambar_blob' => $fileName_blob,
						'path' => $path_now,
						'publish' => $this->input->post('publish_galeri'),
						'tgl_publish' => date('Y-m-d'),
						'upload_by' => $this->session->userdata('user')
					];
					
					//function image_lib ci 
					$this->watermark($this->upload->data('file_name'));
					$this->resizeImage($this->upload->data('file_name'));

					$this->mfoto->addgaleri('t_foto', $values);
					$msg['pesan'] = array(
						'file' => $path_now, 
						'stsText' => 'bg-teal', 
						'stsCode' => 200,
						'content' => 'Galeri <b>'.$this->input->post('judul').'</b> Added'
					);
			}	
		} elseif($this->input->post('judul_galeri') == '') {
			$msg['pesan'] = array('content' => 'Judul galeri tidak boleh kosong', 'stsText' => 'bg-pink');
		} elseif($this->input->post('publish_galeri') == '') {
			$msg['pesan'] = array('content' => 'Publish belum dipillih', 'stsText' => 'bg-pink');
		} else {
			$msg['pesan'] = array('content' => 'Album belum dipilih', 'stsText' => 'bg-orange');
		}	
		echo json_encode($msg);		
	}	
	//==========================================//

	//==========================================//
  ## Tambahkan Galeri Photo Pada Album ID
	public function addgaleridepan() {
		$fileName  = $_FILES['foto']['name'];
		$fileName_blob = file_get_contents($_FILES['foto']['tmp_name']);

		$judul = $this->input->post('judul_galeri');
		$acak27 = generateRandomString(27);
		$date = date('Y-m-d');
		$fid_album = $this->input->post('idalbum');

		$files = "bkppdbalangan_".str_replace(" ","",$judul)."_".$acak27;	
		//init library upload
		$config['upload_path']      = './files/file_galeri/';
		$path_now 								  = site_url('/files/file_galeri/'.strtoupper(str_replace("/","",$files)).'.'.pathinfo($fileName, PATHINFO_EXTENSION));
		$config['allowed_types']    = 'jpg|jpeg|png|JPG|PNG|JPEG';
		$config['max_size'] 				= '5120'; //maksimum besar file 5M
		// $config['max_width'] 				= '1366';
		$config['overwrite']				= true;
		$config['file_ext_tolower'] = true;
		$config['file_name'] 				= strtoupper($files); //nama yang terupload nantinya

		$this->load->library('upload', $config);
		if($this->input->post('idalbum') == '' ) {
			$msg['pesan'] = array('content' => 'Album belum dipilih', 'type' => 'orange');
		} elseif($this->input->post('judul_galeri') == '') {
			$msg['pesan'] = array('content' => 'Judul galeri tidak boleh kosong', 'type' => 'red');
		} elseif($this->input->post('publish_galeri') == '') {
			$msg['pesan'] = array('content' => 'Publish belum dipillih', 'type' => 'red');
		} else {
			if (!$this->upload->do_upload('foto')) {
				$msg['pesan'] = array('content' => $this->upload->display_errors(), 'type' => 'red');
			} else {
					if (file_exists('./files/file_galeri/'.$files)) {
						unlink('./files/file_galeri/'.$files);
					}
					$values = [
						'fid_album_foto' => $fid_album,
						'judul' => $this->input->post('judul_galeri'),
						'keterangan' => $this->input->post('keterangan_galeri'),
						'gambar' => strtoupper($this->upload->data('file_name')),
						'gambar_blob' => $fileName_blob,
						'path' => $path_now,
						'publish' => $this->input->post('publish_galeri'),
						'tgl_publish' => date('Y-m-d'),
						'upload_by' => $this->session->userdata('user')
					];
					
					//fungsi tambahan gambar 
					$this->watermark($this->upload->data('file_name'));
					$this->resizeImage($this->upload->data('file_name'));

					$this->mfoto->addgaleri('t_foto', $values);
					$msg['pesan'] = array(
						'file' => $path_now, 
						'type' => 'green', 
						'content' => 'Galeri <b>'.$judul.'</b> Added'
					);
			}		
		}	
		echo json_encode($msg);		
	}	
	//==========================================//


	//==========================================//
	## List Galeri Berdasarkan Album
	public function list_galeri() {
		$id = $this->input->get('idalbum');
	
		$data = $this->mfoto->list_galeri('t_foto', ['fid_album_foto' => $id, 'upload_by' => $this->session->userdata('user') ]);
			if(count($data) > 0) {
				$row = '';
				foreach($data as $v) {
					$bg = $v->publish == 'N' ? 'border-2 border-col-red' : '';
					$row .= '<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 m-b-10">
											<a href="'.$v->path.'"  data-toggle="lightbox" data-width="900" data-title="'.$v->judul.'" data-footer="'.$v->keterangan.'" data-gallery="example2">
													<img class="img-responsive thumbnail img-galeri '.$bg.'" src="'.base_url('files/file_galeri/thumb/'.$v->gambar).'">
											</a>
											<b>'.$v->judul.'</b>
											<br>
											<span class="col-grey font-11 m-b-10"><em class="glyphicon glyphicon-calendar"></em> '.longdate_indo($v->tgl_publish).' </span><br> <span class="badge badge-teal font-11 "><em class="glyphicon glyphicon-user"></em> '.$v->upload_by.' </span> 
											<a href="javascript:void(0);" class="pull-right" onclick="editfoto('.$v->id_foto.')"><em class="material-icons font-18 pull-left m-r-5 col-grey waves-effect">mode_edit</em></a> 
											
									</div>';
				}
			} else {
				$row = '<div class="inner-content">
										<div class="text-center col-grey">
											<em class="font-30 material-icons">find_in_page</em><br> GALERI KOSONG
										</div>
								</div>';
			}
			echo json_encode($row); 
		}
	//==========================================//
		
		
	//==========================================//
	## List Galeri Depan
	public function list_galeri_depan() {
		$id = $this->input->get('idalbum');
	
		$data = $this->mfoto->list_galeri('t_foto', ['fid_album_foto' => $id ]);
			if(count($data) > 0) {
				$row = '';
				foreach($data as $v) {
					$bg = $v->publish == 'N' ? 'border-2 border-col-red' : '';
					$col = $v->publish == 'N' ? '<span class="col-red font-11 m-r-5 pull-right"><em class="glyphicon glyphicon-eye-close"></em></span>' : '';

					if($v->keterangan != '') {
						$pathSrc = '<br><a target=\'_blank\' href=\''.strtolower($v->path).'\'>'.strtolower($v->gambar).'</a>';
					} else {
						$pathSrc = '<a target=\'_blank\' href=\''.strtolower($v->path).'\'>'.strtolower($v->gambar).'</a>';
					}
					$img_ori 	 = base_url('files/file_galeri/'.strtolower($v->gambar));
					$img_thumb = base_url('files/file_galeri/thumb/'.$v->gambar);
					$row .= '<div class="col-lg-2 col-md-2 col-sm-4 col-xs-12 m-b-10">
					
														
											<a href="'.$img_ori.'" data-toggle="lightbox" data-title="'.$v->judul.'" data-footer="'.$v->keterangan.''.$pathSrc.'" data-gallery="example">
												<img class="img-responsive thumbnail img-galeri m-t-10" src="'.$img_thumb.'">
											</a>
											<div class="col-grey font-12 m-b-5"><em class="glyphicon glyphicon-calendar"></em> '.longdate_indo($v->tgl_publish).' </div>
											<ul class="header-dropdown pull-left list-unstyled">
												<li class="dropdown">
														<a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
																<i class="material-icons font-16">more_vert</i>
														</a>
														<ul class="dropdown-menu">
																<li><a href="javascript:void(0);" onclick="hapusGaleriDepan('.$v->id_foto.','.$id.',\''.$v->judul.'\',\''.$v->gambar.'\')" class="waves-effect waves-block">Hapus</a></li>
																<li><a href="javascript:void(0);" onclick="pindahAlbum('.$v->id_foto.','.$id.',\''.$v->judul.'\',\''.$img_ori.'\')" class=" waves-effect waves-block">Pindah Album</a></li>
														</ul>
												</li>
										</ul>
											<b class="col-blue-grey font-14">'.substr(strip_tags($v->judul),0,15).' ...</b>
											
											<br>
											'.$col.'
									</div>';

									// <em class="glyphicon glyphicon-user"></em> '.ucwords($v->upload_by).' UPLOAD BY
				}
			} else {
				$row = '<div class="col-lg-2 col-md-2 col-sm-6 col-xs-12 text-center p-t-35 p-b-35 border-dot border-1 border-col-grey m-l-15">
				<em class="material-icons">find_in_page</em> <br> Galeri Kosong
			</div>';
			}
			echo json_encode($row); 
		}
		//==========================================//


	//==========================================//
	## Edit Galeri Berdasarkan Album
	public function edit_galeri($id) {
		$edit = $this->mfoto->getGaleriById('t_foto', ['id_foto' => $id])->result();
		if($edit) {
			$msg['responses'] = ['data' => $edit, 'pesan' => true]; 
		} else {
			$msg['responses'] = ['data' => 'Error Responses', 'pesan' => false];
		}
		echo json_encode($msg);
	}
	//==========================================//

	//==========================================//
	## Edit Album Depan
	public function edit_album_depan($id) {
		$edit = $this->mfoto->getAlbumById('t_album_foto', ['id_album_foto' => $id])->result();
		echo json_encode($edit);
	}
	//==========================================//

	//==========================================//
	## List Album	
	public function list_album() {
		$album = $this->mfoto->list_album()->result();
		if(count($album) > 0) {
			$row = '';
			foreach($album as $v) {
				
				$border = $v->publish == 'N' ? 'bg-red' : 'bg-grey';
				$title = $v->publish == 'N' ? '<em class="material-icons font-16 m-t-5 col-red">visibility_off</em>' : '';
				$jml 		= $v->jml_galeri_in_album > 0 ? $j = $v->jml_galeri_in_album : $j = 0; 

				$row .= '<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
									<a href="javascript:void(0)" onclick="list_galeri_depan('.$v->id_album_foto.',\''.$v->judul.'\')">
										<img class="img-responsive thumbnail '.$border.'" src="'.site_url("files/file_album/".$v->gambar).'" width="100%" style="max-height:310px;">
									</a>
									<em class="material-icons font-18 pull-left m-r-5 col-grey">style</em> <span class="col-grey font-12"><b>'.$jml.'</b> Foto</span> <span class="pull-right ">'.$title.'</span> <div class="clearfix"></div>
									<b class="col-black">'.ucwords($v->judul).'</b> 
								</div>';
			}
		} else {
				$row = '<div class="col-lg-2 col-md-2 col-sm-6 col-xs-12 text-center p-t-50 p-b-50 m-l-15">
									<em class="material-icons">find_in_page</em> <br> Album Kosong
								</div>';
		}

		echo json_encode($row);		
	}
	//==========================================//

	public function pindahalbum($fid_album) {
		$db = $this->mfoto->sel_album();
		if($db->num_rows() > 0) {
			$r = $db->result();
			$html = '<select class="form-control" name="nm_pindahfoto">';
			foreach($r as $q) {
				$select = ($fid_album == $q->id_album_foto) ? 'selected' : ''; 
				$html .= '<option value="'.$q->id_album_foto.'" '.$select.'>'.$q->judul.'</option>';
			}
			$html .= '</select>';
		}
		echo $html;
	}

	public function updatepindah() {
		$myfoto	 = $this->input->post('myfoto');
		$myalbum = $this->input->post('myalbum');
		
		$val = [
      'fid_album_foto' => $myalbum,
    ];

    $whr = [
      'id_foto' => $myfoto
    ];

    $send = $this->mfoto->updatepindah('t_foto',$val,$whr);
		// $data = ['msg' => "FOTO ".$myfoto."To ". $myalbum];
		if($send == TRUE) {
			$msg = ['msg' => $myfoto .' DIPENDAH KE '. $myalbum];
		} else {
			$msg = ['msg' => 'Error Moves'];
		}
		echo json_encode($msg); 
	}
	

	//==========================================//
	## List History Galeri By User
	public function listGaleriByUser($values = "")
	{
		$user = $this->session->userdata('user');
		if($values != "")
		{
			$history = $this->mfoto->listGaleriByUser($values, $user)->result();
			if(count($history) > 0)
			{
				$row = '';
				foreach($history as $h)
				{
					if($h->keterangan != '') {
						$pathSrc = '<br><a target=\'_blank\' href=\''.strtolower($h->path).'\'>'.strtolower($h->gambar).'</a>';
					} else {
						$pathSrc = '<a target=\'_blank\' href=\''.strtolower($h->path).'\'>'.strtolower($h->gambar).'</a>';
					}

					$row .= '<div class="col-lg-4 col-md-4 col-sm-3 col-xs-12">
					<span class="col-grey font-11"><em class="glyphicon glyphicon-calendar"></em> '.mediumdate_indo($h->tgl_publish).' </span>
										<a href="'.base_url('files/file_galeri/'.$h->gambar).'" data-toggle="lightbox" data-footer="'.$h->keterangan.''.$pathSrc.'"  data-title="'.ucwords($h->judul).'">
											<img class="img-responsive thumbnail img-galeri m-t-5" src="'.base_url('files/file_galeri/thumb/'.$h->gambar).'">
										</a>
									</div>';
				}
			} else {
				$row = '<div class="text-center col-grey">Tidak ditemukan <b>'.$values.'</b></div>';
			}
		} else {
			$history_null = $this->db->order_by('tgl_publish desc, id_foto desc')->get_where('t_foto', array('upload_by' => $user))->result(); 
			if(count($history_null) > 0)
			{
				$row = '';
				foreach($history_null as $v)
				{
					if($v->keterangan != '') {
						$pathSrc = '<br><a target=\'_blank\' href=\''.strtolower($v->path).'\'>'.strtolower($v->gambar).'</a>';
					} else {
						$pathSrc = '<a target=\'_blank\' href=\''.strtolower($v->path).'\'>'.strtolower($v->gambar).'</a>';
					}
					$row .= '<div class="col-lg-4 col-md-4 col-sm-3 col-xs-12">
					<span class="col-grey font-11"><em class="glyphicon glyphicon-calendar"></em> '.mediumdate_indo($v->tgl_publish).' </span>
										<a href="'.base_url('files/file_galeri/'.$v->gambar).'" data-toggle="lightbox" data-footer="'.$v->keterangan.''.$pathSrc.'" data-title="'.ucwords($v->judul).'">
											<img class="img-responsive thumbnail img-galeri m-t-5" src="'.base_url('files/file_galeri/thumb/'.$v->gambar).'">
										</a>
										
									</div>';
				}
			} else {
				$row = '<div class="text-center col-grey">Tidak Ada History</div>';
			}
		}

		
		echo json_encode($row);
	}
	
	//==========================================//
	
	//==========================================//
	## Update Galeri Photo
	public function updategaleri() 
	{
		$fileName  = $_FILES['gambar_e']['name'];
		$fileName_blob = file_get_contents($_FILES['gambar_e']['tmp_name']);

		$id				 = $this->input->post('idgaleri_e');
		$judul 		 = $this->input->post('judul_e');
		$ket 			 = $this->input->post('keterangan_e');
		$publish 	 = $this->input->post('publish_galeri_e');
		$filebefore= $this->input->post('file_e');
		$acak27 	 = generateRandomString(27);
		$date 		 = date('Y-m-d');

		$files = "bkppdbalangan_".str_replace(" ","",$judul)."_".$acak27;	
		//init library upload
		$config['upload_path']      = './files/file_galeri/';
		$path_now 								  = site_url('/files/file_galeri/'.strtoupper(str_replace("/","",$files)).'.'.pathinfo($fileName, PATHINFO_EXTENSION));
		$config['allowed_types']    = 'jpg|jpeg|png';
		$config['max_size'] 				= '5120'; //maksimum besar file 5M
		$config['max_width'] 				= '1366';
		$config['overwrite']				= true;
		$config['file_ext_tolower'] = true;
		$config['file_name'] 				= strtoupper($files); //nama yang terupload nantinya

		$this->load->library('upload', $config);
		if(!empty($fileName)) {
			if (!$this->upload->do_upload('gambar_e')) {
				$msg['response'] = array('content' => $this->upload->display_errors(), 'bg' => 'bg-red', 'sts' => false);
			} else {
					if (file_exists('./files/file_galeri/'.$filebefore)) {
						unlink('./files/file_galeri/'.$filebefore);
						unlink('./files/file_galeri/thumb/'.$filebefore);
					}
					
					$this->watermark($this->upload->data('file_name'));
					$this->resizeImage($this->upload->data('file_name'));

					$values = [
						'judul' => $judul,
						'keterangan' => $ket,
						'gambar' => strtoupper($this->upload->data('file_name')),
						'gambar_blob' => $fileName_blob,
						'path' => $path_now,
						'publish' => $publish,
						'update_by' => $this->session->userdata('user'),
						'update_at' => date('Y-m-d H:i:s')
					];
					$this->mfoto->updategaleri('t_foto', $values, ['id_foto' => $id]);
					$msg['response'] = array(
						'content' => 'Galeri <b>'.$judul.'</b> Updated', 
						'bg' => 'bg-teal', 
						'sts' => true
					);
			}	
		} else {
			$set = [
				'judul' => $judul,
				'keterangan' => $ket,
				'publish' => $publish,
				'tgl_publish' => date('Y-m-d'),
				'update_by' => $this->session->userdata('user'),
				'update_at' => date('Y-m-d H:i:s')
			];
			$whr = [
				'id_foto' => $id
			];
			$this->mfoto->updategaleri('t_foto', $set, $whr);
			$msg['response'] = array(
					'sts' => true,
					'bg' => 'bg-teal', 
					'content' => 'Foto <b>'.$judul.'</b> Updated'
			);
		}
		echo json_encode($msg);
	}
	//==========================================//

	//==========================================//
  ## Hapus Galeri Photo
	public function hapus_galeri($id, $file) {
		$tbl = 't_foto';
		$where = [
			'id_foto' => $id,
			'gambar' => $file
		];

		$path = './files/file_galeri/';
		$path_thumb = './files/file_galeri/thumb/';
		if(file_exists($path.$file)) {
			unlink($path.$file);
			unlink($path_thumb.$file);
			$this->mfoto->hapus_galeri($tbl,$where);
			$msg['pesan'] = ['type' => 'bg-teal', 'content' => 'Success Deleted', 'stsText' => true];
		} else {
			$msg['pesan'] = ['type' => 'bg-pink', 'content' => 'Error Deleted', 'stsText' => false];
		}
		$json = json_encode($msg);
		echo $json;		
	}
	//==========================================//

	//==========================================//
  ## Hapus Galeri Depan 
	public function hapus_galeri_depan($id, $judul, $file) {
		$tbl = 't_foto';
		$where = [
			'id_foto' => $id,
			'gambar' => $file
		];

		$path 			= './files/file_galeri/';
		$path_thumb = './files/file_galeri/thumb/';
		if(file_exists($path.$file)) {
			unlink($path.$file);
			unlink($path_thumb.$file);
			$this->mfoto->hapus_galeri_depan($tbl,$where);
			$msg['pesan'] = ['type' => 'bg-teal', 'content' => 'Success Deleted <b>'.$judul.'</b>', 'stsText' => true];
		} else {
			$msg['pesan'] = ['type' => 'bg-pink', 'content' => 'Error Deleted', 'stsText' => false];
		}
		$json = json_encode($msg);
		echo $json;		
	}
	//==========================================//

	public function watermark($filename) {
		$config['source_image'] = './files/file_galeri/'. $filename;
		$config['wm_text'] = 'http://web.bkppd-balangankab.info';
		$config['wm_type'] = 'text';
		$config['wm_font_size'] = '16';
		$config['wm_font_color'] = '#ffffff';
		$config['wm_vrt_alignment'] = 'bottom';
		$config['wm_hor_alignment'] = 'center';
		$config['wm_padding'] = '3';

		$this->image_lib->initialize($config);
		$this->image_lib->watermark();
	}

	public function resizeImage($filename)
	{
		
		$source_path = './files/file_galeri/' . $filename;
		$target_path = './files/file_galeri/thumb/'. $filename;
		$config = array(
				'image_library' => 'gd2',
				'source_image' => $source_path,
				'new_image' => $target_path,
				'create_thumb' => TRUE,
				'maintain_ratio' => FALSE,
				'width' => '200',
				'height' => '130'
		);
	
		$this->image_lib->initialize($config);
		$this->image_lib->resize();
	}

}