<?php 
    include('connection.php'); 
    session_start();
    if($_SESSION['first_name'] == null){   
        header('location:login.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('globalHead.php'); ?>
    <link rel="stylesheet" href="dental-records.css">

</head>
<body>

    <h3>My Dental Records</h3>
    <div class="table-container">
        <table class="table">
            <thead class="thead">
                <tr>
                    <th>Id</th>
                    <th scope="col">Date</th>
                    <th scope="col">Tooth</th>
                    <th scope="col">Procedures Performed</th>
                    <th scope="col">Amount Charged</th>
                    <th scope="col">Amount Paid</th>
                </tr>
            </thead>

            <tbody>
                <?php
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    $active_gmail =  $_SESSION['active_gmail'];

                    $sql = "SELECT * FROM dental_records WHERE active_gmail = '$active_gmail' ";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                                echo "<td>" . $row["id"] . "</td>";
                                echo "<td>" . date('F j, Y', strtotime($row['date'])) . "</td>";                           
                                echo "<td>" . $row["tooth"] . "</td>";
                                echo "<td>" . $row["procedures_performed"] . "</td>";
                                echo "<td>" . $row["amount_charged"] . "</td>";
                                echo "<td>" . $row["amount_paid"] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        $msg = "No records found";
                    }
                    $conn->close();
                ?>
            </tbody>
        </table>
       
    </div>
    
    <!-- display $msg (if no dental records are found) -->
    <br>
    <h1><?php echo $msg ?></h1>
</body>
</html>
