<?php
include 'dbconn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    try {
        $stmt = $conn->prepare("SELECT * FROM admin_table WHERE email = ? AND password = ?");
        $stmt->bind_param('ss', $email, $password);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            session_start();
            $_SESSION['email'] = $email;

            header("Location: admin-dashboard.php");
            exit();
        } else {
            $error_message = "Incorrect email or password";
        }

        $stmt->close();

    } catch (Exception $e) {
        $error_message = "Error executing query: " . $e->getMessage();
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('globalHead.php'); ?>
    <link rel="stylesheet" href="style/login.css"> <!-- THE SAME STYLE AS THE OTHER LOGIN PAGE-->
</head>
<body class="login-body">
    <div class="wrapper">
        <?php
            if (isset($error_message)) {
                echo "<p style='color: red;'>$error_message</p>";
            }
        ?>
        <form action="" method="POST">
            <h1>Admin Login</h1>
            <div class="input-box">
                <input type="text" placeholder="Email" id="email" name="email">
                <i class='bx bxs-user'></i>
            </div>

            <div class="input-box">
                <input type="password" placeholder="Password" id="password" name="password">
                <i class='bx bxs-lock-alt'></i>
            </div>

            <button type="submit" class="btn-login-page" id="admin-login-button">Login</button>
        </form>
    </div>

    <!-- <script>
        const adminLoginButton = document.getElementById("admin-login-button");

        // Add event listener to handle button click
        adminLoginButton.addEventListener("click", () => {
            // Redirect to the admin dashboard page
            window.location.href = "admin-dashboard.php";
        });
    </script> -->
</body>
</html>
