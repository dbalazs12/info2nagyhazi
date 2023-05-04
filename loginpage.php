<!DOCTYPE html>
<html>
    <head>
        <title>Magyar Konyha - Amitol a szellem is jol lakik</title>
        <link rel="stylesheet" href="mainpagestyle.css"/>
        <link rel="stylesheet" href="login.css"/>
    </head>

    <body>
        <div id="frame">
            <div id="headerlogin" onclick="window.location.href='mainpage.php';">
                <img src="magyarkonyha.png">
                <p>AMITOL A SZELLEM IS JOLLAKIK</p>
            </div>
            <div id="loginframe">
                <h1 style="margin-top:50px;">Bejelentkezes</h1>
                <form action="login.php" method="post" style="margin-top:70px;">
                    <input class="logininlogin" type="text" name="username" placeholder="Felhasznalonev"><br><br>   
                    <input class="logininlogin" type="password" name="password" placeholder="Jelszo"><br><br>
                    <?php if (isset($error)) { echo '<div class="error">'.$error.'</div>'; } ?>
                    <button type="submit" id="loginbutton">Bejelentkezés</button>
                </form>
                <br/>
                <a id="redirect2signup" href=signuppage.php>Meg nincs fiokja? Regisztraljon</a>

            </div>
        </div>
    </body>
</html>