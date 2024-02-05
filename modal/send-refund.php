<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require './vendor/autoload.php';

$mail = new PHPMailer(true);

$error = NULL;
$first_name = NULL;
$last_name = NULL;
$active_gmail = NULL;

if(isset($_POST['submitRefund'])){
    //get form data
    $id = $_POST['SendRefundId'];
    $first_name = $_POST['toRefundFirstName'];
    $last_name = $_POST['toRefundLastName'];
    $active_gmail = $_POST['toRefundGmail'];
    $contact_number = $_POST['toRefundContactNumber'];
    // $refund_screenshot = $_POST['refundImage'];

    //so connect to database >>>
    $mysqli = new mysqli('localhost', 'root', '', 'dental_clinic_db');

    //update record into database >>>
    $update = $mysqli->query("UPDATE appointments SET refunded = 1 WHERE id = '$id'");

    if($update){

        if($update){
            try {
                //Server settings
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = 'fakemayoldental@gmail.com';                     //SMTP username
                $mail->Password   = 'iuls xqqd dcnd aewa';                               //SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
            
                //Recipients
                $mail->setFrom('fakemayoldental@gmail.com', 'Fake Mayol Dental Clinic');
                $mail->addAddress($active_gmail, $first_name);     //Add a recipient
                $mail->addReplyTo('fakemayoldental@gmail.com', 'Fake Mayol Dental Clinic');
            
                //Attachments
                // $mail->addAttachment('img/my pic.png', "my pic.png");         
                if (isset ($_FILES ['refundImage'])  && $_FILES ['refundImage'] ['error'] == UPLOAD_ERR_OK ) { 
                    $mail->addAttachment ($_FILES ['refundImage'] ['tmp_name'],  $_FILES ['refundImage'] ['name']); 
                }
            
                //Content
                $mail->isHTML(true);                                  //Set email format to HTML 
                $mail->Subject = 'Screenshot of Refund';
                $mail->Body    = 'We apologize for the cancellation. We have already refunded your cancelled appointment.';
                
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
                $mail->send();
                echo "<script>alert('Successfully sent screenshot of refund to patient');  patientToRefund_info.close(); </script>";
                // header('location:register-verify.php');
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        }
    }
}

?>

<dialog id="SendRefund" class="modal modal-view">
    <form id="SendRefundForm" method="POST" enctype="multipart/form-data">
        <b><h3>Send Refund</h3></b>
        <label for="SendRefundId"> <b>Appointment Id:</b> </label>
        <input type="text" id="SendRefundId" name="SendRefundId" readonly>
        <br>
        <!-- first name -->
        <label for="patientToRefundFirstName"> <b>First Name:</b> </label>
        <input type="text" id="patientToRefundFirstName" name="toRefundFirstName" placeholder="First Name" readonly><br>
        <!-- last name -->
        <label for="patientToRefundLastName"> <b>Last Name:</b> </label> 
        <input type="text" id="patientToRefundLastName" name="toRefundLastName" placeholder="Last Name" readonly><br>
        <!-- active gmail -->
        <label for="patientToRefundGmail"> <b>Active Gmail:</b> </label>
        <input type="text" id="patientToRefundGmail" name="toRefundGmail" placeholder="Active Gmail" readonly><br>
        <!-- contact number -->
        <label for="patientToRefundContactNumber"> <b>Contact Number:</b> </label>
        <input type="text" id="patientToRefundContactNumber" name="toRefundContactNumber" placeholder="Contact Number" readonly><br>

        <label for="SendRefundId"> <b>Proof of refund:</b> </label>
        <input type="file" name="refundImage" id = "refundImage" accept=".jpg, .jpeg, .png" value="" required> <br> <br>

        <button onclick="closeSendRefundModal()" type="button" class="close-modal">Close</button>
        <button type="submit" id="submitRefund" name="submitRefund" class="okay-modal">Send refund</button>
    </form>
</dialog>

<script>
    // Open/Close Modal + get patientToRefund data base on ID
    const patientToRefund_info = document.getElementById("SendRefund");

    function openSendRefundModal(appointmentId) {
        document.getElementById('SendRefundId').value = appointmentId;

        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'lib/getAppointmentDetails.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    const patientToRefundDetails = JSON.parse(xhr.responseText);

                    // Display details in textbox
                    document.getElementById('SendRefundId').value = patientToRefundDetails.id;
                    document.getElementById('patientToRefundFirstName').value = patientToRefundDetails.first_name;
                    document.getElementById('patientToRefundLastName').value = patientToRefundDetails.last_name;
                    document.getElementById('patientToRefundGmail').value = patientToRefundDetails.active_gmail;
                    document.getElementById('patientToRefundContactNumber').value = patientToRefundDetails.contact_number;

                } else {
                    console.error('Error fetching appointment details');
                }
            }
        };

        xhr.send('appointmentId=' + encodeURIComponent(appointmentId));

        patientToRefund_info.showModal();
    }

    function closeSendRefundModal() {
        patientToRefund_info.close();
    }
</script>
