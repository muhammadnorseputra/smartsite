<?php  echo '<?xml version="1.0" encoding="' . $encoding . '"?>' . "\n"; ?>
<rss version="2.0"
    xmlns:dc="http://purl.org/dc/elements/1.1/"
    xmlns:sy="http://purl.org/rss/1.0/modules/syndication/"
    xmlns:admin="http://webns.net/mvcb/"
    xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
    xmlns:content="http://purl.org/rss/1.0/modules/content/">
 
    <channel>
     
    <title><?php echo $feed_name; ?></title>
 
    <link><?php echo $feed_url; ?></link>
    <description><?php echo $page_description; ?></description>
    <dc:language><?php echo $page_language; ?></dc:language>
    <dc:creator><?php echo $creator_email; ?></dc:creator>
 
    <dc:rights>Copyright <?php echo gmdate("Y", time()); ?></dc:rights>
    <admin:generatorAgent rdf:resource="http://www.codeigniter.com/" />
 
    <?php 
      foreach($posts->result() as $post):
      // USER POST
      $by = $post->created_by;
      $namalengkap = decrypt_url($this->mf_users->get_userportal_namalengkap($by));
      // POST DETAIL
      $id = encrypt_url($post->id_berita);
      $postby = strtolower(url_title($namalengkap));
      $judul = strtolower($post->judul);
      $posturl = base_url("post/{$postby}/{$id}/".url_title($judul)); 

      if(!empty($post->img)):
          $img = '<img align="left" src="'.base_url('files/file_berita/'.$post->img).'" alt="'.$post->judul.'">';
      elseif(!empty($post->img_blob)):
          $img = '<img align="left" src="data:image/jpeg;base64,'.base64_encode( $post->img_blob ).'"/>';
      else:
          $img = '<img align="left" src="'.base_url('assets/images/noimage.gif').'" alt="'.$post->judul.'">';
      endif;

      $isi_berita = strip_tags($post->content); // membuat paragraf pada isi berita dan mengabaikan tag html
      $isi = substr($isi_berita, 0, 180); // ambil sebanyak 80 karakter
      $isi = substr($isi_berita, 0, strrpos($isi, ' ')); // potong per spasi kalimat
    ?>
     
        <item>
 
          <title><?php echo xml_convert($post->judul); ?></title>
          <link><?php echo $posturl ?></link>
            <description>
              <?= $isi ?>  
            </description>
          <guid><?php echo $posturl ?></guid>
        </item>
 
         
    <?php endforeach; ?>
     
    </channel>
</rss>