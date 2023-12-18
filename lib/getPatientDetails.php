<?php
$patientId = $_POST['patientId'];

include '../connection.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Use prepared statement to prevent SQL injection
$query = "SELECT * FROM patients_table1 WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $patientId); // "i" means int
$stmt->execute();
$result = $stmt->get_result();

// Check if a row is returned
if ($result->num_rows > 0) {
    $patientDetails = $result->fetch_assoc();

    //Format time
    $patientDetails['formatted_timestamp'] = date('Y-m-d h:i A', strtotime($patientDetails['create_date']));
    echo json_encode($patientDetails);
} else {
    echo json_encode(array('error' => 'Patient not found'));
}

$stmt->close();
$conn->close();
?>
