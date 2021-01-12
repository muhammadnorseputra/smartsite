
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Informasi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_b_cpns', 'mcpns');
        $this->load->library('excel');

        if (($this->session->userdata('status') != 'ONLINE') && ($this->session->userdata('user_access') == '')) {
            redirect('login');
        }
    }

    public function index()
    {
        $data = [
          'content' => 'Backend/__CPNS/v_informasi',
          'pageinfo' => '<li>Dasboard</li> <li>Informasi</li> <li class="active">CPNS Kabupaten Balangan</li>',
          'scriptjs' => 'Backend/__ServerSideJs/Cpns/s_informasi_cpns',
          'css' => [
            'assets/plugins/datatable/datatables2.min.css',
            'assets/plugins/datatable/inc_tablesold.css',
            'assets/plugins/ios-confirm/modal.css',
            'assets/plugins/jquery-ui/jquery-ui.css',
            'assets/plugins/jquery-ui/jquery-ui.structure.css',
            'assets/plugins/jquery-ui/jquery-ui.theme.css',
            'assets/plugins/loading-bar/loading-bar.min.css'
          ],
          'js' => [
            'assets/plugins/datatable/pdfmake.min.js',
            'assets/plugins/datatable/vfs_fonts.js',
            'assets/plugins/datatable/datatables_full_extension.min.js',
            'assets/plugins/ios-confirm/modal.js',
            'assets/plugins/loading-bar/loading-bar.min.js'
          ],
        ];
        $this->load->view('Backend/v_home', $data);
    }

    public function intro()
    {
        $data = 'Backend/__CPNS/v_informasi_intro';
        $this->load->view($data);
    }

    public function hasilVerifikasi()
    {
        $data = 'Backend/__CPNS/v_hasilverifikasi';
        $this->load->view($data);
    }

    public function ajaxList_hasilverifikasi()
    {
        $getdata = $this->mcpns->fetch_datatable_hasilverifikasi();
        $data = array();
        $no = $_POST['start'];

        foreach ($getdata as $r) {
            $sub_array = array();
            $sub_array[] = $r->nopeserta;
            $sub_array[] = $r->nik;
            $sub_array[] = $r->nama;
            $sub_array[] = $r->jnskel;
            $sub_array[] = $r->jabatan;
            $sub_array[] = $r->pendidikan;
            $sub_array[] = '
                <button id="detail-verifikasi" data-id="'.$r->nik.'" class="btn btn-link btn-sm bg-white waves-effect waves-float" ><i class="glyphicon glyphicon-search"></i></button>
                
                <button id="edit-verifikasi" data-id="'.$r->nik.'" class="btn btn-link btn-sm bg-cyan waves-effect waves-float" ><i class="glyphicon glyphicon-pencil"></i></button>

                <button id="hapus-verifikasi" data-nama="'.$r->nama.'" data-id="'.$r->nik.'" class="btn btn-link bg-red col-black btn-sm waves-effect waves-float"><i class="glyphicon glyphicon-trash"></i></button>
                
            ';
            $data[] = $sub_array;

            ++$no;
        }

        $output = array(
          'draw' => intval($_POST['draw']),
          'recordsTotal' => $this->mcpns->get_all_datatable_hasilverifikasi(),
          'recordsFiltered' => $this->mcpns->get_filtered_datatable_hasilverifikasi(),
          'data' => $data,
        );

        echo json_encode($output);
    }

    public function uploadDataHasilVerifikasi()
    {
        $data = 'Backend/__CPNS/v_hasilverifikasi_upload';
        $this->load->view($data);
    }

    public function DownloadDataHasilVerifikasi()
    {
        $data = 'Backend/__CPNS/v_download_template_table_hasilverifikasi';
        $this->load->view($data);
    }

    public function imports_peserta_hasilverifikasi()
    {
        if (isset($_FILES['hasilverifikasi']['name'])) {
            $path = $_FILES['hasilverifikasi']['tmp_name'];
            $object = PHPExcel_IOFactory::load($path);
            foreach ($object->getWorksheetIterator() as $worksheet) {
                $highestRow = $worksheet->getHighestRow();
                $highestColumn = $worksheet->getHighestColumn();
                for ($row = 6; $row <= $highestRow; ++$row) {
                    $nik              = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                    $noregister       = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                    $nopeserta        = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                    $nama             = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                    $jk               = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                    $penempatan       = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                    $jabatan          = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                    $pendidikan       = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
                    $jenisformasi     = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
                    $statusverifikasi = $worksheet->getCellByColumnAndRow(10, $row)->getValue();
                    $alasanverifikasi = $worksheet->getCellByColumnAndRow(11, $row)->getValue();
                    $data[] = array(
                    'nik'              => $nik,
                    'noregister'       => $noregister,
                    'nopeserta'        => $nopeserta,
                    'nama'             => $nama,
                    'jnskel'           => $jk,
                    'penempatan'       => $penempatan,
                    'jabatan'          => $jabatan,
                    'pendidikan'       => $pendidikan,
                    'jenisformasi'     => $jenisformasi,
                    'statusverifikasi' => $statusverifikasi,
                    'alasanverifikasi' => $alasanverifikasi
                    );
                }
            }
            $send = $this->mcpns->insert_hasilverifikasi($data);
            if ($send == true) {
                echo 'Data Imported successfully';
            } else {
                echo 'Data sudah pernah di upload';
            }
        }
    }

    public function hapus_hasil_verifikasi()
    {
        $id = $this->input->post('id');
        $tbl = 'cpns_hasilverifikasi';
        $whr = [
            'nik' => $id,
        ];
        $send = $this->mcpns->hapus_hasilverifikasi_byid($tbl, $whr);
        if ($send == true) {
            $msg = 'Success';
        } else {
            $msg = 'Error';
        }
        echo json_encode($msg);
    }

    public function doEmptyTable_HasilVerifikasi()
    {
        $tbl = 'cpns_hasilverifikasi';
        $send = $this->mcpns->doEmptyTable($tbl);
        if ($send == true) {
            $msg = ['type' => 'bg-teal', 'msg' => 'Table telah dikosongkan'];
        } else {
            $msg = ['type' => 'bg-pink', 'msg' => 'Error Deleted'];
        }
        $json = json_encode($msg);
        echo $json;
    }

    public function detail_verifikasi()
    {
        $id = $this->input->post('id');
        $fromdata = $this->mcpns->hasilverifikasi_byid('cpns_hasilverifikasi', $id)->result();
        $data = [
            'fromdata' => $fromdata,
        ];
        $html = 'Backend/__CPNS/v_hasilverifikasi_detail';
        $this->load->view($html, $data);
    }

    public function backup_sql_table_verifikasi()
    {
        $get_req = sha1(date('dmY'));
        $req = $this->input->post('req');
        if ((!empty($req)) && ($get_req == $req)) {
            $this->load->dbutil();
            $dbformat = [
                'tables'     => array('cpns_hasilverifikasi'),
                'format'     => 'zip',
                'add_drop'   => true,
                'add_insert' => true,
                'filename'   => 'hasilverifikasi.sql',
                'newline'    => "\n",
            ];
            $bu = $this->dbutil->backup($dbformat);
            $acak = generateRandomString(7);
            $dbname = $req.'_hasilverifikasi_'.date('dmY').'.zip';
            $save = './files/template/backup/'.$dbname;
            write_file($save, $bu);
            // force_download($dbname, $bu);
            $msg = $dbname;
        } else {
            $msg = 'Error';
        }
        echo json_encode($msg, true);
    }


    public function jadwalTes()
    {
        $data = 'Backend/__CPNS/v_jadwaltes';
        $this->load->view($data);
    }

    public function ajaxList_jadwaltes()
    {
        $getdata = $this->mcpns->fetch_datatable_jadwaltes();
        $data = array();
        $no = $_POST['start'];

        foreach ($getdata as $r) {
            $sub_array = array();
            $sub_array[] = $r->nopeserta;
            $sub_array[] = $r->nik;
            $sub_array[] = $r->nama;
            $sub_array[] = $r->lokasi_tes;
            $sub_array[] = $r->tgl_tes;
            $sub_array[] = $r->waktu_tes;
            $sub_array[] = $r->ruangan_tes;
            $data[] = $sub_array;

            ++$no;
        }

        $output = array(
          'draw' => intval($_POST['draw']),
          'recordsTotal' => $this->mcpns->get_all_datatable_jadwaltes(),
          'recordsFiltered' => $this->mcpns->get_filtered_datatable_jadwaltes(),
          'data' => $data,
        );

        echo json_encode($output);
    }

    public function imports_peserta_jadwaltes()
    {
        if (isset($_FILES['file']['name'])) {
            $path   = $_FILES['file']['tmp_name'];
            $object = PHPExcel_IOFactory::load($path);
            foreach ($object->getWorksheetIterator() as $worksheet) {
                $highestRow    = $worksheet->getHighestRow();
                $highestColumn = $worksheet->getHighestColumn();
                for ($row = 6; $row <= $highestRow; ++$row) {
                    $nopeserta = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                    $nik       = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                    $nama      = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                    $lokasi    = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                    $tgl       = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                    $waktu     = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                    $ruangan   = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                    $data[] = array(
                      'nopeserta'   => $nopeserta,
                      'nik'         => $nik,
                      'nama'        => $nama,
                      'lokasi_tes'  => $lokasi,
                      'tgl_tes'     => $tgl,
                      'waktu_tes'   => $waktu,
                      'ruangan_tes' => $ruangan
                    );
                }
            }
            $send = $this->mcpns->insert_jadwaltes($data);
            if ($send == true) {
                echo 'Data Imported successfully';
            } else {
                echo 'Data sudah pernah di upload';
            }
        }
    }

    public function backup_sql_table_jadwaltes()
    {
        $get_req = sha1(date('dmY'));
        $req = $this->input->post('req');
        if ((!empty($req)) && ($get_req == $req)) {
            $this->load->dbutil();
            $dbformat = [
                'tables'     => array('cpns_jadwaltes'),
                'format'     => 'zip',
                'add_drop'   => true,
                'add_insert' => true,
                'filename'   => 'jadwalTes.sql',
                'newline'    => "\n",
            ];
            $bu      = $this->dbutil->backup($dbformat);
            // $acak = generateRandomString(7);
            $dbname  = $req.'_jadwaltes_'.date('dmY').'.zip';
            $save    = './files/template/backup/'.$dbname;
            write_file($save, $bu);
            // force_download($dbname, $bu);
            $msg     = $dbname;
        } else {
            $msg = 'Error';
        }
        echo json_encode($msg, true);
    }

    public function doEmptyTable()
    {
        $tbl = 'cpns_jadwaltes';
        $send = $this->mcpns->doEmptyTable($tbl);
        if ($send == true) {
            $msg = ['type' => 'bg-teal', 'msg' => 'Table telah dikosongkan'];
        } else {
            $msg = ['type' => 'bg-pink', 'msg' => 'Error Deleted'];
        }
        $json = json_encode($msg);
        echo $json;
    }

    public function downloadTemplate()
    {
        $data = 'Backend/__CPNS/v_download_template_table_jadwaltes';
        $this->load->view($data);
    }

    public function finalData()
    {
        echo 'Final Data';
    }
}
