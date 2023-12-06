<?php
$conn = mysqli_connect("localhost", "root", "", "dental_clinic_db");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $appointmentId = $_POST['appointmentId'];

    $updateQuery = "UPDATE appointments SET status = 'Accepted' WHERE id = $appointmentId";

    $updateResult = mysqli_query($conn, $updateQuery);

    if ($updateResult) {
        echo 'Appointment accepted successfully.';
    } else {
        echo 'Error accepting appointment: ' . mysqli_error($conn);
    }

    exit;
}

echo 'Invalid request.';
?>
