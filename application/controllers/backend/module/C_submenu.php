<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_submenu extends CI_Controller {
	public function __construct() 
	{
    parent::__construct();
		$this->load->model('M_b_submenu', 'msubmenu');
		$this->load->model('M_b_module', 'module');
		$this->load->model('M_b_halaman', 'mhalaman');
    if($this->session->userdata('status') != "ONLINE"){
			redirect("login");
		}
  }
	public function index()
	{
    $data = [
				'content' => 'Backend/__Module/___Submenu/v_table',
				'pageinfo' => '<li>Dasboard</li> <li>Manajemen Menu</li>
							<li class="active">Submenu</li>',
				'scriptjs' => 'Backend/__ServerSideJs/Submenu/S_submenu',
				'css' => [
					'assets/plugins/bootstrap-select/css/bootstrap-select.css'
				],
				'js' => [
					'assets/plugins/bootstrap-select/js/bootstrap-select.js',
					'assets/js/pages/ui/tooltips-popovers.js'
				]
		];
		$this->load->view('Backend/V_home', $data);
	}

	public function caridata()
	{
		$kata = $this->input->get('katakunci');
		$output= array('data' => $this->msubmenu->get_search($kata));
		echo json_encode($output);
	}
	public function loaddata()
	{
		$config = array();
		$config['base_url'] = '#';
		$config['total_rows'] = $this->msubmenu->count_all();
		$config['per_page'] = 5;
		$config['uri_segment'] = 5;
		$config['use_page_numbers'] = TRUE;
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['next_link'] = 'Selanjutnya';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_link'] = 'Sebelumnya';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a href="javascript:void(0);" class="waves-effect">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['num_links'] = 1;
		$this->pagination->initialize($config);
		$page = $this->uri->segment(5);
		$start = ($page - 1) * $config['per_page'];

		$output = array(
			'pagination' => $this->pagination->create_links(),
			'content' => $this->msubmenu->fetch_data($config['per_page'], $start),
			'per' => $config['uri_segment'],
			'totalRows' => $config['total_rows']
		);

		echo json_encode($output);
	}
	public function savesubmenu()
	{
		$submain = $this->input->post('submainmenu');
		$submenu = $this->input->post('submenu');
		$module  = $this->input->post('modulesubmenu');
		$linksub = $this->input->post('linksub');
		$order 	 = $this->input->post('ordersub');
		$aktif 	 = $this->input->post('aktifsub');

		//UNTUK ID CEK PADA DATABASE TABLE `t_module` 
		$link = $module == '27' ? 'halaman/statis/'.$linksub.'/'.$this->mhalaman->get_title_halaman($linksub) : $linksub;

		$value = [
			'idmain' => $submain,
			'fid_module' => $module,
			'nama_sub' => $submenu,
			'link_sub' => $link,
			'order' => $order,
			'aktif' => $aktif
		];

		if($value === '' || $aktif == '' || $submenu == '' || $submain == 0 || $linksub == '')
		{
			$pesan['msgdata']  = 1;
		}
		else
		{
			$pesan['msgdata']  = 0;
			$this->msubmenu->insert('t_submenu', $value);
		}

		echo json_encode($pesan);
	} 
	
	public function mainmenu()
	{
		$sql = $this->msubmenu->get_mainmenu()->result();

		if(count($sql) > 0)
		{
			$rows = '';
			foreach ($sql as $key) {
				$rows .= '<option value="'.$key->id_menu.'">'.ucwords($key->nama_menu).'</option>';
			}
		}
		else
		{
			$rows .= '<option>Menu Kosong</option>';
		}
		echo json_encode($rows);
	}	
	
	public function allmodule()
	{
		$sql = $this->module->get_module_list();

		if(count($sql) > 0)
		{
			$rows = '';
			foreach ($sql as $key) {
				$rows .= '<option value="'.$key->id_module.'">'.ucwords($key->nama_module).'</option>';
			}
		}
		else
		{
			$rows .= '<option>Menu Kosong</option>';
		}
		echo json_encode($rows);
	}
	
	public function editsubmenu()
	{
		$getsub = $this->msubmenu->get_submenu_where_id($this->input->get('idsub'))->result();
		$responses = array(
			'data' => $getsub
		);
		echo json_encode($responses);
	}

	public function updatesubmenu()
	{
		$idmain = $this->input->post('editidmainmenu');
		$fidmodule = $this->input->post('editnamamodule');
		$namasub = $this->input->post('editsubmenu');
		$linksub = $this->input->post('editlinksub');
		$ordersub = $this->input->post('editordersub');
		$aktif = $this->input->post('editaktifsub');
		$id = $this->input->post('editidsub');

		//UNTUK ID CEK PADA DATABASE TABLE `t_module` 
		$link = $fidmodule == '27' ? 'halaman/statis/'.$linksub.'/'.$this->mhalaman->get_title_halaman($linksub) : $linksub;

		if(!empty($id))
		{
			$values = array(
				'idmain' => $idmain,
				'fid_module' => $fidmodule,
				'nama_sub' => $namasub,
				'link_sub' => $link,
				'order' => $ordersub,
				'aktif' => $aktif
			);

			$where = array('idsub' => $id);
			$this->msubmenu->updatesubmenu('t_submenu',$where,$values);

			$msg['type'] = 'success';
			$msg['label'] = 'bg-teal';
			$msg['content'] = 'Submenu <b>'.$namasub.'</b> Telah Terupdate';
		}
		else 
		{
			$msg['type'] = 'error';
			$msg['label'] = 'bg-red';
			$msg['content'] = 'Submenu <b>'.$namasub.'</b> Gagal Diupdate';
		}

		$responses = [
			'message' => $msg
		];

		echo json_encode($responses);
	}
	
	public function multipel_hapus()
	{
		if($this->input->post('checkbox_val'))
		{
			$id = $this->input->post('checkbox_val');
			for($count = 0; $count < count($id); $count++)
			{
				$this->msubmenu->multipel_hapus($id[$count]);
			} 	
		}
	}

	public function hapus($id)
	{
		$where = array('idsub' => $id);
		$this->msubmenu->hapus($where, 't_submenu');
	}
}
?>