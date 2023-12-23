<?php
    session_start();

    if($_SESSION['id'] == null){   
        header('location:login.php');
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('globalHead.php'); ?>
    <link rel="stylesheet" href="appointment-request-sent.css">
</head>
<body>
    <div class="wrapper">
        <div class="rounded-check">
            <img src="img/check 1.png" alt="">
        </div>

        <h1>Appointment Request sent!</h1>

        <div class="paragraphs">
            <div class="par one">
                <p>
                    We’ve reserved your time and saved your <br>
                    appointment details, but your appointment has <br>
                    <span>not been confirmed yet </span>by Mayol Dental Clinic.
                </p>
            </div>
           
            <div class="par two">
                <p>
                    We will notify you with your Gmail after your <br>
                    appointment is finally approved.
                </p>
            </div>

            <div class="par three">
                <p>
                   Once you receive the Gmail notification of the approved appointment, please<br>
                    <span>Arrive at the dental clinic an hour before your appointment schedule</span> for a better
                    dental clinic experience. <b> Thank you! </b>
                </p>
            </div>

            <div class="button-con">
               <button id="home" class="home">Check</button>
            </div>

        </div>

        <script>
            const homeButton = document.getElementById("home");

            homeButton.addEventListener("click", () => {
                window.location.href = "index-after.php"; 
            });
        </script>
    </div>
</body>
</html>