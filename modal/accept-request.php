<dialog id="acceptRequest" class="modal">
    <div class="modal-container">
        <div class="text">Preview<div>
        <form id="appointmentRequestForm" method="POST">
            <input type="hidden" id="acceptAppointmentId" name="acceptAppointmentId" readonly>
            <br>
            <label for="firstNameInput"> <b>First Name:</b> </label>
            <input type="text" id="firstNameInput" name="firstName" placeholder="First Name" readonly><br>
            <label for="lastNameInput"> <b>Last Name:</b> </label>
            <input type="text" id="lastNameInput" name="lastName" placeholder="Last Name" readonly>
            <br><br>
            <img id="screenshotImg" alt="Screenshot" style="max-width: 100%; max-height: 500px;">
            <br>

            <button onclick="closeAcceptModal()" type="button" class="close-modal">Close</button>
            <button type="submit" id="submitBtn" class="okay-modal">Submit</button>

        </form>
    </div>
</dialog>

<script>
    // AJAX Request to accpet the appoitment
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('submitBtn').addEventListener('click', function (event) {
            event.preventDefault();

            fetch('lib/acceptAppointment.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams(new FormData(document.getElementById('appointmentRequestForm'))),
            })
            .then(response => response.text())
            .then(data => {
                alert(data);
                setTimeout(function () {
                    window.location.reload();
                }, 100);
            })
            .catch(error => {
                console.error('Fetch Error:', error);
            });
        });
    });

    // Open/Close Modal + get patient data base on ID
    const accept_request = document.getElementById("acceptRequest");

    function openAcceptModal(appointmentId) {
        document.getElementById('acceptAppointmentId').value = appointmentId;

        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'lib/getAppointmentDetails.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    const appointmentDetails = JSON.parse(xhr.responseText);

                    // Display details in textbox
                    document.getElementById('firstNameInput').value = appointmentDetails.first_name;
                    document.getElementById('lastNameInput').value = appointmentDetails.last_name;
                    
                    // Display screenshot
                    const screenshotImg = document.getElementById('screenshotImg');
                    const screenshotPath = 'screenshots/' + appointmentDetails.screenshot;
                    screenshotImg.src = screenshotPath;
                } else {
                    console.error('Error fetching appointment details');
                }
            }
        };

        xhr.send('appointmentId=' + encodeURIComponent(appointmentId));

        accept_request.showModal();
    }

    function closeAcceptModal() {
        accept_request.close();
    }
</script>
