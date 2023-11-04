<?php

// USER REGISTRATION ------------------------------------------------------------------->
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

$error = NULL;

// SUBMIT REGISTRATION
if(isset($_POST['submit_registration']))
{
    //get form data
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $birthdate = $_POST['birthdate'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $contact_number = $_POST['contact_number'];
    $active_gmail = $_POST['active_gmail'];
    $password = $_POST['password'];
    $repeat_password = $_POST['repeat_password'];

    $medical_info_1 = $_POST['medical_info_1'];
    $medical_info_2 = $_POST['medical_info_2'];
    $medical_info_3 = $_POST['medical_info_3'];
    $medical_info_4 = $_POST['medical_info_4'];
    $medical_info_5 = $_POST['medical_info_5'];
    $medical_info_6 = $_POST['medical_info_6'];
    $medical_info_7 = $_POST['medical_info_7'];
    $medical_info_8 = $_POST['medical_info_8'];
    $medical_info_9 = $_POST['medical_info_9'];
    $medical_info_10 = $_POST['medical_info_10'];


  
    if(strlen($password) < 10){
        $error .= "<p> Your password must be at least 10 characters long </p>";
        echo $error;
    }else if($repeat_password != $password){
        $error .= "<p> Your passwords do not match </p>";
        echo $error;
    }else{
        //form is valid

        //so connect to database >>>
        $mysqli = new mysqli('localhost', 'root', '', 'dental_clinic_db');

        //sanitize the form data >>>
        $first_name = $mysqli->real_escape_string($first_name); 
        $last_name = $mysqli->real_escape_string($last_name); 
        $birthdate = $mysqli->real_escape_string($birthdate); 
        $gender = $mysqli->real_escape_string($gender); 
        $address = $mysqli->real_escape_string($address); 
        $contact_number = $mysqli->real_escape_string($contact_number); 
        $active_gmail = $mysqli->real_escape_string($active_gmail); 
        $password = $mysqli->real_escape_string($password); 
        $repeat_password = $mysqli->real_escape_string($repeat_password);

        $medical_info_1 = $mysqli->real_escape_string($medical_info_1); 
        $medical_info_2 = $mysqli->real_escape_string($medical_info_2); 
        $medical_info_3 = $mysqli->real_escape_string($medical_info_3); 
        $medical_info_4 = $mysqli->real_escape_string($medical_info_4); 
        $medical_info_5 = $mysqli->real_escape_string($medical_info_5); 
        $medical_info_6 = $mysqli->real_escape_string($medical_info_6); 
        $medical_info_7 = $mysqli->real_escape_string($medical_info_7); 
        $medical_info_8 = $mysqli->real_escape_string($medical_info_8); 
        $medical_info_9 = $mysqli->real_escape_string($medical_info_9); 
        $medical_info_10 = $mysqli->real_escape_string($medical_info_10); 
         
        // Check if the email already exists
        $checkEmailQuery = "SELECT * FROM patients_table1 WHERE active_gmail = '$active_gmail'";
        
        $result = $mysqli->query($checkEmailQuery);

        if ($result->num_rows > 0) {
            // Email already exists, handle the error
            $error .= "<p> This email is already registered. Please use a different email address. </p>";
            echo $error;
        }else{

            //generate vkey >>>
            $vkey = substr(number_format(time() * rand(), 0, '', ''), 0, 6);


            //encrypt password
            $password = md5($password);
            
            //insert record into database >>>
            $insert = $mysqli->query("INSERT INTO patients_table1(first_name, last_name, birthdate, gender, address, contact_number, active_gmail, password, vkey, med_info_1, med_info_2, med_info_3, med_info_4, med_info_5, med_info_6, med_info_7, med_info_8, med_info_9, med_info_10)
                                   VALUES('$first_name','$last_name','$birthdate','$gender', '$address',  '$contact_number', '$active_gmail', '$password', '$vkey', '$medical_info_1', '$medical_info_2', '$medical_info_3', '$medical_info_4', '$medical_info_5', '$medical_info_6', '$medical_info_7', '$medical_info_8', '$medical_info_9', '$medical_info_10')");

            if($insert){
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
                    $mail->addAttachment('img/my pic.png', "my pic.png");         //Add attachments
                
                    //Content
                    $mail->isHTML(true);                                  //Set email format to HTML 
                    $mail->Subject = 'Verification Code';
                    $mail->Body    = $vkey;
                    // $mail->Body    = "<a href='http://localhost/login-logout/verify.php?vkey=$vkey'>Verify It's You</a>";
                    
                    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
                
                    $mail->send();
                    // echo 'Message has been sent';
                    header('location:register-verify.php');
                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }
            }

        }
      
    }
}

// VERIFIES USER REGISTRATION: VERIFICATION CODE
if(isset($_POST['submit_vk'])){
    //process verification
    $vkey = $_POST['vkey'];

    $mysqli = new mysqli('localhost', 'root', '', 'dental_clinic_db');

    $resultSet = $mysqli->query("SELECT verified, vkey FROM patients_table1 WHERE verified = 0 AND vkey = '$vkey' LIMIT 1");
    
    if($resultSet->num_rows == 1){
        //validate email
        $update = $mysqli->query("UPDATE patients_table1 SET verified = 1 WHERE vkey = '$vkey' LIMIT 1");
        if($update){
            // echo "Your account has been verified. You may now log in";
            header('location:login.php');
        }else{
            echo $mysqli->error;
        }
    }else{
        // echo "This account is invalid or already verified";
        echo "Incorrect Password. Pleasse try again";
    }
    
}
// else{
//     die("Something went wrong");
// }




?>

<!-- USER REGISTER VERIFICATION -->

