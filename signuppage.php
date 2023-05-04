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
                <!--bal oldali kek dolog-->
                <img src="magyarkonyha.png">
                <p>AMITOL A SZELLEM IS JOLLAKIK</p>
            </div>

            <div id="loginframe">
                <h1 style="margin-top:50px;">Regisztracio</h1>
                <form action=signup.php method="post" style="margin-top:70px;">
                    <input class="logininlogin" type="email" name="email" placeholder="E-mail cim"></br></br>
                    <input class="logininlogin" type="text" name="username" placeholder="Felhasznalonev"></br></br>
                    <input class="logininlogin" type="password" name="password" placeholder="Jelszo"></br></br>
                    <button type="submit" name="submit" id="loginbutton">Regisztracio</button>
                </form>
                <br/>
                <a id="redirect2signup" href="loginpage.php">Mar van fiokja? Jelentkezzen be!</a>
            </div> 
        </div>
    </body>
</html>