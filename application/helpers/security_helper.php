<?php if (!defined("BASEPATH")) exit("No direct script access allowed");
if ( ! function_exists('do_hash'))
  {
      function do_hash($str, $type = 'sha1')
      {
          if ($type == 'sha1')
          {
              return sha1($str);
          }
          else
          {
              return md5($str);
          }
      }
 }
if ( ! function_exists('fstring'))
  {
      function fstring($str)
      {
          $CI =& get_instance();
          $str_to_array = explode(" ", $str);
          foreach ($str_to_array as $word) {
            $q = $CI->mf_users->cari_kata($word)->result();
            foreach ($q as $row) {
              $word_found = strtolower($row->word);
              $new_word = preg_replace('/(?!^.?).(?!.{0}$)/', '*', $word_found);
              
              $key = array_search($word_found, array_map('strtolower', $str_to_array));
              $length = strlen($word_found) - 1;

            $replace = array($key => $new_word);
            $str_to_array = array_replace($str_to_array, $replace);
            }
          }
          $new_str = implode(" ", $str_to_array);
          return $new_str;
      }
 }
function encrypt_url($string) {

    $output = false;
    /*
    * read security.ini file & get encryption_key | iv | encryption_mechanism value for generating encryption code
    */        
    $security       = parse_ini_file("security.ini");
    $secret_key     = $security["encryption_key"];
    $secret_iv      = $security["iv"];
    $encrypt_method = $security["encryption_mechanism"];

    // hash
    $key    = hash("sha256", $secret_key);

    // iv – encrypt method AES-256-CBC expects 16 bytes – else you will get a warning
    $iv     = substr(hash("sha256", $secret_iv), 0, 16);

    //do the encryption given text/string/number
    $result = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
    $output = base64_encode($result);
    return $output;
}



function decrypt_url($string) {

    $output = false;
    /*
    * read security.ini file & get encryption_key | iv | encryption_mechanism value for generating encryption code
    */

    $security       = parse_ini_file("security.ini");
    $secret_key     = $security["encryption_key"];
    $secret_iv      = $security["iv"];
    $encrypt_method = $security["encryption_mechanism"];

    // hash
    $key    = hash("sha256", $secret_key);

    // iv – encrypt method AES-256-CBC expects 16 bytes – else you will get a warning
    $iv = substr(hash("sha256", $secret_iv), 0, 16);

    //do the decryption given text/string/number

    $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    return $output;
}