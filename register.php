<?php

include('config.php');
session_start();


$username = $email = $password = $full_name = $address = $phone_number = '';
$errors = [];


if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $full_name = htmlspecialchars($_POST['full_name']);
    $address = htmlspecialchars($_POST['address']);
    $phone_number = htmlspecialchars($_POST['phone_number']);


    if (empty($username)) {
        $errors['username'] = 'Username is required';
    }
 

  
    if (empty($errors)) {
       
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        
        $stmt = $pdo->prepare("INSERT INTO users (username, email, password_hash, full_name, address, phone_number) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$username, $email, $password_hash, $full_name, $address, $phone_number]);

        
        header("Location: login.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
   
        body {
            background: linear-gradient(to right, #6a11cb, #2575fc);
            font-family: 'Helvetica Neue', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background: #fff;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            width: 100%;
            animation: fadeIn 1s ease-in-out;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
            font-size: 28px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
            color: #555;
        }

        .form-control {
            border-radius: 10px;
            border: 1px solid #ddd;
            padding: 10px;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 10px rgba(0, 123, 255, 0.2);
        }

        .btn-primary {
            background: #007bff;
            border: none;
            border-radius: 10px;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: #0056b3;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 123, 255, 0.3);
        }

        .btn-primary:active {
            background: #003d80;
            transform: translateY(0);
            box-shadow: none;
        }

        .text-danger {
            color: #dc3545;
            font-size: 14px;
            margin-top: 5px;
            display: block;
        }

        .link-container {
            text-align: center;
            margin-top: 20px;
        }

        .link-container a {
            color: #007bff;
            text-decoration: none;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .link-container a:hover {
            text-decoration: underline;
            color: #0056b3;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>

<div class="container">
    <h2>User Registration</h2>
    <form action="register.php" method="POST">
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" class="form-control" id="username" name="username" value="<?php echo $username; ?>">
            <?php if (isset($errors['username'])): ?>
                <span class="text-danger"><?php echo $errors['username']; ?></span>
            <?php endif; ?>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>">
        
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" name="password">
           
        </div>
        <div class="form-group">
            <label for="full_name">Full Name:</label>
            <input type="text" class="form-control" id="full_name" name="full_name" value="<?php echo $full_name; ?>">
            
        </div>
        <div class="form-group">
            <label for="address">Address:</label>
            <input type="text" class="form-control" id="address" name="address" value="<?php echo $address; ?>">
         
        </div>
        <div class="form-group">
            <label for="phone_number">Phone Number:</label>
            <input type="text" class="form-control" id="phone_number" name="phone_number" value="<?php echo $phone_number; ?>">
        
        </div>
        <button type="submit" class="btn btn-primary">Register</button>
        <div class="link-container">
            <a href="login.php">Already Have account? Login here</a>
        </div>
    </form>
</div>

</body>
</html>