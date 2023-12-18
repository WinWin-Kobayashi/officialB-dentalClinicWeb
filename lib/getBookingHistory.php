<?php
$bookingId = $_POST['bookingId'];

include '../connection.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Use prepared statement to prevent SQL injection
$query = "SELECT * FROM appointments WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $bookingId); // "i" means int
$stmt->execute();
$result = $stmt->get_result();

// Check if a row is returned
if ($result->num_rows > 0) {
    $bookingDetails = $result->fetch_assoc();

    //Format time
    $bookingDetails['formatted_timestampBooking'] = date('Y-m-d h:i A', strtotime($bookingDetails['date_created']));
    echo json_encode($bookingDetails);
} else {
    echo json_encode(array('error' => 'Booking not found'));
}

$stmt->close();
$conn->close();
?>
