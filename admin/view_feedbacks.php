<?php

include('config.php');


$stmt = $pdo->query("SELECT * FROM feedbacks ORDER BY submitted_at DESC");
$feedbacks = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Feedbacks</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }

        .feedbacks-container {
            width: 80%;
            margin: 20px auto;
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .feedback {
            margin-bottom: 20px;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 5px;
        }

        .feedback-header {
            font-size: 18px;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }

        .feedback-meta {
            font-size: 14px;
            color: #777;
            margin-bottom: 10px;
        }

        .feedback-message {
            font-size: 16px;
            color: #555;
        }
    </style>
</head>
<body>
<?php include('admin_header.php'); ?>
<div class="feedbacks-container">
    <h2>Feedbacks</h2>
    <?php foreach ($feedbacks as $feedback): ?>
        <div class="feedback">
            <div class="feedback-header"><?php echo htmlspecialchars($feedback['name']); ?></div>
            <div class="feedback-meta"><?php echo htmlspecialchars($feedback['email']); ?> | <?php echo htmlspecialchars($feedback['submitted_at']); ?></div>
            <div class="feedback-message"><?php echo htmlspecialchars($feedback['message']); ?></div>
        </div>
    <?php endforeach; ?>
</div>
</body>
</html>
