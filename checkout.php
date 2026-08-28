<?php

session_start();

include("includes/connection.php");


$cart = $_SESSION['cart'] ?? [];


if (empty($cart)) {

    header("Location: products.php");

    exit;

}


$total = 0;

$cartProducts = [];


foreach ($cart as $product_id => $quantity) {

    $product_id = (int) $product_id;

    $query = "SELECT * FROM products WHERE id = $product_id";

    $result = mysqli_query($con, $query);

    if ($result && mysqli_num_rows($result) > 0) {

        $product = mysqli_fetch_assoc($result);

        $subtotal = $product['price'] * $quantity;

        $total += $subtotal;

        $cartProducts[] = [
            'id' => $product['id'],
            'name' => $product['name'],
            'price' => $product['price'],
            'quantity' => $quantity,
            'subtotal' => $subtotal
        ];

    }

}


$message = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = trim($_POST['name']);

    $email = trim($_POST['email']);

    $phone = trim($_POST['phone']);

    $address = trim($_POST['address']);


    if (
        empty($name) ||
        empty($email) ||
        empty($phone) ||
        empty($address)
    ) {

        $message = "Please fill in all fields.";

    } else {


        $name = mysqli_real_escape_string($con, $name);

        $email = mysqli_real_escape_string($con, $email);

        $phone = mysqli_real_escape_string($con, $phone);

        $address = mysqli_real_escape_string($con, $address);


        $orderQuery = "
            INSERT INTO orders
            (customer_name, email, phone, address, total_amount, status)
            VALUES
            ('$name', '$email', '$phone', '$address', '$total', 'Pending')
        ";


        if (mysqli_query($con, $orderQuery)) {

            $order_id = mysqli_insert_id($con);


            foreach ($cartProducts as $item) {

                $product_id = $item['id'];

                $quantity = $item['quantity'];

                $price = $item['price'];


                $itemQuery = "
                    INSERT INTO order_items
                    (order_id, product_id, quantity, price)
                    VALUES
                    ('$order_id', '$product_id', '$quantity', '$price')
                ";


                mysqli_query($con, $itemQuery);

            }


            $_SESSION['cart'] = [];


            header(
                "Location: checkout.php?success=1"
            );

            exit;

        } else {

            $message = "There was a problem placing your order.";

        }

    }

}

?>

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Checkout | Magnet Snappy</title>

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
                class="site-logo"
                alt="Magnet Snappy"
            >

        </a>

    </div>

</nav>


<section class="products-section">

    <div class="container">

        <?php if (isset($_GET['success'])): ?>

            <div class="empty-products">

                <div class="empty-icon">

                    <i class="bi bi-check-lg"></i>

                </div>

                <h3>
                    Order received! ♥
                </h3>

                <p>
                    Thank you for choosing Magnet Snappy.
                    We'll be in touch about your order.
                </p>

                <a
                    href="products.php"
                    class="btn-shop"
                >
                    Continue Shopping
                </a>

            </div>


        <?php else: ?>


            <div class="row g-5">


                <!-- FORM -->

                <div class="col-lg-7">

                    <div class="contact-card">

                        <span class="section-label">
                            CHECKOUT
                        </span>

                        <h2 style="font-size:48px;">
                            Your details
                        </h2>


                        <?php if (!empty($message)): ?>

                            <div class="alert alert-danger">
                                <?php echo $message; ?>
                            </div>

                        <?php endif; ?>


                        <form
                            method="POST"
                            class="contact-form"
                        >


                            <div class="mb-3">

                                <label>
                                    Full Name
                                </label>

                                <input
                                    type="text"
                                    name="name"
                                    class="form-control"
                                    required
                                >

                            </div>


                            <div class="mb-3">

                                <label>
                                    Email
                                </label>

                                <input
                                    type="email"
                                    name="email"
                                    class="form-control"
                                    required
                                >

                            </div>


                            <div class="mb-3">

                                <label>
                                    Phone
                                </label>

                                <input
                                    type="text"
                                    name="phone"
                                    class="form-control"
                                    required
                                >

                            </div>


                            <div class="mb-3">

                                <label>
                                    Delivery Address
                                </label>

                                <textarea
                                    name="address"
                                    rows="4"
                                    class="form-control"
                                    required
                                ></textarea>

                            </div>


                            <button
                                type="submit"
                                class="send-button"
                            >

                                Place Order

                                <i class="bi bi-arrow-right"></i>

                            </button>

                        </form>

                    </div>

                </div>


                <!-- SUMMARY -->

                <div class="col-lg-5">

                    <div class="product-card p-4">

                        <span class="section-label">
                            ORDER SUMMARY
                        </span>

                        <h3 style="font-size:32px;">
                            Your magnets
                        </h3>


                        <?php foreach ($cartProducts as $item): ?>

                            <div
                                class="d-flex justify-content-between
                                border-bottom py-3"
                            >

                                <span>

                                    <?php
                                    echo htmlspecialchars(
                                        $item['name']
                                    );
                                    ?>

                                    ×
                                    <?php echo $item['quantity']; ?>

                                </span>

                                <strong>

                                    £<?php
                                    echo number_format(
                                        $item['subtotal'],
                                        2
                                    );
                                    ?>

                                </strong>

                            </div>

                        <?php endforeach; ?>


                        <div
                            class="d-flex justify-content-between
                            mt-4"
                        >

                            <strong>
                                Total
                            </strong>

                            <strong
                                style="
                                color:var(--pink);
                                font-size:24px;
                                "
                            >

                                £<?php
                                echo number_format($total, 2);
                                ?>

                            </strong>

                        </div>


                        <p class="mt-3">

                            <i class="bi bi-shield-check"></i>

                            Payment currency:
                            <strong>GBP (£)</strong>

                        </p>

                    </div>

                </div>

            </div>


        <?php endif; ?>

    </div>

</section>

</body>

</html>