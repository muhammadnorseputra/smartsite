<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_banner extends CI_Controller {
	public function __construct() 
	{
    parent::__construct();
		$this->load->model('M_b_banner','mbanner');
    if(($this->session->userdata('status') != "ONLINE")){
			redirect("login");
		}

		/**
    * Manage uploadImage
    *
    * @return Response
   */
  }

  //==========================================//
  ## BANNER 
	public function index()
	{
    $data = [
				'content' => 'Backend/__Module/___Banner/v_table',
				'scriptjs' => 'Backend/__ServerSideJs/Banner/S_banner',
				'pageinfo' => '<li><a href="'.site_url("backend/c_admin").'"><i class="material-icons">dashboard</i> Dasboard</a></li>
							<li class="active">Banner</li>',
				'css' => [
					'assets/plugins/waitme/waitMe.css'
				],
				'js' => [
					'assets/plugins/waitme/waitMe.js'
				]
		];
		$this->load->view('Backend/v_home', $data);
  }
	//==========================================//

	//==========================================//
  ## LIST BANNER
  public function list_banner()
  {
    $data = $this->mbanner->list_banner('t_banner')->result();
    if(count($data) > 0)
    {
      $res = "";
      foreach($data as $v)
      {
				$active = $v->publish == 'N' ? '<b class="font-16 col-grey m-l-5 m-r-5">|</b>  <span class="col-red"><em class="glyphicon glyphicon-eye-close"></em> Tidak Aktif</span>' : '';
        $res .= '<div class="col-md-6">
					<div class="card card-shadow">
							<div class="header">
							<ul class="header-dropdown list-unstyled">
					
								<li class="dropdown">
									<a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
											<span class="glyphicon glyphicon-option-vertical m-t-5"></span>
									</a>
									<ul class="dropdown-menu pull-right">
										<li><a onclick="edit_banner('.$v->id_banner.')" href="javascript:void(0);"  class=" waves-effect waves-block"><span class="glyphicon glyphicon-pencil"></span>Edit</a></li>
										<li><a onclick="hapus_banner('.$v->id_banner.',\''.$v->gambar.'\',\''.ucwords($v->judul).'\')" href="javascript:void(0);" class=" waves-effect waves-block"><span class="glyphicon glyphicon-trash"></span> Hapus</a></li>
									</ul>
								</li>		
							</ul>	
								<h2 class="card-heading">'.$v->judul.' 
									<small><em class="glyphicon glyphicon-user"></em> '.$v->upload_by.'  
									<em class="glyphicon glyphicon-calendar m-l-5"></em> '.longdate_indo($v->tgl_publish).' '.$active.' </small>
									
							</h2>
								
							</div>
							<div class="body">
								<a href="http://'.$v->url.'" target="_blank"><img src="'.$v->path.'" class="border-1" width="100%"></a>
								<b class="pull-right m-t-10 font-12 col-grey">'.$v->jenis.' - '.$v->posisi.' <em class="material-icons font-16 pull-right m-l-5">styles</em> </b>
								<div class="clearfix"></div>
							</div>
							
					</div>
				</div>';
      }
    }
    else 
    {
      $res = '<div class="col-md-12 text-center font-24 col-grey"><em class="material-icons m-r-5">find_in_page</em>No Data</div>';
    }
    echo json_encode($res);
  }
	//==========================================// 

  //==========================================//
  ## PROSES TAMBAH BANNER 
	public function add()
	{
		//TAHAP SATU : AMBIL VALUE DARI INPUTAN
		$fileBanner 	 = $_FILES['gambar']['name'];
		$idJenisBanner = $this->input->post('idjns_banner');
		$judul 				 = $this->input->post('judul');
		$url  				 = $this->input->post('url');
		$publish 			 = $this->input->post('publish');

		//TAHAP DUA: VALIDASI SETIAP INPUTAN
		$config_validation = array(
			array(
							'field' => 'judul',
							'label' => 'Judul Banner',
							'rules' => 'required'
			),
			array(
							'field' => 'url',
							'label' => 'Url',
							'rules' => 'required'
			),
			array(
							'field' => 'publish',
							'label' => 'Publish',
							'rules' => 'required'
			)			
		);

		//TAHAP TIGA: SET VALIDASI
		$this->form_validation->set_rules($config_validation);
		
		//TAHAP EMPAT: CONFIG DATA UPLOAD DAN SIMPAN FILE 
		$acak27 = generateRandomString(27);
		$date   = date('Y-m-d');
		$files  = "bkppdbalangan_".strtolower($acak27);
			
		//INIT LIBRARY UPLOAD
		$config['upload_path']      = './files/file_banner/';
		$path_now 								  = site_url('/files/file_banner/'.str_replace("/","",$files).'.'.pathinfo($fileBanner, PATHINFO_EXTENSION));
		$config['allowed_types']    = 'jpg|jpeg|png';
		$config['max_size'] 				= '5120'; // MAKSIMUM UKURAN FILE 5M
		// $config['max_width'] 				= '900'; 	// MAKSUMIM LEBAL GAMBAR
		// $config['max_height'] 			= '350';  // MAKSUMIM TINGGI GAMBAR
		$config['file_ext_tolower'] = true;
		$config['file_name'] 				= $files; // NAMA FILE YANG TERSIMPAN PADA ROOT	
		$this->load->library('upload', $config);

		//TAHAP LIMA: JALANKAN LOGIKA 
		if(!empty($idJenisBanner)) {
			if($this->form_validation->run() == FALSE) {
				$msg['pesan'] = array( 'content' => validation_errors(), 'colmsg' => 'bg-red');
			} else {
				if (!$this->upload->do_upload('gambar')) {
						$msg['pesan'] = array('content' => $this->upload->display_errors(), 'colmsg' => 'bg-red');
				} else {
						if (file_exists('./files/file_banner/'.$files)) {
							unlink('./files/file_banner/'.$files);
						}
						$values = [
							'fid_jns_banner' => $idJenisBanner,
							'judul' => $judul,
							'gambar' => $this->upload->data('file_name'),
							'url' => $url,
							'publish' => $publish,
							'tgl_publish' => date('Y-m-d'),
							'path' => $path_now,
							'upload_by' =>	$this->session->userdata('user')
						];	
						$this->resizeImage($this->upload->data('file_name'), $idJenisBanner);
						$this->mbanner->add('t_banner', $values);
						$msg['pesan'] = array('preview' => $path_now, 'content' => 'Banner <b>'.$judul.'</b> Added', 'colmsg' => 'bg-teal');
				}	
			}
		} else {
			$msg['pesan'] = array('content' => 'Jenis Banner belum dipilih', 'colmsg' => 'bg-red');
		}		
		echo json_encode($msg);	

  }
	//==========================================//	

  //==========================================//
  ## EDIT BANNER BERDASARKAN ID BANNER
	public function edit_banner($id)
	{
    $data = $this->mbanner->edit_banner('t_banner', ['id_banner' => $id])->result();
    $responses = json_encode($data);
    echo $responses;
  }
	//==========================================// 

	//==========================================//
	## PROSES UPDATE BANNER
	public function update_banner() 
	{
		$id				 = $this->input->post('idbanner_e');
		$id_jns	   = $this->input->post('idjns_banner');
		$judul 		 = $this->input->post('judul_e');
		$url 			 = $this->input->post('url_e');
		$publish 	 = $this->input->post('publish_e');
		$fileName  = $_FILES['gambar_e']['name'];
		$filebefore= $this->input->post('file_before');

		$acak27 	 = generateRandomString(27);
		$date   = date('Y-m-d');

		$files = "bkppdbalangan_".strtolower($acak27);	

		//init library upload
		$config['upload_path']      = './files/file_banner/';
		$path_now 								  = site_url('/files/file_banner/'.str_replace("/","",$files).'.'.pathinfo($fileName, PATHINFO_EXTENSION));
		$config['allowed_types']    = 'jpg|jpeg|png';
		$config['max_size'] 				= '5120';
		$config['overwrite']				= true;
		$config['file_ext_tolower'] = true;
		$config['file_name'] 				= $files; //nama yang terupload nantinya

		$this->load->library('upload', $config);
		if(!empty($fileName)) {
			if (!$this->upload->do_upload('gambar_e')) {
				$msg['response'] = array('content' => $this->upload->display_errors(), 'bg' => 'bg-red', 'sts' => false);
			} else {
					if (file_exists('./files/file_banner/'.$filebefore)) {
						unlink('./files/file_banner/'.$filebefore);
					}
					$values = [
						'fid_jns_banner' => $id_jns,
						'judul' => $judul,
						'url' => $url,
						'gambar' => $this->upload->data('file_name'),
						'path' => $path_now,
						'publish' => $publish,
						'update_by' => $this->session->userdata('user'),
						'update_at' => date('Y-m-d H:i:s')
					];
					$this->mbanner->update_banner('t_banner', $values, ['id_banner' => $id]);
					$msg['response'] = array(
						'content' => 'Banner <b>'.$judul.'</b> Updated', 
						'bg' => 'bg-teal', 
						'sts' => true
					);
			}	
		} else {
			$set = [
				'fid_jns_banner' => $id_jns,
				'judul' => $judul,
				'url' => $url,
				'publish' => $publish,
				'tgl_publish' => date('Y-m-d'),
				'update_by' => $this->session->userdata('user'),
				'update_at' => date('Y-m-d H:i:s')
			];
			$whr = [
				'id_banner' => $id
			];
			$this->mbanner->update_banner('t_banner', $set, $whr);
			$msg['response'] = array(
					'sts' => true,
					'bg' => 'bg-teal', 
					'content' => 'Banner <b>'.$judul.'</b> Updated'
			);
		}
		echo json_encode($msg);
	}
	
	//==========================================//

  //==========================================//
  ## LIST JENIS BANNER
  public function list_jenisbanner()
  {
    $data = $this->mbanner->list_jenisbanner('ref_jns_banner')->result();
    if(count($data) > 0)
    {
      $res = "";
      foreach($data as $v)
      {
        $res .= '<li class="list-group-item">'.$v->jenis.' - '.$v->posisi.' <a href="javascript:void(0);" onclick="hapus_jenisbanner('.$v->id_jns_banner.')" class="pull-right btn-hapus_jenisbanner col-red"><em class="glyphicon glyphicon-trash"></em></a></li>';
      }
    }
    else 
    {
      $res = '<li class="list-group-item disabled"> Posisi Kosong </li>';
    }
    echo json_encode($res);
  }
	//==========================================// 
	
  //==========================================//
  ## LIST JENIS BANNER SELET
  public function list_jenisbanner_select()
  {
    $data = $this->mbanner->list_jenisbanner('ref_jns_banner')->result();
    if(count($data) > 0)
    {
      $res = "<option value='0'>Pilih jenis banner</option>";
      foreach($data as $v)
      {
        $res .= '<option value="'.$v->id_jns_banner.'">'.$v->jenis.' - '.$v->posisi.'</option>';
      }
    }
    else 
    {
      $res = '<option value="0">Pilih jenis banner</option>';
    }
    echo json_encode($res);
  }
	//==========================================// 

  //==========================================//
  ## PROSES TAMBAH JENIS BANNER
  public function add_jenis_banner()
  {
		$jenis = $this->input->post('jenis', true);
		$posisi= $this->input->post('posisi', true);

		$values = [
			'jenis' => $jenis,
			'posisi' => $posisi
		];
		
		$data = $this->mbanner->add_jenis_banner('ref_jns_banner', $values);
		if($data)
		{
			$res = array('message' => '<em class="material-icons font-18 pull-left m-r-10">done</em> Success Posisi <b>'.$values['posisi'].'</b> Ditambahkan', 'message_bg' => 'alert alert-success');
		} 
		else 
		{
			$res = array('message' => '<em class="material-icons font-18 pull-left m-r-10">error_outline</em> Responses Error', 'message_bg' => 'alert alert-warning');
		}
			
    echo json_encode($res);
  }
	//==========================================//	

  //==========================================//
  ## HAPUS LIST JENIS BANNER 
	public function hapus_jenisbanner()
	{
    $id = $this->input->get('id');
    $data = $this->mbanner->hapus_jenisbanner('ref_jns_banner', ['id_jns_banner' => $id]);
    $responses = json_encode($data);
    echo $responses;
  }
	//==========================================// 	

	//==========================================//
  ## HAPUS BANNER
	public function hapus_banner($id, $file) {
		$tbl = 't_banner';
		$where = [
			'id_banner' => $id,
			'gambar' => $file
		];

		$path = './files/file_banner/';
		if(file_exists($path.$file)) {
			unlink($path.$file);
			$this->mbanner->hapus_banner($tbl,$where);
			$msg['pesan'] = ['type' => 'bg-teal', 'content' => 'Success Deleted', 'stsText' => true];
		} else {
			$msg['pesan'] = ['type' => 'bg-pink', 'content' => 'Error Deleted', 'stsText' => false];
		}
		$json = json_encode($msg);
		echo $json;		
	}
	//==========================================//	

	
	public function resizeImage($filename, $jnsb)
	{
		
		$source_path = './files/file_banner/' . $filename;
		$target_path = './files/file_banner/';
		$config_manip = array(
				'image_library' => 'gd2',
				'source_image' => $source_path,
				'new_image' => $target_path,
				// 'create_thumb' => TRUE,
				'maintain_ratio' => TRUE,
				'width' => '600',
				'height' => '250'
		);
	
		$this->load->library('image_lib', $config_manip);
		if($jnsb == '38') {
			$this->image_lib->resize();
		} else {
      $this->image_lib->clear();
		}
		
	}

}
?>
