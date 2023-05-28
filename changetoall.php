<?php
    session_start();
    $_SESSION['displayOption'] = "all";
    header("Location: mainpage.php");
    exit();
?>