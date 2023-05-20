<div id="frame">
    <!--HEADER-->
    <div id="headerleft" onclick="window.location.href='mainpage.php';">
        <!--bal oldali kek dolog-->
        <img src="magyarkonyha.png">
        <p>AMITOL A SZELLEM IS JOLLAKIK</p>
    </div>
        
        <?php
            session_start();
            if (isset($_SESSION['user_id']) && isset($_SESSION['user_type'])) {
                echo '<style>#loginbutton { display:none; }</style>';
                echo '<style>#headerrighttext { display:none; }</style>';
            }
            else{
                echo '<style>#logoutbutton { display:none; }</style>';
                echo '<style>#usernamedisplay { display:none; }</style>';
            }

            //a felhasznalo eleresi koreihez megnezem a tipusat
            if(!isset($_SESSION['user_type'])){
                $_SESSION['user_type'] = 'guest';
            } 
            var_dump($_SESSION['user_type']);

            //displayOption megadja hogy milyen recepteket jelenitsunk meg
            require_once 'db.php';
            $connection = getDb();
            
            echo 'a aaaaaaaaaaaaaaaaaaaaaaaaaaaaa |';
            if (isset($_GET['displayOption'])) {
                $displayOption = mysqli_real_escape_string($connection, $_GET["displayOption"]);
                $_SESSION['displayOption'] = $_GET['displayOption'];
            } else if (!isset($_GET['displayOption'])){
                $_SESSION['displayOption'] = 'all';
            }        
            var_dump($_SESSION['displayOption']);   
            
            //mealtime session valtozo
            if(!isset($_SESSION['mealtime'])){
                $_SESSION['mealtime'] = 'anytime';
            }
            var_dump($_SESSION['mealtime']);
        

        ?>
        <div id="headerright">
            <!--profil-->
            <img src="user.png" id="userimage">
            <a id="headerrighttext">Profil</a>
            <a id="usernamedisplay"> <?php echo $_SESSION['username']; ?></a>
            
            <form action="loginpage.php">
                <button id="loginbutton" type="submit">Bejelentkezes</button>
            </form>
            <form action="logout.php">              <!--valamiert csak igy latja-->          
                <button id="logoutbutton" style="width: 100px; 
                                                    height: 30px;
                                                    background-color: rgb(76, 134, 136);
                                                    border: 0px;
                                                    border-radius: 12px;
                                                    cursor: pointer;
                                                    position:relative;
                                                    top:10px;

                                                    font-size: 12px;
                                                    color:white;
                                                    font-weight: bold;
                                                    font-family: 'Arial';" type="submit">Kijelentkezes</button>
            
            </form>
        </div>

    <?php 
        if($_SESSION['user_type'] == 'guest'){
            $redirect = 'loginpage.php';
        }
        else $redirect = 'newrecipepage.php'
    ?>
    <div id="menubox">
        <a class="custom-button" href=mainpage.php>Fooldal</a>
        <a class="custom-button" href=<?php echo $redirect; ?>>Recept feltoltes</a> 
        <a class="custom-button" href="mainpage.php?displayOption=favorites">Kedvencek</a>
    </div>
</div>
