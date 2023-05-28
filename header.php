<div id="frame">
    <!--HEADER-->
    <?php 
        error_reporting(E_ALL & ~E_NOTICE);
        session_start();
        if($_SESSION['pagecolor'] == 'green'){
            $pngfile = 'magyarkonyha.png';
            $userpngfile = 'user.png';
        }else if ($_SESSION['pagecolor'] == 'brown'){
            $pngfile = 'magyarkonyha2.png';
            $userpngfile = 'user2.png';
        }
    
    ?>
    <div id="headerleft" onclick="window.location.href='changetoall.php';">
        <!--bal oldali kek dolog-->
        <img src=<?php echo $pngfile ?>>
        <p>AMITOL A SZELLEM IS JOLLAKIK</p>
    </div>
        
        <?php
            session_start();
            if(!isset($_SESSION['user_type'])){
                $_SESSION['user_type'] = 'guest';
            }
            echo 'a aaaaaaaaaaaaaaaaaaaaaaaaaaaaa |';
            
            if (isset($_SESSION['user_id']) && isset($_SESSION['user_type'])) {
                echo '<style>#headerloginbutton { display:none; }</style>';
                echo '<style>#headerrighttext { display:none; }</style>';
            }
            else{
                echo '<style>#smalllogoutbutton { display:none; }</style>';
                echo '<style>#usernamedisplay { display:none; }</style>';
            }

            if($_SESSION['user_type'] != 'admin'){
                echo '<style>#adminbutton { display:none; }</style>';
            }

            //a felhasznalo eleresi koreihez megnezem a tipusat
            if(!isset($_SESSION['user_type'])){
                $_SESSION['user_type'] = 'guest';
            } 
            var_dump($_SESSION['user_type']);

            if(!isset($_SESSION['user_id'])){
                $_SESSION['user_id'] = NULL;
            } 

            //displayOption megadja hogy milyen recepteket jelenitsunk meg
            require_once 'db.php';
            $connection = getDb();
        
            if (!isset($_SESSION['displayOption'])){
                $_SESSION['displayOption'] = 'all';
            }        
            var_dump('.     displaygeci:  ' . $_SESSION['displayOption']);   
        
            //keresogomb alapbeallitas
            if(!isset($_SESSION['searchline'])){
                $_SESSION['searchline'] = NULL;
            }
            var_dump($_SESSION['searchline']);
            var_dump($_SESSION['user_type']);

            //pagecolor beallitasa
            if(!isset($_SESSION['pagecolor'])){
                $_SESSION['pagecolor'] = 'green';
            }
            var_dump($_SESSION['pagecolor']);


        ?>
        <div id="headerright">
            <!--profil-->
            <img src=<?php echo $userpngfile?> id="userimage">
            <a id="headerrighttext">Profil</a>
            <a id="usernamedisplay"> <?php echo $_SESSION['username']; ?></a>
            
            <form action="loginpage.php">
                <button id="headerloginbutton" type="submit">Bejelentkezes</button>
            </form>
            <form action="logout.php">              <!--valamiert csak igy latja-->          
                <button id="smalllogoutbutton" type="submit">Kijelentkezes</button>
            
            </form>
            <form action="adminpage.php">
                <button id="adminbutton" type="submit">Moderacio</button>
            </form>
            <form action="updatecolor.php" method="post">
                <button type="submit" id="colorbuttongreen" name="colorbutton" value="green"></button>
                <button type="submit" id="colorbuttonbrown" name="colorbutton" value="brown"></button>
            </form>
            
        </div>

    <?php 
        if($_SESSION['user_type'] == 'guest'){
            $redirectupload = 'loginpage.php';
            $redirectfavorites = 'loginpage.php';
        }
        else {
            $redirectupload = 'newrecipepage.php';
            $redirectfavorites = 'mainpage.php?displayOption=favorites';
        }
    ?>
    <div id="menubox">
        <a class="custom-button" href=changetoall.php>Fooldal</a>
        <a class="custom-button" href=<?php echo $redirectupload; ?>>Recept feltoltes</a> 
        <a class="custom-button" href=changetofavorites.php>Kedvencek</a>
    </div>
</div>
