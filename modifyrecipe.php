<?php
include 'db.php';

if(isset($_POST['submit'])){
    
    $recipe_id = $_POST['recipe_id'];
    $recipe_name = $_POST['recipename'];
    $serving_size = $_POST['servingsize'];
    $preparation_time = $_POST['preparation_time'];
    $cooking_time = $_POST['cooking_time'];
    $ingredients = $_POST['ingredients'];
    $instructions = $_POST['instructions'];
    
    session_start();
    $connection = getDb();
    if(empty($recipe_name) || empty($serving_size) || empty($preparation_time) || empty($cooking_time) || empty($ingredients) || empty($instructions)){
        $_SESSION['badmodify'] = 'true';
        mysqli_close($connection);
        header("Location: modifyrecipepage.php?id=" . $recipe_id);
    }else {
        $query = "UPDATE recipes SET recipe_name = '$recipe_name', 
        ingredients = '$ingredients', preparation_time = '$preparation_time',
        cooking_time = '$cooking_time', instructions = '$instructions',
        serving_size = '$serving_size' WHERE recipe_id = $recipe_id";
        $result = mysqli_query($connection, $query);
    
       
        $_SESSION['badmodify'] = 'false';
        mysqli_close($connection);
        header("Location: recipepage.php?id=" . $recipe_id);
    }
}
?>