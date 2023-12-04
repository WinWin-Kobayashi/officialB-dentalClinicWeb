<?php
// Include your database connection logic here
$conn = mysqli_connect('localhost', 'root', '', 'dental_clinic_db') or die ('Unable to connect');

// Assuming you have a M
$query = "SELECT status, COUNT(*) as count FROM appointments GROUP BY status";
$result = $conn->query($query);

if ($result) {
  $statusCounts = [];
  while ($row = $result->fetch_assoc()) {
    $statusCounts[$row['status']] = $row['count'];
  }

  // Output JSON response
  header('Content-Type: application/json');
  echo json_encode($statusCounts);
} else {
  // Check for query execution errors
  echo "Error executing query: " . $conn->error;
}

// Close the database connection
$conn->close();
?>
