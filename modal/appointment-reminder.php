<?php
session_start();

$mysqli = mysqli_connect("localhost", "root", "", "dental_clinic_db");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$activeGmail = $_SESSION['active_gmail'];

// $query = "SELECT *
//           FROM appointments
//           WHERE active_gmail = ? AND date >= CURDATE() AND status = 'Accepted'
//           ORDER BY date
//           LIMIT 1";

$query = "SELECT *
          FROM appointments
          WHERE active_gmail = ? AND CONCAT(date, ' ', time) >= NOW() AND status = 'Accepted'
          ORDER BY date
          LIMIT 1";


$stmt = $mysqli->prepare($query);
$stmt->bind_param("s", $activeGmail);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0 && !isset($_SESSION['dialog_shown'])) {
    echo '<dialog id="myDialog" class="modal modal-container">';
    echo '<p class="main-text">Upcoming Appointment!</p>';
    while ($row = $result->fetch_assoc()) {
        echo '<label> <b> Date: </b>' . date('F j, Y', strtotime($row['date'])) . '<br>' . 
                     ' <b> Time: </b>' . date('h:i A', strtotime($row['time'])). '</label><br>';
        echo '<label> <b> Service: </b>' . $row['service'] . '</label><br>';
    }
    echo '<button id="closeDialog" class="close-modal-full">Close</button>';
    echo '</dialog>';

    $_SESSION['dialog_shown'] = true;
}

$stmt->close();
$mysqli->close();
?>
<script>
    <?php if ($result->num_rows > 0 && !isset($_SESSION['dialog_closed'])) : ?>
        document.getElementById("myDialog").showModal();

        document.getElementById('closeDialog').addEventListener('click', function () {
            document.getElementById('myDialog').close();
            <?php $_SESSION['dialog_closed'] = true; ?>
        });
    <?php endif; ?>
</script>