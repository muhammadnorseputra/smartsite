<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_download extends CI_Controller {
	public function __construct() 
	{
    parent::__construct();
		$this->load->model('M_b_download', 'mdownload');
    if(($this->session->userdata('status') != "ONLINE") && ($this->session->userdata('user_access') == '')){
			redirect("login");
    }
  }

  //==========================================//
  ## DOWNLOAD 
	public function index()
	{

		$data = [
				'content' 	=> 'Backend/__module/___Download/v_table',
				'scriptjs'  => 'Backend/__ServerSideJs/Download/s_download',
				'pageinfo' 		=> '<li><a href="#"><i class="material-icons">dashboard</i> Dasboard</a></li>
							<li class="active">Download</li>',
				'css' => [
					'assets/plugins/jquery-ui/jquery-ui.min.css',
					'assets/plugins/jquery-ui/jquery-ui.theme.min.css'
				],
				'js' 				=> [
					'assets/plugins/jquery-validation/jquery.validate.js',
					'assets/plugins/jquery-validation/additional-methods.js'
				]
		];
		$this->load->view('Backend/v_home', $data);
			
  }
  //==========================================//

  //==========================================//
  ## EDIT DOWNLOAD BERDASARKAN ID DOWNLOAD 
	public function edit($id)
	{
		
    $data = [
			'content' 	=> 'Backend/__module/___Download/v_edit',
			'scriptjs'  => 'Backend/__ServerSideJs/Download/s_download',
			'pageinfo' 		=> '<li><a href="#"><i class="material-icons">dashboard</i> Dasboard</a></li><li><a href="#"><i class="material-icons">file_download</i> Download</a></li>
							<li class="active">Edit Download</li>',
			'formdata' 	=> $this->mdownload->edit('t_download', $id)->result_array(),
			'js' 				=> [
				'assets/plugins/jquery-validation/jquery.validate.js',
				'assets/plugins/jquery-validation/additional-methods.js'
			]
		];
		$this->load->view('Backend/v_home', $data);
  }
	//==========================================//	

	//==========================================//
  ## LIST LOCAL ( INTERNAL ) DOWNLOAD 
	public function list_internal()
	{
		$data = $this->mdownload->list_internal('t_download')->result();
		if( count($data) > 0 ) {
			$no = 1;
			$row = '';
				foreach($data as $val) {
					if($val->publish == 'N' ? $col = 'col-red font-italic' : $col = '');
					$jmlChar = strlen($val->file);
					$row .= '
										<tr class="'.$col.'">
											<td class="'.$col.'">'.$no.'</td>
											<td class="'.$col.'">'.$val->judul.' <br><code>'.$val->file.'</code></td>
											<td class="'.$col.'">'.date_indo($val->tgl_publish).'</td>											
											<td class="align-center"><a href="javascript:void(0)" onclick=\'window.open("'.$val->path.'", "_blank", "height=650, width=800, top=50, left=250, scrollbars=no, resizable=no")\'><em class="material-icons font-20">attach_file</em></a></td>
											<td class="align-right '.$col.'"><em class="material-icons font-20 pull-left col-grey">file_download</em>'.$val->count.'</td>
											<td class="align-center '.$col.'"><b class="col-teal">'.byte_format($val->ukuran).'</b></td>
											<td class="align-center">
											<a href="c_download/edit/'.$val->id_download.'?module='.$this->madmin->getmodulebycontroller('c_download').'&user='.$this->session->userdata('user_access').'" class="waves-effect waves-circle waves-float">
													<i class="material-icons font-18 m-t-5">mode_edit</i>
											</a>
												<a onclick="hapus('.$val->id_download.',\''.$val->file.'\',\''.$val->judul.'\')" class="waves-effect waves-circle waves-float bg-pink m-l-10">
														<i class="material-icons font-18 m-t-5">delete</i>
												</a>
											</td>
										</tr>
					';
					$no++;
				}
		} else {
			$row = '<tr><td colspan="7" class="text-center col-grey"><em class="font-20 material-icons">find_in_page</em>  Data Kosong</td></tr>';
		}

		$json = json_encode(['data' => $row]);
		echo $json;
  }
	//==========================================//

	//==========================================//
  ## LIST LUAR (LINK EKSTERNAL) DOWNLOAD 
	public function list_eksternal()
	{
		$data = $this->mdownload->list_eksternal('t_download')->result();
		if( count($data) > 0 ) {
			$no = 1;
			$row = '';
				foreach($data as $val) {
					if($val->publish == 'N' ? $col = 'col-red font-italic' : $col = '');
					$row .= '
										<tr>
											<td class="'.$col.'">'.$no.'</td>
											<td class="'.$col.'">'.$val->judul.'</td>
											<td class="'.$col.'">'.date_indo($val->tgl_publish).'</td>
											<td class="align-center"><a href="javascript:void(0);" onclick=\'window.open("'.$val->link.'", "_blank", "height=650, width=800, top=50, left=250, scrollbars=no, resizable=no")\'><em class="material-icons font-20">attach_file</em></a></td>
											<td class="align-right '.$col.'"><em class="material-icons font-20 pull-left col-grey">file_download</em>'.$val->count.'</td>
											<td class="align-center">
											<a href="c_download/edit/'.$val->id_download.'?module='.$this->madmin->getmodulebycontroller('c_download').'&user='.$this->session->userdata('user_access').'" class="waves-effect waves-circle waves-float" id="btn-edit-download-eks">
													<i class="material-icons font-18 m-t-5">mode_edit</i>
											</a>
												<a onclick="hapus_eksternal_file('.$val->id_download.',\''.$val->link.'\')" class="waves-effect waves-circle waves-float bg-pink m-l-10">
														<i class="material-icons font-18 m-t-5">delete</i>
												</a>
											</td>
										</tr>
					';
					$no++;
				}
		} else {
			$row = '<tr><td colspan="6" class="text-center col-grey"><em class="font-20 material-icons">find_in_page</em>  Data Kosong</td></tr>';
		}

		$json = json_encode(['data' => $row]);
		echo $json;
  }
	//==========================================//

	public function edit_linkekseternal($id) {
		$data = [
			'formdata' => $this->mdownload->edit_linkekseternal('t_download', $id)->result()
		];
		$html = $this->load->view('Backend/__Module/___Download/v_edit_eksternal', $data);
		return $html;
	}
	
	//==========================================//
  ## PROSES DOWNLOAD BERDASARKAN LINK EKSTERNAL 
	public function addByLink()
	{
		$values = [
			'judul' => $this->input->post('judul'),
			'link' => reduce_double_slashes($this->input->post('link')),
			'publish' => $this->input->post('publish')
		];
		$data = $this->mdownload->addByLink('t_download', $values);

		if($data) {
			$msg['pesan'] = "Success Uploaded File";
			$msg['type'] = "success";
		} else {
			$msg['pesan'] = array('error' => "Gagal Uploaded File");
			$msg['type'] = "error";
		}
		echo json_encode(['responses' => $msg]);
  }
	//==========================================//
	
  //==========================================//
  ## PROSES UPLOAD FILE DOWNLOAD 
	public function add()
	{
		$file  = $_FILES['file']['name'];
		$file_blob  = file_get_contents($_FILES['file']['tmp_name']);

			if(!empty($file)){
					// membuat nomor acak untuk nama file
					$acak27 = generateRandomString(27);
					$date = date('Y-m-d');
					
					$files = $acak27;	
					//init library upload
					$config['upload_path']          = './files/file_download/';
					$path_now 								      = site_url('/files/file_download/'.strtolower(str_replace("/","",$files)));
					$config['allowed_types']        = 'pdf|doc|xlsx|xls|pptx|csv|zip|rar';
					$config['max_size'] = '2048'; //maksimum besar file 5M
					$config['file_name'] = strtolower($files); //nama yang terupload nantinya
					
					$this->load->library('upload', $config);
					if (!$this->upload->do_upload('file')) {
						$error = array('error' => $this->upload->display_errors());
						$msg['pesan'] = $error;
						$msg['type'] = "error";
					} else {
						$values = [
							'judul' => $this->input->post('judul'),
							'file' => strtolower($this->upload->data('file_name')),	
							'file_blob' => $file_blob,
							'type' => $this->upload->data('file_ext'),
							'path' => $path_now,
							'link' => $this->input->post('link_file'),
							'ukuran' => $this->upload->data('file_size'),
							'publish' => $this->input->post('publish')
						];
						$this->mdownload->in_upload('t_download', $values);					
					
						$msg['pesan'] = "Success Uploaded File";
						$msg['type'] = "success";

					}
						
				echo json_encode(['responses' => $msg]);
					
			} 
		}
  //==========================================//

  //==========================================//
  ## HAPUS FILE DOWNLOAD LOCAL
	public function hapus($id,$file)
	{
		$tbl = 't_download';
		$where = [
			'id_download' => $id,
			'file' => $file
		];

		$path = './files/file_download/';
		if(file_exists($path.$file)) {
			unlink($path.$file);
			$this->mdownload->delete($tbl,$where);
			$msg['pesan'] = ['type' => 'bg-teal', 'content' => 'Success Deleted', 'stsText' => true];
		} else {
			$msg['pesan'] = ['type' => 'bg-pink', 'content' => 'Error Deleted', 'stsText' => false];
		}
		$json = json_encode($msg);
		echo $json;
  }
	//==========================================//	
	
  //==========================================//
  ## HAPUS FILE DOWNLOAD EKSTERNAL 
	public function hapus_eks_link($id)
	{
		$tbl = 't_download';
		$where = [
			'id_download' => $id,
			'link' => $this->input->get('sumber')
		];

		$del = $this->mdownload->delete_eks_link($tbl,$where);
		
		if($del) {
			$msg['pesan'] = ['type' => 'bg-pink', 'content' => 'Error Deleted', 'stsText' => false];
		} else {
			$msg['pesan'] = ['type' => 'bg-teal', 'content' => 'Success Deleted', 'stsText' => true];
		}

		$json = json_encode($msg);
		echo $json;
  }
	//==========================================//	
	
  //==========================================//
  ## UPDATE FILE DOWNLOAD BERDASARKAN ID DOWNLOAD 
	public function update($id)
	{
		$judul = $this->input->post('judul');
		$publish = $this->input->post('publish');
		$link = $this->input->post('link');
		$fileBefore = $this->input->post('file_lama');
		$file = $this->input->post('file');

		if(($link != '') && ($file == '')) {

			$set = [
				'judul' => $judul,
				'publish' => $publish,
				'link' => $link
			];
			$whr = [
				'id_download' => $id
			];

			$this->mdownload->updateElse('t_download', $set, $whr);
			$goBack = "module/c_download?module=".$this->madmin->getmodulebycontroller('c_download')."&user=".$this->session->userdata('user_access');
			redirect(site_url($goBack));

		} else {

			$file_name  = $_FILES['file']['name'];
			$file_name_blob  = file_get_contents($_FILES['file']['tmp_name']);
			if(!empty($file_name)) {
				$acak27 = generateRandomString(27);
				$date = date('Y-m-d');
				
				$files = $acak27;	
				//init library upload
				$config['upload_path']   	= './files/file_download/';
				$path_now 								= site_url('/files/file_download/'.strtolower(str_replace("/","",$files)));
				$config['allowed_types'] 	= 'pdf|doc|xlsx|xls|pptx|csv|zip|rar';
				$config['max_size'] 			= '2048'; //maksimum besar file 5M
				$config['file_name'] 			= strtolower($files); //nama yang terupload nantinya
				
				$this->load->library('upload', $config);
				
				if (!$this->upload->do_upload('file')) {
					$msg = $this->upload->display_errors();	
					// echo $msg;		
					$this->session->set_flashdata(array('pesan' => $msg, 'class' => 'alert alert-warning'));	
					$uri = "backend/module/c_download/edit/".$id."?module=".$this->madmin->getmodulebycontroller('c_download')."&user=".$this->session->userdata('user_access');
					redirect(site_url($uri));	
				} else {
					if (file_exists('./files/file_download/'.$fileBefore)) {
						unlink('./files/file_download/'.$fileBefore);
					}
					$whr = [
						'id_download' => $id
					];
					$values = [
						'judul' => $this->input->post('judul'),
						'file' => strtolower($this->upload->data('file_name')),	
						'file_blob' => $file_name_blob,
						'type' => $this->upload->data('file_ext'),
						'path' => $path_now,
						'ukuran' => $this->upload->data('file_size'),
						'publish' => $this->input->post('publish')
					];
					$this->mdownload->updateElse('t_download', $values, $whr);					
					//$msg = "Success Uploaded File";
					$goBack = "module/c_download?module=".$this->madmin->getmodulebycontroller('c_download')."&user=".$this->session->userdata('user_access');
					redirect(site_url($goBack));
				}


			} else {
				$set = [
					'judul' => $judul,
					'publish' => $publish
				];
				$whr = [
					'id_download' => $id
				];
				$this->mdownload->updateElse('t_download', $set, $whr);
				$goBack = "module/c_download?module=".$this->madmin->getmodulebycontroller('c_download')."&user=".$this->session->userdata('user_access');
				redirect(site_url($goBack));
			}
		}
  }
	//==========================================//	

}

?>