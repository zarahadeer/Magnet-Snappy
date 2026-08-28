<?php
include("../includes/connection.php");

$id=$_GET["id"];

$data=mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM products WHERE id=$id"));

if(isset($_POST["update"])){

$name=$_POST["name"];
$description=$_POST["description"];
$price=$_POST["price"];
$stock=$_POST["stock"];

$q="UPDATE products SET

name='$name',
description='$description',
price='$price',
stock='$stock'

WHERE id=$id";

mysqli_query($con,$q);

header("Location: products.php");

}
?>

<!DOCTYPE html>
<html>
<head>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="../css/style.css">

</head>

<body class="admin-body">

<div class="container py-5">

<div class="admin-panel">

<h2>Edit Product</h2>

<form method="POST">

<input class="form-control mb-3" name="name" value="<?php echo $data['name']; ?>">

<textarea class="form-control mb-3" name="description"><?php echo $data['description']; ?></textarea>

<input class="form-control mb-3" name="price" value="<?php echo $data['price']; ?>">

<input class="form-control mb-3" name="stock" value="<?php echo $data['stock']; ?>">

<button class="btn-shop" name="update">Update Product</button>

</form>

</div>

</div>

</body>
</html>