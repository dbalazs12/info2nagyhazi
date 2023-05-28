<?php
    session_start(); 
    
    if (isset($_POST['search'])) {
        $line = $_POST['search'];
        $_SESSION['searchline'] = $line;
    }

    header("Location: mainpage.php");
    exit();
?>