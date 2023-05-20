<?php
    include 'db.php';
    if(isset($_POST['submit'])) {
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $emailadress = $_POST['email'];
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        $connection = getDb();

        $query = "INSERT INTO users (username, userpassword, useremail, user_type) 
        VALUES ('$username', '$password_hash', '$emailadress', 'common')";

        $result = mysqli_query($connection, $query);

        mysqli_close($connection);

        header("Location: loginpage.php");
        exit();
        }
?>