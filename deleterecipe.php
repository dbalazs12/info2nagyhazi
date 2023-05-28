<?php 
    include 'db.php';

    if(isset($_POST['submitdelete'])){
        $recipe_id = $_POST['recipe_id'];

        $connection = getDb();
        
        // kitorles a kedvencekbol
        $query = "DELETE FROM favorites WHERE recipe_id = '$recipe_id'";
        $result = mysqli_query($connection, $query);

        //torles a user-recept kapcsolatbol, kulonben foreign key violatiopn
        $query = "DELETE FROM user_recipes WHERE recipe_id = '$recipe_id'";
        $result = mysqli_query($connection, $query);

        //torles a receptekbol
        $query = "DELETE FROM recipes WHERE recipe_id = '$recipe_id'";
        $result = mysqli_query($connection, $query);
        
        header("Location: mainpage.php");
        exit();
    }
?>