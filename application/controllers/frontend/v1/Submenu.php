<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Submenu extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->model('model_template_v1/M_f_submenu', 'submenu');
		$this->load->model('M_b_halaman', 'halaman');
		//Check maintenance website
        if(($this->session->userdata('status') == 'ONLINE') && ($this->mf_beranda->get_identitas()->status_maintenance == '1') || ($this->mf_beranda->get_identitas()->status_maintenance == '0')) {
            // redirect(base_url('frontend/v1/beranda'),'refresh');
        } else {
            redirect(base_url('under-construction'),'refresh');
        }
	}
	public function index()
	{
		
	}
	public function get_all_submenu() {
		$list = $this->submenu->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $s) {
			$active = $s->aktif === 'Y' ? '<span class="badge badge-primary">Active</span>' : '<span class="badge badge-light">Unactive</span>';
			if($s->created_by === $this->session->userdata('user_portal_log')['id']):	
			$btnAksi = '<div class="dropdown dropright">
						  <button id="dLabel" class="btn btn-lg border-0 btn-light bg-white p-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						    <i class="fas fa-ellipsis-h p-2"></i>
						  </button>
						  <div class="dropdown-menu" aria-labelledby="dLabel">
						    <a id="btn-edit-submenu" data-id="' . $s->idsub . '" class="dropdown-item rounded-pill text-primary" href="#"><i class="fas fa-edit mr-2"></i> Edit</a>
							<a id="btn-hapus-submenu" data-id="' . $s->idsub . '" class="dropdown-item  rounded-pill text-danger" href="#"><i class="fas fa-trash mr-2 text-danger"></i> Hapus</a>
						  </div>
						</div>';
			else:
			$btnAksi = "<i class='fas fa-lock text-secondary'></i>";	
			endif;
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $btnAksi;
			$row[] = $s->nama_sub;
			$row[] = "<span class='small text-info'>".$s->link_sub."</span>";
			$row[] = $active;
			$row[] = $s->order;
			$data[] = $row;
		}
		$output = array(
				"draw" => $_POST['draw'],
				"recordsTotal" => $this->submenu->count_all(),
				"recordsFiltered" => $this->submenu->count_filtered(),
				"data" => $data,
			);
		//output to json format
		echo json_encode($output);
	}

	public function save() {
		$p = $this->input->post();
		//UNTUK ID CEK PADA DATABASE TABLE `t_module` 
		$module = !empty($p['module']) ? '27' : '0';
		$link = $module == '27' ? 'page/'.$p['link_sub'].'/'.$this->halaman->get_title_halaman($p['link_sub']) : $p['link_sub'];
		$parent = $p['parentsub'] === '0' ? null : $p['parentsub'];

		$value = [
			'idmain' => $p['mainmenu'],
			'fid_idsub' => $parent,
			'fid_module' => $module,
			'nama_sub' => $p['nama_sub'],
			'link_sub' => $link,
			'order' => $p['order'],
			'aktif' => $p['aktif'],
			'created_by' => $this->session->userdata('user_portal_log')['id']
		];
		$db = $this->submenu->insert('t_submenu', $value);
		if($db) {
			$msg = true;
		} else {
			$msg = false;
		}
		echo json_encode($msg);
	}

	public function detail()
	{
		$id = $this->input->get('id');
		$db = $this->submenu->detail($id)->row();
		echo $db;
	}
	public function hapus()
	{
		$id = $this->input->post('id');
		$where = array('idsub' => $id);
		$db = $this->submenu->hapus($where, 't_submenu');
		if($db) {
			$msg = true;
		} else {
			$msg = false;
		}
		echo json_encode($msg);
	}
}