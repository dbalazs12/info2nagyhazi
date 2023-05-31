<?php
    include('db.php');
    $connection = getDb();
    
    $sql = "SELECT recipe_id FROM recipes ORDER BY RAND() LIMIT 1";
    $result = mysqli_query($connection, $sql);
    
    $row = mysqli_fetch_assoc($result);
    $recipe_id = $row['recipe_id'];

    header("Location: recipepage.php?id=$recipe_id");
    exit();
?>