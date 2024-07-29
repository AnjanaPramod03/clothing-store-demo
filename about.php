<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Tweeky Ecommerce</title>
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
        .about-section {
            padding: 40px 20px;
            margin: 20px;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .about-section h2 {
            font-size: 2em;
            margin-bottom: 20px;
            color: #007BFF;
        }
        .about-content {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            text-align: left;
        }
        .about-content div {
            flex: 1 1 45%;
            margin: 10px;
            padding: 20px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .about-content img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
        }
        .about-content p {
            font-size: 1em;
            line-height: 1.6em;
            margin: 20px 0;
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
        <h2>About Us</h2>
        <p>Get to know more about Tweeky Ecommerce and our journey.</p>
    </div>

    <div class="about-section">
        <h2>Our Story</h2>
        <div class="about-content">
            <div>
                <img src="image/360_F_677874003_7bbRZtY0wvdPQcy96jzqBdfju0HahwNp.jpg" alt="Our Story">
                <p>
                    Tweeky Ecommerce started with a simple idea: to provide high-quality, fashionable clothing for everyone. From humble beginnings, we've grown into a trusted brand with a loyal customer base. Our mission is to continue offering the best products and customer service in the industry.
                </p>
            </div>
            <div>
                <img src="image/intro-1663675500.jpg" alt="Our Mission">
                <p>
                    Our mission is to make stylish and comfortable clothing accessible to everyone. We believe in the power of fashion to express individuality and boost confidence. We're committed to sustainability, ethical sourcing, and giving back to our community through various initiatives.
                </p>
            </div>
        </div>
    </div>

    <div class="footer">
        <p>&copy; 2024 Cool Fashion. All Rights Reserved.</p>
    </div>
</body>

</html>
