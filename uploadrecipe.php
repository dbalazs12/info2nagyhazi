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

        var_dump($_FILES);

        if(!empty($_FILES['image']['name'])){
            $filename = basename($_FILES['image']['name']);
            $filetype = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

            $allowtypes = array('jpg', 'png', 'jpeg', 'gif');
            if(in_array($filetype, $allowtypes)){
                $image = $_FILES['image']['tmp_name'];
                $imgcontent = addslashes(file_get_contents($image));
                var_dump($imgcontent);
            }
        }
    


        $connection = getDb();
        
        session_start();
        if (empty($recipe_name) || empty($serving_size) || empty($preparation_time) || empty($cooking_time) || empty($ingredients) || empty($instructions)) {
            $_SESSION['badupload'] = 'true';
            mysqli_close($connection);
            //Header("Location: newrecipepage.php");
        }else{
        
        $stmt = $connection->prepare("INSERT INTO recipes (recipe_name, serving_size, preparation_time, cooking_time, ingredients, instructions, recipe_image) 
        VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $recipe_name, $serving_size, $preparation_time, $cooking_time, $ingredients, $instructions, $file_name);
        $stmt->execute();
        
        session_start();
        //user osszekotese receptel
        $recipe_id = mysqli_insert_id($connection);
        $user_id = $_SESSION['user_id'];
        //var_dump($recipe_id);
        //var_dump($user_id);

        $query = "INSERT INTO user_recipes(user_id, recipe_id) VALUES('$user_id', '$recipe_id')";
        $result = mysqli_query($connection, $query);
        $_SESSION['badupload'] = 'false';
        mysqli_close($connection);
        
        //Header("Location: mainpage.php");
        exit();
        }
    }
?>