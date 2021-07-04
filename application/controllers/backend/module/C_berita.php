<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Berita extends CI_Controller {
	public function __construct() 
	{
    parent::__construct();
		$this->load->model(
			['M_b_berita' => 'mberita', 
			'M_b_komentar' => 'mkomen', 
			'M_b_kategori' => 'mkategori']
		);
		$this->load->library('image_lib');
    _is_logged_in();
	
  }

  //==========================================//
  ## BERITA 
	public function index()
	{

		$data = [
				'content' => 'Backend/__module/___Berita/v_table',
				'scriptjs' => 'Backend/__ServerSideJs/Berita/s_berita',
				'pageinfo' => '<li>Dasboard</li><li class="active">Manajemen Berita</li>',
				'css' => [
					'assets/plugins/datatable/datatables.min.css',
					'assets/plugins/datatable/inc_tablesold.css'
				],
				'js' => [
					'assets/plugins/datatable/datatables.min.js'
				]
		];
		$this->load->view('Backend/v_home', $data);
        
  }

	//==========================================//

  //==========================================//
  ## HALAMAN TAMBAH BERITA
  public function add() 
  {

    $source = [
      'content' => 'Backend/__module/___Berita/v_tambah',
      'scriptjs' => 'Backend/__ServerSideJs/Berita/s_tambah',
			'pageinfo' => '<li>Dasboard</li><li>Manajemen Berita</li> <li class="active">Tambah</li>',
      'css' => [
        'assets/plugins/select2/css/select2.min.css',
        'assets/plugins/select2/css/select2-materialize.css'
      ],
      'js' => [
        'assets/plugins/select2/js/select2.min.js'
      ]
    ];
    $this->load->view('Backend/v_home', $source);
  }
	//==========================================//

  
  //==========================================//
  ## PROSES TAMBAH BERITA
	public function send()
	{
		//TAHAP SATU : AMBIL VALUE DARI INPUTAN
		$filegambar 	      = $_FILES['gambar']['name'];
		$filegambar_blob    = file_get_contents($_FILES['gambar']['tmp_name']);

		$title              = $this->input->post('title_berita');
		$editor 						= $_POST['isi_berita'];
		$komentar  				  = $this->input->post('sts_komentar');
		$kategori 			    = $this->input->post('kategori');
		$publish 			      = $this->input->post('publish');
		$head 			      	= $this->input->post('headline');
		$note 			        = $this->input->post('katapenulis');
    $tags 			        = $this->input->post('tags[]');
    $addTags 						= @implode(',', $tags);

		//TAHAP DUA: VALIDASI SETIAP INPUTAN
		$config_validation = array(
			array(
							'field' => 'title_berita',
							'label' => 'Judul Berita',
							'rules' => 'required',
							'errors' => array(
								'required' => '%s Masih kosong'
							)
			),
			array(
							'field' => 'sts_komentar',
							'label' => 'Komentar Status',
							'rules' => 'required',
							'errors' => array(
								'required' => '%s Masih kosong'
							)
			),
			array(
							'field' => 'kategori',
							'label' => 'Kategori',
							'rules' => 'required',
							'errors' => array(
								'required' => '%s Masih kosong'
							)
			),
			array(
							'field' => 'publish',
							'label' => 'Publish',
							'rules' => 'required',
							'errors' => array(
								'required' => '%s Belum dipilih'
							)
			),
			array(
							'field' => 'headline',
							'label' => 'Headline',
							'rules' => 'required',
							'errors' => array(
								'required' => '%s Belum dipilih'
							)
			)		
		);

		//TAHAP TIGA: SET VALIDASI
		$this->form_validation->set_rules($config_validation);
		
		//TAHAP EMPAT: CONFIG DATA UPLOAD DAN SIMPAN FILE 
		$acak27 = generateRandomString(27);
		// $date   = date('Y-m-d');
		$files  = $acak27;
			
		//INIT LIBRARY UPLOAD
		$config['upload_path']      = './files/file_berita/';
		if(file_exists('./files/file_berita/thumb/'.$files)) {
			$path_now = site_url('/files/file_berita/thumb/'.str_replace("/","",$files).'.'.pathinfo($filegambar, PATHINFO_EXTENSION));
		} else {
			$path_now = site_url('/files/file_berita/'.str_replace("/","",$files).'.'.pathinfo($filegambar, PATHINFO_EXTENSION));
		}
		$config['allowed_types']    = 'jpg|jpeg|png';
		$config['max_size'] 				= '5120'; // MAKSIMUM UKURAN FILE 5M
		$config['file_ext_tolower'] = true;
		$config['file_name'] 				= $files; // NAMA FILE YANG TERSIMPAN PADA ROOT	
		$this->load->library('upload', $config);
    
		//TAHAP LIMA: JALANKAN LOGIKA 
		

			if($this->form_validation->run() === FALSE) {
				// $msg['pesan'] = array( 'content' => validation_errors(), 'colmsg' => 'bg-red');
				$this->session->set_flashdata(array('message' => 'Oopss! Masih ada yang error, coba cek kembali seluruh kolom & isi ulang', 'class' => 'alert alert-danger'));
				redirect(base_url('backend/module/c_berita/add?module='.$this->madmin->getmodulebycontroller('c_berita').'&user='.$this->session->userdata('user_access')));
				
			} else {

				if(!empty($editor)) {

					if (!$this->upload->do_upload('gambar')) {
							$msg['pesan'] = array('content' => $this->upload->display_errors(), 'colmsg' => 'bg-red');
					} else {
						//function image_lib ci 
						if(!empty($this->input->post('mark'))) {
							$this->watermark($this->upload->data('file_name'));
						}
						if(!empty($this->input->post('thumb'))) {
							$this->resizeImage($this->upload->data('file_name'));
						}
						
						$values = [
							'fid_kategori' => $kategori,
              'judul' => $title,
              'headline' => $head,
              'publish' => $publish,
              'content' => $editor,
              'tgl_posting' => date('Y-m-d'),
              'jam' => date('H:i:s'),
							'img' => $this->upload->data('file_name'),
							'img_blob' => $filegambar_blob,
							'path' => $path_now,
							'komentar_status' => $komentar,
							'note' => $note,
							'tags' => $addTags,
							'created_at' => date('Y-m-d H:i:s'),
              'created_by' =>	$this->session->userdata('user'),
						];
						$this->mberita->add('t_berita', $values);
						// $msg['pesan'] = array('content' => 'Berita <b>'.$title.'</b> ditambahkan', 'colmsg' => 'bg-teal');
						$this->session->set_flashdata(array('message' => 'Berita <b>'.$title.'</b> berhasil ditambahkan', 'class' => 'alert alert-success'));
						redirect(base_url('backend/module/c_berita?module='.$this->madmin->getmodulebycontroller('c_berita').'&user='.$this->session->userdata('user_access')));
					}	
				} else {
				// $msg['pesan'] = array('content' => 'Content Check Validate Success, Pilih Tombol Publish', 'colmsg' => 'bg-blue');
				}
			}
  }
  //==========================================//

	public function edit_berita($id) {
		$source = [
      'content' => 'Backend/__module/___Berita/v_edit',
      'scriptjs' => 'Backend/__ServerSideJs/Berita/s_edit',
			'pageinfo' => '<li>Dasboard</li> <li>Manajemen Berita</li> <li>Edit</li><li class="active">'.$this->mberita->get_judulbyid($id).'</li>',
			'e' => $this->mberita->get_beritabyid($id),
      'css' => [
        'assets/plugins/select2/css/select2.min.css',
        'assets/plugins/select2/css/select2-materialize.css'
      ],
      'js' => [
        'assets/plugins/select2/js/select2.min.js'
			],
			'kategori' => $this->mkategori->show_whr_aktif('t_kategori')->result(),
			'tags' => $this->mkategori->show_tags('t_tags')->result()
    ];
    $this->load->view('Backend/v_home', $source);
	}

	public function update() {
		//AMBIL ID BERITA YANG DI EDIT
		$id = $this->input->post('id_berita');

		//AMBIL FILE GAMBAR SAAT INI
		$file_old = $this->input->post('file_old');

		//AMBIL SEMUA ISI FORM
		$file 				      = $_FILES['gambar']['name'];
		$file_blob   			  = file_get_contents($_FILES['gambar']['tmp_name']);
		$title              = $this->input->post('title_berita');
		$editor 						= @$_POST['isi_berita'];
		$komentar  				  = $this->input->post('sts_komentar');
		$kategori 			    = $this->input->post('kategori');
		$publish 			      = $this->input->post('publish');
		$head 			      	= $this->input->post('headline');
		$note 			        = $this->input->post('katapenulis');
    $tags 			        = $this->input->post('tags[]');
		$addTags 						= @implode(',', $tags);
		
		//CONFIG DATA UPLOAD DAN SIMPAN FILE 
		$acak27 = generateRandomString(27);
		// $date   = date('Y-m-d');
		$files  = $acak27;
			
		//INIT LIBRARY UPLOAD
		$config['upload_path']      = './files/file_berita/';
		$path_now 					= site_url('/files/file_berita/thumb/'.str_replace("/","",$files).'.'.pathinfo($file, PATHINFO_EXTENSION));
		$config['allowed_types']    = 'jpg|jpeg|png';
		$config['max_size'] 				= '5120'; // MAKSIMUM UKURAN FILE 5M
		$config['file_ext_tolower'] = true;
		$config['file_name'] 				= $files; // NAMA FILE YANG TERSIMPAN PADA ROOT	
		$this->load->library('upload', $config);

		// if (!$this->upload->do_upload('gambar')) {
		// 	// $msg['pesan'] = array('content' => $this->upload->display_errors(), 'colmsg' => 'bg-red');
		// 	$this->session->set_flashdata(array('message' => $this->upload->display_errors(), 'class' => 'alert alert-warning'));
		// 	redirect(base_url('backend/module/c_berita/edit_berita/'.$id.'?module='.$this->madmin->getmodulebycontroller('c_berita').'&user='.$this->session->userdata('user_access')));
		// } else {
			
			if($this->upload->do_upload('gambar')) {
				if (file_exists('./files/file_berita/'.$file_old)) {
					unlink('./files/file_berita/'.$file_old);
					if(file_exists('./files/file_berita/thumb/'.$file_old)) {
						unlink('./files/file_berita/thumb/'.$file_old);
					}
				}
				//function image_lib ci 
				$this->watermark($this->upload->data('file_name'));
				$this->resizeImage($this->upload->data('file_name'));
				
				$values = [
					'fid_kategori' => $kategori,
					'judul' => $title,
					'headline' => $head,
					'publish' => $publish,
					'content' => $editor,
					'tgl_posting' => date('Y-m-d'),
					'jam' => date('H:i:s'),
					'img' => $this->upload->data('file_name'),
					'img_blob' => $file_blob,
					'path' => $path_now,
					'komentar_status' => $komentar,
					'note' => $note,
					'tags' => $addTags,
					'update_at' => date('Y-m-d H:i:s'),
					'update_by' =>	$this->session->userdata('user'),
				];
			} else {
				$values = [
					'fid_kategori' => $kategori,
					'judul' => $title,
					'headline' => $head,
					'publish' => $publish,
					'content' => $editor,
					'tgl_posting' => date('Y-m-d'),
					'jam' => date('H:i:s'),
					'komentar_status' => $komentar,
					'note' => $note,
					'tags' => $addTags,
					'update_at' => date('Y-m-d H:i:s'),
					'update_by' =>	$this->session->userdata('user'),
				];
			}
			$this->mberita->update('t_berita', $values, ['id_berita' => $id]);
			// $msg['pesan'] = array('content' => 'Berita <b>'.$title.'</b> ditambahkan', 'colmsg' => 'bg-teal');
			$this->session->set_flashdata(array('message' => 'Berita <b>'.$title.'</b> berhasil diupdate', 'class' => 'alert alert-success'));
			redirect(base_url('backend/module/c_berita?module='.$this->madmin->getmodulebycontroller('c_berita').'&user='.$this->session->userdata('user_access')));
		// }	

	}
  
  //==========================================//
  ## LIST BERITA
	public function ajax_list() 
	{
    $search = $this->input->post('judul');

    $get_data = $this->mberita->fetch_datatable_berita($search);
    $data = array();
    $no = $_POST['start'];
  
    foreach($get_data as $r) {
  
    $sub_array = array();
      $sub_array[] = $no+1;
      // $sub_array[] = $r->id_berita;
      $sub_array[] = "<img src='".$r->path."' class='img-circle pull-left m-r-15' width='40' height='40'><b>".$r->judul."</b><br> <i class='material-icons pull-left font-16 m-r-5'>comment</i>".$this->mkomen->jml_komentarbyidberita($r->id_berita)." - <i class='text-danger'>". time_ago($r->jam)."</i>";
      $sub_array[] = longdate_indo($r->tgl_posting);
      $sub_array[] = "<span class='pull-right'>".$r->views."x</span> <i class='material-icons pull-left font-16'>visibility</i>";
      $sub_array[] = '
                          <button type="button" id="edit-berita" data-id="'.$r->id_berita.'" class="btn btn-link btn-sm waves-effect"><i class="glyphicon glyphicon-pencil"></i> EDIT</button>
                          <button type="button" id="hapus-berita" data-id="'.$r->id_berita.'" data-gambar="'.$r->img.'" data-judul="'.$r->judul.'" type="button" class="btn btn-link btn-sm waves-effect"><i class="glyphicon glyphicon-trash"></i> HAPUS</button>
                      ';
      $data[] = $sub_array;
  
    $no++;
    }
  
    $output = array(
      'draw'  		  => intval($_POST['draw']),
      'recordsTotal' 	  => $this->mberita->get_all_data_berita($search),
      'recordsFiltered' => $this->mberita->get_filtered_data_berita($search),
      'data'			  => $data			
    );
  
    echo json_encode($output); 
  }
  //==========================================//

  //==========================================//
  ## LIST KATEGORI
	public function ajax_kategori() 
	{
    $search = $this->input->post('cariKategori');
		$row = $this->mberita->ajax_list_kategori('t_kategori', $search)->result_array();
		$data = array();
		foreach($row as $r) {
			$data[] = array(
				"id" => $r['id_kategori'],
				"value" => $r['id_kategori'],
				"text" => $r['nama_kategori']
			);
		}
		echo json_encode(['items' => $data]);
  }

  //==========================================//

  //==========================================//
  ## LIST TAGS
	public function ajax_tags() 
	{
    $search = $this->input->post('cariTags');
		$rows = $this->mberita->ajax_list_tags('t_tags', $search);
		if($rows->num_rows() > 0) {
			$row = $rows->result_array();
			$data = array();
			foreach($row as $r) {
				$data[] = array(
					"id" => $r['nama_tag'],
					"text" => $r['nama_tag']
				);
			}
		} else {
			$data[] = ['id' => '0', 'text' => 'Tags tidak ditemukan'];
		}
		echo json_encode(['items' => $data]);
  }
  //==========================================//

  //==========================================//
  ## HAPUS BERITA
	public function hapusberita() {
		$id 	= $this->input->post('id');
		$file = $this->input->post('gambar');

		$tbl = 't_berita';
		$where = [
			'id_berita' => $id
		];

		$path = './files/file_berita/';
		$path_thumb = './files/file_berita/thumb/';
		if((file_exists($path.$file))) {
			if(file_exists($path_thumb.$file)) {
				unlink($path_thumb.$file);
			} 
			unlink($path.$file);
			$this->mberita->hapus_berita($tbl,$where);
			$msg = ['type' => 'bg-teal', 'content' => 'Deleted Success'];
		} else {
			$msg = ['type' => 'bg-red', 'content' => 'Deleted Gagal'];
		}
		$json = json_encode($msg);
		echo $json;		
			
	}
	//==========================================//

	public function watermark($filename) {
		$config['source_image'] = './files/file_berita/'. $filename;
		$config['wm_text'] = 'http://web.bkppd-balangankab.info';
		$config['wm_type'] = 'text';
		$config['wm_font_size'] = '8';
		$config['wm_font_color'] = '#ffffff';
		$config['wm_vrt_alignment'] = 'bottom';
		$config['wm_hor_alignment'] = 'center';
		$config['wm_padding'] = '3';

		$this->image_lib->initialize($config);
		$this->image_lib->watermark();
	}
	
	public function resizeImage($filename)
	{
		
		$source_path = './files/file_berita/' . $filename;
		$target_path = './files/file_berita/thumb/'. $filename;
		$config = array(
				'image_library' => 'gd2',
				'source_image' => $source_path,
				'new_image' => $target_path,
				'create_thumb' => TRUE,
				'maintain_ratio' => FALSE,
				'width' => '450',
				'height' => '292'
		);
	
		$this->image_lib->initialize($config);
		$this->image_lib->resize();
	}


}
