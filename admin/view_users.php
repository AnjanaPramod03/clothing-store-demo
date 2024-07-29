<!DOCTYPE html>
<html>
<head>
    <title>View Users - Admin Panel</title>
    <style>
       
       body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f5f5f5;
}

.admin-header {
    background-color: #333;
    color: #fff;
    padding: 20px;
    text-align: center;
    font-size: 24px;
    font-weight: bold;
}

.user-table-container {
    width: 80%;
    margin: 20px auto;
    background-color: skyblue;
    border-radius: 10px;
    padding: 20px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.user-table {
    margin-top: 100px;
    margin-left: 400px;
    display: flex;
    width: 50%;
    border-collapse: collapse;
    background-color: #fff;
    border-radius: 5px;
    align-content: flex-end;
    flex-wrap: nowrap;
    flex-direction: row;
    justify-content: space-evenly;
}


.user-table th, .user-table td {
    padding: 12px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

.user-table th {
    background-color: #333;
    color: #fff;
}

.user-table tbody tr:hover {
    background-color: #f1f1f1;
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
<?php include('admin_header.php'); ?>
<div class="user-table">
    <table>
        <thead>
            <tr>
                <th>User ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Full Name</th>
                <th>Address</th>
                <th>Phone Number</th>
            </tr>
        </thead>
        <tbody>
            <?php
           
            include('config.php');
            $stmt = $pdo->query("SELECT * FROM users");
            while ($row = $stmt->fetch()) {
                echo "<tr>";
                echo "<td>" . $row['user_id'] . "</td>";
                echo "<td>" . $row['username'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>" . $row['full_name'] . "</td>";
                echo "<td>" . $row['address'] . "</td>";
                echo "<td>" . $row['phone_number'] . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>

</body>
</html>
