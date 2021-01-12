
<!-- Jquery Core Js Global Assets-->
<script src="<?= site_url('assets/plugins/bootstrap/js/bootstrap.min.js'); ?>"></script>
<script src="<?= site_url('assets/plugins/node-waves/waves.js'); ?>"></script>
<script src="<?= site_url('assets/plugins/nprogress/nprogress.js'); ?>"></script>
<script src="<?= site_url('assets/plugins/mprogres/js/mprogress.min.js'); ?>"></script>
<script src="<?= site_url('assets/plugins/bootstrap-notify/bootstrap-notify.js'); ?>"></script>
<script src="<?= site_url('assets/plugins/sweetalert/sweetalert.min.js'); ?>"></script>
<script src="<?= site_url('assets/plugins/jquery-confirm/jquery-confirm.min.js'); ?>"></script>

<script src="<?= base_url('assets/js/mproggressbar.js'); ?>"></script>
<script src="<?= base_url('assets/js/session_out.js'); ?>"></script>
<script src="<?= base_url('assets/js/theme.js'); ?>" ></script>
<script src="<?= base_url('assets/js/menu.js'); ?>"></script>

<!-- Global All Assets -->
<script src="<?= site_url('assets/js/admin.js'); ?>"></script>
<script src="<?= site_url('assets/js/pages/index.js'); ?>"></script>
<script src="<?= site_url('assets/js/pages/ui/notifications.js'); ?>"></script>
<script src="<?= site_url('assets/js/demo.js'); ?>"></script>

<?php
    foreach ($autoload_js as $script):
        echo script_tag($script);
    endforeach;
    $this->load->view($templatescript);
?>

</body>

</html>