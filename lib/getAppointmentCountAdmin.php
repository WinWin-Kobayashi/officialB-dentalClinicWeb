<?php

include '../connection.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT date, COUNT(*) AS appointment_count FROM appointments WHERE status = 'Accepted' GROUP BY date";
$result = $conn->query($sql);

$response = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $date = $row["date"];
        $appointmentCount = $row["appointment_count"];
        $appointmentData = array(
            'date' => $date,
            'appointment_count' => $appointmentCount
        );
        $response[] = $appointmentData;
    }
}
$conn->close();
echo json_encode($response);
?>
