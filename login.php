<?php
session_start();
require_once 'db.php';

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Get the user's input from the form
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Connect to the database
  $conn = getDb();

  // Prepare a query to fetch the user's record from the database
  $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
  $stmt->bind_param('s', $username);
  $stmt->execute();
  $result = $stmt->get_result();

  //van-e ilyen username 
  if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['userpassword'])) {
      $_SESSION['user_id'] = $row['user_id'];
      $_SESSION['user_type'] = $row['user_type'];
      //ezzel tudom a headerbe kiirni a nevet
      $_SESSION['username'] = $row['username'];
      
      header('Location: mainpage.php');
      exit;
    } else {
    
      $error = 'Incorrect username or password';
    }
  } else {
    // User not found
  
    echo 'fasz';
  }

  // Close the database connection
  $stmt->close();
  $conn->close();
}
?>