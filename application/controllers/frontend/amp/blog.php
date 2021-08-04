<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends CI_Controller {
	function __construct()
	{
		parent::__construct();	
        $this->load->model('model_template_v1/M_f_post', 'posts');
        $this->load->model('model_template_v1/M_f_users', 'users'); 
	}

	// Site AMP
	public function post($slugPost)
	{		
			// $slugPost = $_GET['title'];
			$slug = isset($slugPost) ? $slugPost : '';
			$id = $this->posts->detailIdBySlug($slug);
        	$detail = $this->posts->detail($id)->row();
        	$judul_seo = ucwords($detail->judul);

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
				$content = nl2br($yt_desc);
			else:
				$content = $detail->content;
			endif;
			// Meta
			if($detail->type === 'YOUTUBE'):
	            $description = !empty($detail->deskripsi) ? $detail->deskripsi : $yt_desc;
	        else:
	            $meta_desc = strip_tags(str_replace('"', '', word_limiter($detail->content, 120)));
	            $description = !empty($detail->deskripsi) ? $detail->deskripsi : $meta_desc;
	        endif;
			$keywords = !empty($detail->keywords) ? $detail->keywords : $detail->tags;

			/*Update Count Views*/
			$count_v = $detail->views;
			$count = $count_v + 1;
			$this->posts->update_count_post($id, $count);

	        $author = $this->users->get_userportal_namapanggilan($detail->created_by)->nama_panggilan;
	        $photo = img_blob($this->users->get_userportal_byid($detail->created_by)->photo_pic);
	        $commentCount = $this->posts->jml_komentar_by_id_berita($id);
			$data = [
				'site' => $this->mf_beranda->get_identitas(),
				'title' => $judul_seo,
				'post' => $detail,
				'postId' => $id,
				'postSlug' => $slug,
				'postCategory' => $this->posts->kategori_byid($detail->fid_kategori),
				'postDatetime' => longdate_indo($detail->tgl_posting),
				'postImage' => $img,
				'postContent' => $content,
				'postAuthor' => ucwords(decrypt_url($author)),
				'postAuthorPic' => $photo,
				'postView' => $count,
				'postComment' => $commentCount,
				'keywords' => $keywords,
				'description' => $description
			];
			return $this->load->view('Frontend/amp/post/index', $data);
	}

}
