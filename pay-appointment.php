<?php
    session_start();

    if($_SESSION['id'] == null){   
        header('location:login.php');
    }
    
    $id = $_GET['id']; //gets the appointment id from the book.php page 
?>

<?php 


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('globalHead.php'); ?> 
    <link rel="stylesheet" href="style/pay-appointment.css">
</head>
<body>
<div class="wrapper">
        <form action="" id="pay-appointment" method="POST" enctype="multipart/form-data">

            <!-- confirms if the id Appointment id is passed -->
            <h1> ID: <?php echo $id;?></h1>
            <input type="hidden" name="id" value="<?php echo $id; ?>">

            <h1>Pay Appointment</h1>
            <p>Your appointment will be confirmed during operating hours after you have
                <br> paid the appointment fee which is <span>P300</span>.
            </p>

            <div class="steps-container">

                <h3>Please do the following steps to secure your appointment: </h3>

                <div class="step">
                    <h4>1. Scan the QR code provided below to pay through Gcash. <b> Make sure to include your Gcash name in the message box before sending the payment. </b> </h4>
                    <div class="step-content">
                        <img src="img/qr 1.png" alt="">
                        <h5>Gcash: 0906-241-6076 <br>
                            Gcash Name: Elaiza Mae Mayol
                        </h5>
                    </div>
                </div>

                <div class="step">
                    <h4>2. Upload a screenshot here as proof of payment.</h4>
                    <div class="step-content">

                        <label for="image">Image : </label>
                        <input type="file" name="image" id = "image" accept=".jpg, .jpeg, .png" value="" required> <br> <br>
                        <!-- <button type = "submit" name = "submit">Submit</button> -->

                        <div class="row">
                            <button type="submit" class="btn" id="cancelButton" name="cancel"">Cancel</button>
                            <button type="submit" class="btn" id="okayButton" required name="submit-payment">Okay</button>
                        </div>

                    </div>
                </div>
                
            </div>
           
        </form> 

        <!-- <script>
            const cancelButton = document.getElementById("cancelButton");

            cancelButton.addEventListener("click", () => {
                window.location.href = "index-after.php";
            });
        </script> -->
    </div>
</body>


<?php

    require 'connection.php';

    if(isset($_POST["submit-payment"])){

        // $name = $_POST["name"];
        if($_FILES["image"]["error"] == 4){
            echo
            "<script> alert('Image Does Not Exist'); </script>"
            ;
        }
        else{
            $fileName = $_FILES["image"]["name"];
            $fileSize = $_FILES["image"]["size"];
            $tmpName = $_FILES["image"]["tmp_name"];

            $validImageExtension = ['jpg', 'jpeg', 'png'];
            $imageExtension = explode('.', $fileName);
            $imageExtension = strtolower(end($imageExtension));

            if ( !in_array($imageExtension, $validImageExtension) ){
            echo
            "
            <script>
                alert('Invalid Image Extension');
            </script>
            ";
            }

            else if($fileSize > 1000000){
            echo
            "
            <script>
                alert('Image Size Is Too Large');
            </script>
            ";
            }

            else{
            $newImageName = uniqid();
            $newImageName .= '.' . $imageExtension;

            move_uploaded_file($tmpName, 'screenshots/' . $newImageName);
            $query = "UPDATE appointments SET screenshot = '$newImageName', status = 'Pending' WHERE id = '$id' LIMIT 1";
            mysqli_query($conn, $query);
            echo

            "
            <script>
                alert('Successfully Added');
                window.location.href = 'appointment-request-sent.php';
            </script>
            ";

            }
        }
    }

   
    if(isset($_POST['cancel'])){
        //get form data
        $appointment_id = $_POST['id'];
       
        //form is valid

        //so connect to database >>>
        $mysqli = new mysqli('localhost', 'root', '', 'dental_clinic_db');

        //update record into database >>>
        $delete = $mysqli->query("DELETE FROM appointments WHERE id = $appointment_id");

        if($delete){
            try{
                echo "  
                        <script>
                            window.location.href = 'index-after.php';
                        </script>
                    ";
            }
            catch (Exception $e){
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        }
    }
    
    
?>

