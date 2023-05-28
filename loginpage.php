<!DOCTYPE html>
<html>

    <?php 
        error_reporting(E_ALL & ~E_NOTICE);
        session_start();
        if($_SESSION['pagecolor'] == 'green'){
            $cssfile = 'green_gray.css';
        }else if ($_SESSION['pagecolor'] == 'brown'){
            $cssfile = 'brown_gray.css';
        }
    
    ?>

    <head>
        <title>Magyar Konyha - Amitol a szellem is jol lakik</title>
        <link rel="stylesheet" href=<?php echo $cssfile ?>>
    </head>

    <?php
    session_start();
    if(!isset($_SESSION['badlogin'])){
        $_SESSION['badlogin'] = 'false';
    }
    var_dump($_SESSION['badlogin']);

    if($_SESSION['badlogin'] == 'false'){
        echo '<style>#badsignuplogin { display:none; }</style>';
    }
    
    ?>

    <?php 
        error_reporting(E_ALL & ~E_NOTICE);
        session_start();
        if($_SESSION['pagecolor'] == 'green'){
            $pngfile = 'magyarkonyha.png';
        }else if ($_SESSION['pagecolor'] == 'brown'){
            $pngfile = 'magyarkonyha2.png';
        }
    
    ?>
    <body>
        <div id="frame">
            <div id="headerlogin" onclick="window.location.href='mainpage.php';">
                <img src=<?php echo $pngfile ?>>
                <p>AMITOL A SZELLEM IS JOLLAKIK</p>
            </div>
            <div id="loginframe">
                <h1 style="margin-top:50px; margin-left:130px;">Bejelentkezes</h1>
                <form action="login.php" method="post" style="margin-top:70px;">
                    <input class="logininlogin" type="text" name="username" placeholder="Felhasznalonev"><br><br>   
                    <input class="logininlogin" type="password" name="password" placeholder="Jelszo"><br><br>
                    <?php if (isset($error)) { echo '<div class="error">'.$error.'</div>'; } ?>
                    <button type="submit" id="loginbutton">Bejelentkezés</button>
                </form>
                <br/>
                <a id="redirect2signup" href=signuppage.php>Meg nincs fiokja? Regisztraljon</a>
                </br></br></br>
                <a id="badsignuplogin">Helytelen jelszo vagy felhasznalonev!</a>
            </div>
        </div>
    </body>
</html>