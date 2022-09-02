<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Ikm extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_template_v1/M_f_ikm', 'ikm');
		//Check maintenance website
        if(($this->session->userdata('status') == 'ONLINE') && ($this->mf_beranda->get_identitas()->status_maintenance == '1') || ($this->mf_beranda->get_identitas()->status_maintenance == '0')) {
            // redirect(base_url('frontend/v1/beranda'),'refresh');
        } else {
            redirect(base_url('under-construction'),'refresh');
        }
	}

	public function ajax_responden()
	{
		// parameter
		$filter_tahun = $this->input->post('filter_tahun');
		$filter_periode = $this->input->post('filter_periode');
		$filter_form = $this->input->post('filter_form');
		$filter_start = $this->input->post('filter_start');
		$filter_end = $this->input->post('filter_end');

		$list = $this->ikm->get_datatables($filter_tahun,$filter_periode,$filter_form,$filter_start,$filter_end);
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $r) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = !empty($r->nipnik) ? $r->nipnik : "-";
			$row[] = $r->nama_lengkap;
			$row[] = $r->umur;
			$row[] = $r->jns_kelamin;
			$row[] = $r->tingkat_pendidikan;
			$row[] = $r->jenis_pekerjaan;
			$row[] = $r->card_responden;

			$data[] = $row;
		}

		$output = array(
				"draw" => $_POST['draw'],
				"recordsTotal" => $this->ikm->count_all($filter_tahun,$filter_periode,$filter_form,$filter_start,$filter_end),
				"recordsFiltered" => $this->ikm->count_filtered($filter_tahun,$filter_periode,$filter_form,$filter_start,$filter_end),
				"data" => $data,
			);
		//output to json format
		echo json_encode($output);
	}
}