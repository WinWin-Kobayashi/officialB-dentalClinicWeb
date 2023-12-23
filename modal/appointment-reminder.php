<?php
$mysqli = mysqli_connect("localhost", "root", "", "dental_clinic_db");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$activeGmail = $_SESSION['active_gmail'];

$lastDisplayTime = isset($_SESSION['last_display_time']) ? $_SESSION['last_display_time'] : 0;
$current_time = time();

if ($current_time - $lastDisplayTime >= 24 * 60 * 60) {
    $query = "SELECT *
              FROM appointments
              WHERE active_gmail = ? AND date > NOW() AND status = 'accepted'
              ORDER BY date
              LIMIT 1";

    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("s", $activeGmail);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['last_display_time'] = $current_time;

        echo '<dialog id="myDialog" class="modal">';
        echo '<p>Reminder</p>';
        echo '<p>Upcoming Appointments:</p>';
        while ($row = $result->fetch_assoc()) {
            echo '<label>Date: ' . $row['date'] . ', Time: ' . $row['time'] . '</label><br>';
            echo '<label>Service: ' . $row['service'] . '</label><br>';
            echo '<hr>';
        }
        echo '<button id="closeDialog">Close</button>';
        echo '</dialog>';
    }

    $stmt->close();
}

$mysqli->close();
?>
<script>
    <?php
    if ($result->num_rows > 0) {
        echo 'document.getElementById("myDialog").showModal();';
    }
    ?>
    document.getElementById('closeDialog').addEventListener('click', function () {
        document.getElementById('myDialog').close();
    });
</script>
