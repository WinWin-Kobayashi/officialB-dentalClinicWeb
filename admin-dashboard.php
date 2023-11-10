<?php include('connection.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('globalHead.php'); ?>
    <link rel="stylesheet" href="admin-dashboard.css">
    <!-- <link rel="stylesheet" href="indexStyle.css"> -->
</head>
<body>

    <?php include('admin-header.php');?>

    <div class="dashboard-container">
        <section id="home">
            <div class="row">
                <div class="confirmed-appointments-container">Confirmed Appointments
                    <div class="appointment-req-table">
                        
                        </div>
                </div>
                <div class="numbers-container">
                    <div class="cancellations">Cancelled: 
                        <div class="appointment-req-table">
                        
                        </div>
                    </div>
                    <div class="accepted">Accepted:
                    </div>
                </div>
            </div>

            <div class="appointment-requests-container">
                <h3>Appointment Requests</h3>
                <form method="get" action="admin-dashboard.php">
                    <!-- Dropdown for filtering by status -->
                    <label for="statusFilter">Filter by Status:</label>
                    <select id="statusFilter" name="status" onchange="this.form.submit()">
                        <option value="Pending" <?php echo ($_GET['status'] == 'Pending') ? 'selected' : ''; ?>>Pending</option>
                        <option value="Cancelled" <?php echo ($_GET['status'] == 'Cancelled') ? 'selected' : ''; ?>>Cancelled</option>
                        <option value="Accepted" <?php echo ($_GET['status'] == 'Accepted') ? 'selected' : ''; ?>>Accepted</option>
                    </select>
                </form>

                <div class="appointment-req-table">
                <?php

                // Check for connection 
                if ($conn) {
                     // Default status filter value
                    $statusFilter = 'Pending';

                    // Check if a specific status is selected in the dropdown
                    if (isset($_GET['status']) && in_array($_GET['status'], ['Pending', 'Canceled', 'Accepted'])) {
                        $statusFilter = $_GET['status'];
                    }

                    $query = "SELECT * FROM appointments WHERE status = '$statusFilter'";
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
                        //mysqli_close($conn);
                    ?>

                </div>
        </section>
    </div>
</body>
</html>