<?php

session_start();


if (!isset($_SESSION['admin_id'])) {
 
    header("Location: admin_login.php");
    exit();
}


include('config.php');
include('admin_header.php');


$stmt = $pdo->query("SELECT o.*, od.*, p.name AS product_name 
                    FROM Orders o 
                    INNER JOIN Order_Details od ON o.order_id = od.order_id 
                    INNER JOIN Products p ON od.product_id = p.product_id");


$orders = [];
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $orders[$row['order_id']][] = $row;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Order Details</title>
    <style>
        
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        .order-details {
            max-width: 800px;
            margin: 50px auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            animation: fadeInUp 1s ease-in-out;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
            font-weight: bold;
        }

        h3 {
            color: #333;
            margin-bottom: 15px;
            font-weight: bold;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #007bff;
            color: #fff;
            font-weight: bold;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        /* Animations */
        @keyframes fadeInUp {
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

<div class="order-details">
    <h2>Order Details</h2>

    <?php foreach ($orders as $order_id => $order_items): ?>
        <h3>Order ID: <?php echo $order_id; ?></h3>
        <table border="1">
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Unit Price</th>
                <th>Total Price</th>
            </tr>
            <?php foreach ($order_items as $item): ?>
                <tr>
                    <td><?php echo $item['product_name']; ?></td>
                    <td><?php echo $item['quantity']; ?></td>
                    <td><?php echo $item['unit_price']; ?></td>
                    <td><?php echo $item['quantity'] * $item['unit_price']; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endforeach; ?>
</div>

</body>
</html>
