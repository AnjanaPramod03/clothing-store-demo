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

// Fetch cart items for the logged-in user
$stmt = $pdo->prepare("SELECT cart.cart_id, products.product_id, products.name, products.price, cart.quantity FROM cart INNER JOIN products ON cart.product_id = products.product_id WHERE cart.user_id = ?");
$stmt->execute([$user_id]);
$cart_items = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Function to calculate total price
function calculateTotalPrice($cart_items) {
    $total_price = 0;
    foreach ($cart_items as $item) {
        $total_price += $item['price'] * $item['quantity'];
    }
    return $total_price;
}

// Handle updating cart quantities
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_cart'])) {
    foreach ($_POST['quantity'] as $cart_id => $quantity) {
        $quantity = intval($quantity);
        if ($quantity <= 0) {
            // Remove item from cart if quantity is 0 or negative
            $stmt = $pdo->prepare("DELETE FROM cart WHERE cart_id = ?");
            $stmt->execute([$cart_id]);
        } else {
            // Update quantity for the item in cart
            $stmt = $pdo->prepare("UPDATE cart SET quantity = ? WHERE cart_id = ?");
            $stmt->execute([$quantity, $cart_id]);
        }
    }
    // Redirect to cart page to reflect changes
    header("Location: cart.php");
    exit();
}

// Handle checkout process
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['checkout'])) {
    $total_amount = calculateTotalPrice($cart_items);
    $payment_method = $_POST['payment_method']; // You can add more fields as needed

    // Insert order into orders table
    $stmt = $pdo->prepare("INSERT INTO orders (user_id, total_amount, payment_method, payment_status) VALUES (?, ?, ?, 'Pending')");
    $stmt->execute([$user_id, $total_amount, $payment_method]);
    $order_id = $pdo->lastInsertId();

    // Insert order details into order_details table
    foreach ($cart_items as $item) {
        $stmt = $pdo->prepare("INSERT INTO order_details (order_id, product_id, quantity, unit_price) VALUES (?, ?, ?, ?)");
        $stmt->execute([$order_id, $item['product_id'], $item['quantity'], $item['price']]);
    }

    // Clear the cart for the user
    $stmt = $pdo->prepare("DELETE FROM cart WHERE user_id = ?");
    $stmt->execute([$user_id]);

    // Redirect to order confirmation page
    header("Location: order_confirmation.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .cart {
            max-width: 800px;
            margin: 50px auto;
            background: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .cart h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        .cart table {
            width: 100%;
            border-collapse: collapse;
        }
        .cart table th, .cart table td {
            padding: 10px;
            border: 1px solid #ddd;
        }
        .cart table th {
            background: #f4f4f4;
        }
        .cart input[type="number"] {
            width: 60px;
        }
        .cart .total {
            text-align: right;
            margin-top: 20px;
        }
        .cart .actions {
            text-align: right;
            margin-top: 20px;
        }
        .cart .actions button, .cart .actions a {
            padding: 10px 20px;
            background: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
            text-decoration: none;
        }
        .cart .actions button:hover, .cart .actions a:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
    <div class="cart">
        <h1>Shopping Cart</h1>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <table>
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cart_items as $item): ?>
                        <tr>
                            <td><?php echo $item['name']; ?></td>
                            <td>Rs.<?php echo number_format($item['price'], 2); ?></td>
                            <td>
                                <input type="number" name="quantity[<?php echo $item['cart_id']; ?>]" value="<?php echo $item['quantity']; ?>" min="1" max="99">
                            </td>
                            <td>Rs.<?php echo number_format($item['price'] * $item['quantity'], 2); ?></td>
                            <td>
                                <button type="submit" name="update_cart">Update</button>
                                <a href="remove_from_cart.php?cart_id=<?php echo $item['cart_id']; ?>">Remove</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </form>
        <div class="total">
            <h3>Total: Rs.<?php echo number_format(calculateTotalPrice($cart_items), 2); ?></h3>
        </div>
        <div class="actions">
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <label for="payment_method">Payment Method:</label>
                <select name="payment_method" id="payment_method" required>
                    <option value="Credit Card">Credit Card</option>
                    <option value="PayPal">PayPal</option>
                    <option value="Cash on Delivery">Cash on Delivery</option>
                </select>
                <button type="submit" name="checkout">Checkout</button>
            </form>
        </div>
    </div>
</body>
</html>
