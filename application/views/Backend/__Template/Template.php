<?php

// Fungsi mengecek apakah terdapat file css / js di halaman teresbut
if((empty($css)) && empty($js)) {$js   = [];$css  = [];} 
elseif (empty($css)) {$css  = [];} 
elseif (empty($js)) {$js   = [];}

$header = [
  'titlebar' =>  ucwords($this->uri->segment(2)).' | Administrator Page',
  'title' => '<b>BKPSDM</b>.v2',
  'skin' => $this->madmin->listskin('t_skin')->result(),
  'label' => $this->madmin->listlabel()->result(),
  'baseinfo' => $this->mpengaturan->getIdentitas()->row(),
  'autoload_css' => $css
];

$footer = [
  'templatescript' => 'Backend/__ServerSideJs/Template/s_template',
  'autoload_js' => $js
];

$this->load->view('Backend/__Template/Header', $header);
$this->load->view('Backend/__Template/TopBar');
$this->load->view('Backend/__Template/LeftSidebar');
$this->load->view('Backend/__Template/RightSidebar'); 
$this->load->view('Backend/__Template/PageInfo'); 
$this->load->view('Backend/__Template/Content');
$this->load->view('Backend/__Template/Footer', $footer);

?>