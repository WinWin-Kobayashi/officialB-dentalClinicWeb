<dialog id="acceptRequest" class="modal">
    <div class="modal-container">
        <div class="text"><b>Confirm Appointment</b><div>
        <h3 id="AcceptPatientInfoName" style="margin-top: 1rem; margin-bottom: 10px; text-align: left; margin-left: 0px; font-weight: 100;"></h3>
        <form id="appointmentRequestForm" method="POST">
            <input type="hidden" id="acceptAppointmentId" name="acceptAppointmentId" readonly>

            <!-- <label for="firstNameInput"> <b>First Name:</b> </label> -->
            <input type="hidden" id="firstNameInput" name="firstName" placeholder="First Name" readonly>
            <!-- <label for="lastNameInput"> <b>Last Name:</b> </label> -->
            <input type="hidden" id="lastNameInput" name="lastName" placeholder="Last Name" readonly>
            
            <img id="screenshotImg" alt="Screenshot" style="max-width: 100%; max-height: 800px;">
            <br>

            <button onclick="closeAcceptModal()" type="button" class="close-modal">Close</button>
            <button type="submit" id="submitBtn" class="okay-modal">OK</button>

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

    function formatDateTime(dateString, timeString) {
        const date = new Date(dateString);
        const options = { year: 'numeric', month: 'long', day: 'numeric' };
        const formattedDate = new Intl.DateTimeFormat('en-US', options).format(date);

        const formattedTime = new Intl.DateTimeFormat('en-US', { hour: 'numeric', minute: 'numeric', hour12: true }).format(new Date('2023-01-01T' + timeString));

        return { formattedDate, formattedTime };
    }

    function openAcceptModal(appointmentId) {
        document.getElementById('acceptAppointmentId').value = appointmentId;

        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'lib/getAppointmentDetails.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    const appointmentDetails = JSON.parse(xhr.responseText);

                    // Format date and time
                    const { formattedDate, formattedTime } = formatDateTime(appointmentDetails.date, appointmentDetails.time);

                    // Concatenate the first name and last name
                    const fullName = `<b>Name:</b> ${appointmentDetails.first_name} ${appointmentDetails.last_name} <b><br>Service:</b> ${appointmentDetails.service} <b><br>Date:</b> ${formattedDate} <b><br>Time:</b> ${formattedTime} <b><br>Screenshot of Payment:</b>`;

                    // Display concatenated name in <h3> tag
                    document.getElementById('AcceptPatientInfoName').innerHTML = fullName;

                    // Display name in textbox
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
