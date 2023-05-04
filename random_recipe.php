<?php
    // Connect to the database and execute a query to retrieve a random row
    require_once('db.php');
    $connection = getDb();
    $sql = "SELECT recipe_id FROM recipes ORDER BY RAND() LIMIT 1";
    $result = mysqli_query($connection, $sql);
    
    // Store the recipe_id of the randomly selected row in a variable
    $row = mysqli_fetch_assoc($result);
    $recipe_id = $row['recipe_id'];

    // Redirect the user to the recipe page with the recipe_id as a parameter in the URL
    header("Location: recipepage.php?id=$recipe_id");
    exit();
?>