<?php

include('config.php');


session_start();


if (!isset($_SESSION['user_id'])) {
    
    header("Location: login.php");
    exit();
}


if (isset($_GET['cart_id'])) {
    $cart_id = $_GET['cart_id'];

    
    $stmt = $pdo->prepare("DELETE FROM cart WHERE cart_id = ?");
    $stmt->execute([$cart_id]);

   
    header("Location: cart.php");
    exit();
} else {
    
    header("Location: cart.php");
    exit();
}
?>
