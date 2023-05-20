<?php 
    function displayname($n){
        require_once 'db.php';
        $connection = getDb();

        $query = "SELECT * FROM recipes WHERE recipe_id = $n";
        $result = mysqli_query($connection, $query);
        
        $row = mysqli_fetch_array($result);
        echo $row['recipe_name'];

        mysqli_close($connection);
    }
?>