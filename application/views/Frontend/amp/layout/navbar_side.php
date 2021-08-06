<!-- Start Sidebar -->
<amp-sidebar
  id="header-sidebar"
  class="ampstart-sidebar px3"
  layout="nodisplay">
  <div class="flex justify-start items-center ampstart-sidebar-header">
    <div
      role="button"
      aria-label="close sidebar"
      on="tap:header-sidebar.toggle"
      tabindex="0"
      class="ampstart-navbar-trigger items-end mb3">
      ✕
    </div>
  </div>
  <nav class="ampstart-sidebar-nav ampstart-nav">
    <ul class="list-reset m0 p0 ampstart-label">
      <?php
      $category = $this->posts->get_kategori();
      foreach ($category as $c) :
      $categoryUrl = base_url('amp/blog/'.url_title($c->nama_kategori));
      ?>
      <li class="ampstart-nav-item">
        <a class="ampstart-nav-link flex justify-between items-center" href="<?= $categoryUrl ?>">
          <?= $c->nama_kategori; ?>
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-folder-symlink" viewBox="0 0 16 16">
            <path d="m11.798 8.271-3.182 1.97c-.27.166-.616-.036-.616-.372V9.1s-2.571-.3-4 2.4c.571-4.8 3.143-4.8 4-4.8v-.769c0-.336.346-.538.616-.371l3.182 1.969c.27.166.27.576 0 .742z"/>
            <path d="m.5 3 .04.87a1.99 1.99 0 0 0-.342 1.311l.637 7A2 2 0 0 0 2.826 14h10.348a2 2 0 0 0 1.991-1.819l.637-7A2 2 0 0 0 13.81 3H9.828a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 6.172 1H2.5a2 2 0 0 0-2 2zm.694 2.09A1 1 0 0 1 2.19 4h11.62a1 1 0 0 1 .996 1.09l-.636 7a1 1 0 0 1-.996.91H2.826a1 1 0 0 1-.995-.91l-.637-7zM6.172 2a1 1 0 0 1 .707.293L7.586 3H2.19c-.24 0-.47.042-.683.12L1.5 2.98a1 1 0 0 1 1-.98h3.672z"/>
          </svg>
        </a>
      </li>
      <?php endforeach; ?>
    </ul>
  </nav>
  <ul class="ampstart-sidebar-faq list-reset m0 border-top pt3">
    <li class="ampstart-faq-item">
      <a rel="noreferrer" href="https://www.buymeacoffee.com/putrabungsu6" class="text-decoration-none">Developer</a>
    </li>
    <li class="ampstart-faq-item">
      <a rel="noreferrer" href="https://wa.me/+6282151811532" class="text-decoration-none">Contact</a>
    </li>
    <li class="ampstart-faq-item">
      <a href="<?= base_url('kebijakan-privacy-policy') ?>" class="text-decoration-none">Privacy</a>
    </li>
  </ul>
</amp-sidebar>
<!-- End Sidebar -->