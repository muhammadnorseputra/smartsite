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
      foreach($categorys->result() as $category):
      $datenow = date('Y-m-d H:i:s');
      $posturl = base_url("k/{$category->nama_kategori}");
      $newDateTime= new DateTime($datenow, new DateTimeZone('Asia/Jakarta'));
    ?>
        <item>
          <title><?php echo xml_convert(ucwords($category->nama_kategori)); ?></title>
          <dc:creator><?= $creator_name ?></dc:creator>
          <link><?php echo $posturl ?></link>
          <guid isPermaLink="false"><?= $posturl ?></guid>
          <pubDate><?= $newDateTime->format('D, d M Y H:i:s O') ?></pubDate>
        </item>
    <?php endforeach; ?>
    </channel>
</rss>