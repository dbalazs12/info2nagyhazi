<?php
    session_start();
    $user_id = $_SESSION['user_id'];
    $recipe_id = $_POST['recipe_id'];

    include('db.php');
    $connection = getDb();

    $query = "DELETE FROM favorites WHERE user_id = $user_id AND recipe_id = $recipe_id";
    $result = mysqli_query($connection, $query);
    mysqli_close($connection);

    header("Location: mainpage.php");
    exit();
?>