<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_menuutama extends CI_Controller {
	public function __construct() 
	{
		parent::__construct();
		$this->load->model('M_b_module', 'module');
		_is_logged_in();
	}   
	public function index()
	{
        $data = [
				'content' => 'Backend/__Module/___Menuutama/v_table',
				'pageinfo' => '<li><a href="#"><i class="material-icons">dashboard</i> Dasboard</a></li>
							<li class="active">Menu Utama</li>',
				'scriptjs' => 'Backend/__ServerSideJs/Menuutama/s_menuutama',
				'css' => [
					'assets/plugins/select2/css/select2.min.css',
					'assets/plugins/select2/css/select2-bootstrap.min.css'
				],
				'js' => [
					'assets/plugins/select2/js/select2.min.js'
				]
		];
		$this->load->view('Backend/v_home', $data);
	}
	public function listlabel()
	{	
		$mod = $this->menu->listlabel()->result();
		$output = '';
		if(count($mod) > 0)
		{
			foreach($mod as $key)
			{
				if($key->aktif == 'Y')
				{
					$col = 'default';
				}
				else 
				{
					$col = 'grey';
				}

				$output .= '<li class="list-group-item text-danger bg-'.$col.'" style="color:black">
											<a href="javascript:void(0)" class="btn btn-xs btn-link pull-left m-l--5" id="editlabel" onclick="editlabel('.$key->id_label.')">
												<em class="material-icons font-12">edit</em>
											</a>'
											.strtoupper($key->nama_label).' 
											<a href="#" onclick="hapuslistlabel('.$key->id_label.')" class="pull-right"><em class="material-icons">highlight_off</em></a>
										</li>';
			}
		}
		$responses = array(
			'data' => $output
		);
		echo json_encode($responses);
	}
	public function editlabel()
	{
		$getLabel = $this->menu->get_labelmenu_where_id($this->input->get('id_label'))->result();
		$responses = array(
			'data' => $getLabel
		);
		echo json_encode($responses);
	}

	public function hapuslabel($idlabel)
	{
		$where = array('id_label' => $idlabel);
		$this->menu->hapuslistlabel($where, 'ref_labelmenu');
	}

	public function listmenu()
	{
		$config = array();
		$config['base_url'] = '#';
		$config['total_rows'] = $this->menu->count_all();
		$config['per_page'] = 6;
		$config['uri_segment'] = 5;
		$config['use_page_numbers'] = TRUE;
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['next_link'] = 'Next';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_link'] = 'Previos';
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
			'content' => $this->menu->listmenu($config['per_page'], $start),
			'per' => $config['per_page'],
			'totalRows' => $config['total_rows']
		);

		echo json_encode($output);
		
	}

	public function labelmenu()
	{
		$search = $this->input->post('searchParm');
		$row = $this->menu->get_labelmenu('ref_labelmenu', $search)->result_array();
		$data = array();
		foreach($row as $r) {
			$data[] = array(
				"id" => $r['id_label'],
				"text" => $r['nama_label']
			);
		}
		echo json_encode(['items' => $data]);
	}


	public function iconmenu()
	{
		$search = $this->input->post('searchIcon');
		$row = $this->menu->get_icon('ref_icon', $search)->result_array();
		$data = array();
		foreach($row as $r) {
			$data[] = array(
				"id" => $r['nama_icon'],
				"text" => $r['nama_icon']
			);
		}
		echo json_encode(['items' => $data]);
	}

	public function savelabel()
	{
		$this->form_validation->set_rules('namalabel','Label','required|trim|min_length[3]');
		$this->form_validation->set_rules('orderlabel','Order','required|trim');
		$this->form_validation->set_rules('aktiflabel','Aktif','required|trim');
		if($this->form_validation->run() === FALSE)
		{
			echo '<div class="alert bg-pink alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
							'.validation_errors().'
						</div>';			
		}
		else
		{
			
			$post_label = $this->input->post('namalabel');
			$post_order = $this->input->post('orderlabel');
			$post_aktif = $this->input->post('aktiflabel');
			$val = array('nama_label' => strtolower($post_label), 'order' => $post_order, 'aktif' => $post_aktif);
			$this->menu->insert_label($val);

			echo '<div class="alert bg-green alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
							Success label telah tersimpan.
						</div>';

		}
	}
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
			echo '<div class="col-red text-left">
							<em class="material-icons font-18 pull-right m-l-10">error</em> '.validation_errors().'
						</div>';
		}
		else
		{
			$post_icon = $this->input->post('namaicon');
			$getNameIcon = $this->menu->CariIcon($post_icon)->row_array();
			if($post_icon == $getNameIcon['nama_icon'])
			{
			echo '<div class="col-orange text-left">
							<em class="material-icons font-18 pull-right m-l-10">info</em> Icon sudah ada di daftar.
						</div>';
			}
			else
			{
			echo '<div class="col-teal text-left">
							<em class="material-icons font-18 pull-right m-l-10">done_all</em> Success icon telah tersimpan.
						</div>';
				
				$val = array('nama_icon' => strtolower($post_icon));
				$this->menu->insert_icon($val);
			}
		}
	}
	public function listicon()
	{
		$getIcon = $this->menu->getIcon()->result();
		if(count($getIcon) > 0)
		{
			$cols = 12;
			$baris = "";
				$no=1;
				foreach($getIcon as $val){
				$baris .= "<div class='col-sm-2 p-b-15 col-xs-1 text-center' data-toggle='tooltip' data-placement='top' title='".ucwords($val->nama_icon)."'><i class='material-icons font-32'>".$val->nama_icon."</i> <div class='font-11 col-grey'>".strtolower($val->nama_icon)."</div></div>";
				$no++;
				}  
			
		}
		echo json_encode($baris);
	}
	
	public function caridata()
	{
		$kata = $this->input->get('katakunci');
		$output= array('data' => $this->menu->get_search($kata));
		echo json_encode($output);
	}

	public function savemenuutama()
	{
		$labelmenu = $this->input->post('labelmenu', true);
		$namamenu = $this->input->post('namamenu', true);

		$linkmenu_m = $this->input->post('linkmenu_p');
		$linkmenu = $this->input->post('linkmenu', true);
		$joinmenu = $linkmenu_m."".$linkmenu;

		$iconmenu = $this->input->post('iconmenu', true);
		$ordermenu = $this->input->post('ordermenu', true);
		$aktifmenu = $this->input->post('aktifmenu', true);
		$stsmenu = $this->input->post('stsmenu');

		if(!empty($namamenu)){
			$mgs['errorType'] = 1;
			$msg['type'] = 'green';
			$msg['content'] = '<em class="glyphicon glyphicon-ok-sign"></em> Menu utama <b>'.$namamenu.'</b> telah berhasil ditambahkan';	
			$insert_arr = [
				'fid_label' => $labelmenu,
				'fid_icon' => $iconmenu,
				'nama_menu' => $namamenu,
				'link' => $joinmenu,
				'sts' => $stsmenu,
				'order' => $ordermenu,
				'aktif' => $aktifmenu
			];

			$this->menu->insertmenu('t_menu', $insert_arr);
		}
		else 
		{
			$mgs['errorType'] = 1;
			$msg['type'] = 'red';
			$msg['content'] = '<em class="material-icons pull-left m-r-10">warning</em> Responses Server Gagal';
		}

		$responses = [
			'message' => $msg
		];

		echo json_encode($responses);	
	}

	public function savelabelmenu()
	{
		$namalabel = $this->input->post('namalabel', true);
		$orderlabel = $this->input->post('orderlabel', true);
		$aktif = $this->input->post('aktiflabel');

		if(!empty($namalabel))
		{
			$msg['type'] = 'success';
			$msg['content'] = 'Data <b>'.$namalabel.'</b> Telah Ditambahkan';

			$insert_arr = [
				'nama_label' => $namalabel,
				'order' => $orderlabel,
				'aktif' => $aktif
			];
			$this->menu->insert_label($insert_arr);
		}
		else
		{
			$msg['type'] = 'error';
			$msg['content'] = '<b>'.$namalabel.'</b> Gagal Ditambahkan';
		}

		$responses = [
			'message' => $msg
		];

		echo json_encode($responses);
	}

	public function updatelabel()
	{
		$namalabel = $this->input->post('editnamalabel');
		$orderlabel = $this->input->post('editorderlabel');
		$aktif = $this->input->post('editaktiflabel');
		$id = $this->input->post('editidlabel');

		if(!empty($id))
		{
			$values = array(
				'nama_label' => $namalabel,
				'order' => $orderlabel,
				'aktif' => $aktif
			);

			$where = array('id_label' => $id);
			$this->menu->updatelabel('ref_labelmenu',$where,$values);

			$msg['type'] = 'success';
			$msg['content'] = 'Label <b>'.$namalabel.'</b> Telah Terupdate !';
		}
		else 
		{
			$msg['type'] = 'error';
			$msg['content'] = 'Label <b>'.$namalabel.'</b> Gagal Diupdate !';
		}

		$responses = [
			'message' => $msg
		];

		echo json_encode($responses);
	}

	public function editmenu()
	{
		$id = $this->input->get('idmenu');
		$getmenu = $this->menu->get_menu_where_id($id)->result();
		$responses = array(
			'data' => $getmenu
		);
		echo json_encode($responses);
	}
	public function multipel_hapus()
	{
		if($this->input->post('checkbox_val'))
		{
			$id = $this->input->post('checkbox_val');
			for($count = 0; $count < count($id); $count++)
			{
				$this->menu->multipel_hapus($id[$count]);
			} 	
		}
	}
	public function updatemenuutama() 
	{
		$_IdLabel  = $this->input->post('labelmenu_e');
		$_NamaMenu = $this->input->post('namamenu_e');
		$_Sts 		 = $this->input->post('stsmenu');
		$_Link 		 = $this->input->post('linkmenu_e');
		$_Icon 		 = $this->input->post('iconmenu_e');
		$_Order 	 = $this->input->post('ordermenu_e');
		$_Aktif 	 = $this->input->post('aktifmenu');
		$_Id 			 = $this->input->post('idmenu_e');

		if(!empty($_Id))
		{
			$values = array(
				'fid_label' => $_IdLabel,
				'fid_icon' => $_Icon,
				'nama_menu' => $_NamaMenu,
				'link' => $_Link,
				'sts' => $_Sts,
				'order' => $_Order,
				'aktif' => $_Aktif
			);

			$where = array('id_menu' => $_Id);
			$this->menu->updatemenu('t_menu',$where,$values);

			$msg['type'] = 'success';
			$msg['content'] = 'Menu '.$_NamaMenu.' Telah Terupdate !';
		}
		else 
		{
			$msg['type'] = 'error';
			$msg['content'] = 'Menu '.$_NamaMenu.' Gagal Diupdate !';
		}

		$responses = [
			'message' => $msg
		];

		echo json_encode($responses);		
	}	
	public function hapus($id)
	{
		$where = array('id_menu' => $id);
		$this->menu->hapus($where, 't_menu');
	}
}
?>
