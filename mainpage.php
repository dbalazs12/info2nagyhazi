<!DOCTYPE html>
<html>
    <head>
        <title>Magyar Konyha - Amitol a szellem is jol lakik</title>
        <link rel="stylesheet" href="mainpagestyle.css"/> 
    </head>
    
    <?php
        require_once 'db.php';

        $username = 'admin';
        $useremail = 'admin@gmail.com';
        $userpassword = password_hash('admin', PASSWORD_DEFAULT);
        $user_type = 'admin';

        $conn = getDb();

        // Check if the user already exists
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? OR useremail = ?");
        $stmt->bind_param('ss', $username, $useremail);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 0) {
            // Insert a new user if the user doesn't exist
            $stmt = $conn->prepare("INSERT INTO users (username, userpassword, useremail, user_type) VALUES (?, ?, ?, ?)");
            $stmt->bind_param('ssss', $username, $userpassword, $useremail, $user_type);
            $stmt->execute();
        }

        $stmt->close();
        $conn->close();
    ?>

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
                    //ha rakattintok akkor ezzel a jo oldalra visz
                    echo '<div class="recipedisplay" onclick="window.location.href=\'recipepage.php?id=' . $row['recipe_id'] . '\'">';
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
                <form action="random_recipe.php">
                    <button id="randombutton" type="submit">Lepj meg!</button>
                </form>
            </div>
        </div>
    </body>
</html>