<!DOCTYPE html>
<html>
    <head>
        <title>Magyar Konyha - Amitol a szellem is jol lakik</title>
        <link rel="stylesheet" href="mainpagestyle.css"/> 
    </head>
    
    <body>
        <?php include('header.php'); ?>
        <div id="frame">
            <div id="receptkereso">
                <!--receptkereso-->
                
                <form action="urlap.aspx" method="post">
                    <input id="search" name="search" type="text" placeholder="Keresés">
                </form>
                <div id="receptkeresotext">
                    <p>Receptkereso</p>
                </div>
            </div>
            <div id="receptframe">
            <?php
                require_once 'displayname.php';
                require_once 'displayimage.php';
                require_once 'db.php';

                $connection = getDb();

                $query = "SELECT * FROM recipes";
                $result = mysqli_query($connection, $query);

                while ($row = mysqli_fetch_array($result)) {
                    echo '<div class="recipedisplay" onclick="window.location.href=\'newrecipe.php\'">';
                    displayimage($row['recipe_id']);
                    echo "</br></br>";
                    displayname($row['recipe_id']);
                    echo '</div>';
                }

                mysqli_close($connection);
            ?>

            </div>
                                 
            <div id="randomrecept">
                
                <div id="randomrecepttext">
                    <p>Veletlen recept</p>
                </div>

                <form action="newrecipe.php">
                    <button id="randombutton" type="submit">Lepj meg!</button>
                </form>
            </div>
        </div>
    </body>
</html>