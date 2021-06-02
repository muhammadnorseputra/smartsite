<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="google-site-verification" content="nD_7kuRJfZNmViXXCEKPsajSAG_US0grvhqG0bqpO6g" />
    <title><?= $title; ?></title>
    <?= 
        !empty($meta) ? $meta : '<meta name="author" content="Muhammad Nor Saputra"/>
                                 <meta name="description" content="'.$mf_beranda->meta_desc.'"/>
                                 <meta name="keywords" content="'.$mf_beranda->meta_seo.'"/>';  
    ?>
    <link rel="shortcut icon" href="<?= base_url('assets/images/logo.png'); ?>">

    <link href="<?= base_url('template/v1/prod/app.css'); ?>" rel="stylesheet" type="text/css">
    <!-- <script data-ad-client="ca-pub-1099792537777374" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script> -->
</head>

<body>
<div class="page-slider">
    <div class="logo-loading">
        <img class="w-25" src="<?= base_url('assets/images/logo.png'); ?>" alt="balangankab">
    </div>
  <div class="slider">
    <div class="line"></div>
    <div class="subline inc"></div>
    <div class="subline dec"></div>
  </div>
  <!-- <p>loading ...</p> -->
</div>