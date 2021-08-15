<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_halaman extends CI_Controller {
	public function __construct() 
	{
    parent::__construct();
		$this->load->model('M_b_halaman', 'mhalaman');
    _is_logged_in();
  }

  //==========================================//
  ## HALAMAN 
	public function index()
	{

		$data = [
				'content' => 'Backend/__module/___Halaman/v_table',
				'scriptjs' => 'Backend/__ServerSideJs/Halaman/s_table',
				'pageinfo' => '<li><a href="#"><i class="material-icons">dashboard</i> Dasboard</a></li>
							<li class="active">Halaman</li>',
				'css' => [
					'assets/plugins/jquery-ui/jquery-ui.min.css',
					'assets/plugins/jquery-ui/jquery-ui.theme.min.css',
					'assets/plugins/datatable/datatables.min.css',
					'assets/plugins/datatable/inc_tablesold.css'
				],
				'js' => [
					'assets/plugins/copy-clipboard/clipboard.min.js',
					'assets/plugins/datatable/datatables.min.js'
				]
		];
		$this->load->view('Backend/v_home', $data);
			
  }
	//==========================================//
	
  //==========================================//
  ## TAMBAH HALAMAN
	public function tambah()
	{
    $data = [
			'content' => 'Backend/__module/___Halaman/v_tambah',
			'scriptjs' => 'Backend/__ServerSideJs/Halaman/s_tambah',
			'pageinfo' => '<li> Dasboard</li><li> Halaman Statis</li> <li class="active">Tambah halaman baru</li>',
			'js' => [
				'assets/plugins/jquery-validation/jquery.validate.js',
				'assets/plugins/jquery-validation/additional-methods.js'
			]
		];
		$this->load->view('Backend/v_home', $data);		
	}
	//==========================================//

  //==========================================//
	## LIST HALAMAN
	public function list_halaman()
	{
		$katakunci = $this->input->post('katakunci');
		
		if($this->session->userdata('lvl') == 'ADMIN') {
			if($katakunci == '') 
			{
				$data = $this->db->order_by('id_halaman','desc')->get('t_halaman')->result();
			} else {
				$data = $this->db->like('title', $katakunci)->or_like('token_halaman', $katakunci)->get('t_halaman')->result();
			}
		} else {
			
			$user = $this->session->userdata('user');
			if($katakunci == '') 
			{
				$data = $this->db->order_by('id_halaman','desc')
												 ->get_where('t_halaman', array('fid_username' => $user))
												 ->result();
			} else {
				$data = $this->db->where('fid_username',$user)
												 ->like('title', $katakunci)
												 ->or_like('token_halaman', $katakunci)
												 ->get('t_halaman')
												 ->result();
			}
		}
			

		if( count($data) != 0 ) {
			$no = 1;
			$row = '';
				foreach($data as $val) {
					if($val->publish == 'N' ? $col = 'bg-grey' : $col = '');
					if($val->filename != ''){
						// $namafile = '<i class="material-icons col-teal m-t--1 font-20">insert_drive_file</i>';
						$format_file = '';
						if(($val->mime == 'application/vnd.open')) {
							$format_file = '<i class="material-icons col-grey m-t--1 font-40">insert_drive_file</i>'; 
						} elseif(($val->mime == 'text/plain')){
							$format_file = '<i class="material-icons col-grey m-t--1 font-40">insert_drive_file</i>'; 
						} elseif ($val->mime == 'image/jpeg') {
							$format_file = '<i class="material-icons col-grey m-t--1 font-40">photo_library</i>';
						} elseif ($val->mime == 'application/pdf') {
							$format_file = '<i class="material-icons col-grey m-t--1 font-40">picture_as_pdf</i>';
						}
						$namafile = $format_file;
					} else {
						$namafile = '';
					}
					if(strlen($val->title) >= 70)  {
						$title = substr(ucwords($val->title),0,70)."...";
					} else {
						$title = $val->title;
					}
					
					if($val->filesize != '0') {
						$btndownload = '<li><a href="'.site_url('backend/module/').'c_halaman/download/'.$val->id_halaman.'" class=" waves-effect waves-block">Download</a></li>';
					} else {
						$btndownload = '';
					}

					$status_publish = ($val->publish == 'Y') ? '<span class="col-teal">ON</span>' : '<span class="col-grey">OFF</span>'; 
					

					//<embed src="data:'.$val->mime.';base64,'.base64_encode($val->file).'" width="150">
					//Mouse hover letakana pada <tr></tr> => style="position:relative;" onmouseover="hover('.$val->id_halaman.')" onmouseleave="leave('.$val->id_halaman.')"

					// style="display:none;position:absolute; right:35%; top:15px;" tambahkan pada span id="button-option">
					$row .= '
										<tr>
											<td class="font-bold">
											<ul class="header-dropdown list-unstyled pull-left m-r-10 m-t-10">
												<li class="dropdown">
												<a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
														<i class="material-icons font-18">more_vert</i>
												</a>
													<ul class="dropdown-menu">
														<li><a onclick="delete_data('.$val->id_halaman.')" href="javascript:void(0);"  class=" waves-effect waves-block"><i class="glyphicon glyphicon-trash m-r-5"></i> Hapus</a></li>
														<li><a onclick="edit_halaman('.$val->id_halaman.')" href="javascript:void(0);" class=" waves-effect waves-block"><i class="glyphicon glyphicon-pencil m-r-5"></i> Edit</a></li>
														<li><a href="javascript:void(0);" class=" waves-effect waves-block disabled"><i class="glyphicon glyphicon-eye-open m-r-5"></i>  Preview</a></li>
														'.$btndownload.'
														<li role="separator" class="divider"></li>
														<li><a onclick="copytoken(\''.$val->token_halaman.'\')" href="javascript:void(0);" class="btn-copy waves-effect waves-block"><i class="glyphicon glyphicon-link m-r-5"></i>  Token</a></li>
													</ul>
												</li>
											</ul>
											<div class="col-black m-t--5 m-l-10">
											<span class=" font-16 ">'.$title.'</span><br>	
											<p class="col-grey">'.$val->created_by.', '.longdate_indo($val->tgl_created).'</p>
											</div>
												
											</td>
											<td class="text-left">
												<a href="javascript:void(0);" onclick=\'window.open("'.site_url('backend/module/').'c_halaman/preview/'.$val->id_halaman.'", "_blank", "height=550, width=960, top=50, left=200, scrollbars=no, resizable=no");\'>
												'.$namafile.'
												</a>
											</td>
											<td class="bg-lime">
												<em class="material-icons font-18">visibility</em> 
												<b class="pull-right">'.$val->views.'</b>
											</td>
											<td class="text-center">
												'.$status_publish.'
											</td>
										</tr>
					';
					$no++;
				}
		} else {
			$row = '<tr><td colspan="5" class="text-center col-grey"><em class="font-28 material-icons">find_in_page</em><br>  Halaman <B>'.$katakunci.'</B> Belum Ada.</td></tr>';
		}

		$json = json_encode(['response' => $row]);
		echo $json;
	}
	//==========================================//
	
	public function list_halaman_datatable() {

    $getdata = $this->mhalaman->fetch_datatable_halaman();
    $data = array();
    $no = $_POST['start'];
  
	foreach($getdata as $val) {
			if($val->publish == 'N' ? $col = 'bg-grey' : $col = '');
			if($val->filename != ''){
				// $namafile = '<i class="material-icons col-teal m-t--1 font-20">insert_drive_file</i>';
				$format_file = '';
				if(($val->mime == 'application/vnd.open')) {
					$format_file = '<i class="material-icons col-grey m-t--1 font-40">insert_drive_file</i>'; 
				} elseif(($val->mime == 'text/plain')){
					$format_file = '<i class="material-icons col-grey m-t--1 font-40">insert_drive_file</i>'; 
				} elseif ($val->mime == 'image/jpeg') {
					$format_file = '<i class="material-icons col-grey m-t--1 font-40">photo_library</i>';
				} elseif ($val->mime == 'application/pdf') {
					$format_file = '<i class="material-icons col-grey m-t--1 font-40">picture_as_pdf</i>';
				}
				$namafile = $format_file;
			} else {
				$namafile = '';
			}
			if(strlen($val->title) >= 70)  {
				$title = substr(ucwords($val->title),0,70)."...";
			} else {
				$title = $val->title;
			}
			
			if($val->filesize != '0') {
				$btndownload = '<li><a href="'.site_url('backend/module/').'c_halaman/download/'.$val->id_halaman.'" class=" waves-effect waves-block">Download</a></li>';
			} else {
				$btndownload = '';
			}

			$status_publish = ($val->publish == 'Y') ? '<span class="col-teal">ON</span>' : '<span class="col-grey">OFF</span>'; 

    		$sub_array = array();
      		$sub_array[] = '<ul class="header-dropdown list-unstyled pull-left m-r-10 m-t-10">
												<li class="dropdown">
												<a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
														<i class="material-icons font-18">more_vert</i>
												</a>
													<ul class="dropdown-menu">
														<li><a onclick="delete_data('.$val->id_halaman.')" href="javascript:void(0);"  class=" waves-effect waves-block"><i class="glyphicon glyphicon-trash m-r-5"></i> Hapus</a></li>
														<li><a onclick="edit_halaman('.$val->id_halaman.')" href="javascript:void(0);" class=" waves-effect waves-block"><i class="glyphicon glyphicon-pencil m-r-5"></i> Edit</a></li>
														<li><a href="javascript:void(0);" class=" waves-effect waves-block disabled"><i class="glyphicon glyphicon-eye-open m-r-5"></i>  Preview</a></li>
														'.$btndownload.'
														<li role="separator" class="divider"></li>
														<li><a onclick="copytoken(\''.$val->token_halaman.'\')" href="javascript:void(0);" class="btn-copy waves-effect waves-block"><i class="glyphicon glyphicon-link m-r-5"></i>  Token</a></li>
													</ul>
												</li>
											</ul>
											<div class="col-black m-t--5 m-l-10">
											<span class=" font-16 ">'.$title.'</span><br>	
											<p class="col-grey">'.$val->created_by.', '.longdate_indo($val->tgl_created).'</p>
											</div>';
      		$sub_array[] = '<a href="javascript:void(0);" onclick=\'window.open("'.site_url('backend/module/').'c_halaman/preview/'.$val->id_halaman.'", "_blank", "height=550, width=960, top=50, left=200, scrollbars=no, resizable=no");\'>
												'.$namafile.'
												</a>';
			$sub_array[] = '<em class="material-icons font-18">visibility</em> 
												<b class="pull-right">'.$val->views.'</b>';			
			$sub_array[] = $status_publish;
      		$data[] 		 = $sub_array;
  
    $no++;
    }
  
    $output = array(
      'draw'  		  		=> intval($_POST['draw']),
      'recordsTotal' 	  => $this->mhalaman->get_all_data_halaman(),
      'recordsFiltered' => $this->mhalaman->get_filtered_data_halaman(),
      'data'			  		=> $data			
    );
  
    echo json_encode($output); 
  }

  //==========================================//
	## PROSES TAMBAH HALAMAN
	public function add()
	{
		$title = $this->input->post('title_halaman');
		$content = $this->input->post('content_halaman');
		$publish = $this->input->post('publish');
		
		$acak 	 = generateRandomString(30);

		$filename = $_FILES['fileinsert']['name'];
		$filetype = $_FILES['fileinsert']['type'];
		$filesize = $_FILES['fileinsert']['size'];
		$getfile 	= file_get_contents($_FILES['fileinsert']['tmp_name']);

		if(!empty($content)) {
			if((!empty($filename)))	
			{
				$valueses = [
					'title' => $title,
					'content' => $content,
					'tgl_created' => date('Y-m-d'),
					'fid_username' => $this->session->userdata('user'),
					'created_by' => $this->session->userdata('namalengkap'),
					'filename' => $filename,
					'file' => $getfile,
					'mime' => $filetype,
					'filesize' => $filesize,
					'token_halaman' => $acak,
					'publish' => $publish
				];
				$this->db->insert('t_halaman', $valueses);
				// $msg = array('content' => 'Ditambahkan Halaman "<b>'.$title.'</b>" <code>'.$filename.'</code>', 'status' => true, 'col' => 'bg-teal');
				$this->session->set_flashdata(array('message' => 'Halaman <b>'.$title.'</b> berhasil ditambahkan, dengan lampiran <code>'.$filename.'</code>', 'class' => 'alert alert-success'));
						redirect(base_url('backend/module/c_halaman?module='.$this->madmin->getmodulebycontroller('c_halaman').'&user='.$this->session->userdata('user_access')));
			} 
			else 
			{
				$values = [
					'title' => $title,
					'content' => $content,
					'tgl_created' => date('Y-m-d'),
					'created_by' => $this->session->userdata('namalengkap'),
					'token_halaman' => $acak,
					'publish' => $publish
				];
				$this->db->insert('t_halaman', $values);
				// $msg = array('content' => 'Halaman <b>'.$title.'</b> ditambahkan', 'status' => true, 'col' => 'bg-teal');
				$this->session->set_flashdata(array('message' => 'Halaman <b>'.$title.'</b> berhasil ditambahkan, tanpa lampiran', 'class' => 'alert alert-success'));
						redirect(base_url('backend/module/c_halaman?module='.$this->madmin->getmodulebycontroller('c_halaman').'&user='.$this->session->userdata('user_access')));
			}
		} else {
			$this->session->set_flashdata(array('message' => 'Bagian content wajib diisi.', 'class' => 'alert alert-warning'));
			redirect(base_url('backend/module/c_halaman/tambah?module='.$this->madmin->getmodulebycontroller('c_halaman').'&user='.$this->session->userdata('user_access')));
		}

	}
	//==========================================//

	//==========================================//
	## PROSES UPDATE HALAMAN
	public function update()
	{
		$id = $this->input->post('idhalaman');
		$title = $this->input->post('title');
		$content = $_POST['content_halaman'];
		$publish = $this->input->post('publish');
		
		$filename = $_FILES['inputfile']['name'];
		$filetype = $_FILES['inputfile']['type'];
		$filesize = $_FILES['inputfile']['size'];

		if(!empty($filename))
		{
			
			$getfile 	= file_get_contents($_FILES['inputfile']['tmp_name']);
			if(!empty($content)) {
				$dset = [
					'title' => $title,
					'content' => $content,
					'update_at' => date('Y-m-d'),
					'update_by' => $this->session->userdata('namalengkap'),
					'filename' => $filename,
					'file' => $getfile,
					'mime' => $filetype,
					'filesize' => $filesize,
					'publish' => $publish
				];
			} else {
				$dset = [
					'title' => $title,
					'update_at' => date('Y-m-d'),
					'update_by' => $this->session->userdata('namalengkap'),
					'filename' => $filename,
					'file' => $getfile,
					'mime' => $filetype,
					'filesize' => $filesize,
					'publish' => $publish
				];
			}

			$dwhr = [
				'id_halaman' => $id
			];

			$this->db->update('t_halaman', $dset, $dwhr);
			// $json = [
			// 	'message' => 'Success updated data',
			// 	'color' => 'teal'
			// ];
			$this->session->set_flashdata(array('message' => 'Halaman <b>'.$title.'</b> berhasil diupdate, dengan lampiran <code>'.$filename.'</code>', 'class' => 'alert alert-success'));
						redirect(base_url('backend/module/c_halaman?module='.$this->madmin->getmodulebycontroller('c_halaman').'&user='.$this->session->userdata('user_access')));
		} 
		else 
		{
			if(!empty($content)) {
			$dset = [
				'title' => $title,
				'content' => $content,
				'update_at' => date('Y-m-d'),
				'update_by' => $this->session->userdata('namalengkap'),
				'publish' => $publish
			];
			} else {
				$dset = [
					'title' => $title,
					'update_at' => date('Y-m-d'),
					'update_by' => $this->session->userdata('namalengkap'),
					'publish' => $publish
				];
			}

			$dwhr = [
				'id_halaman' => $id
			];

			$this->db->update('t_halaman', $dset, $dwhr);
			// $json = [
			// 	'message' => 'Success updated data',
			// 	'color' => 'teal'
			// ];
			$this->session->set_flashdata(array('message' => 'Halaman <b>'.$title.'</b> berhasil diupdate', 'class' => 'alert alert-success'));
						redirect(base_url('backend/module/c_halaman?module='.$this->madmin->getmodulebycontroller('c_halaman').'&user='.$this->session->userdata('user_access')));
		}

		echo json_encode($json);
	}
	//==========================================//

	//==========================================//
	## EDIT HALAMAN BERDASARKAN ID HALAMAN
	public function edithalaman($id)
	{
		$data = $this->mhalaman->Medithalaman($id);
		$json = json_encode($data);
		echo $json;
	}
	//==========================================//
	
	//==========================================//
	## OPEN EDITOR HALAMAN BERDASARKAN ID HALAMAN
	public function openeditor($token)
	{
		$db['r'] = $this->mhalaman->opendataeditor($token)->result();
		$html = $this->load->view('Backend/__Module/___Halaman/v_openeditor', $db);
		$response = $html;
		return $response;
	}
	
	public function saveditor() {
		$id = $this->input->post('token');
		$content = $this->input->post('content');
		$data = [
			'content' => $content
		];
		$whr  = [
			'token_halaman' => $id
		];
		$send = $this->mhalaman->simpandataeditor('t_halaman', $whr, $data);
		if($send == true) {
			$msg = 'Contant has changed';
		} else {
			$msg = 'Error update';
		}
		echo $msg;
	}
	
	public function edittitle($id) {
		$title = $this->input->post('title');
		$data = ['id' => $id, 'title' => $title];
		
		$form = $this->load->view('Backend/__Module/___Halaman/v_form_edittitle', $data);
		return $form;
	}
	
	public function simpantitle($id) {
		$title = $this->input->post('title');
		$data = [
			'title' => $title
		];
		$where = [
			'token_halaman' => $id
		];
		$send = $this->mhalaman->simpantitle('t_halaman', $data, $where);
		if($send == true) {
			$msg = [
				'pesan' => 'Mohon tunggu, updateting database',
				'res'   => $title
			];
		} else {
			$msg = [
				'pesan' => 'Error saat ganti title',
				'res'	=> 'Undefined'
			];
		}
		echo json_encode($msg);
	}
	
	
	//==========================================//
	
	//==========================================//
	## COPY TOKEN HALAMAN BERDASARKAN ID HALAMAN
	public function copytoken($token)
	{
		$html = '
		<div class="input-group">
			
			<span class="help-block">Salin kode dibawah ini, lalu pastekan pada link.</span>
			<div class="form-line">
				<input type="text" class="form-control col-black" value="'.$token.'" readonly>
			</div>
			<div class="input-group-addon m-l-25">
				<a href="javascript:void(0);" class="copy-token" data-clipboard-text="'.$token.'" title="Copy">
					<i class="material-icons">content_copy</i>
				</a>
			</div>
		</div>
		';
		echo $html;
	}
	//==========================================//
	
	//==========================================//
	## PREVIEW HALAMAN BERDASARKAN ID HALAMAN
	public function preview($id) 
	{
		$r = $this->db->get_where('t_halaman', array('id_halaman' => $id))->result();
		if(($r[0]->mime != 'application/pdf') && ($r[0]->mime != 'image/jpeg')){
			force_download($r[0]->filename, $r[0]->file);
		} else {
			$this->output->set_header('Content-type:'.$r[0]->mime);
			$this->output->set_output($r[0]->file);
		}
	}
	//==========================================//

	//==========================================//
	## DOWNLOAD HALAMAN BERDASARKAN ID HALAMAN
	public function download($id)
	{
		$r = $this->db->get_where('t_halaman', array('id_halaman' => $id))->result();		
		header("Content-length: ".$r[0]->filesize."");
		header("Content-type: ".$r[0]->filetype."");
		header("Content-Disposition: attachment; filename=".$r[0]->filename."");
		force_download($r[0]->filename, $r[0]->file);
	}
	//==========================================//

	//==========================================//
	## HAPUS HALAMAN BERDASARKAN ID HALAMAN
	public function delete($id)
	{
		$r = $this->db->delete('t_halaman', array('id_halaman' => $id));
		if($r) 
		{
			$msg = array('type' => 'bg-black', 'content' => 'Deleted Success');
		} 
		else 
		{
			$msg = array('type' => 'bg-red', 'content' => 'Deleted Gagal');
		}

		$json = json_encode($msg);
		echo $json;
	}
	//==========================================//

	//==========================================//
	## HAPUS LAMPIRAN HALAMAN BERDASARKAN ID HALAMAN
	public function hapus_lampiran($id) {
		$val = [
			'filename' => null,
			'file' => null,
			'mime' => null,
			'filesize' => null
		];
		$whr = [
			'id_halaman' => $id
		];
		$send = $this->mhalaman->hapus_lampiranbyid('t_halaman', $val, $whr);
		if($send == true) {
			$msg = array("Lampiran halaman telah dihapus", "ok");
		} else {
			$msg = array("Lampiran gagal dihapus", "fail");
		}
		echo json_encode($msg);

	}
	//==========================================//
	
}