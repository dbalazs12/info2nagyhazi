<?php
    session_start();
    $_SESSION['displayOption'] = "favorites";
    header("Location: mainpage.php");
    exit();
?>