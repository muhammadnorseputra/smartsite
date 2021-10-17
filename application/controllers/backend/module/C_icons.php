<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_icons extends CI_Controller {
	public function __construct() 
	{
    parent::__construct();
		$this->load->model('M_b_icons','micons');
    if(($this->session->userdata('status') != "ONLINE") && ($this->session->userdata('user_access') == '')){
			redirect("login");
    }
  }
	
  //==========================================//
  ## Halaman Icons 
	public function index()
	{

		$data = [
				'content' => 'Backend/__Module/___Icons/v_table',
				'scriptjs' => 'Backend/__ServerSideJs/Icons/s_icons',
				'pageinfo' => '<li><a href="#"><i class="material-icons">dashboard</i> Dasboard</a></li>
							<li class="active">Icons</li>',
				'js' => [
					'https://unpkg.com/popper.js@1',
					'https://unpkg.com/tippy.js@5'
				]
		];
		$this->load->view('Backend/v_home', $data);
						
  }
	//==========================================//

  //==========================================//
  ## Tambah Icons 
	public function saveicon()
	{
		$fromRules = array(
			array(
				'field' => 'namaicon',
				'label' => 'Nama Icon',
				'rules' => 'required|trim|min_length[2]'
			)
		);
		$this->form_validation->set_rules($fromRules);
		if($this->form_validation->run() === FALSE)
		{
			$msg['pesan'] = validation_errors();
			$msg['msg_code'] = 0;
			$msg['type'] = 'bg-red';
		}
		else
		{
			$post_icon = $this->input->post('namaicon');
			$getNameIcon = $this->micons->search($post_icon)->row_array();
			if($post_icon == $getNameIcon['nama_icon'])
			{
				$msg['pesan'] = 'Icon sudah ada di daftar';
				$msg['msg_code'] = 2;
				$msg['type'] = 'bg-orange';
			}
			else
			{
				$msg['msg_code'] = 1;
				$msg['pesan'] = 'Success icon telah tersimpan';
				$msg['type'] = 'bg-teal';
				$val = array('nama_icon' => strtolower($post_icon));
				$this->micons->insert_icon($val);
			}
		}
		echo json_encode($msg);
	}
	//==========================================//
	
  //==========================================//
  ## Cari Icons 	
	public function search()
	{
		$kata = $this->input->post('kata');
		$result_search = $this->micons->search($kata)->result();
		if(count($result_search) > 0)
		{
			$cols = 12;
			$baris = "";
				foreach($result_search as $key){
				$baris .= "<div aria-label='".ucwords($key->nama_icon)."' class='hint--bottom hint--bounce col-sm-2 p-b-15 col-xs-1 text-center' data-hover='hover' data-tippy-content='".ucwords($key->nama_icon)."'><i class='material-icons font-32'>".$key->nama_icon."</i> <div class='font-11'>".strtolower($key->nama_icon)."</div></div>";
				}  
		} else {
				$baris = '<div class="text-center col-grey m-t-15 p-t-15 m-b-15">
										<em class="font-50 material-icons">find_in_page</em><br> Icon tidak ditemukan
									</div>';
		}
		echo json_encode($baris);
	}	
	//==========================================//

	//==========================================//
  ## List Icons 
	public function listicon()
	{
		$getIcon = $this->menu->get_icon('ref_icon', null)->result();
		if(count($getIcon) > 0)
		{
			$cols = 12;
			$baris = "";
				$no=1;
				foreach($getIcon as $val){
				$baris .= "<div aria-label='".ucwords($val->nama_icon)."' class='hint--bottom hint--bounce col-xs-6 col-sm-3 col-md-2 p-b-15 text-center' data-hover='hover' data-tippy-content='".ucwords($val->nama_icon)."'><i class='material-icons font-32'>".$val->nama_icon."</i> <div class='font-11 col-grey'>".strtolower($val->nama_icon)."</div></div>";
				$no++;
				}  
			
		}
		echo json_encode($baris);
	}
	//==========================================//

}
?>