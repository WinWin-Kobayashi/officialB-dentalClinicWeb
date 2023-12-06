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
    $appointmentId = $_POST['reschedAppointmentId'];
    $newDate = $_POST['newDate'];
    $newTime = $_POST['newTime'];

    $updateQuery = "UPDATE appointments SET date = '$newDate', time = '$newTime' WHERE id = $appointmentId";

    $updateResult = mysqli_query($conn, $updateQuery);

    if ($updateResult) {
        // Send email
        sendEmail($appointmentId, $conn, $newTime, $newDate);

        echo 'Appointment accepted and updated successfully.';
    } else {
        echo 'Error accepting and updating appointment: ' . mysqli_error($conn);
    }

    exit;
}


echo 'Invalid request.';

function sendEmail($appointmentId, $conn, $newTime, $newDate) {
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
            $mail->Subject = 'Appointment Rescheduled';
            $mail->Body = "Dear $userName,<br><br>Your appointment has been rescheduled to $newDate at $newTime. Please click the link below to confirm or decline the appointment:
            <br>
            <a href='http://localhost/officialB-dentalClinicWeb/confirm.php?appointmentId=$appointmentId&action=accept'>Accept</a>
            <a href='http://localhost/officialB-dentalClinicWeb/confirm.php?appointmentId=$appointmentId&action=decline'>Decline</a>";

            if (!$mail->send()) {
                echo 'Error sending email: ' . $mail->ErrorInfo;
            }
        }
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>

