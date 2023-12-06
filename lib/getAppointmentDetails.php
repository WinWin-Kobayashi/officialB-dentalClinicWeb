<?php
$appointmentId = $_POST['appointmentId'];

include '../connection.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Use prepared statement to prevent SQL injection
$query = "SELECT * FROM appointments WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $appointmentId); // "i" means int
$stmt->execute();
$result = $stmt->get_result();

// Check if a row is returned
if ($result->num_rows > 0) {
    $appointmentDetails = $result->fetch_assoc();

    //Format time
    $appointmentDetails['formatted_time'] = date('h:i', strtotime($appointmentDetails['time']));
    
    echo json_encode($appointmentDetails);
} else {
    echo json_encode(array('error' => 'Appointment not found'));
}

$stmt->close();
$conn->close();
?>
