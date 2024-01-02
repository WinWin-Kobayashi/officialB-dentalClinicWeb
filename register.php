<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('globalHead.php'); ?>
    <link rel="stylesheet" href="style/register.css">
</head>
<body class="register-body">
    <div class="wrapper">
        <form action="data-processor.php" method="POST">
            <h1>Register</h1>
            <div class="row">
            <div class="input-box">
                    <input type="text" placeholder="First Name" required name="first_name">
                </div>
                <div class="input-box">
                    <input type="text" placeholder="Last Name" required name="last_name">
                </div>
            </div>

            <div class="row">
                <div class="input-box">
                    <input type="date" placeholder="Birthdate" required name="birthdate">
                </div> 

                <select class="input-box drop-down" id="gender" required name="gender" placeholder="Select Gender">
                    <option value="" disabled selected>Select Gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>

            </div>

            <div class="column">
                <div class="input-box">
                    <input type="text" placeholder="Address" required name="address">
                </div>

                <div class="input-box">
                    <input type="text" placeholder="Contact Number" required name="contact_number">
                </div>

                <div class="input-box">
                    <input type="text" placeholder="Active Gmail" required name="active_gmail">
                </div>

                <div class="input-box">
                    <input type="password" placeholder="Password" required name="password">
                </div>

                <div class="input-box">
                    <input type="password" placeholder="Repeat Password" required name="repeat_password">
                </div>
               
            </div>

            <?php include('register-health.php') ?>

            <button type="submit" class="btn-next" name="submit_registration" required>Next</button>
           
        </form>
    </div>
</body>
</html>