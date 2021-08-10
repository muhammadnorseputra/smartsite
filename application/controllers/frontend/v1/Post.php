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
        $this->load->library('image_lib');
        //Check maintenance website
        if(($this->session->userdata('status') == 'ONLINE') && ($this->mf_beranda->get_identitas()->status_maintenance == '1') || ($this->mf_beranda->get_identitas()->status_maintenance == '0')) {
            // redirect(base_url('frontend/v1/beranda'),'refresh');
        } else {
            redirect(base_url('under-construction'),'refresh');
        }
    }
    
    public function detail($slug) {
        $id = $this->post->detailIdBySlug($slug);
        $detail = $this->post->detail($id)->row();
        $judul_seo = ucwords($detail->judul);

        if($detail->publish == 0) {
            return redirect(base_url('404'));
        }
        if(intval($id) == '') {
            return redirect(base_url('404'));
        }
        // Youtube Data
        if($detail->type === 'YOUTUBE'):
            $key      = $this->config->item('YOUTUBE_KEY'); // TOKEN goole developer
            $url      = 'https://www.googleapis.com/youtube/v3/videos?part=snippet,statistics,player&id='.$detail->content.'&key='.$key;
            $yt     = api_client($url);
            $yt_thumb = $yt['items'][0]['snippet']['thumbnails']['medium']['url'];
            $yt_desc = $yt['items'][0]['snippet']['description'];
        endif;

        if(!empty($detail->img) && $detail->type === 'BERITA'):
            $img = base_url('files/file_berita/'.$detail->img.'');
        elseif($detail->type === 'SLIDE'):
            $img = img_blob($this->post->photo_terkait($id,1)->row()->photo);
        else:
            $img = base_url('assets/images/logo.png');
        endif;

         if($detail->type === 'YOUTUBE'):
            $imgurl = $yt_thumb;
            $content = !empty($detail->deskripsi) ? $detail->deskripsi : $yt_desc;
        else:
            $imgurl = $img;
            $meta_desc = strip_tags(str_replace('"', '', word_limiter($detail->content, 120)));
            $content = !empty($detail->deskripsi) ? $detail->deskripsi : $meta_desc;
        endif;
        $meta_keywords = !empty($detail->keywords) ? $detail->keywords : $detail->tags;
        // Meta SEO
        $e = array(
          'general' => true, //description, keywords
          'og' => true,
          'twitter'=> true,
          'robot'=> true
        );
        $meta_tag = meta_tags($e, $title = $judul_seo, $desc=$content,$imgUrl = $imgurl,
                            $url = curPageURL(), $keyWords=$meta_keywords, $type='article', $canonical=curPageURL());

    	$data = [
    		'title' => $judul_seo,
    		'isi' => 'Frontend/v1/pages/p_detail',
            'mf_beranda' => $this->mf_beranda->get_identitas(),
            'mf_menu' => $this->mf_beranda->get_menu(),
            'berita_selanjutnya' => $this->mf_beranda->berita_selanjutnya($id),
            'post_detail' => $detail,
            'mf_kategori' => $this->mf_beranda->get_kategori_listing(),
            'mf_berita_populer' => $this->mf_beranda->berita_populer(),
            'postId' => $id,
            'meta' => $meta_tag
    	];
    	$this->load->view('Frontend/v1/layout/wrapper', $data, FALSE);
    }

    public function search() {
          $output = '';
          $query = $this->input->post('q');
          $data = $this->post->fetch_data_search($query);
          $output .= '<div class="list-group list-group-flush">';
          if($data->num_rows() > 0)
          {
           foreach($data->result() as $row)
           {

            // if($row->type === 'YOUTUBE'):
            //     $key      = $this->config->item('YOUTUBE_KEY'); // TOKEN goole developer
            //     $url      = 'https://www.googleapis.com/youtube/v3/videos?part=snippet,statistics&id='.$row->content.'&key='.$key;
            //     $yt     = api_client($url);
            //     $imgSrc = $yt['items'][0]['snippet']['thumbnails']['medium']['url'];
            //     $yt_desc = $yt['items'][0]['snippet']['description'];
            // endif;
            // if($row->type === 'LINK'):
            //     $url = $row->content;
            //     $linker = getSiteOG($url);
            //     $imgSrc = $linker['image'];
            //     // var_dump($linker);
            // endif;

            $isi_berita = strip_tags($row->content); // membuat paragraf pada isi berita dan mengabaikan tag html
            $isi = substr($isi_berita, 0, 180); // ambil sebanyak 80 karakter
            $isi = substr($isi_berita, 0, strrpos($isi, ' ')); // potong per spasi kalimat

            // Content
            // if($row->type === 'YOUTUBE'):
            //     $content = word_limiter($yt_desc,20);
            // elseif($row->type === 'LINK'):
            //     $content = word_limiter($linker['description'],15);
            // else:
            //     $content = $isi."...";
            // endif;


            $id = encrypt_url($row->id_berita);
            $postby = strtolower(url_title($this->mf_users->get_namalengkap(trim($row->created_by))));
            $judul = strtolower($row->judul);
            $slug = $row->slug;
            // $kategori = url_title(strtolower($this->post->kategori_byid($row->fid_kategori)));
            $posturl = base_url("blog/".$slug);

            if($row->type === 'BERITA'):
                if(!empty($row->img)):
                    $img = '<img style="object-fit:cover; width:320px; height:220px;" class="rounded-left" alt="'.ucwords($row->judul).'" src="'.base_url('files/file_berita/'.$row->img).'">';
                else:
                    $img = '<img style="object-fit:cover; width:320px; height:220px;" class="rounded-left" alt="'.ucwords($row->judul).'" src="data:image/jpeg;base64,'.base64_encode( $row->img_blob ).'"/>';
                endif;
            else:
                $img = '<img style="object-fit:cover; width:320px; height:220px;" class="rounded-left" alt="'.ucwords($row->judul).'" src="'.base_url('assets/images/noimage.gif').'">';
            endif; 

            $output .= '<a href="'.$posturl.'" class="list-group-item border my-2 list-group-item-action rounded p-3 p-md-0">
                        <div class="d-flex justify-content-start align-items-start">
                            <div class="mr-4 d-none d-md-block">
                                '.$img.'
                            </div>
                            <div class="pt-md-3">
                              <h6>'.word_limiter($row->judul, 10).'</h6>
                              <span class="small">'.longdate_indo($row->tgl_posting).'</span>
                              <p class="text-muted small pr-md-4">'.$isi.'...</p>
                            </div>
                        </div>
                      </a>';
           }
          }
          else
          {
           $output .= '<div class="d-flex justify-content-center align-items-center">
                        <div class="w-25">
                            <img src="'.base_url('assets/images/bg/undraw_empty_xct9.svg').'" class="img-fluid"/>
                        </div>
                        <div class="px-3">
                            <h4 class="text-muted"> Keyword <b>"'.$query.'"</b> Not Found</h4>
                            <p class="pl-3 border-left border-warning small text-muted">Sepertinya katakunci yang kamu masukan tidak ada pada database kami</p>
                        </div>
                    </div>';
          }
          $output .= '</div>';
          echo json_encode(['data' => $output, 'count' => $data->num_rows()]);
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

    function template_sumber($text, $icon) {
        $html = '<div class="btn-group btn-group-sm mb-2 ml-3 ml-md-0" role="group" aria-label="button">
                    <button type="button" class="btn btn-sm btn-light" disabled>'.$icon.'</button>
                    <button type="button" class="btn btn-sm btn-default"  disabled>'.$text.'</button>
                </div>';
        return $html;
    }
    public function get_all_post_by_user($id)
    {
        $output = '';
        $data = $this->post->get_all_post_by_user($this->input->post('limit'),$this->input->post('start'), $id);
        if ($data->num_rows() > 0) {
            $output .= '<div class="grid">';
            foreach ($data->result() as $row) {

                // Post created by & gravatar 
                $by = $row->created_by;
                if($by == 'admin') {
                    $namalengkap = $this->mf_users->get_namalengkap($by);
                    $gravatar = base_url('assets/images/users/' . $this->mf_users->get_gravatar($by));
                } else {
                    $namalengkap = decrypt_url($this->mf_users->get_userportal_namalengkap($by));
                    $gravatar = 'data:image/jpeg;base64,' . base64_encode($this->mf_users->get_userportal_byid($by)->photo_pic) . '';
                }

                // Post Data Youtube
                if($row->type === 'YOUTUBE'):
                    $key      = $this->config->item('YOUTUBE_KEY'); // TOKEN goole developer
                    $url      = 'https://www.googleapis.com/youtube/v3/videos?part=snippet,statistics&id='.$row->content.'&key='.$key;
                    $yt     = api_client($url);
                    $yt_thumb = $yt['items'][0]['snippet']['thumbnails']['high']['url'];
                    $yt_desc = $yt['items'][0]['snippet']['description'];
                    $yt_src = $yt['items'][0]['snippet']['channelTitle'];
                endif;

                if($row->type === 'LINK'):
                    $url = $row->content;
                    $linker = getSiteOG($url);
                    // var_dump($linker);
                endif;

                // Post Link Detail
                if($row->type === 'YOUTUBE' || $row->type === 'BERITA'):
                    $id = encrypt_url($row->id_berita);
                    $postby = strtolower(url_title($namalengkap));
                    $slug = strtolower($row->slug);
                    // $kategori = url_title(strtolower($this->post->kategori_byid($row->fid_kategori)));
                    $posturl = base_url("blog/".$slug);
                else:
                    $posturl = base_url('leave?go='.encrypt_url($row->content));
                endif;

                // Post headline YES == 1
                if ($row->headline == '1') {
                    $isi_berita = strip_tags($row->content); // membuat paragraf pada isi berita dan mengabaikan tag html
                    $isi = substr($isi_berita, 0, 180); // ambil sebanyak 80 karakter
                    $isi = substr($isi_berita, 0, strrpos($isi, ' ')); // potong per spasi kalimat
                } else {
                    $isi = $row->content;
                }

                // Content
                if($row->type === 'YOUTUBE'):
                    $content = word_limiter($yt_desc,20);
                elseif($row->type === 'LINK'):
                    $content = word_limiter($linker['description'],15);
                else:
                    $content = $isi."...";
                endif;
                
                // Post button like
                $btn_like = $this->mf_beranda->get_status_like($this->session->userdata('user_portal_log')['id'], $row->id_berita) == true ? 'btn-like' : '';
                $status_like = $this->mf_beranda->get_status_like($this->session->userdata('user_portal_log')['id'], $row->id_berita) == true ? 'fas text-danger' : 'far';
                
                // Gambar
                if($row->type === 'BERITA'):
                    if(!empty($row->img)):
                        $img = '<img class="card-img-top rounded-top border-light" src="'.base_url('files/file_berita/'.$row->img).'" alt="'.$row->judul.'">';
                    elseif(!empty($row->img_blob)):
                        $img = '<img class="card-img-top rounded-top border-light" src="data:image/jpeg;base64,'.base64_encode( $row->img_blob ).'"/>';
                    else:
                        $img = '<img class="card-img-top rounded-top border-light" src="'.base_url('assets/images/noimage.gif').'" alt="'.$row->judul.'">';
                    endif;
                elseif($row->type === 'YOUTUBE'):
                    $img = '<img class="card-img-top rounded-top border-light" src="'.$yt_thumb.'" alt="'.$row->judul.'">';
                elseif($row->type === 'LINK'):
                    $img = '<img class="card-img-top rounded-top border-light" src="'.$linker['image'].'" alt="'.$row->judul.'">';
                else:
                    $img = '<img class="card-img-top rounded-top border-light" src="'.base_url('assets/images/noimage.gif').'" alt="'.$row->judul.'">';
                endif;

                // Sumber
                if($row->type === 'YOUTUBE'):
                    $status_posted = '<abbr title="Repost adalah diposting ulang atau ditampilkan kembali, berdasarkan sumber tertentu.">Repost</abbr>';
                    $text = $yt_src;
                    $icon = '<i class="fab fa-youtube"></i>';
                    $sumber = $this->template_sumber($text, $icon);
                elseif($row->type === 'LINK'):
                    $domain = parse_url($row->content, PHP_URL_HOST);
                    $status_posted = '<abbr title="Repost adalah diposting ulang atau ditampilkan kembali, berdasarkan sumber tertentu.">Repost</abbr>';
                    $text = $domain;
                    $icon = '<i class="fas fa-link"></i>';
                    $sumber = $this->template_sumber($text, $icon);
                else:
                    $domain = parse_url(base_url(), PHP_URL_HOST);
                    $status_posted = 'Posted';
                    $text = $domain;
                    $icon = '<i class="fas fa-globe-asia"></i>';
                    $sumber = $this->template_sumber($text, $icon);
                endif;

                // Post name tags
                $tags = $row->tags;
                $pecah = explode(',', $tags);
                if (count($pecah) > 0) {
                    $tag = '';
                    for ($i = 0; $i < count($pecah); ++$i) {
                        $tag .= '<a href="'.base_url('tag/'.url_title($pecah[$i])).'" class="btn btn-sm btn-outline-light border-0 mr-2 mb-2">#'.$pecah[$i].'</a>';
                    }
                }

                // Post name kategori
                $namakategori = $this->post->kategori_byid($row->fid_kategori);
                $post_list_url = base_url('kategori/' . encrypt_url($row->fid_kategori) . '/' . url_title($namakategori) . '?order=desc');

                // Hasil render html
                $output .= '
                    <div class="grid-item w-100">
                        <div class="card border rounded bg-white mb-3">
                            <a href="'.$posturl.'" class="rounded-top">
                                '.$img.'
                            </a>
                            <div class="card-header bg-white border-0" style="border-radius:10px;">
                                <img src="'.$gravatar. '" width="50" height="50" class="float-left mt-1 mr-4 d-inline-block rounded">
                                <h5 class="card-title d-block">' . $namalengkap . '</h5>
                                <small>'.longdate_indo($row->tgl_posting).'</small>
                            </div>
                            <div class="card-body py-2">
                                <h3 class="card-title font-weight-bold"><a href="'.$posturl.'"><span class="font-weight-bold">'.character_limiter($row->judul, 40).'</span></a></h3>
                                '.$sumber.'
                                <p>
                                    '.$content. '
                                </p>
                                <p><a href="'.$post_list_url.'" class="btn btn-sm btn-primary p-2 mr-2 mb-2 text-white shadow-sm">'.$namakategori.'</a>'.$tag. '</p>
                            </div>
                            <div class="card-footer bg-white p-2 border-0 d-flex justify-content-around" style="border-bottom-left-radius:12px;border-bottom-right-radius:12px;">

                            <button type="button" data-toggle="tooltip" data-placement="bottom" title="Dilihat" class="btn btn-transparent border-light rounded p-2 w-100 float-left text-secondary"><i class="far fa-eye mr-2"></i> '.$row->views. '</button>

                            <button type="button" data-toggle="tooltip" data-placement="bottom" title="Komentar" class="btn btn-transparent  border-light rounded p-2 w-100 float-left text-info"><i class="far fa-comment-alt mr-2"></i> '.$this->komentar->jml_komentarbyidberita($row->id_berita). '</button>

                            <button type="button" data-toggle="tooltip" data-placement="bottom" title="Bagikan postingan ini" id="btn-share" data-row-id="'.$row->id_berita. '" class="btn btn-transparent border-light rounded p-2 w-100 float-left text-success"><i class="fas fa-share-alt mr-2"></i> <span class="share_count">'.$row->share_count. '</span></button>
                            
                            <button type="button" onclick="like_toggle(this)" data-toggle="tooltip" data-placement="bottom" class="btn btn-transparent w-100 border-secondary rounded p-2 float-left '.$btn_like.' text-danger" title="Suka / Tidak suka" data-id-berita="' . $row->id_berita . '" data-id-user="' . $this->session->userdata('user_portal_log')['id'] . '"><i  class="'.$status_like.' fa-heart mr-2"></i> <span class="count_like">'.$row->like_count.'</span> </button>
                            </div>
                        </div>
                        
                    </div>
                ';
            }
            $output .= '</div>';
        }

        // Output json
        echo json_encode(['html' => $output, 'status' => 'is_loaded']);
    }

    public function judul()
    {
        $data = [
            'title' => 'BUAT POSTINGAN',
            'isi' => 'Frontend/v1/pages/p_baru_judul',
            'mf_beranda' => $this->mf_beranda->get_identitas(),
            'mf_menu' => $this->mf_beranda->get_menu(),
            'kategori' => $this->postlist->get_all_kategori()->result()
        ];
        $this->load->view('Frontend/v1/layout/wrapper', $data);
    }

        public function baru_detail()
        {
            $judul = $this->input->post('judul');
            $kategori = $this->input->post('kategori');
            $type = $this->input->post('type');
            $deskripsi = $this->input->post('description');
            $keywords = $this->input->post('keywords');
        
            $data = [
                'judul' => $judul,
                'slug' => url_title(strtolower($judul)),
                'deskripsi' => $deskripsi,
                'keywords' => $keywords,
                'type' => $type,
                'fid_kategori' => $kategori,
                'headline' => '1',
                'publish' => '0',
                'tgl_posting' => date('Y-m-d'),
                'jam' => date('H:i:s'),
                'created_by' => $this->session->userdata('user_portal_log')['id']
            ];

            if(empty($judul) && ($type === 'BERITA' || $type === 'SLIDE')):
                $msg = ['valid' => false, 'pesan' => 'Judul wajid dibuat untuk postingan '.$type];
            elseif(empty($kategori)):
                $msg = ['valid' => false, 'pesan' => 'Kategori belum dipilih'];
            elseif(empty($type)):
                $msg = ['valid' => false, 'pesan' => 'Type Post belum dipilih'];
            else:
                $this->post->doInsertJudulBaru('t_berita', $data);
                $getId = $this->post->getIdByJudulAndType($judul,$type);
                $msg = ['valid' => true, 'type' => $type, 'pesan' => 'Post berhasil dibuat, tunggu mengalihkan', 'id' => encrypt_url($getId)];
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
                'tags' => $this->postlist->get_all_tag()->result()
            ];
            $this->load->view('Frontend/v1/layout/wrapper', $data, FALSE);
        }

        public function postDetailYoutube($id)
        {
            $idb = decrypt_url($id);
            $judul = $this->post->getJudulById($idb);

            $data = [
                'title' => ucwords($judul),
                'isi' => 'Frontend/v1/pages/p_baru_detail_youtube',
                'mf_beranda' => $this->mf_beranda->get_identitas(),
                'mf_menu' => $this->mf_beranda->get_menu(),
                'post' => $this->post->detail($idb)->row(),
                'tags' => $this->postlist->get_all_tag()->result()
            ];
            $this->load->view('Frontend/v1/layout/wrapper', $data, FALSE);
        }
        public function preview_url_link()
        {
            $url = $this->input->post('url');
            $data = getSiteOG($url);
            echo json_encode($data);
        }
        public function postDetailLink($id)
        {
            $idb = decrypt_url($id);
            $judul = $this->post->getJudulById($idb);

            $data = [
                'title' => ucwords($judul),
                'isi' => 'Frontend/v1/pages/p_baru_detail_link',
                'mf_beranda' => $this->mf_beranda->get_identitas(),
                'mf_menu' => $this->mf_beranda->get_menu(),
                'post' => $this->post->detail($idb)->row(),
                'tags' => $this->postlist->get_all_tag()->result()
            ];
            $this->load->view('Frontend/v1/layout/wrapper', $data, FALSE);
        }
        public function update_post_link($publish)
        {
            $id = $this->input->post('id_berita');
            $judul = $this->input->post('judul');
            $content = $this->input->post('content');
            $tags = @implode(',', $this->input->post('tags'));
            $data = [
                'judul' => $judul,
                'slug' => url_title(strtolower($judul)),
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
        public function preview_url_youtube($watchID)
        {
            $key      = $this->config->item('YOUTUBE_KEY'); // TOKEN goole developer
            $url      = 'https://www.googleapis.com/youtube/v3/videos?part=snippet,statistics&id='.$watchID.'&key='.$key;
            $data     = api_client($url);
            echo json_encode($data);
        }
        public function update_post_youtube($publish)
        {
            $id = $this->input->post('id_berita');
            $judul = $this->input->post('judul');
            $content = $this->input->post('content');
            $tags = @implode(',', $this->input->post('tags'));
            $data = [
                'judul' => $judul,
                'slug' => url_title(strtolower($judul)),
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
        public function update_post($publish)
        {
            $id = $this->input->post('id');
            $judul = $this->input->post('judul');
            $deskripsi = $this->input->post('description');
            $keywords = $this->input->post('keywords');
            $content = $this->input->post('content');
            $tags = @implode(',', $this->input->post('tags'));
            $data = [
                'judul' => $judul,
                'slug' => url_title(strtolower($judul)),
                'keywords' => $keywords,
                'deskripsi' => $deskripsi,
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

        public function upload_single_photo($id)
        {
            $idb = decrypt_url($id);
            
            $filename = "blob_".strtolower(url_title($_FILES['file']['name']));
            $path = 'files/file_berita/';

            $file_old = $this->post->getFileNameById($idb);
            if (file_exists('./files/file_berita/'.$file_old)) {
                @unlink('./files/file_berita/'.$file_old);
                if(file_exists('./files/file_berita/thumb/'.$file_old)) {
                    @unlink('./files/file_berita/thumb/'.$file_old);
                }
            }

            $blob = file_get_contents($_FILES['file']['tmp_name']);
            $data = [
                'img_blob' => $blob,
                'img' => $filename
            ];
            $upload = $this->post->doUpdatePhoto('t_berita', ['id_berita' => $idb], $data);
            if($upload == true)
            {
                $msg = true;
                $this->watermark($filename);
                @file_put_contents($path.$filename,$blob);
                // $this->resizeImage($path.$filename);
            } else {
                $msg = false;
            }
            echo json_encode($msg);
        }
        public function list_photo_terkait() {
            $id_berita = $this->input->get('id');
            $id=decrypt_url($id_berita);
            $data = $this->post->photo_terkait($id);
            if($data->num_rows() > 0):
                $html = '';
                foreach($data->result() as $p):
                $img_src = img_blob($p->photo);
                $html .= '<div class="col-md-6">
                                        <div class="position-relative">
                                            <img class="img-fluid w-100 border p-2" style="object-fit:cover; max-height:120px;" src="'.$img_src.'" alt="'.$p->judul.'">
                                            <div class="position-absolute" style="right: 15px;top: 10px;">
                            <a class="text-danger" id="delete_photo_terkait" href="'.base_url('frontend/v1/post/delete_photo_terkait/'.$id_berita.'/'.$p->id_berita_photo).'" data-toggle="tooltip" title="Hapus"><i class="far fa-times-circle shadow bg-white rounded-circle"></i></a>
                        </div>
                                        </div>
                                    </div>';
                endforeach;
            else:
                $html = '<div class="col-md-12"><p class="d-block text-center my-5 text-secondary">
                            Belum ada photo terkait <br>
                            <button type="button" data-toggle="modal" data-target="#uploadPhoto" id="upload" class="btn btn-sm btn-outline-primary mt-2"><i class="fas fa-plus mr-2"></i> Add photo</button>
                        </p></div>';
            endif;
            echo json_encode($html);
        }
        public function upload_single_photo_terkait($id_berita)
        {
            $id = decrypt_url($id_berita);
            // $path_dir = 'files/file_berita/photo_terkait/'.$id_berita;
            // if (!is_dir($path_dir)) {
            //     @mkdir('files/file_berita/photo_terkait/'.$id_berita, 0777, TRUE);
            // }
            $realname = $_FILES['file']['name'];
            $filename = strtolower($realname);
            // $path = 'files/file_berita/photo_terkait/'.$id_berita.'/';
            

            $blob = @file_get_contents($_FILES['file']['tmp_name']);
            $data = [
                'fid_berita' => $id,
                'judul' => $realname,
                'keterangan' => $realname,
                'photo' => $blob,
                'created_at' => date('Y-m-d'),
                'created_by' => $this->session->userdata('user_portal_log')['id']
            ];
            $upload = $this->post->doInsertPhotoTerkait('t_berita_photo', $data);
            if($upload == true)
            {
                $msg = true;
                // @file_put_contents($path.$filename,$blob);
            } else {
                $msg = false;
            }
            echo json_encode($msg);
        }
        public function delete_photo_terkait($id_berita,$id_photo)
        {
            $tbl = 't_berita_photo';
            $whr = [
                'id_berita_photo' => $id_photo    
            ];
            $db = $this->post->doDeletePhotoTerkait($tbl, $whr);
            if($db)
            {
                $msg= "Photo Berhasil Dihapus.";
            } else {
                $msg= "Photo Gagal Dihapus.";
            }
            // redirect(base_url('frontend/v1/post/postDetail/'.$id_berita), 'refresh');
            echo json_encode($msg);
        }
        public function deletePost()
        {
            $table = 't_berita';
            $id = $this->input->post('id');
            $file_old = $this->post->getFileNameById($id);
            if (file_exists('./files/file_berita/'.$file_old)) {
                @unlink('./files/file_berita/'.$file_old);
                if(file_exists('./files/file_berita/thumb/'.$file_old)) {
                    @unlink('./files/file_berita/thumb/'.$file_old);
                }
            }

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
            if(($reply->fid_users_portal == $this->session->userdata('user_portal_log')['id']) && ($reply->aktif != 'N')) {
                if($reply->tanggal === date('Y-m-d')){
                $button_more = '<div class="btn-group float-right">
                                <button type="button" class="btn btn-default text-muted dropdown-toggle dropdown-toggle-split btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu">
                                    <button type="button" id="btn-delete-comment" data-id="'.encrypt_url($reply->id_komentar).'" class="dropdown-item btn-sm" href="#">
                                        <i class="fas fa-trash"></i> Hapus</button>
                                </div>
                            </div>';
                }   else {
                    $button_more = '';
                }
            }  else {
                $button_more = '';
            }
                if(($this->session->userdata('user_portal_log')['online'] == 'ON') && ($reply->aktif != 'N')) {
                    $btn_reply = '<button type="button" id="btn-reply-comment" data-id-parent="' . encrypt_url($reply->fid_users_portal) . '"
                                    data-id-comment="'.$reply->id_komentar.'"
                                    data-id-berita="' . encrypt_url($reply->fid_berita) . '"
                                    data-id-user-comment="' . encrypt_url($this->session->userdata('user_portal_log')['id']) . '"
                                    data-username="' . decrypt_url($reply->nama_lengkap) . '" class="btn text-muted font-small btn-link ml-1 p-0"> <small><i class="fas fa-retweet"></i> Reply</small> </button>';
                } else {
                    $btn_reply = '';
                }

                if($reply->aktif === 'N') {
                    $isi_komentar = '<i class="text-danger">This Comment Is Blocked Administrator</i>';
                } else {
                    $isi_komentar = $reply->isi;
                }
               $output .= ' 
                    <div class="tracking-item reply" id="'.$reply->id_komentar.'">
                        <div class="tracking-icon status-intransit ml-5">
                            <img src="data:image/jpeg;base64,'.base64_encode($reply->photo_pic).'" class="mr-3 rounded-circle" width="40" height="40">
                        </div>
                        <div class="tracking-date small">'.mediumdate_indo($reply->tanggal).'</div>
                        <div class="tracking-content ml-5">
                        '.$button_more.'
                        '.decrypt_url($reply->nama_lengkap). ' &bull; <i class="small">'.time_ago($reply->waktu).'</i><span>'.$isi_komentar. '</span> <div id="displayReplyId'. encrypt_url($reply->fid_users_portal).'"></div> '. $btn_reply.'
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
                if(($comment->fid_users_portal == $this->session->userdata('user_portal_log')['id']) && $comment->aktif != 'N') {
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

                if(($this->session->userdata('user_portal_log')['online'] == 'ON') && $comment->aktif != 'N') {
                    $btn_reply = '<button type="button" id="btn-reply-comment" data-id-parent="' . encrypt_url($comment->fid_users_portal) . '"
                                    data-id-comment="'.$comment->id_komentar.'"
                                    data-id-berita="' . encrypt_url($comment->fid_berita) . '"
                                    data-id-user-comment="' . encrypt_url($this->session->userdata('user_portal_log')['id']) . '"
                                    data-username="' . decrypt_url($profileUser->nama_lengkap) . '" class="btn text-muted font-small btn-link ml-1 p-0"> <small><i class="fas fa-retweet"></i> Reply</small> </button>';
                } else {
                    $btn_reply = '';
                }

                if($comment->aktif === 'N') {
                    $isi_komentar = '<i class="text-danger">This Comment Is Blocked Administrator</i>';
                } else {
                    $isi_komentar = $comment->isi;
                }
                
                $output .= ' 
                            <div class="tracking-item" id="'.$comment->id_komentar.'">
                                <div class="tracking-icon status-intransit">
                                    <img src="data:image/jpeg;base64,'.base64_encode($profileUser->photo_pic).'" class="mr-3 rounded-circle" width="40" height="40">
                                </div>
                                <div class="tracking-date">'.mediumdate_indo($comment->tanggal).'</div>
                                <div class="tracking-content">
                                '.$button.'
                                '.decrypt_url($profileUser->nama_lengkap). ' &bull; <i class="small">'.time_ago($comment->waktu, true).'</i><span>'.$isi_komentar. '</span> <div id="displayReplyId'. encrypt_url($comment->fid_users_portal).'"></div> '. $btn_reply.' 
                                </div>
                            </div>
                 ';

                 $output .= $this->reply($comment->id_komentar);
            endforeach;
        } else {
            $output = '<img src="'.base_url('bower_components/SVG-Loaders/svg-loaders/empty-diskusi.svg').'" class="d-block my-auto mx-auto w-50"><p class="text-center text-muted">
                    <b class="my-2 d-block">Diskusi Kosong</b><small>Belum ada diskusi nih, yok mulai percakapan.</small></p>';
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

    public function watermark($filename) {
        $url = base_url('beranda');
        $wm = parse_url($url, PHP_URL_HOST);
        $config['source_image'] = './files/file_berita/'. $filename;
        $config['wm_text'] = $wm;
        $config['wm_type'] = 'text';
        $config['wm_font_size'] = '8';
        $config['wm_font_color'] = '#ffffff';
        $config['wm_vrt_alignment'] = 'bottom';
        $config['wm_hor_alignment'] = 'left';
        $config['wm_padding'] = '3';

        $this->image_lib->initialize($config);
        $this->image_lib->watermark();
    }
    
    public function resizeImage($filename)
    {
        
        $source_path = './files/file_berita/' . $filename;
        $target_path = './files/file_berita/thumb/'. $filename;
        $config = array(
                'image_library' => 'gd2',
                'source_image' => $source_path,
                'new_image' => $target_path,
                'create_thumb' => TRUE,
                'maintain_ratio' => FALSE,
                'width' => '450',
                'height' => '292'
        );
    
        $this->image_lib->initialize($config);
        $this->image_lib->resize();
    }
}

    /* End of file  frontend\v1\Post.php */
