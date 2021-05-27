<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * SEO Helper
 *
 * Generates Meta tags for search engines optimizations, open graph, twitter, robots
 *
 * @author		Elson Tan (elsodev.com, Twitter: @elsodev)
 * @version     1.0
 */

/**
 * SEO General Meta Tags
 *
 * Generates general meta tags for description, open graph, twitter, robots
 * Using title, description and image link from config file as default
 *
 * @access  public
 * @param   array   enable/disable different meta by setting true/false
 * @param   string  Title
 * @param   string  Description (155 characters)
 * @param   string  Image URL
 * @param   string  Page URL
 */
if(! function_exists('curPageURL')){
    function curPageURL() {
      if(isset($_SERVER["HTTPS"]) && !empty($_SERVER["HTTPS"]) && ($_SERVER["HTTPS"] != 'on' )) {
            $url = 'https://'.$_SERVER["SERVER_NAME"];//https url
      }  else {
        $url =  'http://'.$_SERVER["SERVER_NAME"];//http url
      }
      if(( $_SERVER["SERVER_PORT"] != 80 )) {
         $url .= $_SERVER["SERVER_PORT"];
      }
      $url .= $_SERVER["REQUEST_URI"];
      return $url;
    }
}
if(! function_exists('meta_tags')){
    function meta_tags($enable = array('general' => true, 'og'=> true, 'twitter'=> true, 'robot'=> true), 
        $title = '', $desc = '', $imgUrl ='', $url = '', $keyWords = '', $type = ''){
        $CI =& get_instance();
        $CI->config->load('seo_config');
        $CI->load->model('M_f_beranda');
        $id = $CI->M_f_beranda->get_identitas();
        $output = '';

        //uses default set in seo_config.php
        if($title == ''){
            $title = $CI->config->item('seo_title');
        }
        if($desc == ''){
            $desc = $id->meta_desc;
        }
        if($imgUrl == ''){
            $imgUrl = $CI->config->item('seo_imgurl');
        }
        if($url == ''){
            $url = base_url();
        }
        if($keyWords == '') {
            $keyWords = $id->meta_seo;
        }
        if($type == '') {
            $type = $CI->config->item('seo_type');
        }
        if($enable['general']){
            $output .= '<meta name="viewport" content="width=device-width, initial-scale=1">';
            $output .= '<meta  name="Rating" content="General"/>';
            $output .= '<meta name="Distribution" content="Global" />';
            $output .= '<meta name="audience" content="all" />';
            $output .= '<meta name="SPIDERS" content="ALL"/>';
            $output .= '<meta name="WEBCRAWLERS" content="ALL"/>';
            $output .= '<meta name="geo.placename" content="Indonesia"/>';
            $output .= '<meta name="geo.country" content="id" />';
            $output .= '<meta name="google" content="translate" />';
            $output .= '<meta name="keywords" content="'.$keyWords.'" />';
            $output .= '<meta name="description" content="'.$desc.'" />';
        }
        if($enable['robot']){
            $output .= '<meta name="robots" content="index,follow"/>';
        } else {
            $output .= '<meta name="robots" content="noindex,nofollow"/>';
        }


        //open graph
        if($enable['og']){
            $output .= '<meta property="og:title" content="'.$title.'"/>'
                .'<meta property="og:description" content="'.$desc.'"/>'
                .'<meta property="og:type" content="'.$type.'"/>'
                .'<meta property="og:image" content="'.$imgUrl.'"/>'
                .'<meta property="og:url" content="'.$url.'"/>';
        }

        //twitter card
        if($enable['twitter']){
            $output .= '<meta name="twitter:card" content="summary"/>'
                .'<meta name="twitter:title" content="'.$title.'"/>'
                .'<meta name="twitter:url" content="'.$url.'"/>'
                .'<meta name="twitter:description" content="'.$desc.'"/>'
                .'<meta name="twitter:image" content="'.$imgUrl.'"/>';
        }

        return $output;


    }
}
