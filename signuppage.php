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
        <title>Magyar Konyha - Amitől a szellem is jól lakik</title>
        <link rel="stylesheet" href=<?php echo $cssfile ?>>
    </head>
    
    <?php
    session_start();
    
    //rosszul beirt
    if(!isset($_SESSION['badsignup'])){
        $_SESSION['badsignup'] = 'false';
    }

    // ha minden jo ne legyen hiba
    if($_SESSION['badsignup'] == 'false'){
        echo '<style>#badsignuplogin { display:none; }</style>';
    }
    
    //mar letezo felhasznalo hiba
    if(!isset($_SESSION['usedsignup'])){
        $_SESSION['usedsignup'] = 'false';
    }

    // ha minden jo ne legyen hiba
    if($_SESSION['usedsignup'] == 'false'){
        echo '<style>#signuperror { display:none; }</style>';
    }

    ?>

    <?php 
        error_reporting(E_ALL & ~E_NOTICE);
        session_start();
        //megjelenes beallitasa
        if($_SESSION['pagecolor'] == 'green'){
            $pngfile = 'magyarkonyha.png';
        }else if ($_SESSION['pagecolor'] == 'brown'){
            $pngfile = 'magyarkonyha2.png';
        }
    
    ?>
    <body>
        <div id="frame">
            <div id="headerlogin" onclick="window.location.href='mainpage.php';">
                <img src=<?php echo $pngfile?>>
                <p>AMITŐL A SZELLEM IS JÓLLAKIK</p>
            </div>

            <div id="loginframe">
                <h1 style="margin-top:50px; margin-left:140px;">Regisztrácio</h1>
                <!-- signup form -->
                <form action=signup.php method="post" style="margin-top:70px;">
                    <input class="logininlogin" type="email" name="email" placeholder="E-mail cim"></br></br>
                    <input class="logininlogin" type="text" name="username" placeholder="Felhasznalonev"></br></br>
                    <input class="logininlogin" type="password" name="password" placeholder="Jelszo"></br></br>
                    <button type="submit" name="submit" id="loginbutton">Regisztrácio</button>
                </form>
                <br/>
                <a id="redirect2signup" href="loginpage.php">Már van fiókja? Jelentkezzen be!</a>
                <br/><br/>
                <!-- hibauzenetek -->
                <a id="badsignuplogin">Helytelen jelszó vagy felhasználónév!</a>
                <a id="signuperror">Foglalt e-mail cim vagy felhasznalónáv!</a>
            </div> 
        </div>
    </body>
</html>