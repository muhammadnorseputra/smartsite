<?= "<?xml version=\"1.0\" encoding=\"UTF-8\" ?> \n" ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <!-- Sitemaps Posts -->
    <?php 
        // set the default timezone to use.
        date_default_timezone_set('UTC');

        foreach($posts->result() as $post): 
        // URL
        $slug = strtolower($post->slug);
        $posturl = base_url("blog/{$slug}"); 
        $newDateTime= new DateTime($post->update_at, new DateTimeZone('UTC'));
        $postMod = $newDateTime->format('Y-m-d H:i:sP');
    ?>
    <url>
        <loc><?= $posturl ?></loc>
        <lastmod><?= $postMod ?></lastmod>
        <changefreq>daily</changefreq>
        <priority>0.3</priority>
    </url>
    <?php endforeach; ?>

    <!-- Sitemaps Pages -->
    <?php 
        foreach($pages->result() as $page): 
        // URL
        $slug = strtolower($page->slug);
        $pageUrl = base_url("page/{$slug}"); 
    ?>
    <url>
        <loc><?= $pageUrl ?></loc>
        <changefreq>daily</changefreq>
        <priority>0.3</priority>
    </url>
    <?php endforeach; ?>

    <!-- Sitemaps Category -->
    <?php 
        foreach($categorys->result() as $category): 
        // URL
        $kategori = strtolower($category->nama_kategori);
        $kategoriUrl = base_url("k/{$kategori}"); 
    ?>
    <url>
        <loc><?= $kategoriUrl ?></loc>
        <changefreq>monthly</changefreq>
        <priority>0.4</priority>
    </url>
    <?php endforeach; ?>

    <!-- Sitemaps Tags -->
    <?php 
        foreach($tags->result() as $tag): 
        // URL
        $tag = strtolower(url_title($tag->nama_tag));
        $tagUrl = base_url("k/{$tag}"); 
    ?>
    <url>
        <loc><?= $tagUrl ?></loc>
        <changefreq>monthly</changefreq>
        <priority>0.4</priority>
    </url>
    <?php endforeach; ?>

</urlset>