<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('../globalHead.php') ?>
    <link rel='stylesheet' href='cancel-appointment.css'> 
</head>
<body>
    
</body>
</html>
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
    $cancelReason = $_POST['cancelReason'];

    $updateQuery = "UPDATE appointments SET status = 'Cancelled' WHERE id = $appointmentId";

    $updateResult = mysqli_query($conn, $updateQuery);

    if ($updateResult) {
        $getAppointmentQuery = "SELECT active_gmail, first_name FROM appointments WHERE id = $appointmentId";
        $appointmentResult = mysqli_query($conn, $getAppointmentQuery);

        if ($appointmentResult) {
            $appointmentData = mysqli_fetch_assoc($appointmentResult);
            $toEmail = $appointmentData['active_gmail'];
            $userName = $appointmentData['first_name'];

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

            $mail->isHTML(true);
            $mail->Subject = 'Appointment Canceled';
            $mail->Body = "Dear $userName,<br><br> Your appointment has been canceled. Reason: $cancelReason.";

            if (!$mail->send()) {
                echo 'Error sending email: ' . $mail->ErrorInfo;
            }

            header('Location: ../admin-dashboard.php');
            exit;
        } else {
            echo 'Error fetching email: ' . mysqli_error($conn);
        }
    } else {
        echo 'Error canceling appointment: ' . mysqli_error($conn);
    }
}

if (isset($_GET['appointmentId'])) {
    $appointmentId = $_GET['appointmentId'];

    $selectQuery = "SELECT * FROM appointments WHERE id = $appointmentId";
    $result = mysqli_query($conn, $selectQuery);

    if ($result) {
        $appointment = mysqli_fetch_assoc($result);

        echo '
        <body>
            <div class="wrapper">
                <form method="post" action="">
                    <input type="hidden" name="appointmentId" value="' . $appointmentId . '">
                    <label for="cancelReason">Reason:</label>
                    <select id="cancelReason" name="cancelReason" required>
                        <option value="Overbook">Overbook</option>
                        <option value="No doctor">No doctor</option>
                        <option value="Other">Other</option>
                    </select>
                    <button type="submit" name="submit">Cancel</button>
                </form>
            </div>
        </body>';
        } else {
        echo 'Error fetching appointment details: ' . mysqli_error($conn);
    }
} else {
    echo 'Invalid appointment ID.';
}

mysqli_close($conn);
?>
