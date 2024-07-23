<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Banner extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->model('model_template_v1/M_f_banner', 'banner');
		//Check maintenance website
        if(($this->session->userdata('status') == 'ONLINE') && ($this->mf_beranda->get_identitas()->status_maintenance == '1') || ($this->mf_beranda->get_identitas()->status_maintenance == '0')) {
            // redirect(base_url('frontend/v1/beranda'),'refresh');
        } else {
            redirect(base_url('under-construction'),'refresh');
        }
	}
	public function listimage()
	{
		$data = [
			'title' => 'Banner - BKPPD Balangan',
			'isi'	=> 'Frontend/v1/pages/banner/banner_list',
            'mf_beranda' => $this->mf_beranda->get_identitas(),
            'mf_menu' => $this->mf_beranda->get_menu(),
            'banner' => $this->banner->get_all_banner(null)->result(),
		];

		$this->load->view('Frontend/v1/layout/wrapper', $data, FALSE);
	}
	public function detail($slug) 
	{
		$id = $this->banner->idBannerBySlug($slug);
		if(intval($id) == ''):
			return redirect(base_url('404'));
		endif;
		$data = [
			'title' => 'views: '.$this->banner->get_namabanner($id),
			'isi'	=> 'Frontend/v1/pages/b_detail',
			'uri_id' => $id,
            'mf_beranda' => $this->mf_beranda->get_identitas(),
            'mf_menu' => $this->mf_beranda->get_menu(),
            'banner' => $this->banner->get_detail_banner($id)->row(),
            'banner_all' => $this->banner->get_all_banner($id)->result(),
		];

		$this->load->view('Frontend/v1/layout/wrapper', $data, FALSE);
	}
	public function new_banner($id_jns_banner="") 
	{
		if(empty($this->session->userdata('user_portal_log')['id'])):
		return	redirect(base_url('login_web'),'refresh');
		endif;

			$idjns = decrypt_url($id_jns_banner);
			$data = [
				'title' => 'Created New Banner',
				'idjns' => $idjns,
				'mf_beranda' => $this->mf_beranda->get_identitas(),
	            'mf_menu' => $this->mf_beranda->get_menu(),
            	'jnsbanner' => $this->banner->list_jenisbanner('ref_jns_banner')->result(),
				'isi'	=> 'Frontend/v1/pages/b_baru',
			];

			$this->load->view('Frontend/v1/layout/wrapper', $data, FALSE);
	}
	public function edit($idbanner,$id_jns_banner,$judul)
	{
		if(empty($this->session->userdata('user_portal_log')['id'])):
		return	redirect(base_url('login_web'),'refresh');
		endif;

		$kunci = [
			'id_banner' => decrypt_url($idbanner),
			'fid_jns_banner' => decrypt_url($id_jns_banner)
		];

		$detail = $this->banner->get_detail_by($kunci)->row();

		$data = [
				'title' => 'Edit &bull; '.$judul,
				'p' => $kunci,
				'd' => $detail,
            	'jnsbanner' => $this->banner->list_jenisbanner('ref_jns_banner')->result(),
				'mf_beranda' => $this->mf_beranda->get_identitas(),
	            'mf_menu' => $this->mf_beranda->get_menu(),
				'isi'	=> 'Frontend/v1/pages/b_edit',
			];

			$this->load->view('Frontend/v1/layout/wrapper', $data, FALSE);
	}
	public function hapus_banner($id) 
	{
		$d = $this->banner->get_detail_banner(decrypt_url($id))->row();
		$file = $d->gambar;
		$tbl = 't_banner';
		$where = [
			'id_banner' => decrypt_url($id),
			'gambar' => $file
		];

		$path = './files/file_banner/';
		if(file_exists($path.$file)) {
			unlink($path.$file);
			$this->banner->hapus_banner($tbl,$where);
			$this->session->set_flashdata(['message' => 'Banner berhasil dihapus', 'class' => 'alert-success', 'message_title' => 'Success']);
		} else {
			$this->session->set_flashdata(['message' => 'Banner Gagal dihapus', 'class' => 'alert-danger', 'message_title' => 'Error']);
		}
		redirect(base_url('frontend/v1/album/alert'),'refresh');
	}
	public function upload()
	{
		//TAHAP SATU : AMBIL VALUE DARI INPUTAN
		$fileBanner 	 = $_FILES['gambar']['name'];
		$idJenisBanner = $this->input->post('idjns_banner');
		$judul 				 = $this->input->post('judul');
		$url  				 = $this->input->post('url');
		$keterangan 		= $this->input->post('keterangan');
		$publish 			 = $this->input->post('publish');

		//TAHAP DUA: VALIDASI SETIAP INPUTAN
		$config_validation = array(
			array(
							'field' => 'judul',
							'label' => 'Judul Banner',
							'rules' => 'required'
			),
			array(
							'field' => 'idjns_banner',
							'label' => 'Posisi banner',
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
		$date   = date('dmY');
		$files  = "filebanner-".$date."-".strtolower($acak27);
		//INIT LIBRARY UPLOAD
		$config['upload_path']      = './files/file_banner/';
		$path_now 					= site_url('/files/file_banner/'.str_replace("/","",$files).'.'.pathinfo($fileBanner, PATHINFO_EXTENSION));
		$config['allowed_types']    = 'jpg|jpeg|png|webp';
		$config['max_size'] 				= '5120'; // MAKSIMUM UKURAN FILE 5M
		// $config['max_width'] 				= '900'; 	// MAKSUMIM LEBAL GAMBAR
		// $config['max_height'] 			= '350';  // MAKSUMIM TINGGI GAMBAR
		$config['file_ext_tolower'] = true;
		$config['file_name'] 				= $files; // NAMA FILE YANG TERSIMPAN PADA ROOT	
		$this->load->library('upload', $config);

		//TAHAP LIMA: JALANKAN LOGIKA 
		if(!empty($idJenisBanner)) {
			if($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata(array( 'message' => validation_errors(), 'class' => 'alert-danger'));
			} else {
				if (!$this->upload->do_upload('gambar')) {
						$this->session->set_flashdata(array('message' => $this->upload->display_errors(), 'class' => 'alert-danger'));
				} else {
						if (file_exists('./files/file_banner/'.$files)) {
							unlink('./files/file_banner/'.$files);
						}
						$values = [
							'fid_jns_banner' => $idJenisBanner,
							'judul' => ucwords($judul),
							'slug' => url_title(strtolower($judul)),
							'gambar' => $this->upload->data('file_name'),
							'url' => $url,
							'keterangan' => $keterangan,
							'publish' => $publish,
							'tgl_publish' => date('Y-m-d'),
							'path' => $path_now,
							'upload_by' =>	$this->session->userdata('user_portal_log')['id']
						];	
						$this->resizeImage($this->upload->data('file_name'), $idJenisBanner);
						$this->banner->upload('t_banner', $values);
						$this->session->set_flashdata(array('preview' => $path_now, 'message' => 'Banner <b>'.$judul.'</b> Added', 'class' => 'alert-success'));
				}	
			}
		} else {
			$this->session->set_flashdata(array('message' => 'Jenis Banner belum dipilih', 'class' => 'alert-danger'));
		}	
		redirect(base_url('frontend/v1/banner/new_banner/'.encrypt_url($idJenisBanner)),'refresh');
	}
	public function update_banner()
	{
		$id			= decrypt_url($this->input->post('idbanner'));
		$id_jns	   = $this->input->post('idjns_banner');
		$judul 		 = $this->input->post('judul');
		$url 			 = $this->input->post('url');
		$publish 	 = $this->input->post('publish');
		$keterangan 	 = $this->input->post('keterangan');
		$fileName  = $_FILES['gambar']['name'];

		$dbanner = $this->banner->get_detail_banner($id)->row();
		$file_terdahulu = $dbanner->gambar;
		$filebefore= $file_terdahulu;
		// var_dump($dbanner);
		// die;
		$acak27 	 = generateRandomString(27);
		$date   = date('dmY');
		$files = "filebanner-".$date."-".strtolower($acak27);

		//init library upload
		$config['upload_path']      = './files/file_banner/';
		$path_now 								  = site_url('/files/file_banner/'.str_replace("/","",$files).'.'.pathinfo($fileName, PATHINFO_EXTENSION));
		$config['allowed_types']    = 'jpg|jpeg|png|webp';
		$config['max_size'] 				= '5120';
		$config['overwrite']				= true;
		$config['file_ext_tolower'] = true;
		$config['file_name'] 				= $files; //nama yang terupload nantinya
		$this->load->library('upload', $config);
		if(!empty($fileName)) {
			if (!$this->upload->do_upload('gambar')) {
				$this->session->set_flashdata(array('message' => $this->upload->display_errors(), 'class' => 'alert-danger', 'sts' => false, 'message_title' => 'Gagal'));
			} else {
					if (file_exists('./files/file_banner/'.$filebefore)) {
						unlink('./files/file_banner/'.$filebefore);
					}
					$values = [
						'fid_jns_banner' => $id_jns,
						'judul' => ucwords($judul),
						'slug' => url_title(strtolower($judul)),
						'url' => $url,
						'gambar' => $this->upload->data('file_name'),
						'path' => $path_now,
						'publish' => $publish,
						'keterangan' => $keterangan,
						'update_by' => $this->session->userdata('user_portal_log')['id'],
						'update_at' => date('Y-m-d H:i:s')
					];
					$this->banner->update_banner('t_banner', $values, ['id_banner' => $id]);
					$this->session->set_flashdata(array(
						'message' => 'Banner <b>'.$judul.'</b> Updated', 
						'class' => 'bg-success', 
						'sts' => true,
						'message_title' => 'Success'
					));
			}	
		} else {
			$set = [
				'fid_jns_banner' => $id_jns,
				'judul' => ucwords($judul),
				'slug' => url_title(strtolower($judul)),
				'url' => $url,
				'publish' => $publish,
				'tgl_publish' => date('Y-m-d'),
				'keterangan' => $keterangan,
				'update_by' => $this->session->userdata('user_portal_log')['id'],
				'update_at' => date('Y-m-d H:i:s')
			];
			$whr = [
				'id_banner' => $id
			];
			$this->banner->update_banner('t_banner', $set, $whr);
			$this->session->set_flashdata(array(
					'sts' => true,
					'class' => 'alert-success', 
					'message' => 'Banner <b>'.$judul.'</b> Updated',
					'message_title' => 'Success'
			));
		}
		redirect(base_url('frontend/v1/banner/alert'),'refresh');
	}
	public function alert() 
	{
		$data = [
			'title' => 'Sucess album has ben deleted',
			'mf_beranda' => $this->mf_beranda->get_identitas(),
            'mf_menu' => $this->mf_beranda->get_menu(),
			'isi'	=> 'Frontend/v1/pages/alert',
		];

		$this->load->view('Frontend/v1/layout/wrapper', $data, FALSE);
	}
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

/* End of file Banner.php */
/* Location: ./application/controllers/frontend/v1/Banner.php */