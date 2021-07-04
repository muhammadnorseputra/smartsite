<?php  
/**
 * Function Name
 *
 * Function Description
 *
 * @access	public
 * @param	type	name
 * @return	type	
 */
 
if (! function_exists('cek_internet'))
{
	function cek_internet(){
	 $connected = @fsockopen("www.google.com", 80);
	 if ($connected){
	  $is_conn = true; //jika koneksi tersambung
	  fclose($connected);
	 }else{
	  $is_conn = false; //jika koneksi gagal
	 }
	 return $is_conn;
	}
}

