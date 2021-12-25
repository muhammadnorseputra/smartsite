<?php  
if ($isi) {
	# code...
	$this->load->view($isi);
}
?>

<div class="fixed-bottom ml-auto text-center w-5 d-none d-md-block">
    <button aria-hidden="true" type="button" aria-label="button" title="Back to top" class="btn shadow btn-warning btn-lg border-0 shadow-none text-center rounded btn-backtop rippler rippler-inverse mb-2"><i class="fas fa-arrow-up py-1"></i></button>
</div>
<!-- <script data-name="NBJ-Widget" data-cfasync="false" src="https://www.nihbuatjajan.com/javascripts/widget.prod.min.js" data-id="putra" data-domain="https://www.nihbuatjajan.com" data-description="" data-message="" data-color="#FF813F" data-position="left" data-x_margin="20" data-y_margin="90"></script> -->
<?php if($this->mf_beranda->get_identitas()->status_maintenance == '1') { ?>
 <div class="alert alert-danger fixed-bottom rounded-0 py-2 m-0" role="alert">
    <div class="container text-center">
        <i class="fa fa-info-circle mr-3"></i>Halo, website sedang dalam pengembangan <b>Administrator</b>.
    </div>
</div>
<?php } ?>