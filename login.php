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
                <input type="text" placeholder="Email" name="active_gmail" required="">
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
        $active_gmail = $_POST['active_gmail'];
        $password = $_POST['password'];

        //encrypt password >>>
        $password = md5($password);

        //get all data from patients_table1 >>>
        $select = mysqli_query($conn, "SELECT *  FROM patients_table1 WHERE active_gmail = '$active_gmail' AND password = '$password' ");
        
        // $first_name = $_POST['first_name']; 
        //NOTE: this is a variable that stores the first_name (retrieved from the db table) of the corresponding email and password
        
        //the gotten data from the query is stored here;
        $row = mysqli_fetch_array($select);

        if(is_array($row)){
            $_SESSION['id'] = $row['id'];
            $_SESSION['first_name'] = $row['first_name'];
            $_SESSION['last_name'] = $row['last_name'];
            $_SESSION['birthdate'] = $row['birthdate'];
            $_SESSION['gender'] = $row['gender'];
            $_SESSION['address'] = $row['address'];
            $_SESSION['contact_number'] = $row['contact_number'];
            $_SESSION['active_gmail'] = $row['active_gmail'];
            $_SESSION['password'] = $row['password'];
        }else{
            echo '<script type = "text/javascript">';
            echo 'alert("INVALID EMAIL OR PASSWORD!");';
            echo 'window.location.href = "login.php"';
            echo '</script>';
        }
    }

    // if true
    if(isset($_SESSION["first_name"])){     //the superglobal variable's value can be used in other pages without needing to re-declare 
        header("Location:index-after.php");
    }

?>