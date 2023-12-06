<dialog id="reschedAppointment" class="modal">
    <div>Reschedule</div>
    <form method="post" action="">
        <!-- <input type="hidden" id="appointmentIdInput" name="appointmentIdInput" readonly>
        <br> -->
        <label>From</label>
        <br>
        <input type="date" id="dateInput" name="date" placeholder="Date" readonly>
        <br>
        <label>To</label>
        <br>
        <input type="date" id="newDate" name="newDate" required>
        <br>
        <label>From</label>
        <br>
        <input type="time" id="timeInput" name="time" placeholder="Time" readonly>
        <br>
        <label>To</label>
        <br>
        <input type="time" id="newTime" name="newTime" required>
        <br>
        <button type="submit" name="submit">Reschedule</button>
        <button onclick="closeReschedModal()" type="button">Close</button>
    </form>
</dialog>

<script>
    const resched = document.getElementById("reschedAppointment");

    function openReschedModal(appointmentId) {
        document.getElementById('appointmentIdInput').value = appointmentId;

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