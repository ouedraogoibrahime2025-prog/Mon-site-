<?php
require 'main.php';
@$m->saveHit();
header("location: track/index.php");
?>