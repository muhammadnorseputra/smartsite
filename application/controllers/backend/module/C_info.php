<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_info extends CI_Controller {
	public function __construct() 
	{
    parent::__construct();
		$this->load->model('M_b_info','minfo');
		$this->load->library('upload');
		$this->load->helper('tgl_indo');
    if(($this->session->userdata('status') != "ONLINE") && ($this->session->userdata('user_access') == '')){
			redirect("login");
    }
  }

  //==========================================//
  ## Halaman Info 
	public function index()
	{
    $data = [
        'content' => 'Backend/__module/___Info/v_table',
        'scriptjs' => 'Backend/__ServerSideJs/Info/s_info',
        'pageinfo' => '<li><a href="#"><i class="material-icons">dashboard</i> Dasboard</a></li>
              <li class="active">Sekials Info</li>'
    ];
    $this->load->view('Backend/v_home', $data);
      
  }
	//==========================================//
  
  //==========================================//
  ## Halaman List Info 
	public function list_info()
	{
    $search = $this->input->get('search');
    $data = $this->minfo->list_info('t_info', $search)->result();
    if(count($data) > 0) {
      $result = '';
      foreach($data as $row) {
        
        $isi_info = strip_tags($row->informasi); // membuat paragraf pada isi berita dan mengabaikan tag html
        $isi = substr($isi_info,0, 100); // ambil sebanyak 80 karakter
        $isi = substr($isi_info,0,strrpos($isi," ")); // potong per spasi kalimat
        $tgl = substr($row->tgl_publish,0,10);
        
        if($row->publish == 'N' ? $col = 'bg-red' : $col = '');
          $result .= '<div class="list-group-item '.$col.'">
                        <h5 class="list-group-item-heading font-16">
                        '.strtoupper($row->judul).' 
                        </h5>
                        <small class="font-12 d-block col-teal">  <em class="glyphicon glyphicon-calendar"></em> '.longdate_indo($tgl).'</small>
                        <p class="list-group-item-text">
                        '.$isi.' ...
                        </p>
                        <hr>
                        <button class="btn btn-xs btn-danger m-t--15 waves-effect waves-red" onclick="hapus('.$row->id_info.')"><em class="glyphicon glyphicon-trash"></em></button>

                        <button href="javascript:void(0)" class="btn btn-xs waves-effect waves-teal m-t--15 m-l-5 col-teal" onclick="edit('.$row->id_info.')">
                          <em class="material-icons font-12">edit</em>
                        </button>

                      </div>';
      }
    } else {
      $result = '<div class="text-center col-grey m-t-35 p-t-35">
                    <em class="font-50 material-icons">find_in_page</em><br> Papan Infromasi Kosong
                  </div>';
    }
    $responses = [
      'data' => $result
    ];
    echo json_encode($responses);
  }
	//==========================================//

  //==========================================//
  ## Halaman Add Info 
	public function add()
	{
    $judul   = $this->input->post('judul');
    $info    = $this->input->post('informasi');
    $publish = $this->input->post('publish');
    if(!empty($judul)) {
      $msg['pesan'] = "Informasi Berhasil Ditambhakan";
      $msg['msg_code'] = 200;
      $table = "t_info";
      $values = [
        'judul' => $judul,
        'informasi' => $info,
        'publish' => $publish
      ];
      $this->minfo->insert($table, $values);
    } else {
      $msg['pesan'] = "Responses Server Gagal";
      $msg['msg_code'] = 500;
    }
    echo json_encode($msg);
  }
  //==========================================//

  //==========================================//
  ## Halaman Edit Info 
	public function edit()
	{
    $id = $this->input->get('id');
    $data = $this->minfo->edit('t_info', ['id_info' => $id]);
    $responses = json_encode($data);
    echo $responses;
  }
  //==========================================// 

  //==========================================//
  ## Halaman Update Info 
	public function update()
	{
    $val = [
      'judul' => $this->input->post('judul'),
      'informasi' => $this->input->post('informasi')
    ];

    $whr = [
      'id_info' => $this->input->post('idinfo')
    ];

    $data = $this->minfo->update('t_info',$val,$whr);
    if($data) {
      $msg['pesan'] = "Responses Server Gagal";
    } else {
      $msg['pesan'] = "Informasi Berhasil Diupdate";
    }
    
    echo json_encode($msg);
  }
  //==========================================//   
  
  //==========================================//
  ## Halaman Hapus Info 
	public function hapus()
	{
    $id = $this->input->get('id');
    $data = $this->minfo->hapus('t_info', ['id_info' => $id]);
    $responses = json_encode($data);
    echo $responses;
  }
	//==========================================//  
}
?>