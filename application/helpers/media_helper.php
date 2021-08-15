<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('files'))
 {
   function files($src)
   {
      return base_url('files/'.$src);
   }
 }

if (!function_exists('assets'))
 {
   function assets($src)
   {
      return base_url('assets/'.$src);
   }
 }
/* End of file media_helper.php */