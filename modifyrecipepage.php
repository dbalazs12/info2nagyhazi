<!DOCTYPE html>
<html>
    <?php 
        error_reporting(E_ALL & ~E_NOTICE);
        session_start();
        if($_SESSION['pagecolor'] == 'green'){
            $cssfile = 'green_gray.css';
        }else if ($_SESSION['pagecolor'] == 'brown'){
            $cssfile = 'brown_gray.css';
        }
    
    ?>

    <head>
        <title>Magyar Konyha - Amitol a szellem is jol lakik</title>
        <link rel="stylesheet" href=<?php echo $cssfile ?>>
    </head>

    <?php
    include('db.php');
    $connection = getDb();
    //session start nelkul valamiert nem mukodik, ugyhogy esztetikai okokbol elrejtem a 
    //notice-t, arrol hogy mar van egy meglevo sessionom
    error_reporting(E_ALL & ~E_NOTICE);
    
    session_start();
    if(!isset($_SESSION['badmodify'])){
        $_SESSION['badmodify'] = 'false';
    }
    var_dump($_SESSION['badmodify']);

    if($_SESSION['badmodify'] == 'false'){
        echo '<style>#modifyerror { display:none; }</style>';
    }


    $recipe_id = $_GET['id'];
    
    $query = "SELECT * FROM recipes WHERE recipe_id = $recipe_id";
    $result = mysqli_query($connection, $query);
    
    $row = mysqli_fetch_assoc($result);

    $recipename = $row['recipe_name'];
    $servingsize = $row['serving_size'];
    $preparationtime = $row['preparation_time'];
    $cookingtime = $row['cooking_time'];
    $ingredients = $row['ingredients'];
    $instructions = $row['instructions'];
    $mealtime = $row['mealtime'];

    ?>


    <body>
        <?php include('header.php'); ?>
        <div id="frame">
            <div id="recipebox">
                <h1 id="modifyrecipetext">RECEPT MODOSITASA</h1></br> 
                <!--receptnev-->
                <a id="modifyerror">Sikertelen feltoltes! Kerem ellenorizzen minden mezot!</a>
                <form action="modifyrecipe.php" method="post">
                    <h2 style="color: #777; font-size: 28px;">Recept neve:</br>
                        <input id="recipename" type="text" name="recipename" value="<?php echo $recipename?>"></br>    
                    <h2>
                    <!--hany fore dropdown-->
                    <label for="quantity" style="color: #777; font-size: 28px;">Adag(Fo):</label>
                        <select class="dropdown" name="servingsize">
                        <option value="1"<?php if ($servingsize == 1) echo 'selected'; ?>>1</option>
                        <option value="2"<?php if ($servingsize == 2) echo 'selected'; ?>>2</option>
                        <option value="3"<?php if ($servingsize == 3) echo 'selected'; ?>>3</option>
                        <option value="4"<?php if ($servingsize == 4) echo 'selected'; ?>>4</option>
                        <option value="5"<?php if ($servingsize == 5) echo 'selected'; ?>>5</option>
                        <option value="6"<?php if ($servingsize == 6) echo 'selected'; ?>>6</option>
                        <option value="6+"<?php if ($servingsize > 6) echo 'selected'; ?>>6+</option>
                    </select>
                    <!--elokeszitesi ido-->
                    <h2>
                        <label for="quantity" style="color: #777; font-size: 28px;">Elokeszitesi ido:</label>
                            <select class="dropdown" name="preparation_time">
                            <option value="5"<?php if ($preparationtime == 5) echo 'selected'; ?>>5 perc</option>
                            <option value="10"<?php if ($preparationtime == 10) echo 'selected'; ?>>10 perc</option>
                            <option value="15"<?php if ($preparationtime == 15) echo 'selected'; ?>>15 perc</option>
                            <option value="30"<?php if ($preparationtime == 30) echo 'selected'; ?>>30 perc</option>
                            <option value="45"<?php if ($preparationtime == 45) echo 'selected'; ?>>45 perc</option>
                            <option value="60"<?php if ($preparationtime == 60) echo 'selected'; ?>>60 perc</option>   
                        </select>
                    </h2>
                    <!--Fozesi/sutesi ido-->
                    <h2>
                        <label for="quantity" style="color: #777; font-size: 28px;">Fozesi/sutesi ido:</label>
                        <select class="dropdown" name="cooking_time">
                            <option value="5"<?php if ($cookingtime == 5) echo 'selected'; ?>>5 perc</option>
                            <option value="10"<?php if ($cookingtime == 10) echo 'selected'; ?>>10 perc</option>
                            <option value="15"<?php if ($cookingtime == 15) echo 'selected'; ?>>15 perc</option>
                            <option value="30"<?php if ($cookingtime == 30) echo 'selected'; ?>>30 perc</option>
                            <option value="45"<?php if ($cookingtime == 45) echo 'selected'; ?>>45 perc</option>
                            <option value="60"<?php if ($cookingtime == 60) echo 'selected'; ?>>60 perc</option> 
                            <option value="75"<?php if ($cookingtime == 75) echo 'selected'; ?>>75 perc</option>  
                            <option value="90"<?php if ($cookingtime == 90) echo 'selected'; ?>>90 perc</option>
                        </select>
                    </h2>
                    <!--alapanyagok--> 
                    <h2 style="color: #777; font-size: 28px;">
                        Hozzavalok:<br/>
                        <textarea name="ingredients" class="recipeinput"><?php echo $ingredients?></textarea>
                    </h2>
                    <!--elkeszites-->
                    <h2 style="color: #777; font-size: 28px;">
                        Elkeszites:<br/>
                        <textarea name="instructions" class="recipeinput"><?php echo $instructions?></textarea>
                    </h2>
                    <h2>
                        <label for="quantity" style="color: #777; font-size: 28px;">Kategoria:</label>
                            <select class="dropdown" name="mealtime">
                            <option value="Reggeli"<?php if ($mealtime == 'breakfast') echo 'selected'; ?>>Reggeli</option>
                            <option value="Ebed"<?php if ($mealtime == 'lunch') echo 'selected'; ?>>Ebed</option>
                            <option value="Vacsora"<?php if ($mealtime == 'dinner') echo 'selected'; ?>>Vacsora</option>
                        </select>
                    </h2>
                    <!-- a recipe_id -t is at kell adnom-->
                    <input type="hidden" name="recipe_id" value="<?php echo $recipe_id; ?>">
                    <button type="submit" name="submit">Modositas</button>

                </form>
            </div>
        </div>
        <?php include('footer.php'); ?>
    </body>

</html>