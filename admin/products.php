<?php
session_start();
include("../includes/connection.php");

if(!isset($_SESSION["admin"])){
header("Location: login.php");
exit;
}

$result=mysqli_query($con,"SELECT * FROM products ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>

<title>Manage Products</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="../css/style.css">

</head>

<body class="admin-body">

<div class="container py-5">

<div class="d-flex justify-content-between align-items-center mb-4">

<h1>Products</h1>

<a href="add-product.php" class="btn-shop">+ Add Product</a>

</div>

<div class="admin-panel">

<table class="table align-middle">

<tr>

<th>Image</th>

<th>Name</th>

<th>Price</th>

<th>Stock</th>

<th>Action</th>

</tr>

<?php while($row=mysqli_fetch_assoc($result)){ ?>

<tr>

<td><img src="../images/products/<?php echo $row['image']; ?>" width="70"></td>

<td><?php echo $row['name']; ?></td>

<td>£<?php echo $row['price']; ?></td>

<td><?php echo $row['stock']; ?></td>

<td>

<a href="edit-product.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>

<a href="delete-product.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Delete this product?')">Delete</a>

</td>

</tr>

<?php } ?>

</table>

</div>

</div>

</body>
</html>