<?php
function getDb() {
    $connection = mysqli_connect("localhost", "root", "")
            or die("Kapcsolódási hiba: ". mysqli_error($connection));

        mysqli_select_db($connection, "magyarkonyha");
        mysqli_query($connection, "set character_set_results='utf8'");

        return $connection;
}
?>