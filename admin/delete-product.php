<?php
include("../includes/connection.php");

$id=$_GET["id"];

mysqli_query($con,"DELETE FROM products WHERE id=$id");

header("Location: products.php");
?>