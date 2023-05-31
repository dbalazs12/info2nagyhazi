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
        <?php include('header.php'); ?>
        <div id="frame">
            <div id="displayframe">
                <?php 
                    //delete es favorite gomb elrejtes
                    if (isset($_SESSION['user_type'])) {
                        if ($_SESSION['user_type'] == 'guest') {
                            echo '<style>#deletebutton { display:none; }</style>';
                            echo '<style>#favoritebutton { display:none; }</style>';
                            echo '<style>#modifybutton { display:none; }</style>';
                        }
                    //modositas gomb elrejtes
                    if ($_SESSION['user_type'] == 'common') {
                        $recipe_id = $_GET['id'];
                        $user_id = $_SESSION['user_id'];
                        $query = "SELECT * FROM user_recipes WHERE recipe_id = '$recipe_id' AND user_id = '$user_id'";
                        $result = mysqli_query($connection, $query);
                    
                        if (mysqli_num_rows($result)  == 0) {       
                            echo '<style>#modifybutton { display: none; }</style>';
                            echo '<style>#deletebutton { display:none; }</style>';
                        }
                        
                    }

                    //kinezet miatt kell
                    if ($_SESSION['user_type'] == 'admin'){
                        echo '<style>#modifybutton { bottom:30px; }</style>';
                    }

                    //kedvenc valtas
                    $recipe_id = $_GET['id'];
                    $user_id = $_SESSION['user_id'];
                    
                    $query = "SELECT * FROM favorites WHERE user_id = '$user_id' AND recipe_id = '$recipe_id'";
                    $result = mysqli_query($connection, $query);
                    // annak a felteteleben hogy benne van a kedvencekben melyik gomb jelenjen meg
                    if ($result->num_rows > 0) {
                        echo '<style>#favoritebutton { display:none; }</style>';
                    }else{
                        echo '<style>#removefavoritebutton { display:none; }</style>';
                    }
                }   
                ?>
                
                <?php
                    require_once('db.php');

                    $connection = getDb();
                    
                    $sql = "SELECT * FROM recipes WHERE recipe_id = 1";
                    $result = mysqli_query($connection, $sql);
                    if(isset($_GET['id'])){
                        
                        // a linkbol kiolvasom a megfelelo id-t
                        $recipe_id = $_GET['id'];
                        $sql = "SELECT * FROM recipes WHERE recipe_id = $recipe_id";
                        $result = mysqli_query($connection, $sql);
                             

                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<div id='recipe'>";
                            
                            echo "<div id='recipenamerow'>";
                                
                                    echo "<h1>" . $row['recipe_name'] . "</h1>";
                              
                                
                            echo "</div>";
                            
                            echo "<img id='recipeimage' src='" . $row['recipe_image'] . "'>";
                           
                            echo "</br>";
                            echo "<div id='general'>";
                                echo "<div id='generalinfo'>";
                                    echo "Információk";
                                echo "</div>";
                                
                                echo "<p>Előkészítési idő: " . $row['preparation_time'] . " perc</p>";
                                echo "<p>Elkészítési idő: " . $row['cooking_time'] . " perc</p>";
                                echo "<p>Adag: " . $row['serving_size'] . ' fő' . "</p>";
                                echo "<p>Hozzávalók:</p>";
                                echo "<ul>";
                                //ezzel tudom kulon sorba irni
                                $ingredients = explode(",", $row['ingredients']);
                                foreach ($ingredients as $ingredient) {
                                    echo "<li>" . trim($ingredient) . "</li>";
                                }
                                echo "</br>";
                            echo "</div>";

                            echo "<div id='instructions'>";
                                echo "<div id='instructiontext'>";
                                    echo "Elkészítés";
                                echo "</div>";
                                echo "</br></br></br>";
                                echo $row['instructions'];
                            echo "</div>";
                            // kedvenc-kivetel kedvencekbol- torles- modositas gomb
                            echo "<div id='buttonrow'>";
                                    echo "<form action='addtofavorite.php' method='post'>";
                                        echo "<input type='hidden' name='recipe_id' value='" . $row['recipe_id'] . "'>";    
                                        echo "<button id='favoritebutton' name='submitfavorite'>Kedvencekbe</button>";
                                    echo "</form>";
                                    echo "<form action='removefavorite.php' method='post'>";
                                        echo "<input type='hidden' name='recipe_id' value='" . $row['recipe_id'] . "'>";    
                                        echo "<button id='removefavoritebutton' name='submitremovefavorite'>Eltavolitas a kedvencekből</button>";
                                    echo "</form>";
                                    echo "<form action='deleterecipe.php' method='post'>";
                                        echo "<input type='hidden' name='recipe_id' value='" . $row['recipe_id'] . "'>";    
                                        echo "<button id='deletebutton' name='submitdelete'>Torles</button>";
                                    echo "</form>";
                                    echo "<form action='modifyrecipepage.php?id=$recipe_id'' method='post'>";
                                        echo "<input type='hidden' name='recipe_id' value='" . $row['recipe_id'] . "'>";    
                                        echo "<button id='modifybutton' name='submitmodify'>Modositas</button>";
                                    echo "</form>";
                                    
                                    
                                echo "</div>";
                        echo "</div>";
                    }
                }
                    mysqli_close($connection);
                ?>
            </div>
        </div>
        <?php include('footer.php'); ?>
    </body>

</html>