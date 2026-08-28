<?php

session_start();

include("includes/connection.php");


/* ADD PRODUCT */

if (isset($_GET['add'])) {

    $product_id = (int) $_GET['add'];

    $query = "SELECT * FROM products WHERE id = $product_id";

    $result = mysqli_query($con, $query);

    if ($result && mysqli_num_rows($result) > 0) {

        $product = mysqli_fetch_assoc($result);

        if ($product['stock'] > 0) {

            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = [];
            }

            if (isset($_SESSION['cart'][$product_id])) {

                if (
                    $_SESSION['cart'][$product_id]
                    < $product['stock']
                ) {

                    $_SESSION['cart'][$product_id]++;

                }

            } else {

                $_SESSION['cart'][$product_id] = 1;

            }

        }

    }

    header("Location: cart.php");

    exit;

}


/* REMOVE PRODUCT */

if (isset($_GET['remove'])) {

    $product_id = (int) $_GET['remove'];

    if (isset($_SESSION['cart'][$product_id])) {

        unset($_SESSION['cart'][$product_id]);

    }

    header("Location: cart.php");

    exit;

}


/* UPDATE CART */

if (isset($_POST['update_cart'])) {

    foreach ($_POST['quantity'] as $product_id => $quantity) {

        $product_id = (int) $product_id;

        $quantity = (int) $quantity;

        if ($quantity <= 0) {

            unset($_SESSION['cart'][$product_id]);

        } else {

            $_SESSION['cart'][$product_id] = $quantity;

        }

    }

    header("Location: cart.php");

    exit;

}


$cart = $_SESSION['cart'] ?? [];

$total = 0;

?>

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Your Cart | Magnet Snappy</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    >

    <link
        href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@400;500;600;700;800&family=Poppins:wght@400;500;600;700&display=swap"
        rel="stylesheet"
    >

    <link rel="stylesheet" href="css/style.css">

</head>

<body>


<nav class="navbar navbar-expand-lg main-navbar">

    <div class="container">

        <a class="navbar-brand" href="index.php">

            <img
                src="images/logo.png"
                alt="Magnet Snappy"
                class="site-logo"
            >

        </a>


        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#mainNavbar"
        >

            <span class="navbar-toggler-icon"></span>

        </button>


        <div
            class="collapse navbar-collapse"
            id="mainNavbar"
        >

            <ul class="navbar-nav mx-auto">

                <li class="nav-item">
                    <a class="nav-link" href="index.php">
                        Home
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="products.php">
                        Shop
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="index.php#faq">
                        FAQ
                    </a>
                </li>

            </ul>

            <a href="cart.php" class="cart-button">

                <i class="bi bi-bag-heart"></i>

                Cart

            </a>

        </div>

    </div>

</nav>


<section class="products-section">

    <div class="container">

        <div class="section-heading">

            <div>

                <span class="section-label">
                    YOUR BAG
                </span>

                <h2>
                    Your <span>cart.</span>
                </h2>

            </div>

        </div>


        <?php if (empty($cart)): ?>

            <div class="empty-products">

                <div class="empty-icon">

                    <i class="bi bi-bag-heart"></i>

                </div>

                <h3>
                    Your cart is empty
                </h3>

                <p>
                    Let's find a magnet to make you smile.
                </p>

                <a href="products.php" class="btn-shop">
                    Shop Magnets
                </a>

            </div>


        <?php else: ?>


            <form method="POST">

                <div class="row g-4">


                    <div class="col-lg-8">

                        <?php foreach ($cart as $product_id => $quantity): ?>


                            <?php

                            $product_id = (int) $product_id;

                            $query = "SELECT * FROM products
                                      WHERE id = $product_id";

                            $result = mysqli_query($con, $query);

                            if (!$result || mysqli_num_rows($result) == 0) {
                                continue;
                            }

                            $product = mysqli_fetch_assoc($result);

                            $subtotal =
                                $product['price'] * $quantity;

                            $total += $subtotal;

                            ?>


                            <div
                                class="product-card mb-3 p-3"
                            >

                                <div class="row align-items-center">

                                    <div class="col-4 col-md-3">

                                        <div
                                            class="product-image"
                                            style="height:140px;"
                                        >

                                            <img
                                                src="images/products/<?php echo htmlspecialchars($product['image']); ?>"
                                                alt=""
                                            >

                                        </div>

                                    </div>


                                    <div class="col-8 col-md-5">

                                        <h3>
                                            <?php
                                            echo htmlspecialchars(
                                                $product['name']
                                            );
                                            ?>
                                        </h3>

                                        <p>
                                            £<?php
                                            echo number_format(
                                                $product['price'],
                                                2
                                            );
                                            ?>
                                            each
                                        </p>

                                    </div>


                                    <div class="col-6 col-md-2">

                                        <input
                                            type="number"
                                            name="quantity[<?php echo $product_id; ?>]"
                                            value="<?php echo $quantity; ?>"
                                            min="1"
                                            class="form-control"
                                        >

                                    </div>


                                    <div class="col-6 col-md-2 text-end">

                                        <strong>

                                            £<?php
                                            echo number_format(
                                                $subtotal,
                                                2
                                            );
                                            ?>

                                        </strong>

                                        <br>

                                        <a
                                            href="cart.php?remove=<?php echo $product_id; ?>"
                                            class="text-danger small"
                                        >

                                            Remove

                                        </a>

                                    </div>

                                </div>

                            </div>


                        <?php endforeach; ?>


                        <button
                            type="submit"
                            name="update_cart"
                            class="btn-custom"
                        >

                            Update Cart

                        </button>

                    </div>


                    <div class="col-lg-4">

                        <div class="contact-card">

                            <span class="section-label">
                                ORDER SUMMARY
                            </span>

                            <h2 style="font-size:40px;">
                                Total
                            </h2>

                            <h3
                                style="
                                color:var(--pink);
                                font-family:'Baloo 2';
                                font-size:32px;
                                "
                            >

                                £<?php
                                echo number_format($total, 2);
                                ?>

                            </h3>

                            <p>
                                All prices are in GBP (£).
                            </p>

                            <a
                                href="checkout.php"
                                class="btn-shop"
                            >

                                Proceed to Checkout
                                <i class="bi bi-arrow-right"></i>

                            </a>

                        </div>

                    </div>


                </div>

            </form>


        <?php endif; ?>

    </div>

</section>


<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
></script>

</body>

</html>