<!DOCTYPE html>
<html>
    <head>
        <title>Magyar Konyha - Amitol a szellem is jol lakik</title>
        <link rel="stylesheet" href="green_gray.css"> 
    </head>
    <div id="frame">
    <?php
        include('db.php');
        
        $connection = getDb();

        //felhasznalok kiiratasa tablazatban
        echo '<h3>Felhasznalok</h3>';
        $query =    "SELECT users.user_id, users.username, users.useremail, COALESCE(GROUP_CONCAT(recipes.recipe_name), '-') AS recipe_name
                    FROM users
                    LEFT JOIN favorites ON users.user_id = favorites.user_id
                    LEFT JOIN recipes ON favorites.recipe_id = recipes.recipe_id
                    GROUP BY users.user_id";
        $result = mysqli_query($connection, $query);

        if (mysqli_num_rows($result) > 0) {
            echo '<table class="table">';
                echo '<tr><th>ID</th><th>Felhasznalonev</th><th>Email</th><th>Kedvenc receptek</th></tr>';
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<tr>';
                    echo '<td>' . $row['user_id'] . '</td>';
                    echo '<td>' . $row['username'] . '</td>';
                    echo '<td>' . $row['useremail'] . '</td>';
                    echo '<td>' . $row['recipe_name'] . '</td>';
                }
            echo '</table>';
        }

        //receptek kiirasa tablazatban
        echo '<h3></br>Receptek</h3>';
        $query = "SELECT recipes.recipe_id, recipes.recipe_name, COALESCE(users.username, 'admin') AS uploadedby
          FROM recipes
          LEFT JOIN user_recipes ON recipes.recipe_id = user_recipes.recipe_id
          LEFT JOIN users ON user_recipes.user_id = users.user_id";
        $result = mysqli_query($connection, $query);

        if (mysqli_num_rows($result) > 0) {
        echo '<table class="table">';
        echo '<tr><th>ID</th><th>Recept Nev</th><th>Feltolto</th></tr>';
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            echo '<td>' . $row['recipe_id'] . '</td>';
            echo '<td>' . $row['recipe_name'] . '</td>';
            echo '<td>' . $row['uploadedby'] . '</td>';
            echo '</tr>';
        }
        echo '</table>';
        }
        echo '</br>';
        echo '<form action="mainpage.php" method="post">';
        echo '<button type="submit">Fooldal</button>';
        echo '</form>';


        mysqli_close($connection);
    ?>
    </div>

</html>