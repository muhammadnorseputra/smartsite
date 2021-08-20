<?php header("Content-Type: application/rss+xml"); ?>
<?php  echo '<?xml version="1.0" encoding="' . $encoding . '"?>' . "\n"; ?>
<rss version="2.0"
    xmlns:dc="http://purl.org/dc/elements/1.1/"
    xmlns:sy="http://purl.org/rss/1.0/modules/syndication/"
    xmlns:admin="http://webns.net/mvcb/"
    xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
    xmlns:content="http://purl.org/rss/1.0/modules/content/"
    xmlns:atom="http://www.w3.org/2005/Atom"
    xmlns:g="http://base.google.com/ns/1.0">
    <channel>
    <title><?php echo $feed_name; ?></title>
 
    <link><?php echo $feed_url; ?></link>
    <description><?php echo $page_description; ?></description>
    <dc:language><?php echo $page_language; ?></dc:language>
    <dc:creator><?php echo $creator_email; ?></dc:creator>
 
    <dc:rights>Copyright <?php echo gmdate("Y", time()); ?></dc:rights>
    <admin:generatorAgent rdf:resource="https://web.bkppd-balangankab.info/" />
    <atom:link rel="self" type="application/rss+xml" href="<?php echo $feed_url; ?>"/>
     <?php 
      foreach($posts->result() as $post):
      // USER POST
      $by = $post->created_by;
      $namalengkap = decrypt_url($this->mf_users->get_userportal_namalengkap($by));
      // POST DETAIL
      $id = encrypt_url($post->id_berita);
      $postby = strtolower(url_title($namalengkap));
      $slug = strtolower($post->slug);
      $posturl = base_url("blog/{$slug}"); 

      if($post->type === 'BERITA'):
        if(!empty($post->img)):
            $img = base_url('files/file_berita/'.$post->img);
        else:
            $img = base_url('assets/images/noimage.gif');
        endif;
      elseif($post->type === 'SLIDE'):
        $img_terkait = $this->posts->getImageTerkaitThumb($post->id_berita, 'desc');
        if($img_terkait != NULL):
          $img = $img_terkait;
        endif;
      endif;

      $isi_berita = $post->content; // membuat paragraf pada isi berita dan mengabaikan tag html
      $isi = substr($isi_berita, 0, 180); // ambil sebanyak 80 karakter
      $isi = substr($isi_berita, 0, strrpos($isi, ' ')); // potong per spasi kalimat
      $conditional = $post->tgl_posting === date('Y-m-d') ? 'Terbaru' : 'Lama';
      $newDateTime= new DateTime($post->created_at, new DateTimeZone('UTC'));
    ?>
        <item>
          <title><?php echo xml_convert($post->judul); ?></title>
          <dc:creator><?= $creator_name ?></dc:creator>
          <link><?php echo $posturl ?></link>
          <description>
            <?= htmlentities('<img src="'.$img.'" align="left" hspace="7" width="100">'); ?>
            <![CDATA[<?= strip_tags($isi) ?>]]>
          </description>
          <content:encoded><![CDATA[<?= strip_tags($isi) ?>]]></content:encoded>
          <g:image_link><?= $img ?></g:image_link>
          <g:condition><?= $conditional ?></g:condition>
          <g:id><?= $id ?></g:id>
          <guid isPermaLink="false"><?= $posturl ?></guid>
          <enclosure length="25000" type="image/jpeg" url="<?= $img ?>"/>
          <pubDate><?= $newDateTime->format('D, d M Y H:i:sO') ?></pubDate>
        </item>
    <?php endforeach; ?>
     
    </channel>
</rss>