<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('globalHead.php'); ?>
    <link rel="stylesheet" href="login.css"> <!-- THE SAME STYLE AS THE OTHER LOGIN PAGE-->
</head>
<body class="login-body">
    <div class="wrapper">
        <form action="data-processor.php" method="POST">
            <h1>Admin Login</h1>
            <div class="input-box">
                <input type="text" placeholder="Email" id="email" name="email">
                <i class='bx bxs-user'></i>
            </div>

            <div class="input-box">
                <input type="password" placeholder="Password" id="password" name="password">
                <i class='bx bxs-lock-alt'></i>
            </div>

            <button type="button" class="btn-login-page" id="admin-login-button">Login</button>
        </form>
    </div>

    <script>
        const adminLoginButton = document.getElementById("admin-login-button");

        // Add event listener to handle button click
        adminLoginButton.addEventListener("click", () => {
            // Redirect to the admin dashboard page
            window.location.href = "admin-dashboard.php";
        });
    </script>
</body>
</html>
