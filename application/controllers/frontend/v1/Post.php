<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Post extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->model('model_template_v1/M_f_post', 'post');
        $this->load->model('model_template_v1/M_f_post_list', 'postlist');
        $this->load->model('model_template_v1/M_f_users', 'mf_users'); 
        $this->load->model('M_b_komentar', 'komentar');
        $this->load->helper('time_ago');
        //Check maintenance website
        if(($this->session->userdata('status') == 'ONLINE') && ($this->mf_beranda->get_identitas()->status_maintenance == '1') || ($this->mf_beranda->get_identitas()->status_maintenance == '0')) {
            // redirect(base_url('frontend/v1/beranda'),'refresh');
        } else {
            redirect(base_url('theme/maintenance_site'),'refresh');
        }
    }
    
    public function detail($username, $id,  $judul) {
        
    	$data = [
    		'title' => ucwords($judul),
    		'isi' => 'Frontend/v1/pages/p_detail',
            'mf_beranda' => $this->mf_beranda->get_identitas(),
            'mf_menu' => $this->mf_beranda->get_menu(),
            'berita_selanjutnya' => $this->mf_beranda->berita_selanjutnya(decrypt_url($id)),
            'post_detail' => $this->post->detail(decrypt_url($id))->row(),
            'mf_kategori' => $this->mf_beranda->get_kategori_listing(),
            'mf_berita_populer' => $this->mf_beranda->berita_populer(),
    	];
    	$this->load->view('Frontend/v1/layout/wrapper', $data, FALSE);
    }

    public function search() {
          $output = '';
          $query = $this->input->post('q');
          $data = $this->post->fetch_data_search($query);
          $output .= '<div class="list-group list-group-flush">';
          if($data->num_rows() > 0 && !empty($query))
          {
           foreach($data->result() as $row)
           {
            $isi_berita = strip_tags($row->content); // membuat paragraf pada isi berita dan mengabaikan tag html
            $isi = substr($isi_berita, 0, 80); // ambil sebanyak 80 karakter
            $isi = substr($isi_berita, 0, strrpos($isi, ' ')); // potong per spasi kalimat

            $id = encrypt_url($row->id_berita);
            $postby = strtolower($this->mf_users->get_namalengkap(trim(url_title($row->created_by))));
            $judul = strtolower($row->judul);
            $posturl = base_url("frontend/v1/post/detail/{$postby}/{$id}/" . url_title($judul) . '');
            $output .= '<a href="'.$posturl.'" class="list-group-item list-group-item-action flex-column align-items-start">
                        <div class="d-flex w-100 justify-content-between">
                          <h5 class="mb-1">'.character_limiter($row->judul, 25).'</h5>
                          <span class="small">'.mediumdate_indo($row->tgl_posting).'</span>
                        </div>
                        <p class="mb-1 small">'.$isi.'...</p>
                        <small>Posted by '.decrypt_url($this->mf_users->get_userportal_namalengkap($row->created_by)).'</small>
                      </a>';
           }
          }
          else
          {
           $output .= '<h4 class="mx-auto text-center text-secondary"><img src="'.base_url('assets/images/bg/undraw_empty_xct9.svg').'" class="img-fluid w-50"/> <br>Keyword Search Not Found</h4>';
          }
          $output .= '</div>';
          echo $output;
         }

    public function listdetail()
    {
        $id = decrypt_url($this->input->post('id'));
        $q = $this->post->detail($id);
        if($q->num_rows() > 0)
        {
            $r = $q->row();

            $msg = '<div class="card bg-transparent border-0 shadow-none">
                        <div class="card-footer text-left p-1 border-0">
                            <i class="fas fa-heart text-danger"></i> <b>'.$r->like_count.'</b> 
                            &bull; Likes
                        </div>
                    </div>';
        } else {
            $msg = 'Not found';
        }
        echo $msg;
    }

    public function get_all_post_by_user($id)
    {
        $output = '';
        $data = $this->post->get_all_post_by_user($this->input->post('limit'),$this->input->post('start'), $id);
        if ($data->num_rows() > 0) {
            $output .= '<div class="grid">';
            foreach ($data->result() as $row) {
                $by = $row->created_by;
                if($by == 'admin') {
                    $namalengkap = $this->mf_users->get_namalengkap($by);
                    $gravatar = base_url('assets/images/users/' . $this->mf_users->get_gravatar($by));
                } else {
                    $namalengkap = decrypt_url($this->mf_users->get_userportal_namalengkap($by));
                    $gravatar = 'data:image/jpeg;base64,' . base64_encode($this->mf_users->get_userportal_byid($by)->photo_pic) . '';
                }

                $id = encrypt_url($row->id_berita);
                $postby = strtolower($namalengkap);
                $judul = strtolower($row->judul);
                $posturl = base_url("frontend/v1/post/detail/$postby/$id/".url_title($judul));

                if ($row->headline == '1') {
                    $isi_berita = strip_tags($row->content); // membuat paragraf pada isi berita dan mengabaikan tag html
                    $isi = substr($isi_berita, 0, 180); // ambil sebanyak 80 karakter
                    $isi = substr($isi_berita, 0, strrpos($isi, ' ')); // potong per spasi kalimat
                } else {
                    $isi = $row->content;
                }
                
                $btn_like = $this->mf_beranda->get_status_like($this->session->userdata('user_portal_log')['id'], $row->id_berita) == true ? 'btn-like' : '';
                $status_like = $this->mf_beranda->get_status_like($this->session->userdata('user_portal_log')['id'], $row->id_berita) == true ? 'fas text-danger' : 'far';

                if(empty($row->img)):
                    $img = '<img class="img-fluid w-100" style="border-radius:15px;" src="data:image/jpeg;base64,'.base64_encode( $row->img_blob ).'"/>';
                else:
                    $img = '<img class="img-fluid w-100" style="border-radius:15px;" src="'.base_url('files/file_berita/thumb/'.$row->img).'" alt="'.$row->img.'">';
                endif;

                $output .= '
                    <div class="grid-item w-100">
                        <div class="card border shadow-sm bg-white">
                            <div class="card-header bg-white border-0">
                                <img src="'.$gravatar. '" width="50" height="50" class="float-left mt-1 mr-4 d-inline-block rounded">
                                <h5 class="card-title d-block">' . $namalengkap . '</h5>
                                <small>'.longdate_indo($row->tgl_posting).'</small>
                            </div>
                            <a href="'.$posturl.'" class="p-3">
                                '.$img.'
                            </a>
                            <div class="card-body">
                                <a href="'.$posturl.'"><span class="font-weight-bold">'.character_limiter($row->judul, 40).'</span></a>
                                <p>
                                    '.$isi. '
                                </p>
                                
                            </div>
                            <div class="card-footer p-0 bg-white border-light">
                            <button type="button" data-toggle="tooltip" data-placement="bottom" title="Dilihat" class="btn btn-transparent border-right border-light rounded-0 p-3 float-left"><i class="far fa-eye mr-2"></i> '.$row->views. '</button>

                            <button type="button" data-toggle="tooltip" data-placement="bottom" title="Komentar" class="btn btn-transparent border-right  border-light rounded-0 p-3 float-left"><i class="far fa-comment-alt mr-2"></i> '.$this->komentar->jml_komentarbyidberita($row->id_berita). '</button>

                            <button type="button" data-toggle="tooltip" data-placement="bottom" title="Bagikan postingan ini" id="btn-share" data-row-id="'.$row->id_berita. '" class="btn btn-transparent border-right border-light rounded-0 p-3 float-left"><i class="fas fa-share-alt mr-2"></i> <span class="share_count">'.$row->share_count. '</span></button>
                            
                            <button type="button" onclick="like_toggle(this)" data-toggle="tooltip" data-placement="bottom" class="btn btn-transparent border-secondary rounded-0 p-3 float-left '.$btn_like.'" title="Suka / Tidak suka" data-id-berita="' . $row->id_berita . '" data-id-user="' . $this->session->userdata('user_portal_log')['id'] . '"><i  class="'.$status_like.' fa-heart mr-2"></i> <span class="count_like">'.$row->like_count.'</span> </button>

                            <a href="'.$posturl.'" class="p-3 btn bg-white btn-transparent border-top-0 border-bottom-0 border-right-0 rounded-0 border-light">Baca Selengkapnya <i class="fas fa-arrow-right ml-2"></i></a>
                            </div>
                        </div>
                        
                    </div>
                ';
            }
            $output .= '</div>';
        }
        echo json_encode(['html' => $output, 'status' => 'Loaded']);
    }

        public function judul()
        {
            $data = [
                'title' => 'Buat judul postingan',
                'isi' => 'Frontend/v1/pages/p_baru_judul',
                'mf_beranda' => $this->mf_beranda->get_identitas(),
                'mf_menu' => $this->mf_beranda->get_menu(),
                'kategori' => $this->postlist->get_all_kategori()->result()
            ];
            $this->load->view('Frontend/v1/layout/wrapper', $data, FALSE);
        }

        public function baru_detail()
        {
            $judul = $this->input->post('judul');
            $kategori = $this->input->post('kategori');
        
            $data = [
                'judul' => $judul,
                'fid_kategori' => $kategori,
                'headline' => '1',
                'publish' => '0',
                'tgl_posting' => date('Y-m-d'),
                'jam' => date('H:i:s'),
                'created_by' => $this->session->userdata('user_portal_log')['id']
            ];

            if(empty($judul)):
                $msg = ['valid' => false, 'pesan' => 'Judul wajid dibuat untuk postingan!'];
            elseif(empty($kategori)):
                $msg = ['valid' => false, 'pesan' => 'Kategori belum dipilih'];
            else:
                $this->post->doInsertJudulBaru('t_berita', $data);
                $getId = $this->post->getIdByJudul($judul);
                $msg = ['valid' => true, 'pesan' => 'Judul berhasil dibuat, klik OK untuk melanjutkan', 'id' => encrypt_url($getId)];
            endif;
            echo json_encode($msg);
            
        }
        
        public function postDetail($id)
        {
            $idb = decrypt_url($id);
            $judul = $this->post->getJudulById($idb);
            $data = [
                'title' => ucwords($judul),
                'isi' => 'Frontend/v1/pages/p_baru_detail',
                'mf_beranda' => $this->mf_beranda->get_identitas(),
                'mf_menu' => $this->mf_beranda->get_menu(),
                'post' => $this->post->detail($idb)->row(),
                'tags' => $this->postlist->get_all_tag()->result(),
                'photo_terkait' => $this->post->photo_terkait($idb)
            ];
            $this->load->view('Frontend/v1/layout/wrapper', $data, FALSE);
        }
        
        public function upload_single_photo($id)
        {
            $idb = decrypt_url($id);
            $blob = file_get_contents($_FILES['file']['tmp_name']);
            $data = [
                'img_blob' => $blob
            ];
            $upload = $this->post->doUpdatePhoto('t_berita', $idb, $data);
            if($upload == true)
            {
                $msg = true;
            } else {
                $msg = false;
            }
            echo json_encode($msg);
        }

        public function update_post($publish)
        {
            $id = $this->input->post('id');
            $judul = $this->input->post('judul');
            $content = $this->input->post('content');
            $tags = @implode(',', $this->input->post('tags'));
            $data = [
                'judul' => $judul,
                'content' => $content,
                'tags' => $tags,
                'publish' => $publish,
                'update_at' => date('Y-m-d H:i:s'),
                'update_by' => $this->session->userdata('user_portal_log')['id']
            ];

            $update = $this->post->doUpdatePost('t_berita', $id, $data);
            if($update == true)
            {
                $msg = ['valid' => true];
            }
            else 
            {
                $msg = ['valid' => false];
            }
            echo json_encode($msg);
        }

        public function deletePost()
        {
            $table = 't_berita';
            $id = $this->input->post('id');
            $delete = $this->post->deletePost($table, $id);
            
            if($delete == true)
            {
                $msg = ['valid' => true];
            } else {
                $msg = ['valid' => false];
            }
            echo json_encode($msg);
        }

    public function send_komentar()
    {
        
        $idUser = $this->session->userdata('user_portal_log')['id'];
        $parentId = $this->input->post('id_c');
        $fidIdBerita = $this->input->post('id_b');
        $fidUsersPortal = $idUser;
        $isi = $this->input->post('isi', true);
        $tgl = date('Y-m-d');
        $akf = 'Y';

        $data = [
            'parent_id' => $parentId === NULL ? 0 : $parentId,
            'fid_berita' => $fidIdBerita,
            'fid_users_portal' => $fidUsersPortal,
            'isi' => $isi,
            'tanggal' => $tgl,
            'waktu' => date('H:i:s'),
            'aktif' => $akf
        ];
        $db = $this->post->send_komentar('t_komentar', $data);
        if($db) {
            $valid = true;
        } else {
            $valid = false;
        }

        echo json_encode($valid);
    }

    public function reply($id_komentar) {
        // Replay Komentar
        $output = '';
         // if($this->post->jml_replay_komentar($id_komentar) > 0):
           foreach ($this->post->user_replay_komentar($id_komentar) as $reply) {
            if($reply->fid_users_portal == $this->session->userdata('user_portal_log')['id']) {
                if($reply->tanggal === date('Y-m-d')):
                $button = '<div class="btn-group float-right">
                                <button type="button" class="btn btn-default text-muted dropdown-toggle dropdown-toggle-split btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu">
                                    <button type="button" id="btn-delete-comment" data-id="'.encrypt_url($reply->id_komentar).'" class="dropdown-item btn-sm" href="#">
                                        <i class="fas fa-trash"></i> Hapus</button>
                                </div>
                            </div>';
                else:
                $button = '';
                endif;
            }
        if($this->session->userdata('user_portal_log')['online'] == 'ON') {
            $btn_reply = '<button type="button" id="btn-reply-comment" data-id-parent="' . encrypt_url($reply->fid_users_portal) . '"
                            data-id-comment="'.$reply->id_komentar.'"
                            data-id-berita="' . encrypt_url($reply->fid_berita) . '"
                            data-id-user-comment="' . encrypt_url($this->session->userdata('user_portal_log')['id']) . '"
                            data-username="' . decrypt_url($reply->nama_lengkap) . '" class="btn text-muted font-small btn-link ml-1 p-0"> <small><i class="fas fa-retweet"></i> Reply</small> </button>';
        }
               $output .= ' 
                    <div class="tracking-item reply" id="'.$reply->id_komentar.'">
                        <div class="tracking-icon status-intransit ml-5">
                            <img src="data:image/jpeg;base64,'.base64_encode($reply->photo_pic).'" class="mr-3 rounded-circle" width="40" height="40">
                        </div>
                        <div class="tracking-date small">'.mediumdate_indo($reply->tanggal).'</div>
                        <div class="tracking-content ml-5">
                        '.$button.'
                        '.decrypt_url($reply->nama_lengkap). ' &bull; <i class="small">'.time_ago($reply->waktu).'</i><span>'.$reply->isi. '</span> <div id="displayReplyId'. encrypt_url($reply->fid_users_portal).'"></div> '. $btn_reply.'
                        </div>
                    </div>
         ';  
         $output .= $this->reply($reply->id_komentar);                  
           }
        // endif;
        return $output;
    }

    public function displayKomentar($id_berita) {
        $comments = $this->post->displayKomentar('t_komentar', ['parent_id' => 0,'fid_berita' => decrypt_url($id_berita)]);

        if($comments->num_rows() > 0)
        {   
            $output = '';
            foreach($comments->result() as $comment):
                $profileUser = $this->mf_users->get_userportal_byid($comment->fid_users_portal);
                if($comment->fid_users_portal == $this->session->userdata('user_portal_log')['id']) {
                    if($comment->tanggal === date('Y-m-d')):
                    $button = '<div class="btn-group float-right">
                                    <button type="button" class="btn btn-default text-muted dropdown-toggle dropdown-toggle-split btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu">
                                        <button type="button" id="btn-delete-comment" data-id="'.encrypt_url($comment->id_komentar).'" class="dropdown-item btn-sm" href="#">
                                            <i class="fas fa-trash"></i> Hapus</button>
                                    </div>
                                </div>';
                    else:
                    $button = '';
                    endif;
                } else {
                    $button = '';
                }

                if($this->session->userdata('user_portal_log')['online'] == 'ON') {
                    $btn_reply = '<button type="button" id="btn-reply-comment" data-id-parent="' . encrypt_url($comment->fid_users_portal) . '"
                                    data-id-comment="'.$comment->id_komentar.'"
                                    data-id-berita="' . encrypt_url($comment->fid_berita) . '"
                                    data-id-user-comment="' . encrypt_url($this->session->userdata('user_portal_log')['id']) . '"
                                    data-username="' . decrypt_url($profileUser->nama_lengkap) . '" class="btn text-muted font-small btn-link ml-1 p-0"> <small><i class="fas fa-retweet"></i> Reply</small> </button>';
                }
                
                $output .= ' 
                            <div class="tracking-item" id="'.$comment->id_komentar.'">
                                <div class="tracking-icon status-intransit">
                                    <img src="data:image/jpeg;base64,'.base64_encode($profileUser->photo_pic).'" class="mr-3 rounded-circle" width="40" height="40">
                                </div>
                                <div class="tracking-date">'.mediumdate_indo($comment->tanggal).'</div>
                                <div class="tracking-content">
                                '.$button.'
                                '.decrypt_url($profileUser->nama_lengkap). ' &bull; <i class="small">'.time_ago($comment->waktu, true).'</i><span>'.$comment->isi. '</span> <div id="displayReplyId'. encrypt_url($comment->fid_users_portal).'"></div> '. $btn_reply.' 
                                </div>
                            </div>
                 ';

                 $output .= $this->reply($comment->id_komentar);
            endforeach;
        } else {
            $output = '<img src="'.base_url('bower_components/SVG-Loaders/svg-loaders/empty-diskusi.svg').'" class="d-block my-auto mx-auto w-25"><p class="text-center text-muted">
                    <b class="my-2 d-block">Diskusi Kosong<br></b><small>Belum ada diskusi nih, yok mulai percakapan.</small></p>';
        }

        echo json_encode($output);
    }

    public function form_reply()
    {
        return $this->load->view('Frontend/v1/function/f_reply');
    }
    public function deleteComment() 
    {
        $id = decrypt_url($this->input->get('id'));
        $tbl = 't_komentar';
        $whr = [
            'id_komentar' => $id
        ];
        $deleteComment = $this->post->deleteComment($tbl, $whr);
        if($deleteComment)
        {
            $valid = true;
        } else {
            $valid = false;
        }
        echo json_encode($valid);
    }
}

    /* End of file  frontend\v1\Post.php */
