<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_peraturan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_b_peraturan', 'mperaturan');
        _is_logged_in();
    }

    //==========================================//
    //# Halaman Peraturan
    public function index()
    {
        $data = [
                'content' => 'Backend/__module/___Peraturan/v_table',
                'scriptjs' => 'Backend/__ServerSideJs/Peraturan/s_peraturan',
                'pageinfo' => '<li> Dasboard</li><li class="active">Peraturan</li>',
                'css' => [
                    'assets/plugins/datatable/datatables.min.css',
                    'assets/plugins/datatable/inc_tablesold.css',
                    'assets/plugins/select2/css/select2.min.css',
                    'assets/plugins/select2/css/select2-materialize.css',
                    'assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css',
                ],
                'js' => [
                    'assets/plugins/datatable/datatables.min.js',
                    'assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js',
                    'assets/plugins/bootstrap-datepicker/locales/bootstrap-datepicker.id.min.js',
                    'assets/plugins/jquery-validation/jquery.validate.js',
                    'assets/plugins/jquery-validation/additional-methods.js',
                    'assets/plugins/jquery-form/jquery.form.js',
                    'assets/plugins/select2/js/select2.min.js',
                ],
        ];
        $this->load->view('Backend/v_home', $data);
    }

    //==========================================//

    public function ajax_select_jenisperaturan()
    {
        $search = $this->input->post('searchParm');
        $row = $this->mperaturan->get_select_jenisperaturan('ref_jns_peraturan', $search)->result_array();
        $data = array();
        foreach ($row as $r) {
            $data[] = array(
                'id' => $r['id_jenis_peraturan'],
                'text' => strtoupper($r['nama_jenis_peraturan']),
            );
        }
        echo json_encode(['items' => $data]);
    }

    public function aksitambah()
    {
        $jdl = $this->input->post('judul');
        $jns = $this->input->post('fid_jenis_peraturan');
        $thn = $this->input->post('tahun');
        $fileName = $_FILES['file']['name'];

        $acak27 = generateRandomString(27);
        $date = date('Y-m-d');

        $files = $thn.'~'.$acak27.'~'.str_replace(' ', '-', $jdl);
        $config['upload_path'] = './files/file_peraturan/';
        $config['allowed_types'] = 'pdf|doc';
        $config['max_size'] = '10120'; //maksimum besar file 10M
        $config['overwrite'] = true;
        $config['file_ext_tolower'] = true;
        $config['file_name'] = strtoupper($files); //nama yang terupload nantinya
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('file')) {
            $msg = array('content' => $this->upload->display_errors(), 'errorStatus' => 'warning');
        } else {
            if (file_exists('./files/file_peraturan/'.$files)) {
                unlink('./files/file_peraturan/'.$files);
            }
            $values = [
                    'file' => strtoupper($this->upload->data('file_name')),
                    'judul' => $jdl,
                    'fid_jns_peraturan' => $jns,
                    'tahun' => $thn,
                ];
            $this->mperaturan->insert_file_peraturan('t_peraturan', $values);
            $msg = array(
                    'errorStatus' => 'success',
                    'content' => 'File Peraturan <b>'.$jdl.'</b> Added',
                );
        }

        echo json_encode($msg);
    }

    public function ajax_list_peraturan()
    {
        // $search = $this->input->post('judul');

        $get = $this->mperaturan->fetch_datatable_peraturan();
        $data = array();
        $no = $_POST['start'];

        foreach ($get as $r) {
            $sub_array = array();
            $sub_array[] = $no + 1;
            $sub_array[] = '<b>'.ucwords($r->judul).'</b>';
            $sub_array[] = strtoupper($r->nama_jenis_peraturan);
            $sub_array[] = $r->tahun;
            $sub_array[] = "<a id='button-view' data-title='".$r->judul."' href='".base_url('files/file_peraturan/'.$r->file)."' class='hint--top' aria-label='Download or Preview'><i class='material-icons'>insert_drive_file</i></a>";
            $sub_array[] = '
                          <button type="button" onclick="window.location.href=\''.base_url("backend/module/c_peraturan/edit/$r->id_peraturan?module=".$this->madmin->getmodule('peraturan').'&user='.$this->session->userdata('user_access').'').'\'" class="btn btn-link btn-sm waves-effect m-t--10"><span class="glyphicon glyphicon-pencil m-r-5" aria-hidden="true"></span>EDIT</button>
                          <button data-id="'.$r->id_peraturan.'" data-file="'.$r->file.'" data-judul="'.$r->judul.'" type="button" class="btn btn-link btn-sm waves-red waves-effect m-t--10" id="button-del" aria-label="hapus"><span class="glyphicon glyphicon-trash col-red m-r-5" aria-hidden="false"></span> HAPUS</button>';
            $data[] = $sub_array;

            ++$no;
        }

        $output = array(
      'draw' => intval($_POST['draw']),
      'recordsTotal' => $this->mperaturan->get_all_data_peraturan(),
      'recordsFiltered' => $this->mperaturan->get_filtered_data_peraturan(),
      'data' => $data,
    );

        echo json_encode($output);
    }

    public function edit($id)
    {
        $model = $this->mperaturan->edit_by_id('t_peraturan', $id)->result();
        $data = [
            'content' => 'Backend/__module/___Peraturan/v_edit',
            'scriptjs' => 'Backend/__ServerSideJs/Peraturan/s_edit',
            'model' => $model,
            'pageinfo' => '<li>Dasboard</li> <li>Peraturan</li><li>Edit Peraturan</li><li class="active">'.$this->mperaturan->get_judulbyid($id).'</li>',
            'css' => [
                'assets/plugins/select2/css/select2.min.css',
                'assets/plugins/select2/css/select2-materialize.css',
                'assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css',
            ],
            'js' => [
                'assets/plugins/select2/js/select2.min.js',
                'assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js',
                'assets/plugins/bootstrap-datepicker/locales/bootstrap-datepicker.id.min.js',
            ],
    ];
        $this->load->view('Backend/v_home', $data);
    }

    public function aksiupdate($id, $filelama)
    {
        $jdl = $this->input->post('judul');
        $jns = $this->input->post('jsnperaturan');
        $thn = $this->input->post('tahun');
        $fileName = $_FILES['file']['name'];

        $acak27 = generateRandomString(27);

        $files = '_'.$thn.'~'.$acak27.'~'.str_replace(' ', '-', $jdl);
        $config['upload_path'] = './files/file_peraturan/';
        $config['allowed_types'] = 'pdf|doc';
        $config['max_size'] = '10120'; //maksimum besar file 10M
        $config['overwrite'] = true;
        $config['file_ext_tolower'] = true;
        $config['file_name'] = strtoupper($files); //nama yang terupload nantinya
        $this->load->library('upload', $config);

        if ((isset($fileName)) && (!empty($fileName))) {
            if (!$this->upload->do_upload('file')) {
                $this->session->set_flashdata(array('message' => $this->upload->display_errors(), 'errorStatus' => 'bg-red'));
            } else {
                if (file_exists('./files/file_peraturan/'.$filelama)) {
                    unlink('./files/file_peraturan/'.$filelama);
                }
                $values = [
                        'file' => strtoupper($this->upload->data('file_name')),
                        'judul' => $jdl,
                        'fid_jns_peraturan' => $jns,
                        'tahun' => $thn,
                    ];
                $this->mperaturan->update_file_peraturan('t_peraturan', $values, ['id_peraturan' => $id]);
                $this->session->set_flashdata(array('message' => 'Peraturan <b>'.$jdl.'</b> berhasil diupdate', 'errorStatus' => 'bg-teal'));
            }
        } else {
            $values = [
                'judul' => $jdl,
                'fid_jns_peraturan' => $jns,
                'tahun' => $thn,
            ];
            $this->mperaturan->update_file_peraturan('t_peraturan', $values, ['id_peraturan' => $id]);
            $this->session->set_flashdata(array('message' => 'Peraturan <b>'.$jdl.'</b> berhasil diupdate', 'errorStatus' => 'bg-teal'));
        }
        redirect(base_url('backend/module/c_peraturan/edit/'.$id.'?module='.$this->madmin->getmodule('peraturan').'&user='.$this->session->userdata('user_access')));
    }

    public function hapusperaturan($file)
    {
        $id = $this->input->get('id');
        $tbl = 't_peraturan';
        $where = [
            'id_peraturan' => $id,
        ];

        $path = './files/file_peraturan/';
        if (file_exists($path.$file)) {
            unlink($path.$file);
            $this->mperaturan->hapusperaturan($tbl, $where);
            $msg = ['type' => 'bg-teal', 'content' => 'Deleted'];
        } else {
            $msg = ['type' => 'bg-pink', 'content' => 'Error Deleted'];
        }
        $json = json_encode($msg);
        echo $json;
    }

    public function ajax_list_jns_peraturan()
    {
        $get = $this->mperaturan->fetch_datatable_jns_peraturan();
        $data = array();
        $no = $_POST['start'];

        foreach ($get as $r) {
            $sub_array = array();
            $sub_array[] = $no + 1;
            $sub_array[] = '<b>'.strtoupper($r->nama_jenis_peraturan).'</b>';
            $sub_array[] = '<button type="button" data-id-edit="'.$r->id_jenis_peraturan.'" data-title="'.$r->nama_jenis_peraturan.'" class="btn btn-sm btn-link waves-effect m-t--10" id="button-edit"><span class="glyphicon glyphicon-pencil m-r-5 col-teal" aria-hidden="true"></span> EDIT</button>
													
                         	 <button type="button" class="btn btn-sm btn-link waves-effect m-t--10" id="button-hapus" data-id-hapus="'.$r->id_jenis_peraturan.'" data-title="'.$r->nama_jenis_peraturan.'"><span class="glyphicon glyphicon-trash m-r-5 col-red" aria-hidden="true"></span> HAPUS</button>';
            $data[] = $sub_array;

            ++$no;
        }

        $output = array(
      'draw' => intval($_POST['draw']),
      'recordsTotal' => $this->mperaturan->get_all_data_jns_peraturan(),
      'recordsFiltered' => $this->mperaturan->get_filtered_data_jns_peraturan(),
      'data' => $data,
    );

        echo json_encode($output);
    }

    public function aksiupdate_jns_peraturan($id)
    {
        $namajnsperaturan = $this->input->post('txt');
        $set = [
            'nama_jenis_peraturan' => $namajnsperaturan,
        ];
        $whr = [
            'id_jenis_peraturan' => $id,
        ];

        if ((isset($namajnsperaturan)) && (!empty($namajnsperaturan))) {
            $this->mperaturan->update_jns_peraturan('ref_jns_peraturan', $whr, $set);
            $msg['msg'] = array('type' => 'success', 'title' => 'Success');
        } else {
            $msg['msg'] = array('type' => 'error', 'title' => 'Failed');
        }
        echo json_encode($msg);
    }

    public function aksitambah_jenisperaturan()
    {
        $nama_jenis_peraturan = $this->input->post('nama_jns_peraturan');
        $msg = array();
        if ((isset($nama_jenis_peraturan)) && (!empty($nama_jenis_peraturan))) {
            $this->mperaturan->insert_jns_peraturan('ref_jns_peraturan', ['nama_jenis_peraturan' => $nama_jenis_peraturan]);
            $msg['message'] = "'".$nama_jenis_peraturan."' Success Added";
        } else {
            $msg['message'] = 'Harap isi bagian nama jenis peraturan!';
        }
        echo json_encode($msg);
    }

    public function hapusjnsperaturan()
    {
        $id = $this->input->get('id');
        $title = $this->input->get('title');
        $tbl = 'ref_jns_peraturan';
        $where = [
            'id_jenis_peraturan' => $id,
        ];

        if (!empty($id)) {
            $this->mperaturan->hapusjnsperaturan($tbl, $where);
            $msg = ['type' => 'bg-teal', 'content' => 'Deleted Success <b>'.$title.'</b>'];
        } else {
            $msg = ['type' => 'bg-pink', 'content' => 'Error Deleted  <b>'.$title.'</b>'];
        }
        $json = json_encode($msg);
        echo $json;
    }
}
