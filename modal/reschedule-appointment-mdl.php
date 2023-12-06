<dialog>
    <form method="post" action="">
        <input type="hidden" name="appointmentId" value="' . $appointmentId . '">
        <label for="newDate">New Date:</label>
        <input type="date" id="newDate" name="newDate" required>
        <label for="newTime">New Time:</label>
        <input type="time" id="newTime" name="newTime" required>
        <button type="submit" name="submit">Reschedule</button>
    </form>
</dialog>