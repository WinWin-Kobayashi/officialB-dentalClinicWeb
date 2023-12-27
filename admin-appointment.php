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
    <!-- Google Font Link for Icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="admin-appointment.css">
    <style>
       body{
         background: var(--v-light-purple);
       }

        .appointment-container {
            z-index: 1;
            width: 670px;
        }
    </style>
</head>
<body class='admin-appointment'>

    <?php include('admin-sidebar.php'); ?>
    
    <section class="dashboard" id="dashboard">
        <div class="calendar-container">
            <div class="calendar-wrapper">
                <div class="wrapper">
                    <header>
                        <p class="current-date"></p>
                        <div class="icons">
                        <span id="prev" class="material-symbols-rounded">chevron_left</span>
                        <span id="next" class="material-symbols-rounded">chevron_right</span>
                        </div>
                    </header>
                    <div class="calendar">
                        <ul class="weeks">
                        <li>Sun</li>
                        <li>Mon</li>
                        <li>Tue</li>
                        <li>Wed</li>
                        <li>Thu</li>
                        <li>Fri</li>
                        <li>Sat</li>
                        </ul>
                        <ul class="days"></ul>
                    </div>
                </div>
            </div>

            <!-- // NEED STYLE TO DISPLAY
            <div>
                <div class="cancellations">Cancelled: 
                    <?php echo $cancelledCount; ?>
                </div>
                <div class="accepted">Accepted:
                    <?php echo $acceptedCount; ?>
                </div>
            </div> -->

            <div class="list-wrapper">
                <div class="row">
                    <input type="date" id="selectedDateInput" disabled oninput="fetchAppointments()">
                    <select name="" id="" class="filter-status">
                        <option value="">Accepted</option>
                        <option value="">Canceled</option>
                    </select>
                </div>
                <div class="time-slots" id="appointmentContainer"></div>
            </div>
        
        </div>
    </section>

    <?php require_once('modal/resched-appointment.php');?>
    <?php require_once('modal/cancel-appointment.php');?>

    <script src="script/calendar.js"></script>
    <script>
       function toggleCollapsible(index) {
        const contentList = document.querySelectorAll('.content-list');
        
        // Loop through all content lists and hide them
        contentList.forEach((content, i) => {
            if (i !== index) {
            content.classList.remove('show');
            }
        });

        // Toggle the visibility of the selected content list
        const selectedContent = contentList[index];
        selectedContent.classList.toggle('show');
        }
    </script>
</body>
</html>
