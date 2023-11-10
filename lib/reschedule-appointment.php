<?php
include '../connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $appointmentId = $_POST['appointmentId'];
    $newDate = $_POST['newDate'];
    $newTime = $_POST['newTime'];

    $updateQuery = "UPDATE appointments SET date = '$newDate', time = '$newTime' WHERE id = $appointmentId";

    $updateResult = mysqli_query($conn, $updateQuery);

    if ($updateResult) {
        header('Location: ../admin-dashboard.php');
        exit;
    } else {
        echo 'Error updating appointment: ' . mysqli_error($conn);
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
            <label for="newDate">New Date:</label>
            <input type="date" id="newDate" name="newDate" required>
            <label for="newTime">New Time:</label>
            <input type="time" id="newTime" name="newTime" required>
            <button type="submit" name="submit">Reschedule</button>
        </form>';
    } else {
        echo 'Error fetching appointment details: ' . mysqli_error($conn);
    }
} else {
    echo 'Invalid appointment ID.';
}
mysqli_close($conn);
?>
