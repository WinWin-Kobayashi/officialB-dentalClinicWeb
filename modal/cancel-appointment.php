<dialog id="cancelAppointment" class="modal">
    <div>Cancel Me Senpai</div>
    <form method="post" action="">
        <input type="hidden" name="appointmentId" value="' . $appointmentId . '">
        <label for="cancelReason">Reason:</label>
        <select id="cancelReason" name="cancelReason" required>
            <option value="Overbook">Overbook</option>
            <option value="No doctor">No doctor</option>
             <option value="Other">Other</option>
        </select>
        <br>
        <button type="submit" name="submit">Cancel</button>
        <button onclick="closeCancelModal()" type="button">Close</button>
    </form>
</dialog>

<script>
    const cancel = document.getElementById("cancelAppointment");

    function openCancelModal() {
        cancel.showModal();
    }

    function closeCancelModal() {
        cancel.close();
    }
</script>