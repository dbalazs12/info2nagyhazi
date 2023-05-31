<?php
    session_start();

    if (isset($_POST['colorbutton'])) {
        $color = $_POST['colorbutton'];
        $_SESSION['pagecolor'] = $color;
    }

    header("Location: mainpage.php");
    exit();
?>