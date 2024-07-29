<?php

include('config.php');


if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $username = $_POST['username'];
    $password = $_POST['password'];


    $stmt = $pdo->prepare("SELECT * FROM Admins WHERE username = :username");
    $stmt->execute(['username' => $username]);
    $admin = $stmt->fetch();

    
    if ($admin && password_verify($password, $admin['password_hash'])) {
       
        session_start();
        $_SESSION['admin_id'] = $admin['admin_id'];

      
        header("Location: admin_dashboard.php");
        exit();
    } else {
     
        header("Location: admin_login.php?error=1");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
</head>
<body>

<h2>Admin Login</h2>

<form action="" method="post">
    <label for="username">Username:</label><br>
    <input type="text" id="username" name="username" required><br>
    
    <label for="password">Password:</label><br>
    <input type="password" id="password" name="password" required><br>
    
    <input type="submit" value="Login">
</form>

</body>
</html>
