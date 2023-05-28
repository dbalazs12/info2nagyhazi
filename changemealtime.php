<?php
    session_start();
    if(isset($_POST['mealtime'])){
        $_SESSION['displayOption'] = $_POST['mealtime'];
    }

    header("Location: mainpage.php");
    exit();
?>