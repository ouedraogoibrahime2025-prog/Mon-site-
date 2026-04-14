<?php

$lng = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);

$langs_arr = array("en", "fr", "it", "de", "es", "nl", "cn", "pt", "kr", "jp", "fi", "ru");
if(in_array($lng, $langs_arr)){
    require __DIR__.'/langs/'.$lng.'.php';
}else{
    require __DIR__.'/langs/en.php';
}


?>
