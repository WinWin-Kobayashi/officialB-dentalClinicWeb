<dialog id="acceptRequest" class="modal">
    <div>This is a modal</div>
    <form id="appointmentRequestForm" method="POST">
        <input type="hidden" id="appointmentIdInput" name="appointmentId" readonly>
        <br>
        <input type="text" id="firstNameInput" name="firstName" placeholder="First Name" readonly>
        <br>
        <input type="text" id="lastNameInput" name="lastName" placeholder="Last Name" readonly>
        <br>
        <img id="screenshotImg" alt="Screenshot" style="max-width: 100%; max-height: 200px;">
        <br>
        <button onclick="closeAcceptModal()" type="button">Close</button>
        <button type="submit" id="submitBtn">Submit</button>
    </form>
</dialog>

<script>
    // AJAX Request to accpet the appoitment
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('submitBtn').addEventListener('click', function (event) {
            event.preventDefault();

            fetch('lib/accept-appointment.php', {
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
        document.getElementById('appointmentIdInput').value = appointmentId;

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
