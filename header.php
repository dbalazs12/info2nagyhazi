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
        <!--bal oldal-->
        <img src=<?php echo $pngfile ?>>
        <p>AMITŐL A SZELLEM IS JÓLLAKIK</p>
    </div>
        
        <?php
            session_start();
            //ha nincs bejelentkezve legyen vendeg
            if(!isset($_SESSION['user_type'])){
                $_SESSION['user_type'] = 'guest';
            }
            

            //ha be van jelentkezve valtozzon meg a bejelentkezes gomb kijelentkezesre
            if (isset($_SESSION['user_id']) && isset($_SESSION['user_type'])) {
                echo '<style>#headerloginbutton { display:none; }</style>';
                echo '<style>#headerrighttext { display:none; }</style>';
            }
            else{
                echo '<style>#smalllogoutbutton { display:none; }</style>';
                echo '<style>#usernamedisplay { display:none; }</style>';
            }
            
            // adminpage gomb
            if($_SESSION['user_type'] != 'admin'){
                echo '<style>#adminbutton { display:none; }</style>';
            }

            if(!isset($_SESSION['user_id'])){
                $_SESSION['user_id'] = NULL;
            } 

            //displayOption megadja hogy milyen recepteket jelenitsunk meg
            require_once 'db.php';
            $connection = getDb();
        
            if (!isset($_SESSION['displayOption'])){
                $_SESSION['displayOption'] = 'all';
            }         
        
            //keresogomb alapbeallitas
            if(!isset($_SESSION['searchline'])){
                $_SESSION['searchline'] = NULL;
            }

            //pagecolor beallitasa
            if(!isset($_SESSION['pagecolor'])){
                $_SESSION['pagecolor'] = 'green';
            }

        ?>
        <!-- jobb oldal -->
        <div id="headerright">
            <!--profil-->
            <img src=<?php echo $userpngfile?> id="userimage">
            <a id="headerrighttext">Profil</a>
            <a id="usernamedisplay"> <?php echo $_SESSION['username']; ?></a>
            
            <!--gombok-->
            <form action="loginpage.php">
                <button id="headerloginbutton" type="submit">Bejelentkezés</button>
            </form>
            <form action="logout.php">              <!--valamiert csak igy latja-->          
                <button id="smalllogoutbutton" type="submit">Kijelentkezés</button>
            
            </form>
            <form action="adminpage.php">
                <button id="adminbutton" type="submit">Moderáció</button>
            </form>
            <form action="updatecolor.php" method="post">
                <button type="submit" id="colorbuttongreen" name="colorbutton" value="green"></button>
                <button type="submit" id="colorbuttonbrown" name="colorbutton" value="brown"></button>
            </form>
            
        </div>
    <!-- header alatti bar -->
    <?php 
        if($_SESSION['user_type'] == 'guest'){
            $redirectupload = 'loginpage.php';
        }
        else {
            $redirectupload = 'newrecipepage.php';
        }
    ?>
    <div id="menubox">
        <a class="custom-button" href=changetoall.php>Főoldal</a>
        <a class="custom-button" href=<?php echo $redirectupload; ?>>Recept feltöltés</a> 
        <a class="custom-button" href=changetofavorites.php>Kedvencek</a>
    </div>
</div>
