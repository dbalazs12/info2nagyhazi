<?php
    require_once 'db.php';
    $connection = getDb();

    if (isset($_POST['search'])) {
        $line = $_POST['search'];

        // Perform the search query
        $query = "SELECT * FROM recipes WHERE recipe_name LIKE '%$line%'";
        $result = mysqli_query($connection, $query);

        // Display the search results
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
                // Output the recipe information as desired
                echo $row['recipe_name'];
                echo '<br>';
            }
        }

        
        mysqli_close($connection);
    }
?>