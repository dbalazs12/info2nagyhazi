<?php
include 'db.php';

if(isset($_POST['submit'])){
    session_start();
    $connection = getDb();
    // ujra lekerek minden adatot
    $recipe_id = $_POST['recipe_id'];
    $recipe_name = $_POST['recipename'];
    $serving_size = $_POST['servingsize'];
    $preparation_time = $_POST['preparation_time'];
    $cooking_time = $_POST['cooking_time'];
    $ingredients = $_POST['ingredients'];
    $instructions = $_POST['instructions'];
    
    //regi kep megjegyzese, ha nem valtozott, ne legyen ures kep
    $query = "SELECT recipe_image FROM recipes WHERE recipe_id = $recipe_id";
    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_assoc($result);
    $old_image = $row['recipe_image'];

    // ha talalt uj kepet azt toltse fel
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
        $filename = $old_image;
    }

    // ha uresen maradt valami hibat dobjon vissza
    if(empty($recipe_name) || empty($serving_size) || empty($preparation_time) || empty($cooking_time) || empty($ingredients) || empty($instructions)){
        $_SESSION['badmodify'] = 'true';
        mysqli_close($connection);
        header("Location: modifyrecipepage.php?id=" . $recipe_id);
    }else {
        $query = "UPDATE recipes SET recipe_name = '$recipe_name', 
        ingredients = '$ingredients', preparation_time = '$preparation_time',
        cooking_time = '$cooking_time', instructions = '$instructions',
        serving_size = '$serving_size', recipe_image = '$filename' WHERE recipe_id = $recipe_id";
        $result = mysqli_query($connection, $query);
    
       
        $_SESSION['badmodify'] = 'false';
        mysqli_close($connection);
        header("Location: recipepage.php?id=" . $recipe_id);
    }
}
?>