<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Album extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_template_v1/M_f_album', 'album');
		$this->load->model('M_b_foto', 'mfoto');
		$this->load->library('image_lib');
		if(($this->session->userdata('status') == 'ONLINE') && ($this->mf_beranda->get_identitas()->status_maintenance == '1') || ($this->mf_beranda->get_identitas()->status_maintenance == '0')) {
            // redirect(base_url('frontend/v1/mf_berandaa'),'refresh');
        } else {
            redirect(base_url('under-construction'),'refresh');
        }
	}
	public function index() 
	{
		$data = [
			'title' => 'BKPPD | Album',
			'album' => $this->album->album(),
			'mf_beranda' => $this->mf_beranda->get_identitas(),
            'mf_menu' => $this->mf_beranda->get_menu(),
			'isi'	=> 'Frontend/v1/pages/album',
		];

		$this->load->view('Frontend/v1/layout/wrapper', $data, FALSE);
	}
	
	public function tambah_photo($id)
	{
		if(empty($this->session->userdata('user_portal_log')['id'])):
		return	 redirect(base_url('login_web'),'refresh');
		endif;

			$id_album = decrypt_url($id);
			$data = [
				'title' => 'Tambah photo',
				'id_album' => $id_album,
				'mf_beranda' => $this->mf_beranda->get_identitas(),
	            'mf_menu' => $this->mf_beranda->get_menu(),
				'isi'	=> 'Frontend/v1/pages/u_akun_galeri_add',
			];

			$this->load->view('Frontend/v1/layout/wrapper', $data, FALSE);
	}

	public function detail($id)
	{
		$id_album = decrypt_url($id);
		$data = [
			'title' => url_title($this->album->judul_album_by_id($id_album), '-', true),
			'photos' => $this->album->photos($id_album),
			'mf_beranda' => $this->mf_beranda->get_identitas(),
            'mf_menu' => $this->mf_beranda->get_menu(),
			'isi'	=> 'Frontend/v1/pages/album_detail',
		];

		$this->load->view('Frontend/v1/layout/wrapper', $data, FALSE);
	}

	public function open($id)
	{
		if(empty($this->session->userdata('user_portal_log')['id'])):
		return redirect(base_url('login_web'),'refresh');
		endif;
		$id_album = decrypt_url($id);
		$data = [
			'title' => url_title($this->album->judul_album_by_id($id_album), '-', true),
			'photos' => $this->album->photos($id_album),
			'mf_beranda' => $this->mf_beranda->get_identitas(),
            'mf_menu' => $this->mf_beranda->get_menu(),
			'isi'	=> 'Frontend/v1/pages/u_akun_galeri_open',
		];

		$this->load->view('Frontend/v1/layout/wrapper', $data, FALSE);
	}

	public function edit_photo($id) {
		if(empty($this->session->userdata('user_portal_log')['id'])):
		return redirect(base_url('login_web'),'refresh');
		endif;
		$id_photo = decrypt_url($id);
		$data = [
			'title' => url_title($this->album->detail_photo($id_photo)->judul, '-', true),
			'data' => $this->album->detail_photo($id_photo),
			'mf_beranda' => $this->mf_beranda->get_identitas(),
            'mf_menu' => $this->mf_beranda->get_menu(),
			'isi'	=> 'Frontend/v1/pages/u_akun_galeri_edit',
		];

		$this->load->view('Frontend/v1/layout/wrapper', $data, FALSE);
	}

	public function new_album() {
		if(empty($this->session->userdata('user_portal_log')['id'])):
		return redirect(base_url('login_web'),'refresh');
		endif;
		$data = [
			'title' => 'Buat album baru',
			'mf_beranda' => $this->mf_beranda->get_identitas(),
            'mf_menu' => $this->mf_beranda->get_menu(),
			'isi'	=> 'Frontend/v1/pages/album_baru',
		];

		$this->load->view('Frontend/v1/layout/wrapper', $data, FALSE);
	}
	public function upload_album()
	{
		if(empty($this->session->userdata('user_portal_log')['id'])):
		return redirect(base_url('login_web'),'refresh');
		endif;
		$fileName  = $_FILES['foto']['name'];
		$fileName_blob    = file_get_contents($_FILES['foto']['tmp_name']);

		$acak27 = generateRandomString(27);
		$date = date('Y-m-d');

		$jdl = $this->input->post('photo_judul');

		$files = "bkppdbalangan_".str_replace(" ","",$jdl)."_".$acak27;
		//init library upload
		$config['upload_path']      = './files/file_album/';
		$path_now 								  = base_url('./files/file_album/'.strtoupper(str_replace("/","",$files)).'.'.pathinfo($fileName, PATHINFO_EXTENSION));
		$config['allowed_types']    = 'jpg|jpeg|png';
		$config['max_size'] 				= '5120'; //maksimum besar file 5M
		$config['max_width'] 				= '1366';
		$config['overwrite']				= true;
		$config['file_ext_tolower'] = true;
		$config['file_name'] 				= strtoupper($files); //nama yang terupload nantinya

		$this->load->library('upload', $config);
		if (!$this->upload->do_upload('foto')) {
			$this->session->set_flashdata(['message' =>  $this->upload->display_errors(), 'class' => 'alert-warning']);
				redirect(base_url('frontend/v1/album/new_album/'),'refresh');
		} else {
				if (file_exists('./files/file_album/'.$files)) {
					unlink('./files/file_album/'.$files);
				}
				$values = [
					'judul' => $jdl,
					'keterangan' => $this->input->post('photo_keterangan'),
					'gambar' => strtoupper($this->upload->data('file_name')),
					'gambar_blob' => $fileName_blob,
					'path' => $path_now,
					'publish' => $this->input->post('publish_album'),
					'tgl_publish' => date('Y-m-d'),
					'upload_by' => $this->session->userdata('user_portal_log')['nama_panggilan'],
					'upload_at' => date('Y-m-d H:i:s')
				];

				$this->mfoto->addphoto('t_album_foto', $values);
				$this->session->set_flashdata(['message' => 'Album <b>'.$jdl.'</b> has ben created', 'class' => 'alert-success']);
					redirect(base_url('frontend/v1/album/new_album/'),'refresh');
		}	
	}
	public function ajax_list_album()
	{
		$json = [];
		$val = $this->input->get('search');
		
			$db = $this->album->ajax_list_album($val);
			if($db->num_rows() > 0)
			{
				foreach ($db->result() as $r) {
					$data[] = [
						'id' => $r->id_album_foto,
						'text' => $r->judul
					];
				}
				$json = $data;
			}
		echo json_encode($json);
	}
	public function upload_foto()
	{
		if(empty($this->session->userdata('user_portal_log')['id'])):
		return redirect(base_url('login_web'),'refresh');
		endif;
		$album_id = $this->input->post('id_album');
		$fileName  = $_FILES['foto']['name'];
		$fileName_blob = file_get_contents($_FILES['foto']['tmp_name']);

		$judul = $this->input->post('photo_judul');
		$acak27 = generateRandomString(27);
		$date = date('Y-m-d');

		$files = "bkppdbalangan_".str_replace(" ","",$judul)."_".$acak27;	
		//init library upload
		$config['upload_path']      = './files/file_galeri/';
		$path_now 					= base_url('/files/file_galeri/'.strtoupper(str_replace("/","",$files)).'.'.pathinfo($fileName, PATHINFO_EXTENSION));
		$config['allowed_types']    = 'jpg|jpeg|png';
		$config['max_size'] 				= '5120'; //maksimum besar file 5M
		$config['max_width'] 				= '1366';
		$config['overwrite']				= true;
		$config['file_ext_tolower'] = true;
		$config['file_name'] 				= strtoupper($files); //nama yang terupload nantinya

		$this->load->library('upload', $config);
		if(!empty($album_id)) {
			if (!$this->upload->do_upload('foto')) {
				$this->session->set_flashdata(['message' =>  $this->upload->display_errors(), 'class' => 'alert-warning']);
				redirect(base_url('frontend/v1/album/tambah_photo/'.$album_id),'refresh');
			} else {
					if (file_exists('./files/file_galeri/'.$files)) {
						unlink('./files/file_galeri/'.$files);
					}
					$values = [
						'fid_album_foto' => decrypt_url($album_id),
						'judul' => $this->input->post('photo_judul'),
						'keterangan' => $this->input->post('photo_keterangan'),
						'gambar' => strtoupper($this->upload->data('file_name')),
						'gambar_blob' => $fileName_blob,
						'path' => $path_now,
						'publish' => $this->input->post('publish_galeri'),
						'tgl_publish' => date('Y-m-d'),
						'upload_by' => $this->session->userdata('user_portal_log')['nama_panggilan']
					];

					//function image_lib ci 
					$this->watermark($this->upload->data('file_name'));
					$this->resizeImage($this->upload->data('file_name'));
					$this->mfoto->addgaleri('t_foto', $values);
					$this->session->set_flashdata(['message' => 'Foto <b>'.$this->input->post('photo_judul').'</b> ditambahkan', 'class' => 'alert-success']);
					redirect(base_url('frontend/v1/album/open/'.$album_id),'refresh');
			}
		}
	}
	public function update_foto() 
	{
		if(empty($this->session->userdata('user_portal_log')['id'])):
		return redirect(base_url('login_web'),'refresh');
		endif;
		$id = $this->input->post('id_foto');
		$id_album = $this->album->detail_photo(decrypt_url($id))->fid_album_foto;
		// Foto New
		$fileName  = $_FILES['foto']['name'];
		// Foto Before
		$fileName_before = $this->album->detail_photo(decrypt_url($id))->gambar;

		$judul = $this->input->post('photo_judul');
		$acak27 = generateRandomString(27);
		$date = date('Y-m-d');

		$files = "bkppdbalangan_".str_replace(" ","",$judul)."_".$acak27;	
		//init library upload
		$config['upload_path']      = './files/file_galeri/';
		$path_now 					= base_url('/files/file_galeri/'.strtoupper(str_replace("/","",$files)).'.'.pathinfo($fileName, PATHINFO_EXTENSION));
		$config['allowed_types']    = 'jpg|jpeg|png';
		$config['max_size'] 				= '5120'; //maksimum besar file 5M
		$config['max_width'] 				= '1366';
		$config['overwrite']				= true;
		$config['file_ext_tolower'] = true;
		$config['file_name'] 				= strtoupper($files); //nama yang terupload nantinya

		$this->load->library('upload', $config);
		if(!empty($fileName)) {
			$fileName_blob = file_get_contents($_FILES['foto']['tmp_name']);
			if (!$this->upload->do_upload('foto')) {
				$this->session->set_flashdata(['message' =>  $this->upload->display_errors(), 'class' => 'alert-warning']);
				redirect(base_url('frontend/v1/album/edit_photo/'.$id),'refresh');
			} else {
					if (file_exists('./files/file_galeri/'.$fileName_before)) {
						unlink('./files/file_galeri/'.$fileName_before);
						unlink('./files/file_galeri/thumb/'.$fileName_before);
					}
					$values = [
						'judul' => $this->input->post('photo_judul'),
						'keterangan' => $this->input->post('photo_keterangan'),
						'gambar' => strtoupper($this->upload->data('file_name')),
						'gambar_blob' => $fileName_blob,
						'path' => $path_now,
						'publish' => $this->input->post('publish_galeri'),
						'update_at' => date('Y-m-d H:i:s'),
						'update_by' => $this->session->userdata('user_portal_log')['nama_panggilan']
					];

					//function image_lib ci 
					$this->watermark($this->upload->data('file_name'));
					$this->resizeImage($this->upload->data('file_name'));
					$this->mfoto->updategaleri('t_foto', $values, ['id_foto' => decrypt_url($id)]);
					$this->session->set_flashdata(['message' => 'Foto <b>'.$this->input->post('photo_judul').'</b> berhasil diupdate', 'class' => 'alert-success']);
					redirect(base_url('frontend/v1/album/open/'.encrypt_url($id_album)),'refresh');
			}
		} else {
			$set = [
				'judul' => $this->input->post('photo_judul'),
				'keterangan' => $this->input->post('photo_keterangan'),
				'publish' => $this->input->post('publish_galeri'),
				'update_by' => $this->session->userdata('user_portal_log')['nama_panggilan'],
				'update_at' => date('Y-m-d H:i:s')
			];
			$whr = [
				'id_foto' => decrypt_url($id)
			];
			$this->mfoto->updategaleri('t_foto', $set, $whr);
			$this->session->set_flashdata(['message' => 'Foto <b>'.$this->input->post('photo_judul').'</b> berhasil diupdate', 'class' => 'alert-success']);
			redirect(base_url('frontend/v1/album/open/'.encrypt_url($id_album)),'refresh');
		}

	}
	public function hapus_photo($id) 
	{
		if(empty($this->session->userdata('user_portal_log')['id'])):
		return redirect(base_url('login_web'),'refresh');
		endif;
		$id_album = $this->album->detail_photo(decrypt_url($id))->fid_album_foto; 
		$file = $this->album->detail_photo(decrypt_url($id))->gambar;
		$tbl = 't_foto';
		$where = [
			'id_foto' => decrypt_url($id),
			'gambar' => $file
		];

		$path = './files/file_galeri/';
		$path_thumb = './files/file_galeri/thumb/';
		if(file_exists($path.$file)) {
			unlink($path.$file);
			unlink($path_thumb.$file);
			$this->mfoto->hapus_galeri($tbl,$where);
			$this->session->set_flashdata(['message' => 'Foto berhasil dihapus', 'class' => 'alert-success']);
		} else {
			$this->session->set_flashdata(['message' => 'Foto gagal dihapus', 'class' => 'alert-danger']);
		}
		redirect(base_url('frontend/v1/album/open/'.encrypt_url($id_album)),'refresh');
	}

	public function hapus_album($id) 
	{
		if(empty($this->session->userdata('user_portal_log')['id'])):
		return redirect(base_url('login_web'),'refresh');
		endif;
		$id_album = decrypt_url($id); 
		$file = $this->album->detail_album($id_album)->gambar;
		$tbl = 't_album_foto';
		$where = [
			'id_album_foto' => $id_album,
			'gambar' => $file
		];

		$path = './files/file_album/';
		if(file_exists($path.$file)) {
			unlink($path.$file);
			$this->mfoto->hapus_album($tbl,$where);
			$this->session->set_flashdata(['message' => 'Album berhasil dihapus', 'class' => 'alert-success']);
		} else {
			$this->session->set_flashdata(['message' => 'Album gagal dihapus', 'class' => 'alert-danger']);
		}
		redirect(base_url('frontend/v1/album/alert'),'refresh');
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