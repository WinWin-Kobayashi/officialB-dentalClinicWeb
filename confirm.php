<?php
include 'connection.php';

if ($_GET['appointmentId'] && $_GET['action']) {
    $appointmentId = $_GET['appointmentId'];
    $action = $_GET['action'];

    if ($action === 'accept') {
        $updateQuery = "UPDATE appointments SET status = 'Accepted' WHERE id = $appointmentId";
    } elseif ($action === 'decline') {
        $updateQuery = "UPDATE appointments SET status = 'Cancelled' WHERE id = $appointmentId";
    }

    $updateResult = mysqli_query($conn, $updateQuery);

    if ($updateResult) {
        header('Location: index.php');
        exit(); 
    } else {
        echo 'Error updating appointment status: ' . mysqli_error($conn);
    }
} else {
    echo 'Invalid request.';
}

mysqli_close($conn);
?>
