<?php 

session_start();
$conn = mysqli_connect('localhost', 'root', '', 'dental_clinic_db') or die ('Unable to connect');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('globalHead.php'); ?> 
    <link rel="stylesheet" href="login.css">
</head>
<body class="login-body">
    <div class="wrapper">
        <form action="login.php" method="POST">
            <h1>Login</h1>
            <div class="input-box">
                <input type="text" placeholder="Email" name="email" required="">
                <i class='bx bxs-user'></i>
            </div>

            <div class="input-box">
                <input type="password" placeholder="Password" name="password" required="">
                <i class='bx bxs-lock-alt'></i>
            </div>

            <div class="remember-forgot">
                <label for=""><input type="checkbox"> Remember me</label>
                <a href="#">Forgot Password?</a>
            </div>

            <!-- REMEMBER ARI DAPITA -->
            <button type="submit" class="btn-login-page" name="login">Login</button>

            <div class="register-link">
                <p>Don't have an account? <a href="register.php">Register</a></p>
            </div>
        </form>
    </div>
</body>
</html>

<!-- LOGIN SESSION SETUP -->
<?php 

    //if the login button is activated, perform:
    if(isset($_POST['login']))  
    {
        //get form data >>>
        $email = $_POST['email'];
        $password = $_POST['password'];

        //encrypt password >>>
        $password = md5($password);

        //get data from patients_table1 >>>
        $select = mysqli_query($conn, "SELECT *  FROM patients_table1 WHERE active_gmail = '$email' AND password = '$password' ");

        $first_name = $_POST['first_name']; //NOTE: this is a variable that stores the first_name (retrieved from the db table) of the corresponding email and password
        $row = mysqli_fetch_array($select);

        if(is_array($row)){
            $_SESSION['first_name'] = $row['first_name'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['password'] = $row['password'];
        }else{
            echo '<script type = "text/javascript">';
            echo 'alert("INVALID EMAIL OR PASSWORD!");';
            echo 'window.location.href = "login.php"';
            echo '</script>';
        }
    }

    if(isset($_SESSION["first_name"])){
        header("Location:index-after.php");
    }

?>