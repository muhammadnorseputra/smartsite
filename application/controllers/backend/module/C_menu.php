<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_menu extends CI_Controller {
	public function __construct() 
	{
		parent::__construct();
		$this->load->model('M_b_module', 'module');
		$this->load->model('M_b_icons','micons');
		_is_logged_in();
	}   

	public function index()
	{
        $data = [
				'content' => 'Backend/__Module/___Menu/v_menu',
				'scriptjs' => 'Backend/__ServerSideJs/Menu/s_menu',
				'pageinfo' => '<li>Dasboard</li> <li>Manajemen Menu</li>
							<li class="active">Menuutama</li>',
				'css' => [
					'assets/plugins/select2/css/select2.min.css',
					'assets/plugins/select2/css/select2-materialize.css',
					'assets/plugins/datatable/datatables.min.css',
					'assets/plugins/datatable/inc_tablesold.css'
				],
				'js' => [
					'assets/plugins/select2/js/select2.min.js',
					'assets/plugins/datatable/datatables.min.js'
				]
		];
		$this->load->view('Backend/v_home', $data);
	}
	
	 //==========================================//
  ## VIEW TABLE
	public function menu_table() {
		$data = 'Backend/__Module/___Menu/v_table_menu';
		$this->load->view($data);
	}
	//==========================================//
	
	//==========================================//
  ## AJAX LIST MODULE

  public function ajax_list() {

    $getdata = $this->menu->fetch_datatable_menu();
    $data = array();
    $no = $_POST['start'];
  
    foreach($getdata as $r) {
	
		if($r->sts == 'BACKEND'){
				$status_menu = "<b class='text-danger'><em class='material-icons'>flip_to_back</em></b>";
		}else{
				$status_menu = "<b class='text-success'><em class='material-icons'>flip_to_front</em></b>";
		}

		if($r->aktif == 'Y'){
			$aktif_color = '<em class="material-icons col-green">done</em>';
		} else {
			$aktif_color = '<em class="material-icons col-grey">clear</em>';
		}

		if(($r->link != '#') && ($r->link != '')) {
			$link = $r->link." <a href='".base_url($r->link."?module=".$r->token."&user=".$this->session->userdata('user_access'))."'><i class='material-icons font-14'>launch</i></a>";
		} else {
			$link = $r->link;
		}
			
    $sub_array = array();
      $sub_array[] = $no+1;
      $sub_array[] = $r->order;
			$sub_array[] = strtoupper($r->nama_label);
			$sub_array[] = "<i class='material-icons'>".$r->fid_icon."</i>";		
			$sub_array[] = "<b>".$r->nama_menu."</b>";
			$sub_array[] = $link;
			$sub_array[] = "<center>".$status_menu."</center>";
			$sub_array[] = "<center>".$aktif_color."</center>";
			$sub_array[] = '<div class="btn-group btn-group-xs" role="group">
                          <button type="button" id="btn-edit" data-id="'.$r->id_menu.'"  class="btn bg-default waves-effect">EDIT</button>
                          <button type="button" id="btn-delete" data-id="'.  $r->id_menu .'" data-title="'. $r->nama_menu .'" class="btn bg-red waves-effect">HAPUS</button>
                      </div>';
      $data[] 		 = $sub_array;
  
    $no++;
    }
  
    $output = array(
      'draw'  		  		=> intval($_POST['draw']),
      'recordsTotal' 	  => $this->menu->get_all_data_menu(),
      'recordsFiltered' => $this->menu->get_filtered_data_menu(),
      'data'			  		=> $data			
    );
  
    echo json_encode($output); 
  }

	//==========================================//
	
	//==========================================//
  ## EDIT MENU
	public function edit_menu() {
    $id = $this->input->get('id');
    $data = [
      'content' => 'Backend/__Module/___Menu/v_edit_menu',
      'scriptjs' => 'Backend/__ServerSideJs/Menu/s_menu',
      'pageinfo' => '<li>
                       Dasboard
					 </li>
					 <li>Manajemen Menu</li>
					 <li>Menuutama</li>
					 <li>Edit</li>
					 <li class="active">'. $this->menu->getnamamenu($id) .'</li>',
			'css' => [
				'assets/plugins/bootstrap-select/css/bootstrap-select.css',
				'assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.css',
				'assets/plugins/jquery-spinner/css/bootstrap-spinner.css'
			],
			'js' => [
				'assets/plugins/bootstrap-select/js/bootstrap-select.js',
				'assets/js/pages/ui/tooltips-popovers.js',
				'assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js',
				'assets/plugins/jquery-spinner/js/jquery.spinner.js'
			],
      'id' => $id,
			'x' => $this->menu->getmenubyid($id),
			'get_label' => $this->menu->get_label('ref_label_menu'),
			'get_module' => $this->module->get_module_list()
  ];
  $this->load->view('Backend/v_home', $data);
	}
	//==========================================//  

	//==========================================//
  ## UPDATE MENU
	public function proses_update_menu() {
		$id = $this->input->post('id');
		
    $VAL = [
			'fid_label' => $this->input->post('label'),
			'fid_icon' => $this->input->post('icons'),
			'fid_module' => $this->input->post('module'),
			'nama_menu' => $this->input->post('nama_menu'),
			'link' => $this->input->post('linkmenu'),
			'sts' => $this->input->post('sts'),
			'color' => $this->input->post('color'),
			'order' => $this->input->post('ordermenu'),
			'aktif' => $this->input->post('aktif'),
			'user_menu' => $this->input->post('user_menu')
		];

		$WHR = [
			'id_menu' => $id
		];

		$UPDATE = $this->menu->proses_update_menu('t_menu', $VAL, $WHR);
		$goTo = base_url('backend/module/c_menu?module='.$this->madmin->getmodulebycontroller('c_menu').'&user='.$this->session->userdata('user_access'));
		if($UPDATE == FALSE) {
			$msg = array('jenis' => 'green', 'content' => 'Menu "'.$this->input->post('nama_menu').'" Updated', 'goto' => $goTo, 'icon' => 'glyphicon glyphicon-ok');
		} else {
			$msg = array('jenis' => 'red', 'content' => 'Menu "'.$this->input->post('nama_menu').'" Gagal Updated', 'goto' => $goTo, 'icon' => ' glyphicon glyphicon-remove');
		}
		echo json_encode($msg);
	}
	//==========================================//  
	
	//==========================================//
	## VIEW TABLE
	
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

	public function menu_add() {
		$data = [
			'content' => 'Backend/__Module/___Menu/v_add_menu',
			'scriptjs' => 'Backend/__ServerSideJs/Menu/s_menu',
			'pageinfo' => '<li>Dasboard</li>
						   <li>Manajemen Menu</li>
						   <li>Menuutama</li> 
						   <li class="active">Tambah</li>',
			'css' => [
				'assets/plugins/select2/css/select2.min.css',
				'assets/plugins/select2/css/select2-materialize.css',
				'assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.css',
				'assets/plugins/jquery-spinner/css/bootstrap-spinner.css'
			],
			'js' => [
				'assets/plugins/select2/js/select2.min.js',
				'assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js',
				'assets/plugins/jquery-spinner/js/jquery.spinner.js'
			],
			'get_label' => $this->menu->get_label('ref_label_menu'),
			'get_module' => $this->module->get_module_list()
	];
	$this->load->view('Backend/v_home', $data);
	}



	public function add() {
		$this->form_validation->set_rules('nama_menu','Nama Menu','required|trim|min_length[1]');
		$this->form_validation->set_rules('linkmenu','Link','required|trim');
		$this->form_validation->set_rules('sts','Status','required');
		$this->form_validation->set_rules('aktif','Aktif','required');
		$this->form_validation->set_rules('ordermenu','Order','required');
		$this->form_validation->set_rules('label','Label','required|trim');
		$this->form_validation->set_rules('icons','Icons','required');
		// $this->form_validation->set_rules('module','Module','required|trim');
		$this->form_validation->set_rules('user_menu','User Menu','required');
		if($this->form_validation->run() === FALSE)
		{
			$msg = array('jenis' => 'bg-red', 'content' => validation_errors());			
		}
		else
		{
			
			$post_fid_label 	= $this->input->post('label');
			$post_fid_icon	 	= $this->input->post('icons');
			$post_fid_module 	= $this->input->post('module');
			$post_nama_menu 	= $this->input->post('nama_menu');
			$post_link_menu 	= $this->input->post('linkmenu');
			$post_status_menu = $this->input->post('sts');
			$post_color 	= $this->input->post('color');
			$post_order 			= $this->input->post('ordermenu');
			$post_aktif 			= $this->input->post('aktif');
			$post_user_menu 	= $this->input->post('user_menu');
			
			$val = array(
									'fid_label'	 => $post_fid_label, 
									'fid_icon'	 => $post_fid_icon, 
									'fid_module' => $post_fid_module,
									'nama_menu'	 => $post_nama_menu, 
									'link'	 		 => $post_link_menu, 
									'sts' 			 => $post_status_menu,
									'color' 	 => $post_color,
									'order'	 		 => $post_order, 
									'aktif'	 		 => $post_aktif, 
									'user_menu'  => $post_user_menu
							);
			$this->menu->insert_menu($val);
			$msg = array('jenis' => 'bg-teal', 'content' => 'Menu <b>'. $post_nama_menu . '</b> Telah Ditambahkan');
		}
		echo json_encode($msg);
	}
	//==========================================//

	public function hapus() {
		$id = $this->input->get('id');
		$title = $this->input->get('nama_menu');

		$whr = ['id_menu' => $id];
		$send = $this->menu->delete_menu('t_menu', $whr);
		if($send == TRUE) {
			$msg = ['bg' => 'bg-black', 'msg' => 'Success <B>'. $title . '</B> Deleted'];
		} else{
			$msg = ['bg' => 'bg-red', 'msg' => 'Gagal'];
		}

		echo json_encode($msg);
	}

	 //==========================================//
  ## ADD LABEL MENU
	public function add_label_menu() {
		$data = 'Backend/__Module/___Menu/v_add_label';
		$this->load->view($data);
	}
	//==========================================//

	 //==========================================//
  ## REF ICONS
	public function ref_icons() {
		$data = [
			'geticon' => $this->micons->geticon()
		];
		$content = 'Backend/__Module/___Menu/v_ref_icons';
		$this->load->view($content, $data);
	}
	//==========================================//

	 //==========================================//
  ## REF ICONS
	public function proses_add_icon() {
		$val = $this->input->post('namaicon');
		$listicon = $this->micons->search($val);
		if($listicon->num_rows() > 0) {
			$r = $listicon->row();
			$namaicons = $r->nama_icon;
		} else {
			$namaicons = null;
		}
		
		if((isset($val) == $namaicons) && (!empty($val))) {
			// $this->session->set_flashdata(array('message' => '<strong>Warning!</strong> Icons "'.$val.'" sudah ada'));
			// redirect(base_url('backend/module/c_menu/ref_icons'));
			$msg = ['type' => 'warning', 'msg' => '<strong>Warning!</strong> Icons "'.$val.'" sudah ada'];
		} elseif(empty($val)) {
			// $this->session->set_flashdata(array('message' => '<strong>Info!</strong> nama icon belum dimasukan!'));
			// redirect(base_url('backend/module/c_menu/ref_icons'));
			$msg = ['type' => 'error', 'msg' => '<strong>Info!</strong> nama icon belum dimasukan!'];

		} else {
			$this->menu->proses_input_icon($val); 
			$msg = ['type' => 'success', 'msg' => '<strong>Success!</strong> New Icon Ditambahkan'];
			// $this->session->set_flashdata(array('message' => '<strong>Success!</strong> New Icon Ditambahkan'));
			// redirect(base_url('backend/module/c_menu/ref_icons'));
		}
		echo json_encode($msg);
	}
	//==========================================//	

	public function proses_update_icon() {
		$id = $this->input->post('id');
		$title = $this->input->post('namaicon');

		$post = [
			'nama_icon' => $title
		];

		$whr = [
			'id_icon' => $id
		];

		$send = $this->micons->proses_update_icon('ref_icon', $post, $whr);
		if($send == true) {
			$msg = 'Success';
		} else {
			$msg = 'Error';
		}

		echo json_encode($msg);
	}

	public function proses_hapus_icon() {
		$id = $this->input->post('id');

		$whr = [
			'id_icon' => $id
		];
		$send = $this->micons->proses_hapus_icon('ref_icon', $whr);
		if($send == true) {
			$msg = "Deleted Success";
		} else {
			$msg = "Deleted Gagal";
		}
		echo json_encode($msg);
	}

	//==========================================//
  ## PROSES ADD LABEL MENU
	public function proses_add_label_menu() {
		$VAL = [
			'nama_label' => $this->input->post('nm_label'),
			'order' => $this->input->post('nm_urutan'),
			'aktif' => $this->input->post('nm_status')
		];

		$INSERT = $this->db->insert('ref_label_menu', $VAL);
		if($INSERT) {
			$this->session->set_flashdata(array('message' => '<strong>Success!</strong> New Label Ditambahkan', 'class' => 'alert alert-success'));
			redirect('backend/module/c_menu/add_label_menu');
		} else {
			echo "Error Function";
		}
	}
	//==========================================//

	//==========================================//
  ## PROSES EDIT LABEL MENU
	public function proses_edit_label_menu($id) {
		$DATA = $this->db->get_where('ref_label_menu', array('id_label' => $id))->result();
		if(COUNT($DATA) > 0) {
			$datas = array('data_by_id' => $DATA);
			$this->load->view('Backend/__Module/___Menu/v_edit_label', $datas);
		} else {
			echo "Error Function";
		}
	}
	//==========================================//

	//==========================================//
  ## PROSES UPDATE LABEL MENU
	public function proses_update_label_menu() {
		$VAL = [
			'nama_label' => $this->input->post('nm_label'),
			'order' => $this->input->post('nm_urutan'),
			'aktif' => $this->input->post('nm_status')
		];

		$WHR = [
			'id_label' => $this->input->post('id_label')
		];

		$UPDATE = $this->menu->update_label($VAL, $WHR);
		if($UPDATE == TRUE) {
			$this->session->set_flashdata(array('message' => '<strong>Success!</strong> Label Updated', 'class' => 'alert alert-success'));
			redirect('backend/module/c_menu/add_label_menu');
		} else {
			echo "Error Function";
		}
	}
	//==========================================//

	//==========================================//
  ## PROSES HAPUS LABEL MENU
	public function proses_hapus_label_menu($id) {
		$DELETE = $this->db->where('id_label', $id)->delete('ref_label_menu');
		if($DELETE) {
			$this->session->set_flashdata(array('message' => '<strong>Delete!</strong> Label Dihapus', 'class' => 'alert alert-danger'));
			redirect('backend/module/c_menu/add_label_menu');
		} else {
			echo "Error Function";
		}
	}
	//==========================================//

	public function listicons($icon) {
		$data = [
			'geticon' => $this->micons->geticon(),
			'geticonid' => $icon
		];
		$this->load->view('Backend/__Module/___Menu/v_listicon', $data);
	}
}
