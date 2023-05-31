<?php 
    include 'db.php';
    session_start();
    if(isset($_POST['submit'])){
        // uj recept hozzaadasa
        $recipe_name = $_POST['recipename'];
        $serving_size = $_POST['servingsize'];
        $preparation_time = $_POST['preparation_time'];
        $cooking_time = $_POST['cooking_time'];
        $ingredients = $_POST['ingredients'];
        $instructions = $_POST['instructions'];
        
        //ha van feltotott file kezelje le 
        if(!empty($_FILES['image']['name'])){
            $filename = basename($_FILES['image']['name']);
            $target_dir = 'C:/xampp/htdocs/hazi/'; 
            $target_file = $target_dir . $filename;
            $filetype = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

            $allowtypes = array('jpg', 'png', 'jpeg', 'gif');
            if(in_array($filetype, $allowtypes)){
                $image = $_FILES['image']['tmp_name'];
                move_uploaded_file($image, $target_file);
            }
        }else{
            // nincs feltotott file hiba
            $_SESSION['badupload'] = 'true';
            Header("Location: newrecipepage.php");
        }
        
        $connection = getDb();
        //ha nincs teljesen kitoltve hiba    
        if (empty($recipe_name) || empty($serving_size) || empty($preparation_time) || empty($cooking_time) || empty($ingredients) || empty($instructions)) {
            $_SESSION['badupload'] = 'true';
            mysqli_close($connection);
            Header("Location: newrecipepage.php");
        }else{
        //ha minden jo feltoltheti, ved sql injection ellen
        $stmt = $connection->prepare("INSERT INTO recipes (recipe_name, serving_size, preparation_time, cooking_time, ingredients, instructions, recipe_image) 
        VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $recipe_name, $serving_size, $preparation_time, $cooking_time, $ingredients, $instructions, $filename);
        $stmt->execute();
        
        session_start();
        //user osszekotese a most feltoltott receptel
        $recipe_id = mysqli_insert_id($connection);
        $user_id = $_SESSION['user_id'];

        $query = "INSERT INTO user_recipes(user_id, recipe_id) VALUES('$user_id', '$recipe_id')";
        $result = mysqli_query($connection, $query);
        $_SESSION['badupload'] = 'false';
        mysqli_close($connection);
        
        Header("Location: mainpage.php");
        exit();
        }
    }
?>