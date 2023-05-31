<!DOCTYPE html>
<html>

    <?php 
        error_reporting(E_ALL & ~E_NOTICE); //dupla session start miatt, valamiert csak igy mukodik
        session_start();
        //megjelenes allitasa
        if($_SESSION['pagecolor'] == 'green'){
            $cssfile = 'green_gray.css';
            $pngfile = 'magyarkonyha.png';
        }else if ($_SESSION['pagecolor'] == 'brown'){
            $cssfile = 'brown_gray.css';
            $pngfile = 'magyarkonyha2.png';
        }
    
    ?>

    <head>
        <title>Magyar Konyha - Amitől a szellem is jól lakik</title>
        <link rel="stylesheet" href=<?php echo $cssfile ?>>
    </head>

    <?php
    session_start();
    // ha jo a login ne irja ki a hibat
    if(!isset($_SESSION['badlogin'])){
        $_SESSION['badlogin'] = 'false';
    }


    if($_SESSION['badlogin'] == 'false'){
        echo '<style>#badsignuplogin { display:none; }</style>';
    }
    
    ?>

    <?php 
        error_reporting(E_ALL & ~E_NOTICE); //dupla session start miatt, valamiert csak igy mukodik
        session_start();
        //ha valtogatok a login es signup kozott tunjon el a hibasor
        $_SESSION['usedsignup'] = 'false';
        $_SESSION['badsignup'] = 'false';
    
    ?>
    <body>
        <div id="frame">
            <div id="headerlogin" onclick="window.location.href='mainpage.php';">
                <img src=<?php echo $pngfile ?>>
                <p>AMITŐL A SZELLEM IS JÓLLAKIK</p>
            </div>
            <div id="loginframe">
                <h1 style="margin-top:50px; margin-left:130px;">Bejelentkezés</h1>
                <form action="login.php" method="post" style="margin-top:70px;">
                    <input class="logininlogin" type="text" name="username" placeholder="Felhasznalonev"><br><br>   
                    <input class="logininlogin" type="password" name="password" placeholder="Jelszo"><br><br>
                    <button type="submit" id="loginbutton">Bejelentkezés</button>
                </form>
                <br/>
                <a id="redirect2signup" href=signuppage.php>Még nincs fiókja? Regisztráljon</a>
                </br></br></br>
                <a id="badsignuplogin">Helytelen jelszó vagy felhasználónév!</a>
            </div>
        </div>
    </body>
</html>