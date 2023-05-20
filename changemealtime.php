<?php
    session_start();
    if ($_SERVER['REQUEST_METHOD'] === 'post') {
        if (isset($_POST['mealtime'])) {
            $_SESSION['mealtime'] = $_POST['mealtime'];
        }
    }

    header("Location: mainpage.php");
    exit();
?>