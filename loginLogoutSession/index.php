<?php 

session_start();
$conn = mysqli_connect('localhost', 'root', '', 'test') or die ('Unable to connect');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form action="index.php" method="POST">
        <h1>Login</h1>
        <!-- <input type="text" class="textbox" name="user_name" placeholder="Username" required = ""> <br> -->
        <input type="text" class="textbox" name="email" placeholder="Email" required = ""> <br>
        <input type="password" class="textbox" name="password" placeholder="Password" required = ""> <br>
        <button type="submit" class="button" name="login">Login</button>
        <!-- OR -->
        <!-- <input type="submit" class="button" name="login" value="Login"> -->
    </form>
</body>
</html>

<?php 
    if(isset($_POST['login']))
    {
        
        // $user_name = $_POST['user_name'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        // $select = mysqli_query($conn, "SELECT *  FROM users WHERE user_name = '$user_name' AND email = '$email' AND password = '$password' ");
        $select = mysqli_query($conn, "SELECT *  FROM users WHERE email = '$email' AND password = '$password' ");
        $user_name = $_POST['user_name']; //NOTE: this is a variable that stores the user_name (retrieved from the db table) of the corresponding email and password
        $row = mysqli_fetch_array($select);

        if(is_array($row)){
            $_SESSION['user_name'] = $row['user_name'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['password'] = $row['password'];
        }else{
            echo '<script type = "text/javascript">';
            echo 'alert("INVALID EMAIL OR PASSWORD!");';
            echo 'window.location.href = "index.php"';
            echo '</script>';
        }
    }

    if(isset($_SESSION["user_name"])){
        header("Location:login.php");
    }

?>