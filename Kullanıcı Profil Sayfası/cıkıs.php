<?php

session_start();
session_destroy();


setcookie("cerez", "", time()-3600);

header("location:giris.php");
?>
