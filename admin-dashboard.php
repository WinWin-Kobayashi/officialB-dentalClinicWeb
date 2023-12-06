<?php include('connection.php'); ?>
<?php require_once('lib/accept-appointment.php'); ?>

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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
       body{
         background: var(--v-light-purple);
       }

       #modal{
	padding: 1rem;
	top: 50%;
	left: 50%;
	translate: -50% -50%;
	background: white;
	border-radius: 0.25rem;
	z-index: 10;
}
    </style>

</head>
<body>

    <?php include('admin-header.php');?>

    <div class="dashboard-container">
        <section id="home">
            <div class="row">
                <!-- confirmed appointments box -->
                <div class="confirmed-appointments-container">Confirmed Appointments
                    <div class="appointment-req-table">
                        <div style="width: 80%; margin: auto;">
                            <canvas id="myBarChart" width="400" height="150"></canvas>
                        </div>
                    </div>
                </div>

                <!-- numbers box -->
                <div class="numbers-container">
                    <div class="cancellations">Cancelled: 
                        <?php echo $cancelledCount; ?>
                    </div>
                    <div class="accepted">Accepted:
                        <?php echo $acceptedCount; ?>
                    </div>
                        <div style="margin: auto;">
                            <canvas id="appointmentChart"></canvas>
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
                            <label for="statusFilter">Filter by Status:</label>
                            <select id="statusFilter" name="status" onchange="this.form.submit()">
                                <option value="Pending" <?php echo (isset($_GET['status']) && $_GET['status'] == 'Pending') ? 'selected' : ''; ?>>Pending</option>
                                <option value="Cancelled" <?php echo (isset($_GET['status']) && $_GET['status'] == 'Cancelled') ? 'selected' : ''; ?>>Cancelled</option>
                                <option value="Accepted" <?php echo (isset($_GET['status']) && $_GET['status'] == 'Accepted') ? 'selected' : ''; ?>>Accepted</option>
                            </select>
                        </form>
                    </div>
              

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

                        $query = "SELECT * FROM appointments WHERE status = '$statusFilter'";
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
                                        <th class="fixed"scope="col">Actions</th>
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
                                    ' . (($row['status'] == 'Pending') ? '<td class="action" ">
                                        <button class="button" id="cancel"  onclick="redirectToPage(\'cancel\', ' . $row['id'] . ')">Cancel</button>
                                        <button class="button" id="reschedule" onclick="redirectToPage(\'reschedule\', ' . $row['id'] . ')">Reschedule</button>
                                        <button class="button" id="accept" onclick="openModal(' . $row['id'] . ')">Accept</button>
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

    <?php require_once('modal/accept-modal.php');?>
    
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="script/bar-chart.js" defer></script>
    <script src="script/pie.js" defer></script>
    <script>
    //Make the AJAX request
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
    <script>
    // Fetch Data
    fetch('lib/pie-data.php')
      .then(response => response.json())
      .then(data => {
        const defaultValues = {
          'Pending': 0,
          'Accepted': 0,
          'Cancelled': 0,
        };

        const statusCounts = { ...defaultValues, ...data };
        const labels = Object.keys(statusCounts);
        const counts = Object.values(statusCounts);

        // Create Pie
        const ctx = document.getElementById('appointmentChart').getContext('2d');
        new Chart(ctx, {
          type: 'pie',
          data: {
            labels: labels,
            datasets: [{
              data: counts,
              backgroundColor: ['#FFF27D', '#90F2AC', '#FF6099'], // pie color
            }],
          },
        });
      })
      .catch(error => console.error('Error fetching data:', error));
  </script>
</body>
</html>