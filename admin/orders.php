<?php

session_start();

include("../includes/connection.php");

if (!isset($_SESSION["admin_id"])) {

    header("Location: login.php");
    exit();

}


$query = "SELECT * FROM orders ORDER BY id DESC";

$result = mysqli_query($con, $query);

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
        Orders | Magnet Snappy
    </title>

    <link
        rel="stylesheet"
        href="../css/style.css"
    >

</head>

<body class="admin-page">


<aside class="admin-sidebar">

    <div class="admin-brand">

        <img
            src="../images/logo.png"
            alt="Magnet Snappy"
        >

        <h2>
            Magnet Snappy
        </h2>

        <p>
            Admin Panel
        </p>

    </div>


    <nav class="admin-nav">

        <a href="dashboard.php">
            🏠 Dashboard
        </a>

        <a href="products.php">
            🧲 Products
        </a>

        <a href="add-product.php">
            ➕ Add Product
        </a>

        <a
            href="orders.php"
            class="active"
        >
            📦 Orders
        </a>

        <a href="settings.php">
            ⚙ Settings
        </a>

        <a href="logout.php">
            🚪 Logout
        </a>

    </nav>

</aside>


<main class="admin-main">


    <div class="admin-topbar">

        <div>

            <span class="admin-small-title">
                SHOP MANAGEMENT
            </span>

            <h1>
                Customer Orders
            </h1>

        </div>

    </div>


    <section class="admin-section">

        <div class="admin-table-wrapper">

            <table class="admin-table">

                <thead>

                    <tr>

                        <th>
                            Order #
                        </th>

                        <th>
                            Customer
                        </th>

                        <th>
                            Email
                        </th>

                        <th>
                            Total
                        </th>

                        <th>
                            Status
                        </th>

                        <th>
                            Date
                        </th>

                    </tr>

                </thead>


                <tbody>

                <?php if (mysqli_num_rows($result) > 0): ?>

                    <?php while ($order = mysqli_fetch_assoc($result)): ?>

                        <tr>

                            <td>

                                <strong>
                                    #<?php echo $order["id"]; ?>
                                </strong>

                            </td>


                            <td>

                                <?php

                                echo htmlspecialchars(
                                    $order["customer_name"] ?? "N/A"
                                );

                                ?>

                            </td>


                            <td>

                                <?php

                                echo htmlspecialchars(
                                    $order["email"] ?? "N/A"
                                );

                                ?>

                            </td>


                            <td>

                                <strong>

                                    £<?php

                                    echo number_format(
                                        $order["total"] ?? 0,
                                        2
                                    );

                                    ?>

                                </strong>

                            </td>


                            <td>

                                <span class="order-status">

                                    <?php

                                    echo htmlspecialchars(
                                        $order["status"] ?? "Pending"
                                    );

                                    ?>

                                </span>

                            </td>


                            <td>

                                <?php

                                echo htmlspecialchars(
                                    $order["created_at"] ?? ""
                                );

                                ?>

                            </td>

                        </tr>

                    <?php endwhile; ?>

                <?php else: ?>

                    <tr>

                        <td
                            colspan="6"
                            class="empty-table"
                        >

                            No orders found.

                        </td>

                    </tr>

                <?php endif; ?>

                </tbody>

            </table>

        </div>

    </section>


</main>

</body>

</html>