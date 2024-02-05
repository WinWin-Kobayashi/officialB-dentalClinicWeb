<?php

// USER REGISTRATION ------------------------------------------------------------------->
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require '../vendor/autoload.php';

$conn = mysqli_connect("localhost", "root", "", "dental_clinic_db");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $appointmentId = $_POST['cancelAppointmentId'];
    $cancelReason = $_POST['cancelReason'];

    $updateQuery = "UPDATE appointments SET status = 'Cancelled' WHERE id = $appointmentId";

    $updateResult = mysqli_query($conn, $updateQuery);

    if ($updateResult) {
        // Send email
        sendEmail($appointmentId, $conn, $cancelReason);

        echo 'Appointment cancelled successfully.';
    } else {
        echo 'Error cancelling appointment: ' . mysqli_error($conn);
    }

    exit;
}


echo 'Invalid request.';

function sendEmail($appointmentId, $conn, $cancelReason) {
    $mail = new PHPMailer(true);

    try {
        $getAppointmentQuery = "SELECT active_gmail, first_name FROM appointments WHERE id = $appointmentId";
        $appointmentResult = mysqli_query($conn, $getAppointmentQuery);

        if ($appointmentResult) {
            $row = mysqli_fetch_assoc($appointmentResult);
            $toEmail = $row['active_gmail'];
            $userName = $row['first_name'];

            // Send email using PHPMailer
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
        }
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>

