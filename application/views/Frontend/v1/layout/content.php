<?php  
if ($isi) {
	# code...
	$this->load->view($isi);
}
?>

<div class="fixed-bottom mx-auto text-center w-5 mb-5">
    <button type="button" title="Back to top" class="btn shadow btn-info shadow mb-5 mb-md-3 px-5 px-md-3 text-center rounded btn-backtop rippler rippler-inverse"><i class="fas fa-arrow-up"></i></button>
</div>
<?php if($this->mf_beranda->get_identitas()->status_maintenance == '1') { ?>
 <div class="alert alert-danger fixed-bottom rounded-0 py-2 m-0" role="alert">
    <div class="container text-center">
        <i class="fa fa-info-circle mr-3"></i> Website sedang dalam pengembangan.
    </div>
</div>
<?php } ?>