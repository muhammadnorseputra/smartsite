<!DOCTYPE html>
<html lang="id-ID">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="google-site-verification" content="nD_7kuRJfZNmViXXCEKPsajSAG_US0grvhqG0bqpO6g" />
    <title><?= $title; ?></title>
    <?= 
    !empty($meta) ? $meta : '<meta name="author" content="muhamamdnorseputra@gmail.com"/>
                                 <meta name="description" content="'.$mf_beranda->meta_desc.'"/>
                                 <meta name="keywords" content="'.$mf_beranda->meta_seo.'"/>';  
    ?>
    <link rel="dns-prefetch" href="https://fonts.googleapis.com/">
    <link rel="dns-prefetch" href="https://web.bkppd-balangankab.info/">
    <link rel="dns-prefetch" href="https://www.googletagmanager.com/">
    <link rel="dns-prefetch" href="https://googleads.g.doubleclick.net/">
    <link rel="preconnect" href="https://googleads.g.doubleclick.net/" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com/" crossorigin>
    <link rel="preconnect" href="https://web.bkppd-balangankab.info/" crossorigin>
    <link rel="preconnect" href="https://www.googletagmanager.com/" crossorigin>
    <link rel="prerender" href="<?= base_url('template/v1/prod/app.css'); ?>" as="style" crossorigin>
    <link rel="prefetch" href="<?= base_url('template/v1/prod/app.css'); ?>" as="style" crossorigin>
    <link rel="stylesheet" href="<?= base_url('template/v1/prod/app.css'); ?>" type="text/css">
    <link rel="prerender" href="<?= base_url('template/v1/prod/vendor-min.js'); ?>" as="script" crossorigin>
    <link rel="prerender" href="<?= base_url('template/v1/prod/app-min.js'); ?>" as="script" crossorigin>
    <link rel="prefetch" href="<?= base_url('bower_components/jquery/dist/jquery.min.js'); ?>" as="script" crossorigin>
    <!-- <link rel="stylesheet" href="<?= base_url('template/v1/prod/app.css'); ?>"  type="text/css"> -->
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-199508931-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-199508931-1');
    </script>
</head>

<body>
<div class="page-slider">
    <div class="logo-loading">
        <img class="w-50" src="<?= base_url('assets/images/logo.png'); ?>" alt="BKPPD BALANGAN">
    </div>
  <div class="slider">
    <div class="line"></div>
    <div class="subline inc"></div>
    <div class="subline dec"></div>
  </div>
  <!-- <p>loading ...</p> -->
</div>