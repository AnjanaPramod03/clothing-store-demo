<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .dashboard {
            background-color: #75d4ff;
    padding: 40px;
    border-radius: 10px;
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    text-align: center;

        }

        h2 {
            font-size: 24px;
            color: #333;
            margin-bottom: 20px;
        }

        h1 {
            font-size: 36px;
            color: #007bff;
            margin-bottom: 40px;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }
            100% {
                transform: scale(1.1);
            }
        }
    </style>
</head>
<body>
    <?php include 'admin_header.php'; ?>

<div class="container">
    <div class="dashboard">
        <h2>Welcome Admin!</h2>
        <h1>This is your admin dashboard.</h1>
    </div>
</div>

</body>
</html>
