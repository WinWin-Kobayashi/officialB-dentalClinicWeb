<dialog id="reschedAppointment" class="modal">
    <div>Reschedule</div>
    <form method="post" action="">
        <input type="hidden" name="appointmentId" value="' . $appointmentId . '">
        <label for="newDate">New Date:</label>
        <input type="date" id="newDate" name="newDate" required>
        <label for="newTime">New Time:</label>
        <input type="time" id="newTime" name="newTime" required>
        <button type="submit" name="submit">Reschedule</button>
        <button onclick="closeReschedModal()" type="button">Close</button>
    </form>
</dialog>

<script>
    const resched = document.getElementById("reschedAppointment");

    function openReschedModal() {
        resched.showModal();
    }

    function closeReschedModal() {
        resched.close();
    }
</script>