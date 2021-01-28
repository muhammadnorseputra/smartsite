<?php

// Filtering Module Uri
$url_module = $this->input->get('module');
$modules = $this->madmin->getmoduleuser($this->session->userdata('user'));
$module_user = explode(',', $modules[0]->fid_token);
$module_key = array_search($url_module, $module_user, true);
$module_val = in_array($url_module, $module_user) ? $module_user[$module_key] : '';

// $uri_controller = $this->uri->segment(3);
// $modules2 = $this->madmin->getmodulebycontroller($uri_controller);

if (empty($module_val)) {
    $this->load->view('Backend/v_module_404');
} else {
    // if($modules2 != $url_module ) {
    //     $this->load->view('Backend/v_module_404');
    // } else { ?>
<section class="content" id="load-content">
	<div class="container">
	    <div class="content-inner out fadeIn">
	        <?php $this->load->view($content); ?>
	    </div>
	</div>
</section>
<?php $this->load->view($scriptjs); ?>
<?php
}  ?>