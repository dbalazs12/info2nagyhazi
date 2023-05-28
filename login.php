<?php
session_start();
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  
  $username = $_POST['username'];
  $password = $_POST['password'];

  $conn = getDb();

  $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
  $stmt->bind_param('s', $username);  
  $stmt->execute();
  $result = $stmt->get_result();


  if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['userpassword'])) {
      $_SESSION['user_id'] = $row['user_id'];
      $_SESSION['user_type'] = $row['user_type'];
      $_SESSION['username'] = $row['username'];
      

      $_SESSION['badlogin'] = 'false';
      $stmt->close();
    $conn->close();
      header('Location: mainpage.php');
      exit;
    } else {
      $_SESSION['badlogin'] = 'true';
      $stmt->close();
    $conn->close();
      header('Location: loginpage.php');
      exit;
    } 
  }else {
    $_SESSION['badlogin'] = 'true';
    $stmt->close();
    $conn->close();
    header('Location: loginpage.php');
    exit;
  }
}
?>