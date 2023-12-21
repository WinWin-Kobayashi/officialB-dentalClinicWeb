<?php 
    include('connection.php'); 
    session_start();
    if($_SESSION['id'] == null){   
        header('location:login.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('globalHead.php'); ?>
    <link rel="stylesheet" href="book-history.css">
</head>
<body>

    <h3>My Booking History</h3>
    <div class="table-container">
        <table class="table">
            <thead class="thead">
                <tr>
                    <th>Id</th>
                    <th scope="col">Date Created</th>
                    <th scope="col">Appointment Date</th>
                    <th scope="col">Appointment Time</th>
                    <th scope="col">Service</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>

            <tbody>
                <?php
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    $active_gmail =  $_SESSION['active_gmail'];

                    $sql = "SELECT * FROM appointments WHERE active_gmail = '$active_gmail' ";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                                echo "<td>" . $row["id"] . "</td>";
                                echo "<td>" . date("F d, Y \a\\t h:i A", strtotime($row["date_created"])) . "</td>";                                echo "<td>" . date('F j, Y', strtotime($row['date'])) . "</td>";
                                echo "<td>" . date('h:i A', strtotime($row['time'])) . "</td>";
                                echo "<td>" . $row["service"] . "</td>";
                                echo "<td>" . $row["status"] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "No records found";
                    }
                    $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
