<?php  
if ($isi) {
	# code...
	$this->load->view($isi);
}
?>

<div class="fixed-bottom ml-auto text-center w-5 mb-5 pb-4">
    <button aria-hidden="true" type="button" aria-label="button" title="Back to top" class="btn shadow btn-primary btn-lg border-0 shadow-sm text-center rounded btn-backtop rippler rippler-inverse mb-3"><i class="fas fa-arrow-up px-1 py-2"></i></button>
</div>
<!-- <script data-name="NBJ-Widget" data-cfasync="false" src="https://www.nihbuatjajan.com/javascripts/widget.prod.min.js" data-id="putra" data-domain="https://www.nihbuatjajan.com" data-description="" data-message="" data-color="#FF813F" data-position="left" data-x_margin="20" data-y_margin="90"></script> -->
<?php if($this->mf_beranda->get_identitas()->status_maintenance == '1') { ?>
 <div class="alert alert-danger fixed-bottom rounded-0 py-2 m-0" role="alert">
    <div class="container text-center">
        <i class="fa fa-info-circle mr-3"></i>Halo, website sedang dalam pengembangan <b>Administrator</b>.
    </div>
</div>
<?php } ?>