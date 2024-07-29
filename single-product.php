<?php
include('config.php');
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if (!isset($_GET['product_id'])) {
    header("Location: error.php");
    exit();
}

$stmt = $pdo->prepare("SELECT * FROM products WHERE product_id = ?");
$stmt->execute([$_GET['product_id']]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) {
    header("Location: error.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_to_cart'])) {
    $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;
    if ($quantity <= 0) {
        $quantity = 1;
    }

    $stmt = $pdo->prepare("INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, ?)");
    $stmt->execute([$user_id, $_GET['product_id'], $quantity]);

    header("Location: cart.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        body { 
            font-family: Arial, sans-serif; 
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
        .section { 
            padding: 20px; 
            text-align: center; 
            margin-top: 80px; /* Add margin to avoid overlap with fixed header */
        }
        .product-item { 
            display: inline-block; 
            margin: 10px; 
            padding: 10px; 
            border: 1px solid #ddd; 
            width: 200px; 
        }
        .product-item img { 
            max-width: 100%; 
            height: auto; 
        }
        .product-item h4, 
        .product-item span { 
            margin: 5px 0; 
        }
        .nav a { 
            margin: 0 15px; 
            text-decoration: none; 
            color: #333; 
        }
        .footer { 
            background: #f4f4f4; 
            padding: 20px; 
            text-align: center; 
        }
        body {
            font-family: 'Helvetica Neue', sans-serif;
            background: #f9f9f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        h2 {
            text-align: center;
            color: #333;
            margin-top: 20px;
            font-size: 32px;
            letter-spacing: 1px;
        }
        .containersp {
            width: 90%;
            max-width: 800px;
            background: #fff;
            padding: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
            overflow: hidden;
            animation: fadeIn 1s ease-in-out;
        }
        .product-detailssp {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            margin-top: 20px;
        }
        .product-image {
            flex: 1 1 300px;
            text-align: center;
            padding: 10px;
        }
        .product-image img {
            max-width: 100%;
            border-radius: 15px;
            transition: transform 0.3s ease;
        }
        .product-image img:hover {
            transform: scale(1.05);
        }
        .product-infosp {
            flex: 1 1 300px;
            padding: 20px;
            background: #f1f1f1;
            border-radius: 15px;
            margin-left: 20px;
        }
        .product-infosp p {
            margin: 10px 0;
            font-size: 18px;
            color: #555;
        }
        .product-infosp p strong {
            color: #333;
            font-weight: 600;
        }
        form {
            margin-top: 20px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            font-size: 18px;
            color: #333;
            margin-bottom: 10px;
        }
        input[type="number"] {
            width: 100px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 8px;
            text-align: center;
            transition: all 0.3s ease;
            outline: none;
            font-size: 16px;
        }
        input[type="number"]:focus {
            border-color: #007bff;
            box-shadow: 0 0 10px rgba(0, 123, 255, 0.2);
        }
        .btn {
            background: #007bff;
            color: white;
            border: none;
            padding: 15px 30px;
            border-radius: 8px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s ease;
            font-size: 18px;
            margin-top: 10px;
        }
        .btn:hover {
            background: #0056b3;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 123, 255, 0.3);
        }
        .btn:active {
            background: #003d80;
            transform: translateY(0);
            box-shadow: none;
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
        @media (max-width: 768px) {
            .product-detailssp {
                flex-direction: column;
            }
            .product-infosp {
                margin-left: 0;
                margin-top: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Cool Fashion</h1>
        <nav class="nav">
            <a href="#home">Home</a>
            <a href="#men">Men</a>
            <a href="#women">Women</a>
            <a href="#kids">Kids</a>
            <a href="#accessories">Accessories</a>
            <a href="login.php">Login</a>
            <a href="cart.php">Cart</a>
        </nav>
    </div>
    <div class="containersp">
        <h2><?php echo $product['name']; ?></h2>
        <div class="product-detailssp">
            <div class="product-image">
                <img src="uploads/<?php echo $product['image_url']; ?>" alt="Product Image">
            </div>
            <div class="product-infosp">
                <p><strong>Price:</strong> Rs.<?php echo $product['price']; ?></p>
                <p><strong>Description:</strong> <?php echo $product['description']; ?></p>
                <p><strong>Category:</strong> <?php echo $product['category']; ?></p>
            </div>
        </div>
        <form action="" method="POST">
            <div class="form-group">
                <label for="quantity">Quantity:</label>
                <input type="number" class="form-control" id="quantity" name="quantity" value="1" min="1">
            </div>
            <button type="submit" class="btn btn-primary" name="add_to_cart">Add to Cart</button>
        </form>
    </div>
</body>
</html>
