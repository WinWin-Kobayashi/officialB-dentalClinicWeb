<?php
include '../connection.php';

// USER REGISTRATION ------------------------------------------------------------------->
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

$error = NULL;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $appointmentId = $_POST['appointmentId'];
    $newDate = $_POST['newDate'];
    $newTime = $_POST['newTime'];

    $updateQuery = "UPDATE appointments SET date = '$newDate', time = '$newTime' WHERE id = $appointmentId";

    $updateResult = mysqli_query($conn, $updateQuery);

    if ($updateResult) {
        $getEmailQuery = "SELECT active_gmail FROM appointments WHERE id = $appointmentId";
        $emailResult = mysqli_query($conn, $getEmailQuery);

        if ($emailResult) {
            $emailRow = mysqli_fetch_assoc($emailResult);
            $toEmail = $emailRow['active_gmail'];

            // Send email using PHPMailer
            $mail = new PHPMailer;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'fakemayoldental@gmail.com';
            $mail->Password = 'iuls xqqd dcnd aewa';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; 
            $mail->Port = 465;

            $mail->setFrom('fakemayoldental@gmail.com', 'Fake Mayol Dental Clinic');
            $mail->addAddress($toEmail);

            $mail->Subject = 'Appointment Rescheduled';
            $mail->Body = "Your appointment has been rescheduled to $newDate at $newTime.";

            if (!$mail->send()) {
                echo 'Error sending email: ' . $mail->ErrorInfo;
            }

            header('Location: ../admin-dashboard.php');
            exit;
        } else {
            echo 'Error fetching email: ' . mysqli_error($conn);
        }
    } else {
        echo 'Error updating appointment: ' . mysqli_error($conn);
    }
}

if (isset($_GET['appointmentId'])) {
    $appointmentId = $_GET['appointmentId'];

    $selectQuery = "SELECT * FROM appointments WHERE id = $appointmentId";
    $result = mysqli_query($conn, $selectQuery);

    if ($result) {
        $appointment = mysqli_fetch_assoc($result);

        echo '<form method="post" action="">
            <input type="hidden" name="appointmentId" value="' . $appointmentId . '">
            <label for="newDate">New Date:</label>
            <input type="date" id="newDate" name="newDate" required>
            <label for="newTime">New Time:</label>
            <input type="time" id="newTime" name="newTime" required>
            <button type="submit" name="submit">Reschedule</button>
        </form>';
    } else {
        echo 'Error fetching appointment details: ' . mysqli_error($conn);
    }
} else {
    echo 'Invalid appointment ID.';
}
mysqli_close($conn);
?>
