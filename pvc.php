<?php

$ch = curl_init();

  curl_setopt($ch, CURLOPT_URL, "https://wikimedia.org/api/rest_v1/metrics/pageviews/top/en.wikipedia/all-access/2022/04/03");
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
  curl_setopt($ch, CURLOPT_POST, true);
 // curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
  


  $headers = array();
  $headers[] = "Content-Type: application/json";
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

  $result = json_decode(curl_exec($ch), TRUE);
  if (curl_errno($ch)) {
      echo 'Error:' . curl_error($ch);
  }
  curl_close ($ch);
	echo"<pre>";
    print_r($result); // data should be here
	echo"</pre>";
    exit('hazaa');
?>