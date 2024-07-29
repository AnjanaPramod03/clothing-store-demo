<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $stmt = $conn->prepare("INSERT INTO feedbacks (name, email, message) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $message);

    if ($stmt->execute()) {
        echo "New feedback submitted successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Tweeky Ecommerce</title>
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
        .contact-section {
            padding: 40px 20px;
            margin: 20px;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .contact-section h2 {
            font-size: 2em;
            margin-bottom: 20px;
            color: #007BFF;
        }
        .contact-content {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            text-align: left;
        }
        .contact-content div {
            flex: 1 1 45%;
            margin: 10px;
            padding: 20px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .contact-content iframe {
            width: 100%;
            height: 300px;
            border: none;
            border-radius: 10px;
        }
        .contact-content form {
            display: flex;
            flex-direction: column;
        }
        .contact-content input, .contact-content textarea {
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .contact-content button {
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #007BFF;
            color: white;
            font-size: 1em;
            cursor: pointer;
        }
        .contact-content button:hover {
            background-color: #0056b3;
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
            <a href="index.php">Home</a>
            <a href="index.php#men">Men</a>
            <a href="index.php#women">Women</a>
            <a href="index.php#kids">Kids</a>
            <a href="about.php">About</a>
            <a href="contact.php">Contact</a>
            <a href="login.php">Login</a>
            <a href="cart.php">Cart</a>
        </nav>
    </div>

    <div class="main-banner">
        <h2>Contact Us</h2>
        <p>Stylish apparel for every occasion.</p>
    </div>

    <div class="contact-section">
        <h2>Send Your Feedback</h2>
        <div class="contact-content">
            <div>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1978.962756140249!2d80.34156378289596!3d7.2493183307722875!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae3170038af125b%3A0xbda4964209460ac4!2sKumesh%20fashan!5e0!3m2!1sen!2slk!4v1717005754017!5m2!1sen!2slk" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            <div>
                <form id="contact" action="" method="post">
                    <input name="name" type="text" id="name" placeholder="Your name" required>
                    <input name="email" type="text" id="email" placeholder="Your email" required>
                    <textarea name="message" rows="6" id="message" placeholder="Your message" required></textarea>
                    <button type="submit" id="form-submit">Send Message</button>
                </form>
            </div>
        </div>
    </div>

    <div class="footer">
        <p>&copy; 2024 Cool Fashion. All Rights Reserved.</p>
    </div>
</body>

</html>
