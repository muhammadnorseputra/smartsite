<!DOCTYPE html>

<!---
Copyright 2017 The AMP Start Authors. All Rights Reserved.

Licensed under the Apache License, Version 2.0 (the "License");
you may not use this file except in compliance with the License.
You may obtain a copy of the License at

      http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software
distributed under the License is distributed on an "AS-IS" BASIS,
WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
See the License for the specific language governing permissions and
limitations under the License.
-->

<html amp="amp">
  <head>
    <meta charset="utf-8" />
    <title><?= $title ?></title>
    <link rel="canonical" href="<?= curPageURL(); ?>" />
    <meta name="viewport" content="width=device-width" />
    <meta name="amp-google-client-id-api" content="googleanalytics" />
    <meta name="robots" content="index,follow"/>
    <meta name="keywords" content="<?= $keywords ?>" />
    <meta name="description" content="<?= $description ?>" />
    <script async="" src="https://cdn.ampproject.org/v0.js"></script>
    <link rel="dns-prefetch" href="https://cdn.ampproject.org/">
    <style amp-boilerplate="">
      @import "<?= base_url('template/amp/base.css') ?>"
    </style>
    <noscript>
      <style amp-boilerplate="">
        body {
          -webkit-animation: none;
          -moz-animation: none;
          -ms-animation: none;
          animation: none;
        }
      </style>
    </noscript>

    <script
      custom-element="amp-sidebar"
      src="https://cdn.ampproject.org/v0/amp-sidebar-0.1.js"
      async=""
    ></script>

    <style amp-custom="">
      @import "<?= base_url('template/amp/page.css') ?>"
    </style>
  </head>
  <body>
    <!-- Start Navbar -->
    <header
      class="ampstart-headerbar fixed flex justify-start items-center top-0 left-0 right-0 pl2 pr4"
    >
      <a class="text-decoration-none flex items-center ampstart-label" href="<?= base_url('amp') ?>"> 
      <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-arrow-left-circle mr1" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
      </svg>
        Back 
      </a>
      <amp-img
        src="<?= img_blob($site->site_logo) ?>"
        width="160"
        height="50"
        layout="fixed"
        class="my0 mx-auto"
        alt="<?= $site->site_title ?>"
      ></amp-img>
    </header>

    <!-- End Navbar -->
    <main id="content" role="main">
      <article class="recipe-article">
        <header>
          <span class="ampstart-subtitle block px3 pt2 mb2 caps"><?= $postCategory ?></span>
          <h4 class="mb1 px3 bold ampstart-title-sm"><?= $title ?></h4>

          <!-- Start byline -->
          <address class="ampstart-byline clearfix mb4 px3 h5 flex justify-start">
            <amp-img
              src="<?= $postAuthorPic ?>"
              width="30"
              height="30"
              class="circle"
              alt="<?= $postAuthor ?>"
            ></amp-img>
            <time
              class="ampstart-byline-pubdate ampstart-small-text block bold my1 ml2"
              datetime="<?= $post->tgl_posting ?>"
              ><?= $postAuthor ?> &bull; <?= $postDatetime ?></time
            >
          </address>
          <!-- End byline -->
          <amp-img
            src="<?= $postImage ?>"
            width="1280"
            height="853"
            layout="responsive"
            alt="The final spritzer"
            class="mb4 mx3 rounded ampstart-card"
          ></amp-img>
        </header>
        <section class="mb4 px3">
          <?= $postContent ?>
          <div class="flex justify-between items-center mt3">
            <div class="flex justify-start">
              <span>
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                  <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                  <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                </svg>
              </span>
              <span class="ml2">
                <?= $postView  ?>
              </span> 
            </div>
            <div class="flex justify-start align-center">
              <span>
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-hand-thumbs-up" viewBox="0 0 16 16">
                <path d="M8.864.046C7.908-.193 7.02.53 6.956 1.466c-.072 1.051-.23 2.016-.428 2.59-.125.36-.479 1.013-1.04 1.639-.557.623-1.282 1.178-2.131 1.41C2.685 7.288 2 7.87 2 8.72v4.001c0 .845.682 1.464 1.448 1.545 1.07.114 1.564.415 2.068.723l.048.03c.272.165.578.348.97.484.397.136.861.217 1.466.217h3.5c.937 0 1.599-.477 1.934-1.064a1.86 1.86 0 0 0 .254-.912c0-.152-.023-.312-.077-.464.201-.263.38-.578.488-.901.11-.33.172-.762.004-1.149.069-.13.12-.269.159-.403.077-.27.113-.568.113-.857 0-.288-.036-.585-.113-.856a2.144 2.144 0 0 0-.138-.362 1.9 1.9 0 0 0 .234-1.734c-.206-.592-.682-1.1-1.2-1.272-.847-.282-1.803-.276-2.516-.211a9.84 9.84 0 0 0-.443.05 9.365 9.365 0 0 0-.062-4.509A1.38 1.38 0 0 0 9.125.111L8.864.046zM11.5 14.721H8c-.51 0-.863-.069-1.14-.164-.281-.097-.506-.228-.776-.393l-.04-.024c-.555-.339-1.198-.731-2.49-.868-.333-.036-.554-.29-.554-.55V8.72c0-.254.226-.543.62-.65 1.095-.3 1.977-.996 2.614-1.708.635-.71 1.064-1.475 1.238-1.978.243-.7.407-1.768.482-2.85.025-.362.36-.594.667-.518l.262.066c.16.04.258.143.288.255a8.34 8.34 0 0 1-.145 4.725.5.5 0 0 0 .595.644l.003-.001.014-.003.058-.014a8.908 8.908 0 0 1 1.036-.157c.663-.06 1.457-.054 2.11.164.175.058.45.3.57.65.107.308.087.67-.266 1.022l-.353.353.353.354c.043.043.105.141.154.315.048.167.075.37.075.581 0 .212-.027.414-.075.582-.05.174-.111.272-.154.315l-.353.353.353.354c.047.047.109.177.005.488a2.224 2.224 0 0 1-.505.805l-.353.353.353.354c.006.005.041.05.041.17a.866.866 0 0 1-.121.416c-.165.288-.503.56-1.066.56z"/>
              </svg>
              </span>
              <span class="ml2">
                <?= $post->like_count;  ?>
              </span> 
            </div>
            <div class="flex justify-start align-center">
              <span>
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-chat-left-text" viewBox="0 0 16 16">
                  <path d="M14 1a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H4.414A2 2 0 0 0 3 11.586l-2 2V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12.793a.5.5 0 0 0 .854.353l2.853-2.853A1 1 0 0 1 4.414 12H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                  <path d="M3 3.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 6a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 6zm0 2.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z"/>
                </svg>
              </span>
              <span class="ml2">
                <?= $postComment ?>
              </span> 
            </div>
            <div class="flex justify-start align-center">
              <span>
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-share" viewBox="0 0 16 16">
                  <path d="M13.5 1a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM11 2.5a2.5 2.5 0 1 1 .603 1.628l-6.718 3.12a2.499 2.499 0 0 1 0 1.504l6.718 3.12a2.5 2.5 0 1 1-.488.876l-6.718-3.12a2.5 2.5 0 1 1 0-3.256l6.718-3.12A2.5 2.5 0 0 1 11 2.5zm-8.5 4a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zm11 5.5a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3z"/>
                </svg>
              </span>
              <span class="ml2">
                <?= $post->share_count  ?>
              </span> 
            </div>
            
          </div>
          <!-- <div class="mt3 border-top ampstart-related-article-section">
            
          </div> -->
        </section>
        <section class="mb4 px3">
          <a href="<?= base_url("blog/{$postSlug}") ?>" class="ampstart-accent">
            Lihat versi non-AMP
          </a>
        </section>
      </article>
    </main>

    <!-- Start Footer -->
    <footer class="ampstart-footer flex flex-column items-center px3">
      <nav class="ampstart-footer-nav">
        <ul class="list-reset flex flex-wrap mb3">
          <li class="px1">
            <a class="text-decoration-none ampstart-label" href="<?= base_url('beranda') ?>">Home</a>
          </li>
          <li class="px1">
            <a class="text-decoration-none ampstart-label" target="_blank" href="https://www.buymeacoffee.com/putrabungsu6">Depelover</a>
          </li>
          <li class="px1">
            <a class="text-decoration-none ampstart-label" href="https://wa.me/+6282151811532">Contact</a>
          </li>
          <li class="px1">
            <a class="text-decoration-none ampstart-label" href="<?= base_url('kebijakan-privacy-policy') ?>">Privacy</a>
          </li>
        </ul>
      </nav>
      <p class="ampstart-small-text center"> &copy; <?= $site->site_title ?>, <?= date('Y') ?> <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
  <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>
</svg> AMP Version </p>
    </footer>
    <!-- End Footer -->
  </body>
</html>