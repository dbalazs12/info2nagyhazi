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
    
    //rosszul beirt
    if(!isset($_SESSION['badsignup'])){
        $_SESSION['badsignup'] = 'false';
    }
    var_dump($_SESSION['badsignup']);

    if($_SESSION['badsignup'] == 'false'){
        echo '<style>#badsignuplogin { display:none; }</style>';
    }
    

    //mar letezo reg
    if(!isset($_SESSION['usedsignup'])){
        $_SESSION['usedsignup'] = 'false';
    }
    var_dump('hasznalt = ' . $_SESSION['usedsignup']);

    if($_SESSION['usedsignup'] == 'false'){
        echo '<style>#signuperror { display:none; }</style>';
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
                <!--bal oldali kek dolog-->
                <img src=<?php echo $pngfile?>>
                <p>AMITOL A SZELLEM IS JOLLAKIK</p>
            </div>

            <div id="loginframe">
                <h1 style="margin-top:50px; margin-left:140px;">Regisztracio</h1>
                <form action=signup.php method="post" style="margin-top:70px;">
                    <input class="logininlogin" type="email" name="email" placeholder="E-mail cim"></br></br>
                    <input class="logininlogin" type="text" name="username" placeholder="Felhasznalonev"></br></br>
                    <input class="logininlogin" type="password" name="password" placeholder="Jelszo"></br></br>
                    <button type="submit" name="submit" id="loginbutton">Regisztracio</button>
                </form>
                <br/>
                <a id="redirect2signup" href="loginpage.php">Mar van fiokja? Jelentkezzen be!</a>
                <br/><br/>
                <a id="badsignuplogin">Helytelen jelszo vagy felhasznalonev!</a>
                <a id="signuperror">Foglalt e-mail cim vagy felhasznalonev!</a>
            </div> 
        </div>
    </body>
</html>