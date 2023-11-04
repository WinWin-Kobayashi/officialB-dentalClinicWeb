<?php 
    session_start();
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
    <h1>Welcome <?php echo $_SESSION['user_name']; ?> </h1>
    <h5>Click here to <a href="logout.php">Logout</a> </h5>
</body>
</html>