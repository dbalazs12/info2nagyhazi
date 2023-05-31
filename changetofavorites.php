<?php
    session_start();
    if($_SESSION['user_type'] == 'guest'){
        header("Location: loginpage.php");
        exit();
    }else{
        $_SESSION['displayOption'] = "favorites";
        header("Location: mainpage.php");
        exit();
    }
    
    
?>