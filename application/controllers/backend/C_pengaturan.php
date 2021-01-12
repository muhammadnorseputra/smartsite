<!-- Developer Balangan  Maju -- file :: C_pengaturan - author :: mnorseputra -->
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_pengaturan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_b_pengaturan', 'mpengaturan');

        if (($this->session->userdata('status') != 'ONLINE') && ($this->session->userdata('user_access') == '')) {
            redirect('login');
        }
    }

    /* -------------------------------------------------------------------------- */
    /*                    PARSING URL HALAMAN HANYA SATU METHOD                   */
    /* -------------------------------------------------------------------------- */
    public function referensi($params)
    {
        $parser = \WyriHaximus\HtmlCompress\Factory::construct();
        $data = [
            'content' => $parser->compress('Backend/__Pengaturan/'.$params),
            'scriptjs' => $parser->compress('Backend/__ServerSideJs/pengaturan/'.substr($params, 2, 100)), //v_backup to backup
            'pageinfo' => '<li> Dasboard</li> <li> Pengaturan</li> <li class="active">'.ucwords(substr($params, 2, 100)).'</li>',
            'css' => [
                $parser->compress('assets/plugins/ios-confirm/modal.css'),
            ],
            'js' => [
                $parser->compress('assets/plugins/ios-confirm/modal.js'),
            ],
        ];
        $this->load->view('Backend/v_home', $data);
    }

    /* -------------------------------------------------------------------------- */

    /* -------------------------------------------------------------------------- */
    /*                               BACKUP DATABASE                              */
    /* -------------------------------------------------------------------------- */

    public function bu_database()
    {
        $this->load->dbutil();
        $dbformat = ['format' => 'zip', 'filename' => 'my_db_backup.sql'];
        $bu = $this->dbutil->backup($dbformat);
        $acak = generateRandomString(5);
        $dbname = 'BACKUP-DB'.date('dmY').'.zip';
        $save = './files/file_backup/db/'.$dbname;
        write_file($save, $bu);
        force_download($dbname, $bu);
    }

    /* -------------------------------------------------------------------------- */

    /* -------------------------------------------------------------------------- */
    /*                            BACKUP FILES WEBSITE                            */
    /* -------------------------------------------------------------------------- */

    public function bu_site()
    {
        $opt = array(
            'src' => 'files', // dir name to backup
            'dst' => 'files/file_backup/site/', // dir name backup output destination
        );

        // Codeigniter v3x
        $this->load->library('recurseZip_lib', $opt);
        $download = $this->recursezip_lib->compress();

        redirect(base_url($download));
    }

    /* -------------------------------------------------------------------------- */

    /* -------------------------------------------------------------------------- */
    /*                          TABS MAINTENANCE WEBSITE                          */
    /* -------------------------------------------------------------------------- */

    public function maintenance()
    {
        $data = [
            'fromdata' => $this->mpengaturan->getMaintenance()->result(),
        ];
        $html = $this->load->view('Backend/__Pengaturan/v_umum_maintenance', $data);

        return $html;
    }

    /* ------------------------ Aksi Aktifkan Mantenance ------------------------ */

    public function do_maintenance()
    {
        $status = $this->input->post('status');
        $post = [
            'status_maintenance' => $status,
        ];
        $this->mpengaturan->doPostMaintenance('t_pengaturan', $post);
        if ($status == 1) {
            $msg = array('message' => 'Website Maintenance <b>ON</b>', 'classes' => 'bg-green');
        } else {
            $msg = array('message' => 'Website Maintenance <b>OFF</b>', 'classes' => 'bg-grey');
        }
        echo json_encode($msg);
    }

    /* -------------------------------------------------------------------------- */

    /* -------------------------------------------------------------------------- */
    /*                             TABS WIDGET WEBSITE                            */
    /* -------------------------------------------------------------------------- */

    public function widget()
    {
        $data = [
            'fromdata' => $this->mpengaturan->getWidgetData()->result(),
        ];
        $html = $this->load->view('Backend/__Pengaturan/v_umum_widget', $data);

        return $html;
    }

    /* -------------------------- Halaman Tambah Widget ------------------------- */

    public function doAddWidget()
    {
        $data = 'Backend/__Pengaturan/v_umum_widget_add';
        $this->load->view($data);
    }

    /* --------------------------- Aksi Tambah Widget --------------------------- */

    public function doAddWidgetToDb()
    {
        $title = $this->input->post('title_widgets');
        $content = $this->input->post('content_widgets');
        $show = $this->input->post('show_widgets');
        if (empty($title)) {
            $msg = ['msg' => 'Isi bagian title', 'type' => 'error'];
        } elseif (empty($show)) {
            $msg = ['msg' => 'Pilih tampilkan atau tidak', 'type' => 'error'];
        } else {
            $post = [
                'title' => $title,
                'content' => $content,
                'show' => $show,
            ];

            if ($this->mpengaturan->doAddWidgetToDb('t_widget', $post) == true) {
                $msg = ['msg' => 'Success added new widget '.$title, 'type' => 'success'];
            } else {
                $msg = ['msg' => 'Feild Added', 'type' => 'error'];
            }
        }

        echo json_encode($msg);
    }

    /* ----------------- Aksi Update Widget Tampilkan atau Tidak ---------------- */

    public function doUpdateWidget()
    {
        $status = $this->input->post('show');
        $id = $this->input->post('id');
        $title = $this->input->post('title');
        $post = [
            'show' => $status,
        ];
        $whr = [
            'id_widget' => $id,
        ];
        $this->mpengaturan->doUpdateWidget('t_widget', $post, $whr);
        if ($status == 'Y') {
            $msg = array('message' => 'Widget <span class="col-yellow">'.$title.'</span> <b>ON</b>', 'classes' => 'bg-green');
        } else {
            $msg = array('message' => 'Widget <span class="col-yellow">'.$title.'</span> <b>OFF</b>', 'classes' => 'bg-grey');
        }
        echo json_encode($msg);
    }

    /* ------------------------- Aksi Hapus Widget By ID ------------------------ */

    public function doHapusWidget()
    {
        $id = $this->input->post('id');
        $tbl = 't_widget';
        $where = [
            'id_widget' => $id,
        ];
        if (!empty($id)) {
            $this->mpengaturan->hapusWidget($tbl, $where);
            $msg = ['type' => 'bg-teal', 'msg' => 'Deleted Success'];
        } else {
            $msg = ['type' => 'bg-pink', 'msg' => 'Error Deleted'];
        }
        $json = json_encode($msg);
        echo $json;
    }

    /* --------------------------- Halaman Edit Widget -------------------------- */

    public function editWidget($id)
    {
        $data = [
            'fromdata' => $this->mpengaturan->getWidgetEdit($id)->result(),
        ];
        $html = $this->load->view('Backend/__Pengaturan/v_umum_widget_edit', $data);

        return $html;
    }

    /* ------------------------ Aksi Update Seluruh Data ------------------------ */

    public function doPutWidget()
    {
        $id = $this->input->post('id_widget');
        $title = $this->input->post('title_widget');
        $content = $this->input->post('content_widget');
        $show = $this->input->post('show_widget');

        $put = [
            'title' => $title,
            'content' => $content,
            'show' => $show,
        ];

        $whr = [
            'id_widget' => $id,
        ];

        $send = $this->mpengaturan->doPutWidget('t_widget', $put, $whr);
        if ($send == true) {
            $msg = ['type' => 'OK', 'msg' => $title.' berhasil diupdate'];
        } else {
            $msg = ['type' => 'GAGAL', 'msg' => $title.' gagal diupdate'];
        }

        echo json_encode($msg);
    }

    /* -------------------------------------------------------------------------- */

    /* -------------------------------------------------------------------------- */
    /*                           TABS IDENTITAS WEBSITE                           */
    /* -------------------------------------------------------------------------- */

    public function identitas()
    {
        $data = [
            'fromdata' => $this->mpengaturan->getIdentitas()->result(),
        ];
        $html = $this->load->view('Backend/__Pengaturan/v_umum_identitas', $data);

        return $html;
    }

    /* -------------------------- Aksi Update Identitas ------------------------- */

    public function do_identitas()
    {
        $bkppd_logo = file_get_contents($_FILES['bkppd_logo']['tmp_name']);
        $bkppd_title = $this->input->post('bkppd_title');
        $bkppd_seo = $this->input->post('bkppd_seo');
        $bkppd_desc = $this->input->post('bkppd_desc');

        $module = $this->madmin->getmodulebycontroller('c_pengaturan_umum');
        $userid = $this->session->userdata('user_access');

        if (!empty($bkppd_logo)) {
            $post = [
                'site_logo' => $bkppd_logo,
                'site_title' => $bkppd_title,
                'meta_seo' => $bkppd_seo,
                'meta_desc' => $bkppd_desc,
            ];
        } else {
            $post = [
                'site_title' => $bkppd_title,
                'meta_seo' => $bkppd_seo,
                'meta_desc' => $bkppd_desc,
            ];
        }

        $do_post = $this->mpengaturan->doPostIdentitas('t_pengaturan', $post);
        if ($do_post == true) {
            redirect(base_url('backend/c_pengaturan/referensi/v_umum?module='.$module.'&user='.$userid));
        } else {
            redirect(base_url('backend/c_pengaturan/referensi/v_umum?module='.$module.'&user='.$userid));
        }
    }

    /* --------------------------- Aksi Update Kontak --------------------------- */

    public function do_kontak()
    {
        $email = $this->input->post('bkppd_email');
        $fb = $this->input->post('bkppd_fb');
        $ig = $this->input->post('bkppd_ig');
        $nohp = $this->input->post('bkppd_nohp');
        $embed_maps = $this->input->post('embed_maps');

        $module = $this->madmin->getmodulebycontroller('c_pengaturan_umum');
        $userid = $this->session->userdata('user_access');

        $post = [
            'map_embed' => $embed_maps,
            'email' => $email,
            'fb' => $fb,
            'ig' => $ig,
            'nohp' => $nohp,
        ];

        $do_post = $this->mpengaturan->doPostKontak('t_pengaturan', $post);
        if ($do_post == true) {
            redirect(base_url('backend/c_pengaturan/referensi/v_umum?module='.$module.'&user='.$userid));
        } else {
            redirect(base_url('backend/c_pengaturan/referensi/v_umum?module='.$module.'&user='.$userid));
        }
    }

    /* -------------------------------------------------------------------------- */

    /* -------------------------------------------------------------------------- */
    /*                   HALAMAN AKSES LOGIN PAGE ADMINISTRATOR                   */
    /* -------------------------------------------------------------------------- */

    public function akseslogin()
    {
        $data = [
            'content' => 'Backend/__Pengaturan/v_akses_login',
            'scriptjs' => 'Backend/__ServerSideJs/pengaturan/akses_login', //v_backup to backup
            'pageinfo' => '<li> Dasboard</li> <li> Pengaturan</li> <li class="active">Akses Login</li>',
        ];

        $this->load->view('Backend/v_home', $data);
    }

    /* ------------------------- Halaman Form Akses Baru ------------------------ */

    public function akseslogin_baru()
    {
        $html = $this->load->view('Backend/__Pengaturan/v_akses_login_baru');

        return $html;
    }

    /* ------------------------- Aksi Tambah Akses Baru ------------------------- */

    public function do_hakakses()
    {
        $inputIp = $this->input->post('ip');
        $inputBlock = $this->input->post('block');
        $inputName = $this->input->post('nama_pemilik');
        $inputType = $this->input->post('type_pemilik');

        $toPost = array(
            'ip' => $inputIp,
            'name' => $inputName,
            'type' => $inputType,
            'block' => $inputBlock,
            'token' => sha1($inputIp),
        );

        $toTable = 'ref_access_logregistered';
        $status = $inputBlock == 'y' ? 'Blocked' : 'No Block';
        if ((!empty($inputIp)) && (!empty($inputName)) && (!empty($inputType))) {
            $send = $this->mpengaturan->registered_ip($toTable, $toPost);
            if ($send == true) {
                $msg = array('message' => '<b>'.$inputIp.'</b> Is Success Registered & Status <b>'.$status.'</b>', 'status' => 'bg-greadient-greenlightgreen');
            } else {
                $msg = array('message' => $inputIp.' Error Registered', 'status' => 'bg-red');
            }
        } elseif (empty($inputIp)) {
            $msg = array('message' => 'Ip address undefined, please insert ip valid', 'status' => 'bg-greadient-redpurple');
        } elseif (empty($inputName)) {
            $msg = array('message' => 'Name undefined, please insert name', 'status' => 'bg-greadient-redpurple');
        } elseif (empty($inputType)) {
            $msg = array('message' => 'Type undefined, please insert Type', 'status' => 'bg-greadient-redpurple');
        }

        echo json_encode($msg);
    }

    /* ---------------------------- Daftar Hak Akses ---------------------------- */

    public function akseslogin_list()
    {
        $data['datas'] = $this->mpengaturan->get_datas('ref_access_logregistered')->result();
        $html = $this->load->view('Backend/__Pengaturan/v_akses_login_list', $data);

        return $html;
    }

    /* ------------------------ Halaman Akses Login Edit ------------------------ */

    public function akseslogin_edit($id)
    {
        $data['datas'] = $this->mpengaturan->get_datas_byid('ref_access_logregistered', $id)->result();
        $html = $this->load->view('Backend/__Pengaturan/v_akses_login_edit', $data);

        return $html;
    }

    /* ----------------------- Aksi Update Hak Akses Login ---------------------- */

    public function do_hakakses_update($id)
    {
        $post = [
            'ip' => $this->input->post('ip'),
            'name' => $this->input->post('nama_pemilik'),
            'type' => $this->input->post('type_pemilik'),
            'block' => $this->input->post('block'),
            'token' => sha1($this->input->post('ip')),
        ];
        $whr = [
            'id_access_logregistered' => $id,
        ];
        $toTable = 'ref_access_logregistered';
        $send = $this->mpengaturan->update_datas_byid($toTable, $post, $whr);
        if ($send == true) {
            $msg = 'Success Update';
        } else {
            $msg = 'Gagal Update';
        }
        echo json_encode($msg);
    }

    /* -------------------------------------------------------------------------- */
}
