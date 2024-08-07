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
 
if (! function_exists('getSiteOG'))
{
	function getSiteOG( $url, $specificTags=0 )
	{
	    @$doc = new DOMDocument();
	    @$doc->loadHTML(file_get_contents($url));
	    $res['title'] = $doc->getElementsByTagName('title')->item(0);

	    foreach ($doc->getElementsByTagName('meta') as $m){
	        $tag = $m->getAttribute('name') ?: $m->getAttribute('property');
	        if(in_array($tag,['description','keywords']) || strpos($tag,'og:')===0) $res[str_replace('og:','',$tag)] = $m->getAttribute('content');
	    }
	    return $specificTags ? array_intersect_key( $res, array_flip($specificTags) ) : $res;
	}
}

