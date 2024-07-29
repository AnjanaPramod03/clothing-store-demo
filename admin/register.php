<?php

include('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $username = $_POST['username'];
    $password = $_POST['password'];

    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO Admins (username, password_hash) VALUES (:username, :password_hash)");
    $stmt->execute(['username' => $username, 'password_hash' => $password_hash]);

    header("Location: admin_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Registration</title>
</head>
<body>

<h2>Admin Registration</h2>

<form action="" method="post">
    <label for="username">Username:</label><br>
    <input type="text" id="username" name="username" required><br>
    
    <label for="password">Password:</label><br>
    <input type="password" id="password" name="password" required><br>
    
    <input type="submit" value="Register">
</form>

</body>
</html>
