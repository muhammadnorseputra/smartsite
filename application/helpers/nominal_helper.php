<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('nominal')) {
	function nominal($angka){
		$jd = number_format($angka, 0, ',', '.');
		return $jd;
	}
}

if (!function_exists('cekValue')) {
	function cekValue($value, $default = null){
		$jd = isset($value) ? $value : $default;
		return $jd;
	}
}

function formatting($phone){
	if(preg_match('/([0-9]{4})([0-9]{4})([0-9]{4})$/', $phone, $value)) {
      $format = $value[1] . '-' . $value[2] . '-' . $value[3];
  } else {
  		$format = 'Invalid Number';
  }
  return $format;
}
//RUN SCRIPT
// $this->load->helper('nominal');
// echo nominal('300000');
?>