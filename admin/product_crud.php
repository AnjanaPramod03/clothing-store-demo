<?php

session_start();


if (!isset($_SESSION['admin_id'])) {
    
    header("Location: admin_login.php");
    exit();
}


include('config.php');
include('admin_header.php');


function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


$name = $description = $price = $category = '';
$error = '';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $name = sanitize_input($_POST['name']);
    $description = sanitize_input($_POST['description']);
    $price = floatval($_POST['price']);
    $category = sanitize_input($_POST['category']);

    
    if (empty($name) || empty($description) || empty($price) || empty($category)) {
        $error = "All fields are required.";
    } else {
       
        $target_dir = "../uploads/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

       
        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["image"]["tmp_name"]);
            if($check !== false) {
                $uploadOk = 1;
            } else {
                $error = "File is not an image.";
                $uploadOk = 0;
            }
        }

        
        if ($_FILES["image"]["size"] > 500000) {
            $error = "Sorry, your file is too large.";
            $uploadOk = 0;
        }

     
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            $error = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

       
        if ($uploadOk == 0) {
            $error = "Sorry, your file was not uploaded.";
        
        } else {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
              
                $stmt = $pdo->prepare("INSERT INTO Products (name, description, price, category, image_url) VALUES (:name, :description, :price, :category, :image_url)");
                $result = $stmt->execute(['name' => $name, 'description' => $description, 'price' => $price, 'category' => $category, 'image_url' => $target_file]);

                if ($result) {
                    
                    
                } else {
                    
                    $error = "Error inserting product into database.";
                }
            } else {
                $error = "Sorry, there was an error uploading your file.";
            }
        }
    }
}


if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
    $stmt = $pdo->prepare("DELETE FROM Products WHERE product_id = :product_id");
    $stmt->execute(['product_id' => $product_id]);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Product CRUD</title>
    <style>
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        .containerad {
            max-width: 600px;
            margin: 50px auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            animation: fadeInUp 1s ease-in-out;
        }

        .containeradt {
            max-width: 800px;
            margin: 20px auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            animation: fadeInUp 1s ease-in-out;
        }

        h2, h3 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
            font-weight: bold;
        }

        form {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #666;
        }

        input[type="text"],
        textarea,
        input[type="file"],
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            transition: border-color 0.3s;
        }

        input[type="text"]:focus,
        textarea:focus,
        input[type="file"]:focus {
            outline: none;
            border-color: #007bff;
        }

        textarea {
            height: 100px;
            resize: none;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        table {
            width: 100%;
            border-collapse: collapse;
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

        td img {
            max-width: 100px;
            height: auto;
            border-radius: 5px;
        }

        td a {
            color: #007bff;
            text-decoration: none;
            transition: color 0.3s;
        }

        td a:hover {
            color: #0056b3;
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

<div class="containerad">
    <h2>Product CRUD</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" value="<?php echo $name; ?>"><br>

        <label for="description">Description:</label><br>
        <textarea id="description" name="description"><?php echo $description; ?></textarea><br>

        <label for="price">Price:</label><br>
        <input type="text" id="price" name="price" value="<?php echo $price; ?>"><br>

        <label for="category">Category:</label><br>
        <input type="text" id="category" name="category" value="<?php echo $category; ?>"><br>

        <label for="image">Image:</label><br>
        <input type="file" id="image" name="image"><br>

        <input type="submit" name="submit" value="Save">
        <span style="color: red;"><?php echo $error; ?></span>
    </form>
</div>

<div class="containeradt">
    <h3>Product List</h3>
    <table border="1">
        <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Category</th>
            <th>Image</th>
            <th>Action</th>
        </tr>
        <?php
        // Retrieve products from database and display in table
        $stmt = $pdo->query("SELECT * FROM Products");
        while ($row = $stmt->fetch()) {
            echo "<tr>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['description'] . "</td>";
            echo "<td>" . $row['price'] . "</td>";
            echo "<td>" . $row['category'] . "</td>";
            echo "<td><img src='../uploads/" . $row['image_url'] . "' width='100'></td>";
            echo "<td><a href='?action=delete&product_id=" . $row['product_id'] . "'>Delete</a></td>";
            echo "</tr>";
        }
        ?>
    </table>
</div>

</body>
</html>
