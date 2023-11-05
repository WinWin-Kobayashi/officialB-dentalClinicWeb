<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Google Font Link for Icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
    <link rel="stylesheet" href="admin-appointment.css">
</head>
<body>
    <?php include('admin-header.php');?>
    <div class="calendar-container">
        <div class="wrapper">
        <header>
            <p class="current-date"></p>
            <div class="icons">
            <span id="prev" class="material-symbols-rounded">chevron_left</span>
            <span id="next" class="material-symbols-rounded">chevron_right</span>
            </div>
        </header>
        <div class="calendar">
            <ul class="weeks">
            <li>Sun</li>
            <li>Mon</li>
            <li>Tue</li>
            <li>Wed</li>
            <li>Thu</li>
            <li>Fri</li>
            <li>Sat</li>
            </ul>
            <ul class="days"></ul>
        </div>
        </div>
    </div>

    <div class="appointment-container">
        <div class="filtered-data">
            <h1>Appointment</h1>
            <?php

            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "appointment";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn-> connect_error) {
                die("Connection error: ". $conn->connection_error);
            }
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Retrieve the user's selected date from the form
                $date = $_POST['appointment'];

                // time range
                $start_time = strtotime("09:00:00");
                $end_time = strtotime("17:00:00");

                // Loop through all hours and initialize empty arrays
                $tables = array();
                for ($i = 9; $i <= 17; $i++) {
                    $tables[date("g A", $start_time)] = array();
                    $start_time = strtotime("+1 hour", $start_time);
                }

                // query database and generate the data
                $sql = "SELECT * FROM Sched WHERE date = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("s", $date);
                $stmt->execute();
                $result = $stmt->get_result();

                while ($row = $result->fetch_assoc()) {
                    $time = date("g A", strtotime($row['time']));
                    $tables[$time][] = $row;
                }

                // display tables with data
                foreach ($tables as $time => $table_data) {
                    if (!empty($table_data)) {
                        echo "<h3>$time</h3>";
                        echo "<table>";
                        echo "<tr><th>ID</th><th>First Name</th><th>Time</th><th>Date</th></tr>";
                        foreach ($table_data as $row) {
                            echo "<tr>";
                            echo "<td>" . $row['id'] . "</td>";
                            echo "<td>" . $row['first_name'] . "</td>";
                            echo "<td>" . $row['time'] . "</td>";
                            echo "<td>" . $row['date'] . "</td>";
                            echo "</tr>";
                        }
                        echo "</table>";
                    } else {
                        //print empty if no data pass
                        echo "empty";
                    }
                }

                $stmt->close();
            }

            $conn->close();
            ?>
        </div>
    </div>

    <script src="script/calendar.js" defer></script>
</body>
</html>