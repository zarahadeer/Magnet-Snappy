<?php

session_start();

include("../includes/connection.php");

if (!isset($_SESSION["admin_id"])) {

    header("Location: login.php");
    exit();

}

$admin_id = $_SESSION["admin_id"];

$success = "";
$error = "";


/* GET CURRENT ADMIN */

$query = "SELECT * FROM admins WHERE id = ? LIMIT 1";

$stmt = mysqli_prepare($con, $query);

mysqli_stmt_bind_param($stmt, "i", $admin_id);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

$admin = mysqli_fetch_assoc($result);

mysqli_stmt_close($stmt);


/* UPDATE SETTINGS */

if (isset($_POST["update_settings"])) {

    $username = trim($_POST["username"]);
    $new_password = trim($_POST["new_password"]);
    $confirm_password = trim($_POST["confirm_password"]);


    if (empty($username)) {

        $error = "Username cannot be empty.";

    }

    elseif (
        !empty($new_password) &&
        $new_password !== $confirm_password
    ) {

        $error = "Passwords do not match.";

    }

    elseif (
        !empty($new_password) &&
        strlen($new_password) < 6
    ) {

        $error = "Password must contain at least 6 characters.";

    }

    else {

        /* Check duplicate username */

        $check = "SELECT id FROM admins
                  WHERE username = ?
                  AND id != ?
                  LIMIT 1";

        $check_stmt = mysqli_prepare($con, $check);

        mysqli_stmt_bind_param(
            $check_stmt,
            "si",
            $username,
            $admin_id
        );

        mysqli_stmt_execute($check_stmt);

        $check_result = mysqli_stmt_get_result($check_stmt);

        if (mysqli_num_rows($check_result) > 0) {

            $error = "That username is already being used.";

        }

        mysqli_stmt_close($check_stmt);


        if (empty($error)) {

            if (!empty($new_password)) {

                $hashed_password = password_hash(
                    $new_password,
                    PASSWORD_DEFAULT
                );

                $update = "UPDATE admins
                           SET username = ?, password = ?
                           WHERE id = ?";

                $update_stmt = mysqli_prepare(
                    $con,
                    $update
                );

                mysqli_stmt_bind_param(
                    $update_stmt,
                    "ssi",
                    $username,
                    $hashed_password,
                    $admin_id
                );

            } else {

                $update = "UPDATE admins
                           SET username = ?
                           WHERE id = ?";

                $update_stmt = mysqli_prepare(
                    $con,
                    $update
                );

                mysqli_stmt_bind_param(
                    $update_stmt,
                    "si",
                    $username,
                    $admin_id
                );
            }


            if (mysqli_stmt_execute($update_stmt)) {

                $_SESSION["admin_username"] = $username;

                $success = "Settings updated successfully!";

                $admin["username"] = $username;

            } else {

                $error = "Something went wrong.";

            }

            mysqli_stmt_close($update_stmt);
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

    <title>
        Admin Settings | Magnet Snappy
    </title>

    <link
        rel="stylesheet"
        href="../css/style.css"
    >

</head>

<body class="admin-settings-page">

<div class="settings-wrapper">

    <div class="settings-card">


        <div class="settings-logo">

            <img
                src="../images/logo.png"
                alt="Magnet Snappy"
            >

        </div>


        <div class="settings-heading">

            <span class="section-label">
                MAGNET SNAPPY
            </span>

            <h1>
                Admin Settings
            </h1>

            <p>
                Manage your admin username and password.
            </p>

        </div>


        <?php if (!empty($success)): ?>

            <div class="settings-success">

                ✓ <?php echo htmlspecialchars($success); ?>

            </div>

        <?php endif; ?>


        <?php if (!empty($error)): ?>

            <div class="settings-error">

                <?php echo htmlspecialchars($error); ?>

            </div>

        <?php endif; ?>


        <form
            method="POST"
            class="settings-form"
        >

            <div class="settings-form-group">

                <label for="username">
                    Admin Username
                </label>

                <input
                    type="text"
                    id="username"
                    name="username"
                    value="<?php echo htmlspecialchars($admin["username"]); ?>"
                    required
                >

            </div>


            <div class="settings-form-group">

                <label for="new_password">
                    New Password
                </label>

                <input
                    type="password"
                    id="new_password"
                    name="new_password"
                    placeholder="Leave empty to keep current password"
                >

                <small>
                    Minimum 6 characters.
                </small>

            </div>


            <div class="settings-form-group">

                <label for="confirm_password">
                    Confirm New Password
                </label>

                <input
                    type="password"
                    id="confirm_password"
                    name="confirm_password"
                    placeholder="Enter the new password again"
                >

            </div>


            <button
                type="submit"
                name="update_settings"
                class="settings-button"
            >
                Save Changes
            </button>

        </form>


        <div class="settings-links">

            <a href="dashboard.php">
                ← Dashboard
            </a>

            <a href="logout.php">
                Logout
            </a>

        </div>

    </div>

</div>

</body>

</html>