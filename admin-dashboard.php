<?php include('connection.php'); ?>

<?php

// Count accpted and cancelled

$sqlAccepted = "SELECT COUNT(*) AS acceptedCount FROM appointments WHERE status = 'Accepted'";
$resultAccepted = $conn->query($sqlAccepted);
$sqlCancelled = "SELECT COUNT(*) AS cancelledCount FROM appointments WHERE status = 'Cancelled'";
$resultCancelled = $conn->query($sqlCancelled);
$sqlPending = "SELECT COUNT(*) AS pendingCount FROM appointments WHERE status = 'Pending'";
$resultPending = $conn->query($sqlPending );
$acceptedCount = 0;
$cancelledCount = 0;
$pendingCount = 0;

if ($resultAccepted && $resultCancelled) {
    $rowAccepted = $resultAccepted->fetch_assoc();
    $rowCancelled = $resultCancelled->fetch_assoc();
    $rowPending = $resultPending->fetch_assoc();

    $acceptedCount = $rowAccepted['acceptedCount'];
    $cancelledCount = $rowCancelled['cancelledCount'];
    $pendingCount = $rowPending['pendingCount'];
} else {
    echo "Error: " . $sqlAccepted . "<br>" . $conn->error;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('globalHead.php'); ?>
    <link rel="stylesheet" href="admin-dashboard.css">
    <!-- <link rel="stylesheet" href="indexStyle.css"> -->
    <style>
       body{
         background: var(--v-light-purple);
       }
    </style>
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
                        <?php echo $cancelledCount; ?>
                    </div>
                    <div class="accepted">Accepted:
                        <?php echo $acceptedCount; ?>
                    </div>
                </div>
            </div>

            <div class="appointment-requests-container">
                <h3>Appointment Requests ( <?php echo $pendingCount; ?> )</h3>
                <form method="get" action="admin-dashboard.php">
                    <!-- Dropdown for filtering by status -->
                    <label for="statusFilter">Filter by Status:</label>
                    <select id="statusFilter" name="status" onchange="this.form.submit()">
                        <option value="Pending" <?php echo (isset($_GET['status']) && $_GET['status'] == 'Pending') ? 'selected' : ''; ?>>Pending</option>
                        <option value="Cancelled" <?php echo (isset($_GET['status']) && $_GET['status'] == 'Cancelled') ? 'selected' : ''; ?>>Cancelled</option>
                        <option value="Accepted" <?php echo (isset($_GET['status']) && $_GET['status'] == 'Accepted') ? 'selected' : ''; ?>>Accepted</option>
                    </select>
                </form>

                <div class="appointment-req-table">
                    <?php
                    // Check for connection 
                    if ($conn) {
                        // Default status filter value
                        $statusFilter = 'Pending';

                        // Check if a specific status is selected in the dropdown
                        if (isset($_GET['status']) && in_array($_GET['status'], ['Pending', 'Cancelled', 'Accepted'])) {
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
                                    ' . (($row['status'] == 'Pending') ? '<td>
                                        <button onclick="redirectToPage(\'cancel\', ' . $row['id'] . ')">Cancel</button>
                                        <button onclick="redirectToPage(\'reschedule\', ' . $row['id'] . ')">Reschedule</button>
                                        <button onclick="acceptAppointment(' . $row['id'] . ')">Accept</button>
                                    </td>' : '') . '
                                </tr>';
                            }

                            echo '</tbody></table>';
                        } else {
                            echo 'Error: ' . mysqli_error($conn);
                        }
                    } else {
                        echo 'Database connection failed: ' . mysqli_connect_error();
                    }
                    // close connections
                    // mysqli_close($conn);
                ?>

            </div>
        </section>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
    //Make the AJAX request
        function acceptAppointment(appointmentId) {
            var url = 'lib/accept-appointment.php';
            $.post(url, { appointmentId: appointmentId }, function (response) {
                alert(response);
                setTimeout(function() {
                    window.location.reload();
                }, 100);
            });
        }
        function redirectToPage(action, appointmentId) {
            var url;
            if (action === 'cancel') {
                url = 'lib/cancel-appointment.php';
            } else if (action === 'reschedule') {
                url = 'lib/reschedule-appointment.php';
            }
            url += '?appointmentId=' + appointmentId;

            window.location.href = url;
        }
    </script>
</body>
</html>