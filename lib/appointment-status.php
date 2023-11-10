<?php

include('../connection.php');

if (isset($_POST['appointmentId'])) {
    $appointmentId = $_POST['appointmentId'];
    $query = '';

    // if cancel validate
    if (isset($_POST['cancel'])) {
        $checkQuery = "SELECT status FROM appointments WHERE id = $appointmentId";
        $checkResult = mysqli_query($conn, $checkQuery);

        if ($checkResult && $row = mysqli_fetch_assoc($checkResult)) {
            if ($row['status'] !== 'Cancelled') {
                $query = "UPDATE appointments SET status = 'Cancelled' WHERE id = $appointmentId";
            } else {
                header("Location: ../admin-dashboard.php?error=Appointment is already Cancelled");
                exit();
            }
        }
        // else if accept validate
    } elseif (isset($_POST['accept'])) {
        $checkQuery = "SELECT status FROM appointments WHERE id = $appointmentId";
        $checkResult = mysqli_query($conn, $checkQuery);

        if ($checkResult && $row = mysqli_fetch_assoc($checkResult)) {
            if ($row['status'] !== 'Cancelled') {
                $query = "UPDATE appointments SET status = 'Accepted' WHERE id = $appointmentId";
            } else {
                header("Location: ../admin-dashboard.php?error=Cannot update a Cancelled appointment");
                exit();
            }
        }
    } else {
        header("Location: ../admin-dashboard.php?error=Invalid operation");
        exit();
    }

    if (!empty($query)) {
        $result = mysqli_query($conn, $query);

        if ($result) {
            header('Location: ../admin-dashboard.php');
        } else {
            header("Location: ../admin-dashboard.php?error=Error updating appointment status");
            exit();
        }
    }
} else {
    header("Location: ../admin-dashboard.php?error=Form not submitted properly");
    exit();
}

mysqli_close($conn);
?>
