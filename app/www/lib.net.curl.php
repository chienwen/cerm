<?php
    define("USER_AGENT","Opera/9.80 (Windows NT 6.1; U; zh-TW) Presto/2.9.181 Version/12.00");

//function curlFetch($url, $postData=false, $referer=false, $headers=false){
//	return shell_exec('wget -O - --user-agent="' . USER_AGENT . '" --no-check-certificate "' . $url . '"');
//}

function curlFetch($url, $postData=false, $referer=false, $headers=false){
	$ch = curl_init();
	if($postData!==false){ 
		curl_setopt($ch, CURLOPT_POST,1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData)); 
	}
	if($referer===false){
		$referer = "http://www.yahoo.com/";
	}
	//curl_setopt($ch, CURLOPT_REFERER, $referer);

	if(!empty($headers)){
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	}

	curl_setopt($ch, CURLOPT_USERAGENT, USER_AGENT);
	curl_setopt($ch, CURLOPT_URL,$url); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true );
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false );

	$data=curl_exec($ch);
	curl_close($ch);
	return $data;
}

