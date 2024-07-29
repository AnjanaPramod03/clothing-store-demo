<?php
// Include configuration file and database connection
include('config.php');

// Start the session
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect user to login page if not logged in
    header("Location: login.php");
    exit();
}

// Get the user ID from session
$user_id = $_SESSION['user_id'];

// Redirect to index page after 5 seconds
header("refresh:5;url=index.php");

// Function to fetch the latest order details for the user
function getLatestOrder($pdo, $user_id) {
    $stmt = $pdo->prepare("SELECT * FROM orders WHERE user_id = ? ORDER BY order_id DESC LIMIT 1");
    $stmt->execute([$user_id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

$order = getLatestOrder($pdo, $user_id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
    <style>
        body {
            font-family: 'Helvetica Neue', sans-serif;
            background: #f9f9f9;
            margin: 0;
            padding: 0;
        }
        .header {
            background: #f4f4f4;
            padding: 20px;
            text-align: center;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
        }
        .nav a {
            margin: 0 15px;
            text-decoration: none;
            color: #333;
        }
        .confirmation-container {
            margin-top: 80px;
            width: 90%;
            max-width: 800px;
            background: #fff;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
            overflow: hidden;
            animation: fadeIn 1s ease-in-out;
            text-align: center;
            padding: 40px;
            margin: 100px auto;
        }
        .confirmation-container h1 {
            color: #007bff;
            font-size: 36px;
            margin-bottom: 20px;
        }
        .confirmation-container p {
            color: #333;
            font-size: 18px;
            margin-bottom: 20px;
        }
        .confirmation-container a {
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s ease;
        }
        .confirmation-container a:hover {
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
    <div class="header">
        <h1>Cool Fashion</h1>
        <nav class="nav">
            <a href="index.php" class="active">Home</a>
            <a href="index.php">Men's</a>
            <a href="index.php">Women's</a>
            <a href="index.php">Kid's</a>
            <a href="about.php">About Us</a>
            <a href="products.php">Products</a>
            <a href="contact.php">Contact Us</a>
            <a href="cart.php">Shopping Cart</a>
        </nav>
    </div>
    <div class="confirmation-container">
        <h1>Thank You for Your Order!</h1>
        <p>Your order has been placed successfully.</p>
        <p>Order ID: <?php echo htmlspecialchars($order['order_id']); ?></p>
        <p>Total Amount: Rs.<?php echo number_format($order['total_amount'], 2); ?></p>
        <p>You will be redirected to the homepage shortly.</p>
        <p>If you are not redirected, <a href="index.php">click here</a>.</p>
    </div>
</body>
</html>
