<?php
    include 'db.php';
    session_start();

    if(isset($_POST['submit'])) {
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $emailadress = $_POST['email'];
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        //ha ures az egyik mezo hiba
        if (empty($username) || empty($password)) {
            $_SESSION['badsignup'] = 'true';
            $_SESSION['usedsignup'] = 'false';
            header('Location: signuppage.php');
        }else {
            $connection = getDb();
            
            $query = "SELECT * FROM users WHERE username = '$username' OR useremail = '$emailadress'";
            $result = mysqli_query($connection, $query);
            // ha mar van ilyen adattal rendelkezo user hiba
            if (mysqli_num_rows($result) > 0) {
                $_SESSION['usedsignup'] = 'true';
                $_SESSION['badsignup'] = 'false';
                header('Location: signuppage.php');
                exit();
            }else{
                // ha minden jo uj user
                $query = "INSERT INTO users (username, userpassword, useremail, user_type) 
                VALUES ('$username', '$password_hash', '$emailadress', 'common')";
        
                $result = mysqli_query($connection, $query);
        
                mysqli_close($connection);
                
                $_SESSION['usedsignup'] = 'false';
                $_SESSION['badsignup'] = 'false';
                $_SESSION['badlogin'] = 'false';
                header("Location: loginpage.php");
            
                exit();
                }
            }
        }
?>