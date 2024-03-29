<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if ( ! function_exists('script_tag')) {
    function script_tag($src = '', $language = 'javascript', $type = 'text/javascript', $index_page = FALSE)
    {
        $CI =& get_instance();
        $script = '<scr'.'ipt';
        if (is_array($src)) {
            foreach ($src as $k=>$v) {
                if ($k == 'src' AND strpos($v, '://') === FALSE) {
                    if ($index_page === TRUE) {
                        $script .= ' src="'.$CI->config->site_url($v).'"';
                    }
                    else {
                        $script .= ' src="'.$CI->config->slash_item('base_url').$v.'"';
                    }
                }
                else {
                    $script .= "$k=\"$v\"";
                }
            }

            $script .= "></scr"."ipt>\n";
        }
        else {
            if ( strpos($src, '://') !== FALSE) {
                $script .= ' src="'.$src.'" ';
            }
            elseif ($index_page === TRUE) {
                $script .= ' src="'.$CI->config->site_url($src).'" ';
            }
            else {
                $script .= ' src="'.$CI->config->slash_item('base_url').$src.'" ';
            }

            $script .= 'language="'.$language.'" type="'.$type.'"';
            $script .= '></scr'.'ipt>'."\n";
        }
        return $script;
    }
}