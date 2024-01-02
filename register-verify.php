<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('globalHead.php'); ?>
    <link rel="stylesheet" href="style/register-verify.css">
</head>
<body>
    <div class="wrapper">
        <form action="data-processor.php" method="POST">
            <h1>Verify Email</h1>
            <h3>Please enter the verification code we sent to your Gmail</h3>
            <div class="input-box">
                <!-- the vkey value will be sent to be processed  -->
                <input type="text" placeholder="Verification Code" name="vkey">  
            </div>

            <button type="submit" class="btn-verify" name="submit_vk">Verify</button>
        </form>
    </div>
</body>
</html>


