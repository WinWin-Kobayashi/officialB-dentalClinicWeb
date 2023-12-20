<?php
$treatmentRecordId = $_POST['treatmentRecordId'];

include '../connection.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Use prepared statement to prevent SQL injection
$query = "SELECT * FROM treatment_records WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $treatmentRecordId); // "i" means int
$stmt->execute();
$result = $stmt->get_result();

// Check if a row is returned
if ($result->num_rows > 0) {
    $treatmentRecordDetails = $result->fetch_assoc();

    //Format time
    $treatmentRecordDetails['formatted_treatmentDate'] = date('Y-m-d', strtotime($treatmentRecordDetails['date']));
    echo json_encode($treatmentRecordDetails);
} else {
    echo json_encode(array('error' => 'Treatment not found'));
}

$stmt->close();
$conn->close();
?>
