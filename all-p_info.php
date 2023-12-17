<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('globalHead.php'); ?> 
    <link rel="stylesheet" href="user-profile.css">
</head>
<body>
    <div class="wrapper">
        <h1>My Profile</h1>

        <div class="retriever">
            <?php
            session_start();

            // Create connection
            $conn = mysqli_connect('localhost', 'root', '', 'dental_clinic_db') or die ('Unable to connect');
            // Check connection
            if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
            }

            $first_name = $_SESSION["first_name"];

            $sql = "SELECT first_name, last_name, birthdate, gender, address, contact_number, active_gmail FROM patients_table1 WHERE first_name='$first_name'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                // echo "<label for='first_name'> <b> First Name: </b>" . $row["first_name"] . "</label> <br>";
                echo "<label class='label' for='first_name'><b>First Name:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $row["first_name"] . "</label> <br>";
                echo "<label for='last_name'> <b> Last Name: </b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $row["last_name"] . "</label> <br>";
                echo "<label for='birth_date'> <b> Birthdate: </b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $row["birthdate"] . "</label> <br>";
                echo "<label for='gender'> <b> Gender: </b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $row["gender"] . "</label> <br>";
                echo "<label for='address'> <b> Address: </b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $row["address"] . "</label> <br>";
                echo "<label for='contact_number'> <b> Contact Number: </b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $row["contact_number"] . "</label> <br>";
                echo "<label for='active_gmail'> <b> Active Gmail: </b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $row["active_gmail"] . "</label> <br>";
            }
            } else {
            echo "0 results";
            }
            $conn->close();
            ?>
            </div>
    </div>
   
</body>
</html>
