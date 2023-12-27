<?php
$conn = mysqli_connect("localhost", "root", "", "dental_clinic_db");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $date = $_POST['appointment'];
} else {
    $date = date("Y-m-d");
}

$sql = "SELECT * FROM appointments WHERE date = ? AND status = 'Accepted' ORDER BY time";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $date);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $currentTime = '';
    $collapsibleIndex = 0;

    while ($row = $result->fetch_assoc()) {
        $appointmentTime = date('g A', strtotime($row['time']));

        // Check if the time has changed
        if ($appointmentTime !== $currentTime) {
            // If yes, close the previous collapsible div
            if ($currentTime !== '') {
                echo '</ul></div>';
            }

            // Fetch appointments count for a specific date and time from the database
$countSql = "SELECT COUNT(*) as count FROM appointments WHERE date = ? AND time = ? AND status = 'Accepted'";
$countStmt = $conn->prepare($countSql);

// Display the new time as a collapsible header with right arrow icon and item count
echo "
<button type='button' class='collapsible' onclick='toggleCollapsible($collapsibleIndex)' style='position: relative; width: 500px; border-top: 1px solid #ccc;'>
    <h3 style='color: purple; margin-top: 1px; display: flex; justify-content: space-between; align-items: center; padding-top: 5px;'>
        <span>$appointmentTime</span>";

// Bind parameters for the count query
$countStmt->bind_param("ss", $date, $row['time']);
$countStmt->execute();
$countResult = $countStmt->get_result();

if ($countResult->num_rows > 0) {
    $countRow = $countResult->fetch_assoc();
    $appointmentCount = $countRow['count'];

    echo "
        <span style='display: flex; align-items: center;'>
            <span style='font-size: 14px;'>$appointmentCount</span>
            <i class='material-icons' style='margin-left: 5px;'>keyboard_arrow_down</i>
        </span>";
} else {
    // if no apointments 404
    echo "<span>No appointments</span>";
}

echo "
    </h3>
</button>";
            echo "<div class='content-list'><ul>";
            $collapsibleIndex++;

            $currentTime = $appointmentTime;
        }

        // Display the appointment details as list view using table
        echo "<table style='background: var(--v-light-purple); background: var(--light-purple); width: 97%; padding: 15px; margin-top: 5px; margin-bottom: 5px; color: var(--v-dark-purple); border-radius: 10px; text-align: justify'>";
            echo "<tr style='font-size: 16px;'>";
                echo "<td> <b>" . date('h:i A', strtotime($row['time'])) . "</b> </td>";
                echo "<td>" . $row['first_name'] . ' ' .$row['last_name'] . ' : <b> ' .$row['service'] . " </b> </td>";
                echo "<td style='display: flex; flex-direction: row; width: 95%; justify-content: flex-end;'>
                <button onclick=\"redirectToPage('cancel', {$row['id']})\" style='font-size: 18px; padding: 3px 6px 3px 6px; color: white; background: #FF6099; border: none; border-radius: 5px; cursor: pointer;'>Cancel</button>
                <button onclick=\"redirectToPage('reschedule', {$row['id']})\" style='margin-left: 10px; font-size: var(--small-font); padding: 3px 6px 3px 6px; color: var(--v-dark-purple); background: #FFF27D; border: none; border-radius: 5px; cursor: pointer;'>Reschedule</button>
                </td>";
            echo "</tr>";
        echo "</table>";
    }

    // Close the last collapsible div
    echo '</ul></div>';
} else {
    echo "No appointments for the selected date.";
}

$stmt->close();
$conn->close();
?>