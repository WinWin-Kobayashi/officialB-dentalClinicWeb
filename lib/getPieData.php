<?php
$conn = mysqli_connect('localhost', 'root', '', 'dental_clinic_db') or die ('Unable to connect');

// Adjust interval if want to include beyond 1 day
$query = "SELECT status, COUNT(*) as count FROM appointments
          WHERE date >= DATE_SUB(CURDATE(), INTERVAL 1 DAY)
          AND status IN ('Accepted', 'Cancelled') GROUP BY status";
$result = $conn->query($query);

if ($result) {
  $statusCounts = [
    'Accepted' => 0,
    'Cancelled' => 0
  ];
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
