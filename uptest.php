<?php

$pic = $_FILES["pic"]["tmp_name"];
$name = $_FILES["pic"]["name"];
$stream = fopen($pic,'r');
$order = rand(1,5);
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://content.dropboxapi.com/2/files/upload",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_FOLLOWLOCATION => TRUE,
  CURLOPT_SSL_VERIFYPEER => false,
  CURLOPT_BINARYTRANSFER => true,
  CURLOPT_INFILE => $stream,
//CURLOPT_INFILESIZE => $dataLength,
  CURLOPT_UPLOAD => 1,
/*
  CURLOPT_POSTFIELDS => json_encode($data),
  CURLOPT_POSTFIELDS => @a.png,
*/
  CURLOPT_HTTPHEADER => array(
    "authorization: Bearer bPb_t-TFVAAAAAAAAAAAIHgSwitXtZuh6lNpLAjrof1GExsrOljTc_6XcIq7zK23",
    "content-type: application/octet-stream",
    "dropbox-api-arg: {\"path\":\"/".$order."/".$name."\"}"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}