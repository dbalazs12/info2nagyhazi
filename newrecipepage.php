<!DOCTYPE html>
<html>

    <?php 
        error_reporting(E_ALL & ~E_NOTICE);
        session_start();
        //megjelenes beallitasa
        if($_SESSION['pagecolor'] == 'green'){
            $cssfile = 'green_gray.css';
            $uploadpngfile = 'pictureuploadgreen.png';
        }else if ($_SESSION['pagecolor'] == 'brown'){
            $cssfile = 'brown_gray.css';
            $uploadpngfile = 'pictureuploadbrown.png';
        }
    
    ?>

    <head>
        <title>Magyar Konyha - Amitol a szellem is jol lakik</title>
        <link rel="stylesheet" href=<?php echo $cssfile ?>>
    </head>

    <body>
        <?php 
        include('header.php'); 
        //session start nelkul valamiert nem mukodik, ugyhogy esztetikai okokbol elrejtem a 
        //notice-t, arrol hogy mar van egy meglevo sessionom
        error_reporting(E_ALL & ~E_NOTICE);
        session_start();
        if(!isset($_SESSION['badupload'])){
            $_SESSION['badupload'] = 'false';
        }
        
        if($_SESSION['badupload'] == 'false'){
            echo '<style>#uploaderror { display:none; }</style>';
        }
        
        ?>
        <div id="frame">
            <div id="recipebox">
                <h1 id="newrecipetext" >TÖLTS FEL EGY RECEPTET!</h1></br> 
                <!--receptnev-->
                <a id="uploaderror">Sikertelen feltöltés! Kérem ellenőrizzen minden mezőt!</a>
                <form action="uploadrecipe.php" method="post" enctype="multipart/form-data">
                    <h2 style="color: #777; font-size: 28px;">Recept neve:</br>
                        <input id="recipename" type="text" name="recipename"></br>    
                    <h2>
                    <!--hany fore dropdown-->
                    <label for="quantity" style="color: #777; font-size: 28px;">Adag(Fő):</label>
                        <select class="dropdown" name="servingsize">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="6+">6+</option>
                    </select>
                    <!--elokeszitesi ido-->
                    <h2>
                        <label for="quantity" style="color: #777; font-size: 28px;">Előkészitési idő:</label>
                            <select class="dropdown" name="preparation_time">
                            <option value="5">5 perc</option>
                            <option value="10">10 perc</option>
                            <option value="15">15 perc</option>
                            <option value="30">30 perc</option>
                            <option value="45">45 perc</option>
                            <option value="60">60 perc</option>   
                        </select>
                    </h2>
                    <!--Fozesi/sutesi ido-->
                    <h2>
                        <label for="quantity" style="color: #777; font-size: 28px;">Főzési/sütési idő:</label>
                        <select class="dropdown" name="cooking_time">
                            <option value="5">5 perc</option>
                            <option value="10">10 perc</option>
                            <option value="15">15 perc</option>
                            <option value="30">30 perc</option>
                            <option value="45">45 perc</option>
                            <option value="60">60 perc</option> 
                            <option value="75">75 perc</option>  
                            <option value="90">90 perc</option>
                        </select>
                    </h2>
                    <!--alapanyagok--> 
                    <h2 style="color: #777; font-size: 28px;">
                        Hozzávalók:<br/>
                        <textarea name="ingredients" class="recipeinput"></textarea>
                    </h2>
                    <!--elkeszites-->
                    <h2 style="color: #777; font-size: 28px;">
                        Elkészítes:<br/>
                        <textarea name="instructions" class="recipeinput"></textarea>
                    </h2>

                    <h2>
                        <label for="mealtime" style="color: #777; font-size: 28px;">Kategória:</label>
                            <select class="dropdown" name="mealtime">
                            <option value="Reggeli">Reggeli</option>
                            <option value="Ebed">Ebéd</option>
                            <option value="Vacsora">Vacsora</option>
                        </select>
                    </h2>
                    
                    <input id="uploadimagebutton" type="file" name="image" >
        
                    </br>

                    <button id="uploadrecipebutton" type="submit" name="submit">Feltöltés</button>
                    
                </form>
                
            </div>
        </div>
        <?php include('footer.php'); ?>
    </body>

</html>