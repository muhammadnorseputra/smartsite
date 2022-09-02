<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Saran extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->model('model_template_v1/M_f_saran', 'saran');
		$this->load->model('model_template_v1/M_f_beranda', 'beranda');
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
	public function get_all_saran() {
		$whr = [
			'kategori' => $this->input->post('kategori')
		];
		$list = $this->saran->get_datatables($whr);
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $s) {
			$mail = !empty($s->email) ? "<a href='mailto:".$s->email."' class='text-info small'>".$s->email."</a>" : "-";
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $s->nama_lengkap."<br> <span class='small text-muted'>".longdate_indo(substr($s->tgl_kirim,0,10))."</span>";
			$row[] = "<p class='text-muted'>".character_limiter($s->isi_saran, 50)."</p>";
			$row[] = $mail;
			$row[] = "<button id='detail-saran' id_saran='".$s->id_saran."' class='btn btn-sm btn-primary'><i class='fas fa-book mr-2'></i> Detail</button>";
			$data[] = $row;
		}
		$output = array(
				"draw" => $_POST['draw'],
				"recordsTotal" => $this->saran->count_all($whr),
				"recordsFiltered" => $this->saran->count_filtered($whr),
				"data" => $data,
			);
		//output to json format
		echo json_encode($output);
	}
	public function detail() {
		$id = $this->input->post('id');
		$db = $this->saran->detail('public_saran', ['id_saran' => $id])->row();
		echo json_encode($db);
	}
	public function votes()
	{
		$id = decrypt_url($this->input->post('vote'));
		$cookie = get_cookie('cookie_vote');
			// var_dump($count);
		if(empty($cookie) || $cookie !== '1') {
			$count = $this->beranda->get_poling_id($id);
			$whr  = ['id_poling' => $id];
			$data = ['value' => $count+1];
			$db = $this->beranda->update_vote('t_poling', $data, $whr);
			if($db)
			{
				set_cookie('cookie_vote','1','3600');
				$this->session->set_flashdata(['message' => '<i class="fas fa-check-circle text-success mr-3"></i><b>Terimakasih</b>, voting anda telah direkam', 'class' => 'alert-warning']);
			} else {
				delete_cookie('cookie_vote');
			}
			redirect(base_url('beranda'),'refresh');
		}
	}
 }