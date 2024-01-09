<?php
    include('connection.php');
    
//APPOINTMENT REMINDERS ONLY SENDS WHEN THE ADMIN LOGS IN. ONCE A DAY.
    include('admin-appointment-reminders.php'); 

    // Get the current date
    $currentDate = date('Y-m-d');

    // Query to get the date when the last reminders were sent
    $query = "SELECT reminder_date FROM reminders_sent ORDER BY reminder_date DESC LIMIT 1";
    $result = $conn->query($query);

    if ($result) {
        $row = $result->fetch_assoc();
        $lastReminderDate = $row['reminder_date'];

        // If the reminders have not been sent today, send them
        if ($lastReminderDate != $currentDate) {
            sendAppointmentReminders();

            // Update the reminders_sent table
            $conn->query("INSERT INTO reminders_sent (reminder_date) VALUES ('$currentDate')");
        }
    }
?>


<?php

// Count accepted and cancelled
$sqlPending = "SELECT COUNT(*) AS pendingCount FROM appointments WHERE status = 'Pending'";
$resultPending = $conn->query($sqlPending);

if ($resultPending) {
    $rowPending = $resultPending->fetch_assoc();
    $pendingCount = $rowPending['pendingCount'];
} else {
    $pendingCount = 0;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('globalHead.php'); ?>
    <link rel="stylesheet" href="style/admin-dashboard.css">
    <!-- <link rel="stylesheet" href="indexStyle.css"> -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

    <?php include('admin-sidebar.php');?>

    <section class="dashboard" id="dashboard">
        <div class="dashboard-container">
            <section id="home" class="home">
                <div class="row">
                    <!-- confirmed appointments box -->
                    <div class="confirmed-appointments-container">
                        <div class="appointment-req-table">
                            <div style="width: 80%; margin: auto;">
                                <canvas id="myBarChart" width="400" height="150"></canvas>
                            </div>
                        </div>
                    </div>

                    <!-- numbers box -->
                    <div class="numbers-container" style="display: flex; align-items: center; justify-content: center;">
                        <div style="position: relative; margin-top: -6.5rem; height: 250px; width: 250px;" >
                            <canvas id="appointmentChart" ></canvas>
                        </div>
                    </div>
                </div>

                <!-- appointments req container -->
                <div class="appointment-requests-container">
                

                    <div class="ap-req-con-row">
                        <h3>Appointment Requests ( <?php echo $pendingCount; ?> )</h3>

                        <div class="selection">
                            <form method="get" action="admin-dashboard.php" >
                                <!-- Dropdown for filtering by status -->
                                <label for="statusFilter">
                                    <i class="material-icons">filter_alt</i>Filter</label>
                                <select id="statusFilter" name="status" onchange="this.form.submit()">
                                    <option value="Pending" <?php echo (isset($_GET['status']) && $_GET['status'] == 'Pending') ? 'selected' : ''; ?>>Pending</option>
                                    <option value="Cancelled" <?php echo (isset($_GET['status']) && $_GET['status'] == 'Cancelled') ? 'selected' : ''; ?>>Cancelled</option>
                                    <option value="Accepted" <?php echo (isset($_GET['status']) && $_GET['status'] == 'Accepted') ? 'selected' : ''; ?>>Accepted</option>
                                </select>
                            </form>
                        </div>

                        <form action="" method="get">
                            <input type="hidden" name="status" value="Pending">
                            <button type="submit">
                                <i class="material-icons">sync</i>Refresh</button>
                        </form>
                

                    </div>
                

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

                            $query = "SELECT * FROM appointments WHERE status = '$statusFilter' ORDER BY date DESC, time DESC";
                            $result = mysqli_query($conn, $query);

                            if ($result) { ?>
                            <div class="table-div">
                                <table class="table">
                                    <thead class="thead">
                                        <tr>
                                            <th class="fixed" scope="col">Name</th>
                                            <th class="fixed" scope="col">Date</th>
                                            <th class="fixed" scope="col">Time</th>
                                            <th class="fixed" scope="col">Service</th>
                                            <th class="fixed" scope="col">Status</th>
                                            <th class="fixed" scope="col">Screenshot</th>
                                            <?php if($statusFilter === 'Pending') { ?>
                                            <th class="fixed" scope="col">Actions</th>
                                            <?php } ?>
                                        </tr>
                                    </thead>

                                    <tbody> <?php ;



                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo '<tr>
                                        <td>' . $row['first_name'] . ' ' . $row['last_name'] . '</td>
                                        <td>' . date('F j, Y', strtotime($row['date'])) . '</td>
                                        <td>' . date('h:i A', strtotime($row['time'])) . '</td>
                                        <td>' . $row['service'] . '</td>
                                        <td>' . $row['status'] . '</td>
                                        <td> <button class="button" id="viewss" onclick="openViewScreenshotModal(' . $row['id'] . ')">View</button></td>
                                        ' . (($row['status'] == 'Pending') ? '<td class="action">
                                            <button class="button" id="cancel"  onclick="openCancelModal(' . $row['id'] . ')">Cancel</button>
                                            <button class="button" id="reschedule" onclick="openReschedModal(' . $row['id'] . ')">Reschedule</button>
                                            <button class="button" id="accept" onclick="openAcceptModal(' . $row['id'] . ')">Accept</button>
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
    </section>

    <?php require_once('modal/accept-request.php');?>
    <?php require_once('modal/resched-appointment.php');?>
    <?php require_once('modal/cancel-appointment.php');?>
    <?php require_once('modal/view-screenshot.php');?>


    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!-- <script src="script/bar-chart.js" defer></script> -->
    <script src="script/pie.js" defer></script>
    <script>
    //Make the AJAX request
        // function redirectToPage(action, appointmentId) {
        //     var url;
        //     if (action === 'cancel') {
        //         url = 'lib/cancel-appointment.php';
        //     } else if (action === 'reschedule') {
        //         url = 'lib/reschedule-appointment.php';
        //     }
        //     url += '?appointmentId=' + appointmentId;

        //     window.location.href = url;
        // }
    </script>

<?php
// SQL queries
$sql_accepted = "SELECT date, COUNT(*) as count FROM appointments WHERE status = 'Accepted' GROUP BY date ORDER BY date ASC";
$sql_cancelled = "SELECT date, COUNT(*) as count FROM appointments WHERE status = 'Cancelled' GROUP BY date ORDER BY date ASC";
$sql_request = "SELECT date, COUNT(*) as count FROM appointments WHERE status = 'Pending' GROUP BY date ORDER BY date ASC";

$result_accepted = $conn->query($sql_accepted);
$result_cancelled = $conn->query($sql_cancelled);
$result_request = $conn->query($sql_request);

// Check if the queries returned a result
if (!$result_accepted || !$result_cancelled || !$result_request) {
    die("Query failed: " . $conn->error);
}

// Fetch data and format it for JavaScript
$labels = array();
$dataset_accepted = array();
$dataset_cancelled = array();
$dataset_request = array();

while($row = $result_accepted->fetch_assoc()) {
    $labels[] = $row['date'];
    $dataset_accepted[] = $row['count'];
}

while($row = $result_cancelled->fetch_assoc()) {
    $dataset_cancelled[] = $row['count'];
}

while($row = $result_request->fetch_assoc()) {
    $dataset_request[] = $row['count'];
}

// Encode data in JSON format
$labels_json = json_encode($labels);
$dataset_accepted_json = json_encode($dataset_accepted);
$dataset_cancelled_json = json_encode($dataset_cancelled);
$dataset_request_json = json_encode($dataset_request);
?>

<script>
// Use the JSON data to populate the chart
var data = {
    labels: <?php echo $labels_json; ?>,
    datasets: [
        {
            label: 'Cancelled',
            backgroundColor: 'rgba(255, 99, 132, 0.7)', // Adjusted opacity to 0.7
            borderColor: 'rgba(255, 99, 132, 1)',
            borderWidth: 1,
            data: <?php echo $dataset_cancelled_json; ?>,
        },
        {
            label: 'Accepted',
            backgroundColor: '#90F2AC', // Adjusted opacity to 0.7
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1,
            data: <?php echo $dataset_accepted_json; ?>
        },
        {
            label: 'Request',
            backgroundColor: 'rgba(255, 206, 86, 0.7)', // Adjusted opacity to 0.7
            borderColor: 'rgba(255, 206, 86, 1)',
            borderWidth: 1,
            data: <?php echo $dataset_request_json; ?>
        },
    ]
};


// Create Bar Chart
var ctx = document.getElementById('myBarChart').getContext('2d');
var myBarChart = new Chart(ctx, {
    type: 'bar',
    data: data,
    options: {
        scales: {
            x: {
                stacked: true,
                ticks: {
                    color: '#531A62', // text color of x-axis
                    color: 'rgba(83, 26, 98, 0.5)',
                    font: {
                        // family: 'Arial', 
                        size: 13, // font size
                        weight: 'bold',
                    }
                }
            },
            y: {
                stacked: true,
                ticks: {
                    beginAtZero: true,
                    stepSize: 1, // This ensures that only integer values are shown on the y-axis
                    color: '#531A62',
                    color: 'rgba(83, 26, 98, 0.5)',
                    font: {
                        size: 13,
                        weight: 'bold',
                    }
                }
            }
        }
    }
});
</script>
</body>
</html>