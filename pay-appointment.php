<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('globalHead.php'); ?> 
    <link rel="stylesheet" href="pay-appointment.css">
</head>
<body>
    <div class="wrapper">
        <form action="" id="pay-appointment">
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
                        <button id="upload-file">Choose a File</button>
                        <h5>No File Chosen</h5>
                    </div>
                </div>
                
            </div>

            <div class="row">
                <button type="button" class="btn-cancel" id="cancelButton">Cancel</button>
                <button type="button" class="btn-okay" id="okayButton">Okay</button>
            </div>
           
        </form> 

        <script>
            // Get references to the Cancel and Okay buttons
            const cancelButton = document.getElementById("cancelButton");
            const okayButton = document.getElementById("okayButton");

            // Add event listeners to handle button clicks
            cancelButton.addEventListener("click", () => {
                // Redirect to the home page when Cancel is clicked
                window.location.href = "index-after.php"; // Replace "home.html" with the actual URL of your home page
            });

            okayButton.addEventListener("click", () => {
                // Redirect to the confirmation page when Okay is clicked
                window.location.href = "appointment-request-sent.php"; // Replace "confirmation.html" with the actual URL of your confirmation page
            });
        </script>
    </div>
</body>
</html>