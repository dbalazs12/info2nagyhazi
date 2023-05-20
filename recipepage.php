<!DOCTYPE html>
<html>
    <head>
        <title>Magyar Konyha - Amitol a szellem is jol lakik</title>
        <link rel="stylesheet" href="mainpagestyle.css"/> 
        <link rel="stylesheet" href="recipepagestyle.css"/> 
    </head>

    <body>
        <?php include('header.php'); ?>
        <div id="frame">
            <div id="displayframe">
                <?php 
                if (isset($_SESSION['user_id']) && isset($_SESSION['user_type'])) {
                    if ($_SESSION['user_type'] == 'guest' || $_SESSION['user_type'] == 'common') {
                        echo '<style>#deletebutton { display:none; }</style>';
                        echo '<style>#favoritebutton { position:relative; left:378px; }</style>';
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
                                echo "<div id='row'>";
                                    echo "<h1>" . $row['recipe_name'] . "</h1>";
                                echo "</div>";
                                echo "<div id='row'>";
                                    echo "<form action='deleterecipe.php' method='post'>";
                                        echo "<input type='hidden' name='recipe_id' value='" . $row['recipe_id'] . "'>";    
                                        echo "<button id='deletebutton' name='submitdelete'>Torles</button>";
                                    echo "</form>";
                                    echo "<form action='addtofavorite.php' method='post'>";
                                        echo "<input type='hidden' name='recipe_id' value='" . $row['recipe_id'] . "'>";    
                                        echo "<button id='favoritebutton' name='submitfavorite'>Kedvencekbe</button>";
                                    echo "</form>";
                                echo "</div>";
                            echo "</div>";
                            
                            echo "<img id='recipeimage' src='" . $row['recipe_image'] . "'>";
                           
                            echo "</br>";
                            echo "<div id='general'>";
                                echo "<div id='generalinfo'>";
                                    echo "Informaciok";
                                echo "</div>";
                                
                                echo "<p>Elokeszitesi ido: " . $row['preparation_time'] . " perc</p>";
                                echo "<p>Elkeszetesi ido: " . $row['cooking_time'] . " perc</p>";
                                echo "<p>Serving size: " . $row['serving_size'] . ' fo' . "</p>";
                                echo "<p>Hozzavalok:</p>";
                                echo "<ul>";
                                $ingredients = explode(",", $row['ingredients']);
                                foreach ($ingredients as $ingredient) {
                                    echo "<li>" . trim($ingredient) . "</li>";
                                }
                                echo "</br>";
                            echo "</div>";

                            echo "<div id='instructions'>";
                                echo "<div id='instructiontext'>";
                                    echo "Elkeszites";
                                echo "</div>";
                                echo "</br></br></br>";
                                echo $row['instructions'];
                            echo "</div>";
                        echo "</div>";
                    }
                }
                    mysqli_close($connection);
                ?>
            </div>
        </div>
    </body>

</html>