<?php  
if ($isi) {
	# code...
	$this->load->view($isi);
}
?>

<div class="fixed-bottom ml-auto text-center w-5 mb-5 mr-5">
    <button type="button" title="Back to top" class="btn shadow btn-info shadow rounded-circle text-center rounded btn-backtop rippler rippler-inverse"><i class="fas fa-arrow-up px-1 py-2"></i></button>
</div>
<?php if($this->mf_beranda->get_identitas()->status_maintenance == '1') { ?>
 <div class="alert alert-danger fixed-bottom rounded-0 py-2 m-0" role="alert">
    <div class="container text-center">
        <i class="fa fa-info-circle mr-3"></i>Halo, pengunjung website sedang dalam pengembangan <b>Administrator</b>.
    </div>
</div>
<?php } ?>