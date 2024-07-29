<?php
// Include configuration file and database connection
include('config.php');

// Fetch products grouped by category
$stmt = $pdo->query("SELECT * FROM Products ORDER BY category");

// Initialize arrays to store products for each category
$categories = ['men', 'women', 'kids'];
$productsByCategory = array_fill_keys($categories, []);

// Organize products by category
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $productsByCategory[$row['category']][] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tweeky Ecommerce</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
            color: #333;
        }
        .header {
            background: #f4f4f4;
            padding: 20px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 2.5em;
        }
        .header .nav a {
            margin: 0 15px;
            text-decoration: none;
            color: #333;
            font-weight: bold;
            transition: color 0.3s;
        }
        .header .nav a:hover {
            color: #007BFF;
        }
        .main-banner {
            padding: 50px 20px;
            text-align: center;
            background: linear-gradient(to right, #ff7e5f, #feb47b);
            color: #fff;
        }
        .main-banner h2 {
            font-size: 2.5em;
            margin-bottom: 10px;
        }
        .main-banner p {
            font-size: 1.2em;
        }
        .section {
            padding: 40px 20px;
            margin: 20px 0;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .section h2 {
            font-size: 2em;
            margin-bottom: 20px;
            text-transform: capitalize;
            color: #007BFF;
        }
        .product-item {
            display: inline-block;
            margin: 10px;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            width: 250px;
            background: #fff;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .product-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .product-item img {
            max-width: 100%;
            height: auto;
            border-bottom: 1px solid #ddd;
            padding-bottom: 15px;
            margin-bottom: 15px;
        }
        .product-item h4 {
            font-size: 1.5em;
            margin: 5px 0;
            color: #007BFF;
        }
        .product-item span {
            display: block;
            font-size: 1.2em;
            margin: 5px 0;
            color: #555;
        }
        .product-item div {
            margin-top: 10px;
        }
        .product-item a {
            text-decoration: none;
            color: #007BFF;
            font-weight: bold;
            margin-right: 10px;
            transition: color 0.3s;
        }
        .product-item a:hover {
            color: #0056b3;
        }
        .footer {
            background: #f4f4f4;
            padding: 20px;
            text-align: center;
        }
        .footer p {
            margin: 0;
            color: #555;
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
            <a href="about.php">about</a>
            <a href="contact.php">contact</a>
            <a href="login.php">Login</a>
            <a href="cart.php">Cart</a>
        </nav>
    </div>

    <div class="main-banner" id="home">
        <h2>Welcome to Cool Fashion</h2>
        <p>Stylish apparel &amp; every occasion.</p>
    </div>

    <?php foreach ($categories as $category): ?>
        <div class="section" id="<?php echo $category; ?>">
            <h2><?php echo ucfirst($category); ?>'s Clothes</h2>
            <?php foreach ($productsByCategory[$category] as $product): ?>
                <div class="product-item">
                    <img src="uploads/<?php echo $product['image_url']; ?>" alt="<?php echo $product['name']; ?>">
                    <h4><?php echo $product['name']; ?></h4>
                    <span>Rs.<?php echo $product['price']; ?></span>
                    <div>
                        <a href="single-product.php?product_id=<?php echo $product['product_id']; ?>">View</a>
                        <a href="single-product.php?product_id=<?php echo $product['product_id']; ?>">Buy</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endforeach; ?>

    <div class="footer">
        <p>&copy; 2024 Cool Fashion. All Rights Reserved.</p>
    </div>
</body>

</html>
