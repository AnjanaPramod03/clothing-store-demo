<?php

include('config.php');
session_start();


$username = $password = '';
$errors = [];


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

   
    if (empty($username)) {
        $errors['username'] = 'Username is required';
    }
    

  
    if (empty($errors)) {
        
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

       
        if ($user && password_verify($password, $user['password_hash'])) {
           
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['username'];

        
            header("Location: index.php");
            exit();
        } else {
            $errors['login'] = 'Invalid username or password';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Base Styling */
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

        /* Animations */
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
    <h2>User Login</h2>
    <form action="login.php" method="POST">
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" class="form-control" id="username" name="username" value="<?php echo $username; ?>">
            <?php if (isset($errors['username'])): ?>
                <span class="text-danger"><?php echo $errors['username']; ?></span>
            <?php endif; ?>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" name="password">
            <?php if (isset($errors['login'])): ?>
                <span class="text-danger"><?php echo $errors['login']; ?></span>
            <?php endif; ?>
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
        <div class="link-container">
            <a href="register.php">Not registered yet?</a>
        </div>
    </form>
</div>

</body>
</html>

