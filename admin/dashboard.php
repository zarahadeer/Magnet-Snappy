<?php

session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

include("../includes/connection.php");

$pageTitle = "Admin Dashboard | Magnet Snappy";

/* =========================
   COUNT PRODUCTS
========================= */

$productQuery = "SELECT COUNT(*) AS total FROM products";
$productResult = mysqli_query($con, $productQuery);

$productData = mysqli_fetch_assoc($productResult);
$totalProducts = $productData['total'];


/* =========================
   COUNT ORDERS
========================= */

$orderQuery = "SELECT COUNT(*) AS total FROM orders";
$orderResult = mysqli_query($con, $orderQuery);

$orderData = mysqli_fetch_assoc($orderResult);
$totalOrders = $orderData['total'];


/* =========================
   COUNT ADMINS
========================= */

$adminQuery = "SELECT COUNT(*) AS total FROM admins";
$adminResult = mysqli_query($con, $adminQuery);

$adminData = mysqli_fetch_assoc($adminResult);
$totalAdmins = $adminData['total'];


/* =========================
   LATEST PRODUCTS
========================= */

$latestProductsQuery = "
    SELECT *
    FROM products
    ORDER BY id DESC
    LIMIT 5
";

$latestProductsResult = mysqli_query($con, $latestProductsQuery);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        <?php echo $pageTitle; ?>
    </title>

    <!-- MAIN WEBSITE CSS -->
    <link
        rel="stylesheet"
        href="../css/style.css"
    >

</head>


<body class="admin-page">


<!-- =========================
     ADMIN HEADER
========================= -->

<header class="admin-header">

    <div class="admin-header-container">

        <div class="admin-brand">

            <img
                src="../images/logo.png"
                alt="Magnet Snappy"
            >

            <div>

                <h1>
                    Magnet Snappy
                </h1>

                <p>
                    Admin Dashboard
                </p>

            </div>

        </div>


        <div class="admin-header-actions">

            <a
                href="../index.php"
                class="admin-view-site"
                target="_blank"
            >
                View Website
            </a>

            <a
                href="logout.php"
                class="admin-logout"
            >
                Logout
            </a>

        </div>

    </div>

</header>


<!-- =========================
     ADMIN NAVIGATION
========================= -->

<nav class="admin-nav">

    <div class="admin-nav-container">

        <a
            href="dashboard.php"
            class="admin-nav-link active"
        >
            Dashboard
        </a>

        <a
            href="products.php"
            class="admin-nav-link"
        >
            Products
        </a>

        <a
            href="add-product.php"
            class="admin-nav-link"
        >
            Add Product
        </a>

        <a
            href="orders.php"
            class="admin-nav-link"
        >
            Orders
        </a>

        <a
            href="settings.php"
            class="admin-nav-link"
        >
            Settings
        </a>

    </div>

</nav>


<!-- =========================
     DASHBOARD CONTENT
========================= -->

