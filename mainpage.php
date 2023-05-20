<!DOCTYPE html>
<html>
    <head>
        <title>Magyar Konyha - Amitol a szellem is jol lakik</title>
        <link rel="stylesheet" href="mainpagestyle.css"> 
    </head>
    
    <!--admin csinalas-->
    <?php
        require_once 'db.php';

        $username = 'admin';
        $useremail = 'admin@gmail.com';
        $userpassword = password_hash('admin', PASSWORD_DEFAULT);
        $user_type = 'admin';

        $conn = getDb();

        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? OR useremail = ?");
        $stmt->bind_param('ss', $username, $useremail);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 0) {
            $stmt = $conn->prepare("INSERT INTO users (username, userpassword, useremail, user_type) VALUES (?, ?, ?, ?)");
            $stmt->bind_param('ssss', $username, $userpassword, $useremail, $user_type);
            $stmt->execute();
        }

        $stmt->close();
        $conn->close();
    ?>

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
            <div id="receptframe">
            <?php
             
                require_once 'db.php';
                require_once 'displayrecipes.php';

                $connection = getDb();
                
                if($_SESSION['displayOption'] == 'all'){
                    $query = "SELECT * FROM recipes";
                    $result = mysqli_query($connection, $query);
                    displayRecipes($result);
                }else if($_SESSION['displayOption'] == 'favorites'){
                    $query = "SELECT * FROM favorites WHERE user_id = '" . $_SESSION['user_id'] . "'";;
                    $result = mysqli_query($connection, $query);
                    displayRecipes($result);
                }

                mysqli_close($connection);
            ?>

            </div>
                                 
            <div id="randomrecept">
                
                <div id="randomrecepttext">
                    <p>Veletlen recept</p>
                </div>
                <form action="random_recipe.php">
                    <button id="randombutton" type="submit">Lepj meg!</button>
                </form>
            </div>
            
            <div id="category">  
                <div id="randomrecepttext">
                    <p>Rendezes</p>
                </div>
                <form action="changemealtime.php" type="post">
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
    </body>
</html>