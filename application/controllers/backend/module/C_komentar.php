<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_komentar extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('M_b_komentar', 'mkomentar');
    if (($this->session->userdata('status') != "ONLINE") && ($this->session->userdata('user_access') == '')) {
      redirect("login");
    }
  }

  //==========================================//
  ## Halaman Komentar 
  public function index()
  {

    $data = [
      'content' => 'Backend/__module/___Komentar/v_table',
      'scriptjs' => 'Backend/__ServerSideJs/Komentar/s_komentar',
      'pageinfo' => '<li>
                        <a href="#"><i class="material-icons">dashboard</i> Dasboard</a>
                      </li>
                      <li class="active">
                         Manajemen Komentar
                      </li>',
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
  ## AJAX LIST KOMENTAR

  public function ajax_list()
  {
    // $search = $this->input->post('judul');

    $get_data = $this->mkomentar->fetch_datatable_komentar();
    $data = array();
    $no = $_POST['start'];

    foreach ($get_data as $r) {

      $sub_array = array();
      $sub_array[] = $no + 1;
      $sub_array[] = "<img src='" . img_blob($r->photo_pic) . "' width='50' height='50' class='img-circle'><br><code>ID." . $r->id_komentar . "</code>";
      $sub_array[] = $r->parent_id;
      $sub_array[] = "<u><b class='font-12'>" . decrypt_url($r->nama_lengkap) . "</b></u><br><a href='mailto:" . decrypt_url($r->email) . "' target='_blank'>" . decrypt_url($r->email) . "</a><br><code>" . longdate_indo($r->tanggal) . " / " . substr($r->waktu, 0, 5) . " WIB</code>";
      $sub_array[] = $r->judul;
      $sub_array[] = '<div class="btn-group btn-group-xs" role="group">
                          <button type="button" class="btn btn-link waves-effect" id="detail" data-id="' . $r->id_komentar . '" data-parent="' . $r->parent_id . '">DETAIL</button>
                          <button type="button" id="hapus" data-id="' . $r->id_komentar . '" class="btn btn-danger waves-effect">HAPUS</button>
                      </div>';
      $data[]      = $sub_array;

      $no++;
    }

    $output = array(
      'draw'            => intval($_POST['draw']),
      'recordsTotal'     => $this->mkomentar->get_all_data_komentar(),
      'recordsFiltered' => $this->mkomentar->get_filtered_data_komentar(),
      'data'            => $data
    );

    echo json_encode($output);
  }

  //==========================================//

  public function detail_komentar()
  {
    $id = $this->input->get('id');
    $parent_id = $this->input->get('parent_id');
    $data = [
      'id' => $id,
      'd' => $this->mkomentar->getbyid('t_komentar', $id),
      'r' => $this->mkomentar->getreplykomentar($parent_id)
    ];
    $file = 'Backend/__Module/___Komentar/v_detail';
    $this->load->view($file, $data);
  }

  public function proses_balas_komentar()
  {
    $isi = $this->input->post('isi_komentar');
    $parent_id = $this->input->post('parent_id');
    $fid_berita = $this->input->post('fid_berita');

    if (!empty($isi)) {
      $GT_VAL = [
        'parent_id' => $parent_id,
        'fid_berita' => $fid_berita,
        'gravatar' => $this->session->userdata('lvl') . ".png",
        'level' =>  $this->session->userdata('lvl'),
        'nama_lengkap' => $this->session->userdata('namalengkap'),
        'email' => $this->session->userdata('emailuser'),
        'isi' => $isi,
        'tanggal' => date('Y-m-d'),
        'jam' => date('H:i:s'),
        'aktif' => 'Y'
      ];
      $this->mkomentar->proses_balas_komentar('t_komentar', $GT_VAL);
      $msg = array('msg' => 'Komentar Balasan, Success', 'type' => 1);
    } else {
      $msg = array('msg' => 'Komentar Kosong !', 'type' => 0);
    }
    echo json_encode($msg);
  }

  public function hapus_komentar()
  {
    $id = $this->input->get('id');
    $send = $this->mkomentar->hapus_komentar('t_komentar', $id);
    if ($send == true) {
      $msg = "Hapus Berhasil di eksekusi.";
    } else {
      $msg = "Gagal";
    }
    echo json_encode($msg);
  }
}