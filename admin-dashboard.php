<?php include('connection.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('globalHead.php'); ?>
    <link rel="stylesheet" href="admin-dashboard.css">
    <link rel="stylesheet" href="indexStyle.css">
</head>
<body>

    <?php include('admin-header.php');?>

    <!-- for error on appointment status -->
    <?php if (isset($_GET['error'])) { ?>
        <script>
            alert("<?php echo $_GET['error']; ?>");
        </script>
    <?php } ?>


    <section id="home">
        <div class="row">
            <div class="confirmed-appointments-container">Confirmed Appointments</div>
            <div class="numbers-container">
                <div class="cancellations">Cancelled: </div>
                <div class="accepted">Accepted: </div>
            </div>
        </div>

        <div class="appointment-requests-container">
            <h3>Appointment Requests</h3>
            <div class="appointment-req-table">
            <?php

            // Check for connection 
            if ($conn) {

                $query = "SELECT * FROM appointments";
                $result = mysqli_query($conn, $query);
                if ($result) {
                    echo '<table class="table">
                        <thead class="thead">
                            <tr>
                                <th>Id</th>
                                <th scope="col">Fullname</th>
                                <th scope="col">Date Created</th>
                                <th scope="col">Appointment Date</th>
                                <th scope="col">Appointment Time</th>
                                <th scope="col">Service</th>
                                <th scope="col">Status</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>

                        <tbody>';

                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<tr>
                                <td>' . $row['id'] . '</td>
                                <td>' . $row['first_name'] . ' ' . $row['last_name'] . '</td>
                                <td>' . date('Y-m-d', strtotime($row['date_created'])) . '</td>
                                <td>' . $row['date'] . '</td>
                                <td>' . date('h:i A', strtotime($row['time'])) . '</td>
                                <td>' . $row['service'] . '</td>
                                <td>' . $row['status'] . '</td>
                                <td>
                                    <form method="post" action="lib/appointment-status.php">
                                        <input type="hidden" name="appointmentId" value="' . $row['id'] . '">
                                        <button type="submit" name="cancel">Cancel</button>
                                        <button>Reschedule</button>
                                        <button type="submit" name="accept">Accept</button>
                                    </form>
                                </td>
                            </tr>';
                        }

                        echo '</tbody></table>';
                        } else {
                            echo 'Error: ' . mysqli_error($conn);
                        }
                } else {
                    echo 'Database connection failed: ' . mysqli_connect_error();
                    }
                    // close connetions
                    mysqli_close($conn);
                ?>

            </div>
        </div>
    </section>

</body>
</html>