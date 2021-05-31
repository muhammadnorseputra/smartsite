<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_kategori extends CI_Controller {
	public function __construct() 
	{
    parent::__construct();
		$this->load->model('M_b_kategori', 'mkategori');
    _is_logged_in();
  }

  //==========================================//
  ## Halaman Kategori 
	public function index()
	{
 
    $data = [
        'content' => 'Backend/__Module/___Kategori/v_table',
        'scriptjs' => 'Backend/__ServerSideJs/Kategori/s_kategori',
        'pageinfo' => '<li> Dasboard</li>
              <li class="active">Kategori</li>',
        'css' => [
          'assets/plugins/jquery-ui/jquery-ui.min.css',
          'assets/plugins/jquery-ui/jquery-ui.theme.min.css'
        ],
    ];
    $this->load->view('Backend/v_home', $data);
      
  }
  //==========================================//

  //==========================================//
  ## Fungsi Cari Kategori
  public function search()
  {
    $katakunci = $this->input->post('cariNamaKategori');
    $data = $this->mkategori->search('t_kategori', $katakunci)->result();
    if(count($data) > 0)
    {
      $res = "";
      $no = 1;
      foreach($data as $v)
      {
        if($v->aktif != 'Y' ? $label = 'list-group-bg-pink' : $label = '');

        $res .= '<div class="col-md-6 m-t-10 border-bottom">'.$no.". <b>"  .$v->nama_kategori. ' </b>
                  <a onclick="del('.$v->id_kategori.')" class="circle waves-effect waves-ripple waves-circle col-red pull-right m-t--10"><em class="material-icons font-12">delete</em></a>

                  <a onclick="edit('.$v->id_kategori.')" class="circle waves-effect waves-ripple waves-circle pull-right m-t--10 col-teal"><em class="material-icons font-12">edit</em></a>
                </div>';
        $no++; 
      }
    }
    else 
    {
      $res = '<li class="list-group-item disabled"> Kategori Kosong </li>';
    }
    $responses = [
      'data' => $res
    ];
    echo json_encode($responses);
  }
  //==========================================//  
  
  //==========================================//
  ## Fungsi List Kategori
  public function show()
  {
    $data = $this->mkategori->show('t_kategori')->result();
    if(count($data) > 0)
    {
      $res = "";
      $no = 1;
      foreach($data as $v)
      {
        if($v->aktif != 'Y' ? $label = 'list-group-bg-grey' : $label = '');        
        $res .= '<div class="col-md-6 m-t-10 border-bottom">'.$no.". <b>"  .$v->nama_kategori. ' </b>
                  <a onclick="del('.$v->id_kategori.')" class="circle waves-effect waves-ripple waves-circle col-red pull-right m-t--10"><em class="material-icons font-12">delete</em></a>

                  <a onclick="edit('.$v->id_kategori.')" class="circle waves-effect waves-ripple waves-circle pull-right m-t--10 col-teal"><em class="material-icons font-12">edit</em></a>
                </div>';
      $no++; 
    }
    }
    else 
    {
      $res = '<li class="list-group-item disabled"> Kategori Kosong </li>';
    }
    $responses = [
      'data' => $res
    ];
    echo json_encode($responses);
  }
  //==========================================//

  //==========================================//
  ## Fungsi List Tags
  public function show_tags()
  {
    $data = $this->mkategori->show_tags('t_tags')->result();
    if(count($data) > 0)
    {
      $no=1;
      $res = "<div class='row'>";
      foreach($data as $v)
      {

        $res .= '<div class="col-lg-3">
                  <span class="label bg-grey m-r-25 p-t-10 p-b-10 p-l-10 p-r-10 m-r-5 m-b-10 animated bounceIn d-block">
                  <a style="position:relative; display:inline-block; right:5px; top:8px;" class="btn-link" href="javascript:void(0)" onclick="del_tags('.$v->id_tag.')"><em class="material-icons">clear</em></a> '.strtoupper($v->nama_tag).' </span>
                 </div>';
      $no++;
      }
      $res .= "</div>";
    }
    else 
    {
      $res = 'Tags Kosong';
    }
    $responses = [
      'data' => $res
    ];
    echo json_encode($responses);
  }
  //==========================================//

  //==========================================//
  ## Fungsi Tambah Tags
  public function add_tags()
  {
    $tags = $this->input->post('NamaTag', true);
    $values = [
      'nama_tag' => strtolower(trim(strtolower($tags)))
    ];
    $data = $this->mkategori->insert_tags('t_tags', $values);
    $responses = [
      'data' => $data
    ];
    echo json_encode($responses);
  }
  //==========================================//
  
  //==========================================//
  ## Fungsi Tambah Kategori
  public function add()
  {
    $nama_kategori = $this->input->post('nama_kategori', true);
    $aktifkategori = $this->input->post('aktifkategori');

    if(!empty($aktifkategori) && !empty($nama_kategori))
    {
      $values = [
        'nama_kategori' => strtolower(trim($nama_kategori)),
        'aktif' => $aktifkategori
      ];

      $this->mkategori->insert('t_kategori', $values);
      $msg['type'] = 'success';
      $msg['content'] = 'Kategori <b>'.$nama_kategori.'</b> Ditambahkan';
    }
    elseif(empty($nama_kategori))
    {
      $msg['type'] = 'error';
      $msg['content'] = 'Kategori Tidak Boleh Kosong!';
    }
    else 
    {
      $msg['type'] = 'error';
      $msg['content'] = 'Respon Server Gagal !';
    }

    $responses = [
      'result' => $msg
    ];
    echo json_encode($responses);
  }
  //==========================================//

  //==========================================//
  ## Fungsi Edit Kategori
  public function edit($id)
  {
    $data = $this->mkategori->edit('t_kategori', ['id_kategori' => $id])->result();
    $responses = json_encode($data);
    echo $responses;
  } 
  //==========================================//

  //==========================================//
  ## Fungsi Edit Kategori
  public function update()
  {
    $val = [
      'nama_kategori' => $this->input->post('namakategori'),
      'aktif' => $this->input->post('aktif')
    ];

    $whr = [
      'id_kategori' => $this->input->post('idkategori')
    ];

    $this->mkategori->update('t_kategori',$val,$whr);
  }
  //==========================================//

  //==========================================//
  ## Fungsi Hapus Kategori
  public function del()
  {
    $id = $this->input->post('id');
    $data = $this->mkategori->del('t_kategori', ['id_kategori' => $id]);
    $responses = json_encode($data);
    echo $responses;
  }
  //==========================================//

  //==========================================//
  ## Fungsi Hapus Tags
  public function del_tags()
  {
    $id = $this->input->post('id');
    $data = $this->mkategori->del_tags('t_tags', ['id_tag' => $id]);
    $responses = json_encode($data);
    echo $responses;
  }
  //==========================================//
}