<?php

namespace CurlTransmitter;

class CurlTransmitter
{
    private function get_curl($url)
    {
        if(function_exists('curl_init')) {
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
			$output = curl_exec($ch);
			echo curl_error($ch);
			curl_close($ch);
			return $output;
		} else {
			if (!$content = @file_get_contents($url)) {
				$error = error_get_last();
				throw new Exception('HTTP request failed. Error: ' . $error['message']);
			}
			return $content;
		}
    }

    public function getData($url, $params)
    {  
        return $this->get_curl($url.'?'.http_build_query($params));
        
    }
}
?>