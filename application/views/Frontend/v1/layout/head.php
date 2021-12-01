<!DOCTYPE html>
<html lang="id-ID">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="google-site-verification" content="nD_7kuRJfZNmViXXCEKPsajSAG_US0grvhqG0bqpO6g" />
    <link rel="alternate" hreflang="id-ID" href="<?= curPageURL(); ?>"/>
    <link rel="apple-touch-icon" sizes="32x32" href="<?= base_url('assets/images/logo.png') ?>" />
    <link rel="shortcut icon" sizes="32x32" href="<?= base_url('assets/images/logo.png') ?>" />
    <link rel="manifest" href="<?= base_url('manifest.json') ?>" crossorigin="anonymous">
    <!-- browser color -->
    <meta name="theme-color" content="#01877c">
    <meta name="msapplication-navbutton-color" content="#01877c">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <title><?= $title; ?></title>
    <?= 
    !empty($meta) ? $meta : '
    <meta name="robots" content="noindex, nofollow, noarchive"/>
    <meta name="googlebot-news" content="noindex, nofollow, noarchive" />
    <meta  name="googlebot" content="noindex, nofollow, noarchive" />
    <meta name="author" content="muhamamdnorseputra@gmail.com"/>
    <meta name="description" content="'.$mf_beranda->meta_desc.'"/>
    <meta name="keywords" content="'.$mf_beranda->meta_seo.'"/>';  
    ?>
    <link rel="preconnect" href="https://fonts.googleapis.com/"/>
    <link rel="preload" as="font" href="<?= base_url('bower_components/Font-Awesome/webfonts//fa-solid-900.woff2') ?>" crossorigin="anonymous">
    <link rel="preload" as="font" href="<?= base_url('bower_components/Font-Awesome/webfonts//fa-brands-400.woff2') ?>" crossorigin="anonymous">
    <link rel="preload" as="font" href="<?= base_url('bower_components/Font-Awesome/webfonts//fa-regular-400.woff2') ?>" crossorigin="anonymous">
    <link rel="preload" href="<?= base_url('template/v1/prod/vendor-min.js'); ?>" as="script" crossorigin="anonymous">
    <link rel="preload" href="<?= base_url('template/v1/prod/app-min.js'); ?>" as="script" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="<?= base_url('template/v1/prod/app.css'); ?>">
    <link rel="prefetch" href="<?= base_url('bower_components/jquery/dist/jquery.min.js'); ?>" as="script" crossorigin="anonymous">
    <link rel="dns-prefetch" href="//fonts.googleapis.com/">
    <link rel="dns-prefetch" href="//web.bkppd-balangankab.info/">
    <link rel="dns-prefetch" href="//www.googletagmanager.com/">
    <link rel="subresource" href="<?= base_url('assets/images/logo.png'); ?>">
    <link rel="subresource" href="<?= base_url('assets/images/bg/bg.png'); ?>">
    <link rel="subresource" href="<?= base_url('assets/images/bg/bg-home.png'); ?>">
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-199508931-1" crossorigin="anonymous"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-199508931-1');
    </script>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6373503432980668"
     crossorigin="anonymous"></script>
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