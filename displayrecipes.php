<?php 
    require_once 'displayimage.php';
    require_once 'displayname.php';
    function displayRecipes($res){
        while ($row = mysqli_fetch_array($res)) {
            //ha rakattintok akkor ezzel a jo oldalra visz
            echo '<div class="recipedisplay" onclick="window.location.href=\'recipepage.php?id=' . $row['recipe_id'] . '\'">';
            displayimage($row['recipe_id']);
            echo "</br></br>";
            displayname($row['recipe_id']);
            echo '</div>';
        }
    }

?>
