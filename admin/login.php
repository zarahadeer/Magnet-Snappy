<?php

session_start();

include("../includes/connection.php");

$error = "";

if (isset($_SESSION["admin_id"])) {
    header("Location: dashboard.php");
    exit();
}

if (isset($_POST["login"])) {

    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    if (empty($username) || empty($password)) {

        $error = "Please enter your username and password.";

    } else {

        $query = "SELECT * FROM admins WHERE username = ? LIMIT 1";

        $stmt = mysqli_prepare($con, $query);

        mysqli_stmt_bind_param($stmt, "s", $username);

        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) == 1) {

            $admin = mysqli_fetch_assoc($result);

            /*
             * Supports:
             * 1. Existing plain-text password
             * 2. New secure password hash
             */

            if (
                password_verify($password, $admin["password"]) ||
                $password === $admin["password"]
            ) {

                $_SESSION["admin_id"] = $admin["id"];
                $_SESSION["admin_username"] = $admin["username"];

                header("Location: dashboard.php");
                exit();

            } else {

                $error = "Incorrect username or password.";
            }

        } else {

            $error = "Incorrect username or password.";
        }

        mysqli_stmt_close($stmt);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin Login | Magnet Snappy</title>

    <link rel="stylesheet" href="../css/style.css">

</head>

<body class="admin-login-page">

<div class="login-wrapper">

    <div class="login-card">

        <div class="login-logo">

            <img
                src="../images/logo.png"
                alt="Magnet Snappy Logo"
            >

        </div>

        <div class="login-heading">

            <span class="section-label">
                MAGNET SNAPPY
            </span>

            <h1>
                Admin Login
            </h1>

            <p>
                Sign in to manage your magnet shop.
            </p>

        </div>

        <?php if (!empty($error)): ?>

            <div class="login-error">
                <?php echo htmlspecialchars($error); ?>
            </div>

        <?php endif; ?>

        <form method="POST" class="login-form">

            <div class="login-form-group">

                <label for="username">
                    Username
                </label>

                <input
                    type="text"
                    id="username"
                    name="username"
                    placeholder="Enter username"
                    required
                >

            </div>

            <div class="login-form-group">

                <label for="password">
                    Password
                </label>

                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Enter password"
                    required
                >

            </div>

            <button
                type="submit"
                name="login"
                class="login-button"
            >
                Login
            </button>

        </form>

        <div class="login-back">

            <a href="../index.php">
                ← Back to Magnet Snappy
            </a>

        </div>

    </div>

</div>

</body>

</html>