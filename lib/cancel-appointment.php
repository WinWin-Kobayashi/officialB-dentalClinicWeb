<?php
include '../connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $appointmentId = $_POST['appointmentId'];
    $cancelReason = $_POST['cancelReason'];

    $updateQuery = "UPDATE appointments SET status = 'Cancelled' WHERE id = $appointmentId";

    $updateResult = mysqli_query($conn, $updateQuery);

    if ($updateResult) {
        header('Location: ../admin-dashboard.php');
        exit;
    } else {
        echo 'Error canceling appointment: ' . mysqli_error($conn);
    }
}

if (isset($_GET['appointmentId'])) {
    $appointmentId = $_GET['appointmentId'];

    $selectQuery = "SELECT * FROM appointments WHERE id = $appointmentId";
    $result = mysqli_query($conn, $selectQuery);

    if ($result) {
        $appointment = mysqli_fetch_assoc($result);

        echo '<form method="post" action="">
            <input type="hidden" name="appointmentId" value="' . $appointmentId . '">
            <label for="cancelReason">Reason:</label>
            <select id="cancelReason" name="cancelReason" required>
                <option value="Overbook">Overbook</option>
                <option value="No doctor">No doctor</option>
                <option value="Other">Other</option>
            </select>
            <button type="submit" name="submit">Cancel</button>
        </form>';
    } else {
        echo 'Error fetching appointment details: ' . mysqli_error($conn);
    }
} else {
    echo 'Invalid appointment ID.';
}

mysqli_close($conn);
?>
