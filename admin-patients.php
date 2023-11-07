<?php include('connection.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php include('admin-header.php'); ?>
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

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Query to fetch data from the patients_table1
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

    // Close the database connection
    $conn->close();
    ?>
</table>
</body>
</html>