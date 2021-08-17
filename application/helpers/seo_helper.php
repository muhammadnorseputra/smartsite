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
      if(isset($_SERVER["HTTPS"]) && !empty($_SERVER["HTTPS"]) && ($_SERVER["HTTPS"] != 'off' )) {
            $url = 'https://'.$_SERVER["SERVER_NAME"];//https url
      }  else {
        $url =  'http://'.$_SERVER["SERVER_NAME"];//http url
      }
      // if(( $_SERVER["SERVER_PORT"] != 80 )) {
      //    $url .= ":".$_SERVER["SERVER_PORT"];
      // }
      $url .= $_SERVER["REQUEST_URI"];
      return $url;
    }
}
if(! function_exists('strip_only_tags')){
    function strip_only_tags($str, $stripped_tags = null) {
      // Tidak ada tag yang dihapus
      if ($stripped_tags == null) {
        return $str;
      }
      // Dapatkan daftar tag
      // Misal: <b><i><u> menjadi array('b','i','u')
      $tags = explode('>', str_replace('<', '', $stripped_tags));
      $result = preg_replace('#</?(' . implode('|', $tags) . ').*?>#is', '', $str);
      return $result;
    }

}
if(! function_exists('meta_tags')){

    function meta_tags($enable = ['general' => false, 'og'=> false, 'twitter'=> false, 'robot'=> false], 
        $title = '', 
        $metadesc = '', 
        $imgUrl = '', 
        $url = '', 
        $keyWords = '', 
        $type = '', 
        $canonical = '',
        $urlamp = ''){

        $CI =& get_instance();
        $CI->config->load('seo_config');
        $CI->load->model('M_f_beranda');
        $CI->load->library('user_agent'); // load library 
        // MOBILE DEVICE
        $mobile = $CI->agent->is_mobile();

        // GET ID
        $id = $CI->M_f_beranda->get_identitas();
        $output = '';

        $app_id = '165462475462282';
        
        //uses default set in seo_config.php
        $title      = $title == '' ? $CI->config->item('seo_title') : $title;
        $desc       = $metadesc == '' ? $id->meta_desc : $metadesc;
        $imgUrl     = $imgUrl == '' ? $CI->config->item('seo_imgurl') : $imgUrl;
        $url        = $url == '' ? base_url('beranda') : $url;
        $keyWords   = $keyWords == '' ? $id->meta_seo : $keyWords;
        $type       = $type == '' ? $CI->config->item('seo_type') : $type;
        $canonical  = $canonical == '' ? base_url('beranda') : $canonical;
        $urlamp     = $urlamp == '' ? base_url('amp') : $urlamp;

        if($enable['general']){
            $output .= '<link rel="canonical" href="'.$canonical.'" />';
            $output .= '<link rel="amphtml" href="'.$urlamp.'" data-component-name="amp:html:link">';
            // $output .= '<link rel="canonical" href="'.$canonical.'" />';
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
            $output .= '<meta http-equiv="content-language" content="In-Id" />';
        }

        if($enable['robot']){
            $output .= '<meta name="robots" content="max-image-preview:large, index,follow"/>'
                    .'<meta name="googlebot-news" content="max-image-preview:large, index, follow" />'
                    .'<meta  name="googlebot" content="max-image-preview:large, index, follow" />';
        } else {
            $output .= '<meta name="robots" content="noindex,nofollow"/>';
        }

        //open graph
        if($enable['og']){
            $output .= '<meta property="og:type" content="'.$type.'" />'
                .'<meta property="og:url" content="'.$url.'" />'
                .'<meta property="og:title" content="'.$title.'" />'
                .'<meta property="og:description" content="'.$desc.'" />'
                .'<meta property="og:image" content="'.$imgUrl.'" />'
                .'<meta property="og:site_name" content="web.bkppd-balangnakab.info" />'
                .'<meta property="fb:page_id" content="'.$app_id.'" />';
        }

        //twitter card
        if($enable['twitter']){
            $output .= '<meta name="twitter:card" content="summary_large_image"/>'
                .'<meta name="twitter:title" content="'.$title.'"/>'
                .'<meta name="twitter:site" content="@norsptra" />'
                .'<meta name="twitter:creator" content="@norsptra">'
                .'<meta name="twitter:url" content="'.$url.'"/>'
                .'<meta name="twitter:description" content="'.$desc.'"/>'
                .'<meta name="twitter:image" content="'.$imgUrl.'"/>';
        }

        return $output;


    }
}
