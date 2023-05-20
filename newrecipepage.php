<!DOCTYPE html>
<html>
    <head>
        <title>Magyar Konyha - Amitol a szellem is jol lakik</title>
        <link rel="stylesheet" href="newrecipestyle.css"/>
        <link rel="stylesheet" href="mainpagestyle.css"/> 
    </head>

    <body>
        <?php include('header.php'); ?>
        <div id="frame">
            <div id="recipebox">
                <h1 style="text-align: center; color: rgb(76, 134, 136);">TOLTS FEL EGY RECEPTET!</h1></br> 
                <!--receptnev-->
                <form action="uploadrecipe.php" method="post">
                    <h2 style="color: #777; font-size: 28px;">Recept neve:</br>
                        <input id="recipename" type="text" name="recipename"></br>    
                    <h2>
                    <!--hany fore dropdown-->
                    <label for="quantity" style="color: #777; font-size: 28px;">Adag(Fo):</label>
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
                        <label for="quantity" style="color: #777; font-size: 28px;">Elokeszitesi ido:</label>
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
                        <label for="quantity" style="color: #777; font-size: 28px;">Fozesi/sutesi ido:</label>
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
                        Hozzavalok:<br/>
                        <textarea name="ingredients" class="recipeinput"></textarea>
                    </h2>
                    <!--elkeszites-->
                    <h2 style="color: #777; font-size: 28px;">
                        Elkeszites:<br/>
                        <textarea name="instructions" class="recipeinput"></textarea>
                    </h2>
                    <button type="submit" name="submit">Feltoltes</button>
                </form>
            </div>
        </div>
    </body>

</html>