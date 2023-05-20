<?php 
    include 'db.php';

    if(isset($_POST['submit'])){
        // uj recept hozzaadasa
        $recipe_name = $_POST['recipename'];
        $serving_size = $_POST['servingsize'];
        $preparation_time = $_POST['preparation_time'];
        $cooking_time = $_POST['cooking_time'];
        $ingredients = $_POST['ingredients'];
        $instructions = $_POST['instructions'];

        $connection = getDb();
        
        //sqli injection ellen
        $stmt = $connection->prepare("INSERT INTO recipes (recipe_name, serving_size, preparation_time, cooking_time, ingredients, instructions) 
        VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss",$recipe_name,$serving_size,$preparation_time,
        $cooking_time, $ingredients, $instructions);
        $stmt->execute();
        
        session_start();
        //user osszekotese receptel
        $recipe_id = mysqli_insert_id($connection);
        $user_id = $_SESSION['user_id'];
        //var_dump($recipe_id);
        //var_dump($user_id);

        $query = "INSERT INTO user_recipes(user_id, recipe_id) VALUES('$user_id', '$recipe_id')";
        $result = mysqli_query($connection, $query);

        mysqli_close($connection);
        
        Header("Location: mainpage.php");
        exit();
    }
?>