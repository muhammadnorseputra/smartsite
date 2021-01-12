<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_agenda extends CI_Controller {
	public function __construct() 
	{
    parent::__construct();
		$this->load->model('M_b_agenda', 'magenda');
    if(($this->session->userdata('status') != "ONLINE") && ($this->session->userdata('user_access') == '')){
			redirect("login");
    }
  }

  //==========================================//
  ## Agenda 
	public function index()
	{

				$data = [
						'content' => 'Backend/__module/___Agenda/v_table',
						'scriptjs' => 'Backend/__ServerSideJs/Agenda/s_agenda',
						'pageinfo' => '<li>
															<a href="#"><i class="material-icons">dashboard</i> Dasboard</a>
													</li>
													<li class="active">Agenda</li>',
						'css' => [
							'assets/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css',
							'assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css',
							'assets/plugins/jquery-ui/jquery-ui.min.css',
							'assets/plugins/jquery-ui/jquery-ui.theme.min.css'
						],
						'js' => [
							'assets/plugins/momentjs/moment.js',
							'assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js',
							'assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js',
							'assets/plugins/bootstrap-datepicker/locales/bootstrap-datepicker.id.min.js',
							'assets/plugins/jquery-inputmask/jquery.inputmask.bundle.js',
							'assets/js/pages/forms/input-masked.js',
							'assets/js/pages/forms/input-datetime.js'
						]
				];
				$this->load->view('Backend/v_home', $data);
			
  }
  //==========================================//

	//==========================================//
	## LIST AGENDA
	public function list_agenda() 
	{
		$cari = $this->input->get('katakunci');
		$tglM = $this->input->get('tgl_m');
		$tglS = $this->input->get('tgl_s');

		if(($cari != "")){
			$data = $this->db->like('tema', $cari)->get_where('t_agenda', array('username' => $this->session->userdata('user')))->result();
		} elseif(($tglM != "") && ($tglM != "")) {
			$data = $this->db->like('tgl_mulai', $tglM)->like('tgl_selesai', $tglS)->get_where('t_agenda', array('username' => $this->session->userdata('user')))->result();	
		} else {	
			$data = $this->db->order_by('id_agenda')->get_where('t_agenda', array('username' => $this->session->userdata('user')))->result();
		}

    if(count($data) > 0)
    {
			$res = '';
			// $no = 1;
      foreach($data as $v)
      {
				$res .= '<tr>
										<td><b class="col-black">'.$v->tema.'</b></td>
										<td>'.$v->isi_agenda.'</td>
										<td>'.longdate_indo_v2($v->tgl_mulai).' <b> - </b> '.longdate_indo_v2($v->tgl_selesai).'</td>
										<td><b class="col-teal">'.substr($v->jam,0,5).' </b> WIB</td>
										<td>'.$v->pengirim.'</td>
										<td class="text-center">
											<button class="btn btn-link btn-circle col-red waves-effect m-t--10" onclick="hapus('.$v->id_agenda.')">
												<i class="glyphicon glyphicon-trash"></i>
											</button>
										</td>
										<td class="text-center">
											<a href="c_agenda/edit/'.$v->id_agenda.'?module='.$this->madmin->getmodulebycontroller('c_agenda').'&user='.$this->session->userdata('user_access').'">
												<i class="material-icons font-18">mode_edit</i>
											</a>
										</td>
								</tr>';
			// $no++;
			}
    }
    else 
    {
      $res = '<tr><td colspan="7" class="text-center col-grey"><em class="material-icons m-r-5 font-18">find_in_page</em>No Data</td></tr>';
		}
		
    echo json_encode($res);
	}
	//==========================================//
	
  //==========================================//
	## PROSES TAMBAH AGENDA 
	public function add()
	{
		$tema 			 = $this->input->post('tema', true);
		$lokasi 		 = $this->input->post('lokasi', true);
		$jam 				 = $this->input->post('jam');
		$tgl_mulai 	 = $this->input->post('tgl_mulai');
		$tgl_selesai = $this->input->post('tgl_selesai');
		$isi 				 = $this->input->post('isi_agenda');

		$useradd = $this->session->userdata('user');
		$pengirim = $this->input->post('pengirim');

		$validation = [
			[
				'field' => 'tema',
				'label' => 'Tema Agenda',
				'rules' => 'required'
			],
			[
				'field' => 'lokasi',
				'label' => 'Lokasi',
				'rules' => 'required'
			],
			[
				'field' => 'jam',
				'label' => 'Jam',
				'rules' => 'required'
			],
			[
				'field' => 'tgl_mulai',
				'label' => 'Tanggal Mulai',
				'rules' => 'required|date'
			],
			[
				'field' => 'tgl_selesai',
				'label' => 'Tanggal Selesai',
				'rules' => 'required|date'
			],
			[
				'field' => 'isi_agenda',
				'label' => 'Isi Agenda',
				'rules' => 'required'
			]
		];
		$this->form_validation->set_rules($validation);
		if($this->form_validation->run() === FALSE)
		{
			$msg['data'] = ['message' => validation_errors(), 'colmsg' => 'red', 'iconmsg' => 'info'];
		} 
		else 
		{
			$values = [
				'tema' => $tema,
				'isi_agenda' => $isi,
				'lokasi' => $lokasi,
				'jam' => $jam,
				'tgl_mulai' => $tgl_mulai,
				'tgl_selesai' => $tgl_selesai,
				'tgl_posting' => date('Y-m-d H:i:s'),
				'pengirim' => $pengirim,
				'username' => $useradd
			];
			$this->db->insert('t_agenda', $values);
			$msg['data'] = ['message' => 'Success <b>'. $tema .'</b> Added', 'colmsg' => 'teal', 'iconmsg' => 'done_all'];
		}

		$output = [
			'response' => $msg,
		];

		echo json_encode($output);
	}
	//==========================================//

  //==========================================//
  ## HALAMAN EDIT AGENDA
	public function edit($id)
	{

		
    $get = $this->db->get_where('t_agenda', ['id_agenda' => $id])->result();
    $data = [
			'content' => 'Backend/__module/___Agenda/v_edit',
			'scriptjs' => 'Backend/__ServerSideJs/Agenda/s_edit',
			'pageinfo' => '<li><a href="#"><i class="material-icons">dashboard</i> Dasboard</a></li>
						<li><a href="#"><i class="material-icons">assignment</i> Agenda</a></li> <li class="active">Edit Agenda</li>',
			'data' => $get,
			'css' => [
				'assets/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css',
				'assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css'
			],
			'js' => [
				'assets/plugins/momentjs/moment.js',
				'assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js',
				'assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js',
				'assets/plugins/bootstrap-datepicker/locales/bootstrap-datepicker.id.min.js',
				'assets/plugins/jquery-inputmask/jquery.inputmask.bundle.js',
				'assets/js/pages/forms/input-masked.js',
				'assets/js/pages/forms/input-datetime.js'
			]
		];
		$this->load->view('Backend/v_home', $data);
  }
	//==========================================// 

  //==========================================//
  ## PROSES UPDATE AGENDA
	public function update()
	{
    $val = [
      'tema' 				=> $this->input->post('tema'),
      'isi_agenda' 	=> $this->input->post('isi_agenda'),
			'lokasi' 			=> $this->input->post('lokasi'),
      'jam' 				=> $this->input->post('jam'),
      'tgl_mulai' 	=> $this->input->post('tgl_mulai'),
      'tgl_selesai' => $this->input->post('tgl_selesai')
    ];

    $whr = [
      'id_agenda' => $this->input->post('id_agenda')
    ];

    $data = $this->db->where($whr)->update('t_agenda', $val);
    if($data === TRUE) {
      $msg = array('content' => "Agenda Berhasil Diupdate", 'color' => 'bg-teal', 'icon' => 'done_all');
    } else {
      $msg = array('content' => "Responses Server Error", 'color' => 'bg-red', 'icon' => 'remove');
    }
    
    echo json_encode(['message' => $msg]);
  }
	//==========================================//
		
  //==========================================//
  ## PROSES HAPUS AGENDA
	public function hapus()
	{
    $id = $this->input->get('id');
    $data = $this->db->delete('t_agenda', ['id_agenda' => $id]);
    $responses = json_encode($data);
    echo $responses;
  }
	//==========================================//  
}