<main class="admin-main">

    <div class="admin-container">


        <!-- WELCOME -->

        <div class="admin-welcome">

            <div>

                <span class="section-label">
                    MAGNET SNAPPY ADMIN
                </span>

                <h2>
                    Welcome back! 💕
                </h2>

                <p>
                    Manage your magnets, products and
                    customer orders from here.
                </p>

            </div>

        </div>


        <!-- =========================
             STATISTICS
        ========================= -->

        <div class="admin-stats">


            <!-- PRODUCTS -->

            <div class="admin-stat-card pink-card">

                <div class="admin-stat-icon">
                    🧲
                </div>

                <div>

                    <h3>
                        <?php echo $totalProducts; ?>
                    </h3>

                    <p>
                        Total Products
                    </p>

                </div>

            </div>


            <!-- ORDERS -->

            <div class="admin-stat-card blue-card">

                <div class="admin-stat-icon">
                    🛒
                </div>

                <div>

                    <h3>
                        <?php echo $totalOrders; ?>
                    </h3>

                    <p>
                        Total Orders
                    </p>

                </div>

            </div>


            <!-- ADMINS -->

            <div class="admin-stat-card purple-card">

                <div class="admin-stat-icon">
                    👤
                </div>

                <div>

                    <h3>
                        <?php echo $totalAdmins; ?>
                    </h3>

                    <p>
                        Admin Accounts
                    </p>

                </div>

            </div>

        </div>


        <!-- =========================
             QUICK ACTIONS
        ========================= -->

        <section class="admin-section">

            <div class="admin-section-heading">

                <div>

                    <span class="section-label">
                        QUICK ACTIONS
                    </span>

                    <h2>
                        Manage Your Store
                    </h2>

                </div>

            </div>


            <div class="admin-actions">


                <a
                    href="add-product.php"
                    class="admin-action-card"
                >

                    <span class="action-icon">
                        ➕
                    </span>

                    <div>

                        <h3>
                            Add Product
                        </h3>

                        <p>
                            Add a new magnet to your shop.
                        </p>

                    </div>

                </a>


                <a
                    href="products.php"
                    class="admin-action-card"
                >

                    <span class="action-icon">
                        🧲
                    </span>

                    <div>

                        <h3>
                            Manage Products
                        </h3>

                        <p>
                            Edit or delete your products.
                        </p>

                    </div>

                </a>


                <a
                    href="orders.php"
                    class="admin-action-card"
                >

                    <span class="action-icon">
                        📦
                    </span>

                    <div>

                        <h3>
                            View Orders
                        </h3>

                        <p>
                            Check customer orders.
                        </p>

                    </div>

                </a>

            </div>

        </section>


        <!-- =========================
             LATEST PRODUCTS
        ========================= -->

        <section class="admin-section">

            <div class="admin-section-heading">

                <div>

                    <span class="section-label">
                        YOUR SHOP
                    </span>

                    <h2>
                        Latest Products
                    </h2>

                </div>


                <a
                    href="products.php"
                    class="admin-small-button"
                >
                    View All
                </a>

            </div>


            <div class="admin-products-table">

                <?php if (
                    $latestProductsResult &&
                    mysqli_num_rows($latestProductsResult) > 0
                ): ?>

                    <table>

                        <thead>

                            <tr>

                                <th>
                                    ID
                                </th>

                                <th>
                                    Product
                                </th>

                                <th>
                                    Price
                                </th>

                                <th>
                                    Action
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                        <?php while (
                            $product =
                            mysqli_fetch_assoc(
                                $latestProductsResult
                            )
                        ): ?>

                            <tr>

                                <td>
                                    <?php
                                    echo htmlspecialchars(
                                        $product['id']
                                    );
                                    ?>
                                </td>


                                <td>

                                    <div class="admin-product-name">

                                        <?php
                                        if (
                                            !empty(
                                                $product['image']
                                            )
                                        ):
                                        ?>

                                            <img
                                                src="../<?php
                                                echo htmlspecialchars(
                                                    $product['image']
                                                );
                                                ?>"
                                                alt="<?php
                                                echo htmlspecialchars(
                                                    $product['name']
                                                );
                                                ?>"
                                            >

                                        <?php endif; ?>


                                        <span>

                                            <?php
                                            echo htmlspecialchars(
                                                $product['name']
                                            );
                                            ?>

                                        </span>

                                    </div>

                                </td>


                                <td>

                                    <strong class="admin-price">

                                        £<?php
                                        echo number_format(
                                            $product['price'],
                                            2
                                        );
                                        ?>

                                    </strong>

                                </td>


                                <td>

                                    <a
                                        href="edit-product.php?id=<?php
                                        echo $product['id'];
                                        ?>"
                                        class="admin-edit-button"
                                    >
                                        Edit
                                    </a>

                                </td>

                            </tr>

                        <?php endwhile; ?>

                        </tbody>

                    </table>

                <?php else: ?>

                    <div class="admin-empty">

                        <div>
                            🧲
                        </div>

                        <h3>
                            No products yet
                        </h3>

                        <p>
                            Add your first Magnet Snappy
                            product.
                        </p>

                        <a
                            href="add-product.php"
                            class="btn-pink"
                        >
                            Add Product
                        </a>

                    </div>

                <?php endif; ?>

            </div>

        </section>


    </div>

</main>


<!-- =========================
     ADMIN FOOTER
========================= -->

<footer class="admin-footer">

    <p>
        © <?php echo date("Y"); ?>
        Magnet Snappy · Admin Panel
    </p>

</footer>


</body>

</html>