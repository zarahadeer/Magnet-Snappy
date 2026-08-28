<?php
session_start();
include("../includes/connection.php");

if(isset($_POST["submit"])){

$name=$_POST["name"];
$description=$_POST["description"];
$price=$_POST["price"];
$stock=$_POST["stock"];

$image=$_FILES["image"]["name"];
$temp=$_FILES["image"]["tmp_name"];

move_uploaded_file($temp,"../images/products/".$image);

$q="INSERT INTO products(name,description,price,image,stock)
VALUES('$name','$description','$price','$image','$stock')";

mysqli_query($con,$q);

header("Location: products.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>

<title>Add Product</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="../css/style.css">

</head>

<body class="admin-body">

<div class="container py-5">

<div class="admin-panel">

<h2>Add Product</h2>

<form method="POST" enctype="multipart/form-data">

<input class="form-control mb-3" name="name" placeholder="Product Name" required>

<textarea class="form-control mb-3" name="description" placeholder="Description"></textarea>

<input class="form-control mb-3" type="number" step="0.01" name="price" placeholder="Price (£)" required>

<input class="form-control mb-3" type="number" name="stock" placeholder="Stock" required>

<input class="form-control mb-3" type="file" name="image" required>

<button class="btn-shop" name="submit">Save Product</button>

</form>

</div>

</div>

</body>
</html>