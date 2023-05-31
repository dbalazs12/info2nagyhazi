<!DOCTYPE html>
<html>

    <?php 
        error_reporting(E_ALL & ~E_NOTICE);
        session_start();
        //megjelenes beallitasa
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
    
    
    <body>
        <?php 
            include('header.php');
            
        ?>
        
        <div id="frame">
            <div id="receptkereso">
                <!--receptkereso-->
                
                <form action="search.php" method="post">
                    <input id="search" name="search" type="text" placeholder="Keresés">
                </form>
                <div id="receptkeresotext">
                    <p>Receptkereso</p>
                </div>
            </div>
            <!-- a recepteket megjelenito frame -->
            <div id="receptframe">
                <?php
                
                    require_once 'db.php';
                    require_once 'displayrecipes.php';

                    $connection = getDb();
                    $nores = true;

                    //ha van kereses akkor azokat jelenitse meg
                    if($_SESSION['searchline'] != NULL){ 
                        $searchline = $_SESSION['searchline'];
                        $query = "SELECT * FROM recipes WHERE recipe_name LIKE '%$searchline%'";
                        $result = mysqli_query($connection, $query);
                        if (mysqli_num_rows($result) > 0) {
                            displayRecipes($result);
                            $nores = false;
                        }
                        $_SESSION['searchline'] = NULL;
                    // alapbeallitas, minden jelenjen meg
                    }else if($_SESSION['displayOption'] == 'all'){
                        $query = "SELECT * FROM recipes";
                        $result = mysqli_query($connection, $query);
                        if (mysqli_num_rows($result) > 0) {
                            displayRecipes($result);
                            $nores = false;
                        }
                    // csak a kedvencek jelenjenek meg
                    }else if($_SESSION['displayOption'] == 'favorites'){
                        $query = "SELECT * FROM favorites WHERE user_id = '" . $_SESSION['user_id'] . "'";;
                        $result = mysqli_query($connection, $query);
                        if (mysqli_num_rows($result) > 0) {
                            displayRecipes($result);
                            $nores = false;
                        }
                    // csak a reggeli jelenjen meg
                    }else if($_SESSION['displayOption'] == 'breakfast'){
                        $query = "SELECT * FROM recipes WHERE mealtime = 'breakfast'";
                        $result = mysqli_query($connection, $query);
                        if (mysqli_num_rows($result) > 0) {
                            displayRecipes($result);
                            $nores = false;
                        }
                    // csak az ebed jelenjen meg
                    }else if($_SESSION['displayOption'] == 'lunch'){
                        $query = "SELECT * FROM recipes WHERE mealtime = 'lunch'";
                        $result = mysqli_query($connection, $query);
                        if (mysqli_num_rows($result) > 0) {
                            displayRecipes($result);
                            $nores = false;
                        }
                    // csak a vacsora jelenjen meg
                    }else if($_SESSION['displayOption'] == 'dinner'){
                        $query = "SELECT * FROM recipes WHERE mealtime = 'dinner'";
                        $result = mysqli_query($connection, $query);
                        if (mysqli_num_rows($result) > 0) {
                            displayRecipes($result);
                            $nores = false;
                        }
                    }
                    // ha a keresesnel (vagy barmikor) nincs talalat irja ki
                    if($nores == true){
                        echo  '<h2 id="nohit">Nincs talalat!</h2>';
                    }
                    mysqli_close($connection);
                   
                ?>

                
            </div>
            <!-- veletlen recept gomb -->                     
            <div id="randomrecept">
                
                <div id="randomrecepttext">
                    <p>Veletlen recept</p>
                </div>
                <form action="random_recipe.php">
                    <button id="randombutton" type="submit">Lepj meg!</button>
                </form>
            </div>
            <!-- reggeli, ebed, vacsora gombok -->
            <div id="category">  
                <div id="randomrecepttext">
                    <p>Rendezes</p>
                </div>

                <form action="changemealtime.php" method="post">
                    <button class="timeofdaybutton" type="submit" name="mealtime" value="breakfast">Reggeli</button>
                </form>

                <form action="changemealtime.php" method="post">
                    <button class="timeofdaybutton" type="submit" name="mealtime" value="lunch">Ebéd</button>
                </form>

                <form action="changemealtime.php" method="post">
                    <button class="timeofdaybutton" type="submit" name="mealtime" value="dinner">Vacsora</button>
                </form>
                
            </div>
        </div>
        <?php include('footer.php'); ?>
    </body>
</html>