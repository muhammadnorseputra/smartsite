<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_poling extends CI_Controller {
	public function __construct() 
	{
    parent::__construct();
		$this->load->model('M_b_poling', 'mpoling');
    if(($this->session->userdata('status') != "ONLINE") && ($this->session->userdata('user_access') == '')){
			redirect("login");
    }
  }

  //==========================================//
  ## Halaman Poling 
	public function index()
	{

    $data = [
        'content' => 'Backend/__Module/___Poling/v_table',
        'scriptjs' => 'Backend/__ServerSideJs/Poling/s_poling',
        'pageinfo' => '<li><a href="#"><i class="material-icons">dashboard</i> Dasboard</a></li>
              <li class="active">Poling</li>',
        'css' => [
          'assets/plugins/morrisjs/morris.css'
        ],
        'js' => [
          'assets/plugins/raphael/raphael.min.js',
          'assets/plugins/morrisjs/morris.js'
        ]
    ];
    $this->load->view('Backend/v_home', $data);
        
  }
	//==========================================//

  //==========================================//
  ## Halaman List Poling Pertanyaan 
	public function list_pertanyaan_or_jawaban()
	{
    $jenis = $this->input->get('jenis');
    $data = $this->mpoling->list_pertanyaan_or_jawaban('t_poling',$jenis)->result();
    if(count($data) > 0) {
      $result = '';
      foreach($data as $row) {
        if($row->aktif == 'N' ? $col = 'col-red' : $col = '');
        if($row->status == 'PERTANYAAN' ? $tanda = '?' : $tanda = '');
          $result .= '<li class="m-b-5 '.$col.'">
                        <a href="javascript:void(0);" onclick="edit('.$row->id_poling.')" class="p-r-1">
                        <em class="glyphicon glyphicon-edit"></em></a> <a href="javascript:void(0);" onclick="hapus('.$row->id_poling.')" class="p-r-5">
                        <em class="glyphicon glyphicon-remove"></em></a> '.$row->label.' '.$tanda.' 
                      </li>';
      }
    } else {
      $result = '<div class="text-center col-grey">
                    <em class="font-30 material-icons">find_in_page</em><br> '.$jenis.' KOSONG
                  </div>';
    }
    $responses = [
      'data' => $result
    ];
    echo json_encode($responses);
  }
  //==========================================//
  
  //==========================================//
  ## Halaman Add Poling 
	public function add()
	{
    $judul   = $this->input->post('judul');
    $sts     = $this->input->post('jenispoling');
    $aktif   = $this->input->post('aktif');
    if(!empty($judul)) {
      $msg['pesan'] = "Poling Berhasil Ditambahkan";
      $msg['msg_code'] = 200;
      $table = "t_poling";
      $values = [
        'label' => $judul,
        'status' => $sts,
        'aktif' => $aktif
      ];
      $this->mpoling->insert($table, $values);
    } else {
      $msg['pesan'] = "Responses Server Gagal";
      $msg['msg_code'] = 500;
    }
    echo json_encode($msg);
  }
  //==========================================//

  //==========================================//
  ## Halaman Edit Poling 
	public function edit()
	{
    $id = $this->input->get('id');
    $data = $this->mpoling->edit('t_poling', ['id_poling' => $id]);
    $responses = json_encode($data);
    echo $responses;
  }
  //==========================================// 

  //==========================================//
  ## Halaman Update Poling 
	public function update()
	{
    $val = [
      'label' => $this->input->post('judul'),
      'status' => $this->input->post('jenispoling'),
      'aktif' => $this->input->post('aktif')
    ];

    $whr = [
      'id_poling' => $this->input->post('idpoling')
    ];

    $data = $this->mpoling->update('t_poling',$val,$whr);
    if($data) {
      $msg['pesan'] = "Responses Server Gagal";
    } else {
      $msg['pesan'] = "Poling Berhasil Diupdate";
    }
    
    echo json_encode($msg);
  }
  //==========================================// 

  //==========================================//
  ## Halaman Grafik Poling 
	public function grafik()
	{
    $data = $this->mpoling->grafik('t_poling');
    $responses = json_encode($data);
    echo $responses;
  }
  //==========================================// 
  
  //==========================================//
  ## Halaman Hapus Poling 
	public function hapus()
	{
    $id = $this->input->get('id');
    $data = $this->mpoling->hapus('t_poling', ['id_poling' => $id]);
    $responses = json_encode($data);
    echo $responses;
  }
  //==========================================//  
  
  //==========================================//
  ## Halaman Review Poling 
	public function review_p()
	{
    return $this->mpoling->preview_pertanyaan();
  }
  //==========================================//  
  
  //==========================================//
  ## Halaman Review Poling 
	public function review_j()
	{
    return $this->mpoling->preview_jawaban();
  }
	//==========================================//    
}
?>