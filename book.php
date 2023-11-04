<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('globalHead.php'); ?>
    <link rel="stylesheet" href="book.css">
    <style>
        select{
            width: 100%;
            height: 100%;
            background: transparent;
            border: none;
            outline: none;
            border: 1px solid var(--dark-purple);
            border-radius: 15px;
            font-size: var(--small-font);
            color: var(--v-dark-purple);
            padding: 20px 45px 20px 20px;
        }

    </style>
</head>
<body>
   
<div class="wrapper">
        <form id="appointmentForm" action="register-health.php">
            <h1>Book Appointment</h1>
            <div class="row">
                <div class="input-box">
                    <input type="date" placeholder="Date">
                </div>
                <div class="input-box">
                    <input type="time" placeholder="Time">
                </div>
            </div>

            <!-- <div class="input-box">
                <input type="text" placeholder="Select Service">
            </div> -->

            <select class="input-box drop-down" id="services" required name="services" placeholder="Select Service">
                <option value="" disabled selected>Select Service</option>
                <option value="Dental Checkup">Dental Checkup</option>
                <option value="Tooth Extraction">Tooth Extraction</option>
                <option value="Dental Cleaning">Dental Cleaning</option>
            </select>

            <div class="row">
                <button type="button" class="btn-cancel" id="cancelButton">Cancel</button>
                <button type="button" class="btn-okay" id="okayButton">Okay</button>
            </div>
        </form>
    </div>

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
            window.location.href = "pay-appointment.php"; // Replace "confirmation.html" with the actual URL of your confirmation page
        });
    </script>


</body>
</html>
