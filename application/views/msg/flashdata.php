<?php 
	if($this->session->flashdata('message') <> '') {
		echo '<div class="'.$this->session->flashdata('class').' alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>	
						'. $this->session->flashdata('message') .'

					</div>';
	}
?>