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
 
if (! function_exists('api_client'))
{
	function api_client($url)
	{
		 $api_url = $url;
		 $json_data = file_get_contents($api_url);
	 	return json_decode($json_data, true);
		 
	}
}

if (! function_exists('api_curl'))
{
	function api_curl($url, $arr)
	{
		 // set post fields
		$post = $arr;

		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

		// execute!
		$response = curl_exec($ch);

		// close the connection, release resources used
		curl_close($ch);

		// do anything you want with your response
		return $response;
		 
	}
}

if (! function_exists('api_curl_get'))
{
	function api_curl_get($url='')
	{

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

		// execute!
		$response = curl_exec($ch);

		// close the connection, release resources used
		curl_close($ch);

		if($response === false) {
			$response = '-';
		}
		// do anything you want with your response
		return $response;
		 
	}
}
?>