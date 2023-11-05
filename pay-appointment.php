<?php
    session_start();
    $id = $_GET['id']; //gets the appointment id from the book.php page 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('globalHead.php'); ?> 
    <link rel="stylesheet" href="pay-appointment.css">
</head>
<body>
    <div class="wrapper">
        <form action="" id="pay-appointment" method="POST" enctype="multipart/form-data">

            <!-- confirms if the id Appointment id is passed -->
            <h1><?php echo $id;?></h1>

            <h1>Pay Appointment</h1>
            <p>Your appointment will be confirmed during operating hours after you have
                <br> payed the appointment fee which is <span>P300</span>.
            </p>

            <div class="steps-container">

                <h3>Please do the following steps to secure your appointment: </h3>

                <div class="step">
                    <h4>1. Scan the QR code provided below to pay through Gcash.</h4>
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
                        <input type="file" name="image" accept="image/*" required>
                        <button type="submit" name="upload">Upload</button>
                    </div>
                </div>
                
            </div>

            <div class="row">
                <button type="button" class="btn-cancel" id="cancelButton" name="cancel">Cancel</button>
                <button type="submit" class="btn-okay" id="okayButton" required name="submit-payment">Okay</button>
            </div>
           
        </form> 

        <script>
            // Get references to the Cancel and Okay buttons
            const cancelButton = document.getElementById("cancelButton");

            // Add event listeners to handle button clicks
            cancelButton.addEventListener("click", () => {
                // Redirect to the home page when Cancel is clicked
                window.location.href = "index-after.php"; // Replace "home.html" with the actual URL of your home page
            });

          
        </script>
    </div>
</body>
</html>

<?php
    // submit payment
    if(isset($_POST['submit-payment'])){
        // connect to db
        $mysqli = new mysqli('localhost', 'root', '', 'dental_clinic_db');

        //needs to also insert image
        $update = $mysqli->query("UPDATE appointments SET status = 'Pending' WHERE id = '$id' LIMIT 1");

        if($update){
            header('location:appointment-request-sent.php');
        }else{
            echo $mysqli->error;
        }
    }

    
?>

