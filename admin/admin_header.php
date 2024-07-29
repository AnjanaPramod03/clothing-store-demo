<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <style>
        /* Base Styling */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }

        .header {
            background-color: #f19a73;
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
        }

        .admin-nav {
            background-color:  #f19a73;
            padding: 10px 0;
            text-align: center;
        }

        .admin-nav a {
            color: #fff;
            text-decoration: none;
            margin: 0 20px;
            font-size: 18px;
        }

        .admin-nav a:hover {
            text-decoration: underline;
        }

        .logout-btn {
            background-color: #c00;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 20px;
        }

        .logout-btn:hover {
            background-color: #900;
        }
    </style>
</head>
<body>

<div class="header">
    <h1>Admin Dashboard</h1>
</div>

<div class="admin-nav">
    <a href="admin_dashboard.php">Dashboard</a>
    <a href="product_crud.php">Products</a>
    <a href="order_details.php">Orders</a>
    <a href="view_users.php">Users</a>
    <a href="view_feedbacks.php">Feedbacks</a>
    <button class="logout-btn"><a href="#">Logout</a></button>
</div>

</body>
</html>
