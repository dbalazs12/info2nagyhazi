<?php 
    include 'db.php';

    if(isset($_POST['submitfavorite'])){
        $recipe_id = $_POST['recipe_id'];
        session_start();
        $user_id = $_SESSION['user_id'];

        $connection = getDb();
        
        $query = "INSERT INTO favorites VALUES ('$user_id', '$recipe_id')";
        $result = mysqli_query($connection, $query);
        
        header("Location: mainpage.php");
        exit();
    }
?>