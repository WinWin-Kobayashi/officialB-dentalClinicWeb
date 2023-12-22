<dialog id="reschedAppointment" class="modal modal-view">
    <div class="text">Reschedule</div>
    <form id="rescheduleForm" class="rescheduleForm-modal">
        <!-- You can include the appointmentId here as a hidden input if needed -->
        <input type="hidden" id="reschedAppointmentId" name="reschedAppointmentId" readonly>
        <label>From:</label>
        <br>
        <input type="date" id="dateInput" name="date" placeholder="Date" readonly>
        <br>
        <label>To:</label>
        <br>
        <input type="date" id="newDate" name="newDate" required>
        <br>
        <label>From:</label>
        <br>
        <input type="time" id="timeInput" name="time" placeholder="Time" readonly>
        <br>
        <label>To:</label>
        <br>
        <input type="time" id="newTime" name="newTime" required>
        <br>
        <button type="button" id="rescheduleBtn" class="okay-modal">OK</button>
        <button type="button" onclick="closeReschedModal()" class="close-modal">Close</button>
    </form>
</dialog>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('rescheduleBtn').addEventListener('click', function () {

            const formData = new FormData(document.getElementById('rescheduleForm'));

            fetch('lib/rescheduleAppointment.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams(formData),
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
    const resched = document.getElementById("reschedAppointment");

    function openReschedModal(appointmentId) {
        document.getElementById('reschedAppointmentId').value = appointmentId;

        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'lib/getAppointmentDetails.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    const appointmentDetails = JSON.parse(xhr.responseText);

                    // Display details in textboxes
                    document.getElementById('dateInput').value = appointmentDetails.date;
                    document.getElementById('timeInput').value = appointmentDetails.formatted_time;
                } else {
                    console.error('Error fetching appointment details');
                }
            }
        };

        xhr.send('appointmentId=' + encodeURIComponent(appointmentId));
        resched.showModal();
    }

    function closeReschedModal() {
        resched.close();
    }
</script>