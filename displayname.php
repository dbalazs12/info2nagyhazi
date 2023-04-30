<?php
function displayname($rownumber) {
    require_once 'db.php';
    $connection = getDb();

    $query = "SELECT recipe_name FROM recipes";
    $result = mysqli_query($connection, $query);

    for ($i = 1; $i <= $rownumber; $i++) {
        $row = mysqli_fetch_array($result);
    }

    echo $row['recipe_name'];

    mysqli_close($connection);
};
?>