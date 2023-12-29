<?php 
    ob_start(); // Start output buffering
    session_start();
    if ($_SESSION['id'] == null) {   
        header('location: login.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('globalHead.php'); ?>
    <link rel="stylesheet" href="book.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
    <style>
        select {
            width: 100%;
            height: 100%;
            background: transparent;
            border: none;
            outline: none;
            border: 1px solid var(--dark-purple);
            border-radius: 15px;
            font-size: var(--small-font);
            color: var(--v-dark-purple);
            padding: 20px 45px 20px 20px;
        }

        .wrapper .hide{
            display: none;
        }
    </style>
</head>
<body>
<div class="wrapper">
    <form id="appointmentForm" action="" method="POST">
        <h1>Book Appointment</h1>

       <!-- TRIAL -->
       <div class="row hide">
                <div class="input-box ">
                    <input type="text" value="<?php echo $_SESSION['first_name']?>" required name="first_name" readonly>
                </div>
                <div class="input-box ">
                    <input type="text" value="<?php echo $_SESSION['last_name']?>" required name="last_name" readonly>
                </div>

                <div class="input-box ">
                    <input type="text" value="<?php echo $_SESSION['active_gmail']?>" required name="active_gmail" readonly>
                </div>

                <div class="input-box ">
                    <input type="text" value="<?php echo $_SESSION['contact_number']?>" required name="contact_number" readonly>
                </div>

        </div>
        <!-- TRIAL -->

        <div class="row">
            <div class="input-box">
                <input type="date" placeholder="Date" required name="date" id="selectedDateInput">
            </div>
            <div class="input-box">
                <input type="time" placeholder="Time" required name="time" id="selectedTime">
            </div>
        </div>

        <select class="input-box drop-down" id="service" required name="service" placeholder="Select Service">
            <option value="" disabled selected>Select Service</option>
            <option value="Radiographic Examination">Radiographic Examination</option>
            <option value="Operculectomy">Operculectomy</option>
            <option value="Dental Crowns">Dental Crowns</option>
            <option value="Dental Bridges">Dental Bridges</option>
            <option value="Pulpotomy and Root Canal Treatment">Pulpotomy and Root Canal Treatment</option>
            <option value="Complete Denture">Complete Denture</option>
            <option value="Dental Consultation or Check-up">Dental Consultation or Check-up</option>
            <option value="Wisdom Tooth Removal">Wisdom Tooth Removal</option>
        </select>

        <div class="calendar-container">
        <div class="wrap-date">
            <header>
              <p class="current-date" title=""></p>
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
          <div class="wrap-time">
            <header>
              <select class="options-type">
                <option value="Morning">Morning</option>
                <option value="Afternoon">Afternoon</option>
              </select>
            </header>
            <div class="time-slot">
              <ul class="radio-group" id="timeSlotsContainer"></ul>
            </div>
          </div> 
        </div>

        <div class="row">
            <button type="button" class="btn-cancel" id="cancelButton">Cancel</button>
            <button type="submit" class="btn-okay" id="okayButton" required name="submit_book-info">Okay</button>
        </div>
    </form>
</div>

<script src="script/date-time.js"></script>
<script>
    // Get references to the Cancel and Okay buttons
    const cancelButton = document.getElementById("cancelButton");

    // Add event listeners to handle button clicks
    cancelButton.addEventListener("click", () => {
        // Redirect to the home page when Cancel is clicked
        window.location.href = "index-after.php"; // Replace "home.html" with the actual URL of your home page
    });
</script>
</body>
</html>

<?php 
    // SUBMIT DATE AND TIME TO APPOINTMENTS TABLE
    if (isset($_POST['submit_book-info'])) {
        // Get form data
        $date = $_POST['date'];
        $time = $_POST['time'];
        $service = $_POST['service'];
        $first_name = $_POST['first_name']; 
        $last_name = $_POST['last_name']; 
        $active_gmail = $_POST['active_gmail']; 
        $contact_number = $_POST['contact_number']; 

        // Connect to the database
        $mysqli = new mysqli('localhost', 'root', '', 'dental_clinic_db');

        // Check for database connection errors
        if ($mysqli->connect_error) {
            die("Connection failed: " . $mysqli->connect_error);
        }

        // Sanitize the form data
        $date = $mysqli->real_escape_string($date);
        $time = $mysqli->real_escape_string($time);
        $service = $mysqli->real_escape_string($service);
        $first_name = $mysqli->real_escape_string($first_name);
        $last_name = $mysqli->real_escape_string($last_name);
        $active_gmail = $mysqli->real_escape_string($active_gmail);
        $contact_number = $mysqli->real_escape_string($contact_number);

        // Insert record into the database
        $insert = $mysqli->query("INSERT INTO appointments(time, date, first_name, last_name, service, active_gmail, contact_number, status)
                                  VALUES ('$time', '$date', '$first_name', '$last_name', '$service', '$active_gmail', '$contact_number', 'Pending')");

        // EXTRACT THE ID FROM THIS CURRENT INSERTED DATA
        $select = mysqli_query($mysqli, "SELECT id from appointments WHERE active_gmail = '$active_gmail' AND screenshot = '' ");
        $row = mysqli_fetch_array($select);
        if(is_array($row)){
            $id = $row['id'];
            // echo $id;
        }

        // Check if the insertion was successful
        if ($insert) {
            // header("location: pay-appointment.php?id=$id");
            header("location: pay-appointment.php?id=$id&date=$date&time=$time&service=$service");
            exit; // Exit to prevent further execution
        } else {
            echo "Error: " . $mysqli->error;
        }

        // Close the database connection
        $mysqli->close();
    }

?>

<?php 
    ob_end_flush(); // Send the buffered output
?>
