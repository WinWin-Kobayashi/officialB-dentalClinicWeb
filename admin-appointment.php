<?php include('connection.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Google Font Link for Icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="admin-appointment.css">
    <style>
       body{
         background: var(--v-light-purple);
       }
    </style>
</head>
<body class='admin-appointment'>

    <?php include('admin-header.php'); ?>
    
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
            <h1 style="color: var(--v-dark-purple);">Accepted Appointments</h1>
            <?php

                // MAKE SURE TO CHANGE YOUR DATABASE VALUES IF NECESSARY; ERROR USUALLY OCCUR HERE
                // $servername = "localhost";
                // $username = "root";
                // $password = "";
                // $dbname = "dental_clinic_db";

                // $conn = new mysqli($servername, $username, $password, $dbname);

                // if ($conn-> connect_error) {
                //     die("Connection error: ". $conn->connect_error);
                // }
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
                    $sql = "SELECT * FROM appointments WHERE date = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("s", $date);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    while ($row = $result->fetch_assoc()) {
                        $time = date("g A", strtotime($row['time']));
                        $tables[$time][] = $row;
                    }

                    echo "<br>";

                    echo "<h2 style='color: var(--v-dark-purple); border-bottom: 3px solid var(--v-dark-purple); display: inline-block'>" . date('F j, Y', strtotime($date)) . "</h2>";


                    // display tables with data
                    foreach ($tables as $time => $table_data) {
                        if (!empty($table_data)) {
                            echo "<h3 style='color: var(--v-dark-purple); margin-top: 1rem;'>$time</h3>";
                            // echo "<tr><th>First Name</th><th>Last Name</th><th>Time</th><th>Date</th></tr>";
                            echo "<table style='background: var(--v-light-purple); background: var(--light-purple); width: 97%; padding: 15px; margin-top: 5px; margin-bottom: 5px; color: var(--v-dark-purple); border-radius: 10px; text-align: justify'>";
                                // echo "<tr><th>First Name</th><th>Last Name</th><th>Time</th><th>Date</th></tr>";
                                foreach ($table_data as $row) {
                                    echo "<tr style='font-size: var(--small-font);'>";
                                    echo "<td> <b>" . date('h:i A', strtotime($row['time'])) . "</b> </td>";
                                        echo "<td>" . $row['first_name'] . ' ' .$row['last_name'] .  "</td>";
                                        // echo "<td>" . date('F j', strtotime($row['date'])) . "</td>";
                                        // echo "<td>" . "<button>Reschedule</button>" . "<button>Cancel</button>" . "</td>";
                                        echo "<td style='display: flex; flex-direction: row; width: 95%; justify-content: flex-end;'>
                                                <button style='font-size: var(--small-font); padding: 5px 10px 5px 10px; color: white; background: #FF6099; border: none; border-radius: 5px; cursor: pointer;'>Cancel</button>
                                                <button style='margin-left: 10px; font-size: var(--small-font); padding: 5px 10px 5px 10px; color: var(--v-dark-purple); background: #FFF27D; border: none; border-radius: 5px; cursor: pointer;'>Reschedule</button>
                                             </td>";
                                    echo "</tr>";
                                }
                            echo "</table>";
                        } else {
                            //print empty if no data pass
                            // echo "empty";
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

<!-- <button style='padding: 5px 10px 5px 10px; color: var(--v-dark-purple); background: #FFF27D; border: none; border-radius: 5px; cursor: pointer;'>Reschedule</button> -->
