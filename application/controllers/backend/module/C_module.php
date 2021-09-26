<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_module extends CI_Controller {
	public function __construct() 
	{
    parent::__construct();
		$this->load->model('M_b_module', 'module');
    _is_logged_in();
  }

  //==========================================//
  ## Halaman Module 
	public function index()
	{

		$data = [
				'content' => 'Backend/__Module/___Module/v_module',
				'scriptjs' => 'Backend/__ServerSideJs/Module/s_module',
				'pageinfo' => '<li><a href="#"><i class="material-icons">dashboard</i> Dasboard</a></li>
							<li class="active">Module Web</li>',
				'css' => [
					'assets/plugins/datatable/datatables.min.css',
					'assets/plugins/datatable/inc_tablesold.css',
					'assets/plugins/jquery-ui/jquery-ui.min.css',
					'assets/plugins/jquery-ui/jquery-ui.theme.min.css'
				],
				'js' => [
					'assets/plugins/datatable/datatables.min.js'
				]
		];
		$this->load->view('Backend/v_home', $data);
		
	}
  //==========================================//

  //==========================================//
  ## VIEW TABLE
	public function module_table() {
		$data = 'Backend/__module/___Module/v_table';
		$this->load->view($data);
	}
	//==========================================//
	
	//==========================================//
  ## VIEW ADD
	public function module_add() {
		$data = 'Backend/__module/___Module/v_add';
		$this->load->view($data);
	}
	//==========================================//

	//==========================================//
  ## VIEW EDIT
	public function module_edit($id) {
		$fr = 'Backend/__module/___Module/v_edit';
		$data['data'] = $this->module->edit('t_module', $id);
		$this->load->view($fr, $data);
	}
	//==========================================//

	//==========================================//
  ## AJAX LIST MODULE

  public function ajax_list() {

    $getdata = $this->module->fetch_datatable_module();
    $data = array();
    $no = $_POST['start'];
  
    foreach($getdata as $r) {
		if($r->aktif == 'Y') {
			$aktif = '<i class="material-icons">visibility</i>';
		} else {
			$aktif = '<i class="material-icons col-grey">visibility_off</i>';
		}

    		$sub_array = array();
      		$sub_array[] = $no+1;
      		$sub_array[] = strtoupper($r->nama_module);
			$sub_array[] = $aktif;			
			$sub_array[] = '<div class="btn-group btn-group-xs" role="group">
                          <button type="button" id="btn-edit" data-id="'.$r->id_module.'"  class="btn bg-default waves-effect">MODIFIKASI</button>
                          <button type="button" id="btn-delete" data-id="'.  $r->id_module .'" data-title="'. $r->nama_module .'" class="btn bg-red waves-effect">HAPUS</button>
                      </div>';
      $data[] 		 = $sub_array;
  
    $no++;
    }
  
    $output = array(
      'draw'  		  		=> intval($_POST['draw']),
      'recordsTotal' 	  => $this->module->get_all_data_module(),
      'recordsFiltered' => $this->module->get_filtered_data_module(),
      'data'			  		=> $data			
    );
  
    echo json_encode($output); 
  }

	//==========================================//
	
	//==========================================//
  ## AKSI ADD
	public function add() {
    $nama_module = $this->input->post('nama_module', true);
		$aktif			 = $this->input->post('aktif');
		$meta        = $this->input->post('meta');
		if($meta == 'backend') {
			$values = [
				'controller' => 'c_'.strtolower(str_replace(" ","_",$nama_module)),
				'nama_module' => strtolower(trim(strtolower($nama_module))),
				'meta' => $meta,
				'token' => generateRandomString(18),
				'aktif' => $aktif
			];
		} else {
			$values = [
				'nama_module' => strtolower(trim(strtolower($nama_module))),
				'meta' => $meta,
				'token' => generateRandomString(18),
				'aktif' => $aktif
			];
		}
		if(!empty($nama_module)) {
			$send = $this->module->insert_module('t_module', $values);
		} else {
			$send =  false;			
		}
		if($send != false) {
			$msg = array('type' => 'success', 'content' => "Module <b>". $nama_module ."</b> telah ditambahkan");
		} else {
			$msg = array('type' => 'error', 'content' => "Terjadi Kesalahan ". $nama_module . "tidak berhasil");
		}
    echo json_encode($msg);
	}
	
	//==========================================//

	//==========================================//
  ## UPDATE MODULE
  public function update()
  {
    $val = [
			'controller' => 'c_'.strtolower(str_replace(" ","_",$this->input->post('nama_module'))),
      'nama_module' => $this->input->post('nama_module'),
      'aktif' 			=> $this->input->post('aktif')
    ];

    $whr = [
      'id_module' => $this->input->post('id_module')
    ];

		$send = $this->module->update('t_module',$val,$whr);
		if($send == FALSE) {
			$msg = "Success Updated";
		} else {
			$msg = "Gagal";
		}

		echo json_encode($msg);
  }
	//==========================================//
	
	public function hapus() {
		$id = $this->input->get('id');
		$title = $this->input->get('nama_module');
		$tbl = 't_module';
		$where = [
			'id_module' => $id
		];

		if(!empty($id)) {
			$this->module->hapus($tbl,$where);
			$msg = ['type' => 'bg-teal', 'content' => 'Deleted Success <b>'.$title.'</b>'];
		} else {
			$msg = ['type' => 'bg-pink', 'content' => 'Error Deleted  <b>'.$title.'</b>'];
		}
		$json = json_encode($msg);
		echo $json;		
	}
	

}