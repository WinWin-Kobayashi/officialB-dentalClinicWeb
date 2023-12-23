<?php

$mysqli = mysqli_connect("localhost", "root", "", "dental_clinic_db");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$activeGmail = $_SESSION['active_gmail'];

$query = "SELECT *
          FROM appointments
          WHERE active_gmail = ? AND date > NOW()";

$stmt = $mysqli->prepare($query);
$stmt->bind_param("s", $activeGmail);
$stmt->execute();
$result = $stmt->get_result();
?>

<dialog id="myDialog" class="modal">
    <p>Reminder</p>
    <button id="closeDialog">Close</button>
</dialog>

<script>
    <?php
    if ($result->num_rows > 0) {
        echo 'document.getElementById("myDialog").showModal();';
    }
    ?>
    document.getElementById('closeDialog').addEventListener('click', function() {
        document.getElementById('myDialog').close();
    });
</script>