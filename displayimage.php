<?php
function displayimage($n) {
    require_once 'db.php';
    $connection = getDb();

    $query = "SELECT * FROM recipes WHERE recipe_id = $n";
    $result = mysqli_query($connection, $query);

    $row = mysqli_fetch_array($result);
    $image_path = $row['recipe_image'];
    $recipe_name = $row['recipe_name'];

    mysqli_close($connection);
    ?>
    <img src="<?php echo $image_path; ?>" alt="<?php echo $recipe_name; ?>" style="width: 250px; height: 180px; border-top-left-radius:10px; border-top-right-radius: 10px;">
<?php
}
?>
