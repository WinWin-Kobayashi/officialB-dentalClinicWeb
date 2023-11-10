<?php include('connection.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('globalHead.php'); ?>
    <link rel="stylesheet" href="admin-patients.css">
    <style>
       body{
         background: var(--v-light-purple);
       }
    </style>
</head>
<body>
    <?php include('admin-header.php'); ?>

        <div class="patients-container">
            <div class="appointment-details">
                <table border="1">
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Birthdate</th>
                    <th>Gender</th>
                    <th>Address</th>
                    <th>Contact Number</th>
                    <th>Active Gmail</th>
                    <th>Verified</th>
                    <th>Create Date</th>
                </tr>

                <?php

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "SELECT * FROM patients_table1";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["id"] . "</td>";
                        echo "<td>" . $row["first_name"] . "</td>";
                        echo "<td>" . $row["last_name"] . "</td>";
                        echo "<td>" . $row["birthdate"] . "</td>";
                        echo "<td>" . $row["gender"] . "</td>";
                        echo "<td>" . $row["address"] . "</td>";
                        echo "<td>" . $row["contact_number"] . "</td>";
                        echo "<td>" . $row["active_gmail"] . "</td>";
                        echo "<td>" . $row["verified"] . "</td>";
                        echo "<td>" . $row["create_date"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "No records found";
                }
                $conn->close();
                ?>
            </table>
        </div>
    </div>
</body>
</html>