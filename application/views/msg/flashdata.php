<?php 
	if($this->session->flashdata('message') <> '') {
		echo '<div class="alert '.$this->session->flashdata('class').' alert-dismissible">	
						'. $this->session->flashdata('message') .'
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
					</div>';
	}
?>