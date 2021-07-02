<?php  echo '<?xml version="1.0" encoding="' . $encoding . '"?>' . "\n"; ?>
<rss version="2.0" xmlns:g="http://base.google.com/ns/1.0">
 
    <channel>
    <title><?php echo $feed_name; ?></title>
 
    <link><?php echo $feed_url; ?></link>
    <description><?php echo $page_description; ?></description>
    <language><?php echo $page_language; ?></language>
    <author><?php echo $creator_email; ?></author>
 
    <copyright>Copyright <?php echo gmdate("Y", time()); ?></copyright>
 
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
          $img = base_url('files/file_berita/'.$post->img);
      else:
          $img = base_url('assets/images/noimage.gif');
      endif;

      $isi_berita = $post->content; // membuat paragraf pada isi berita dan mengabaikan tag html
      $isi = substr($isi_berita, 0, 180); // ambil sebanyak 80 karakter
      $isi = substr($isi_berita, 0, strrpos($isi, ' ')); // potong per spasi kalimat
    ?>
     
        <item>
 
          <title><?php echo xml_convert($post->judul); ?></title>
          <link><?php echo $posturl ?></link>
            <description>
              <?= strip_only_tags($isi, '<p><b><img><code><label><i>') ?>  
            </description>
            <g:image_link><?= $img ?></g:image_link> 
          <g:id><?php echo $posturl ?></g:id>
        </item>
 
         
    <?php endforeach; ?>
     
    </channel>
</rss>