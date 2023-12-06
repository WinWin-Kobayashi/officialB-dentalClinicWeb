<dialog id="cancelAppointment" class="modal">
    <div>Cancel Me Senpai</div>
    <form id="cancelForm" method="post">
        <input type="hidden" id="cancelAppointmentId" name="cancelAppointmentId" readonly>
        <br>
        <label>Reason</label>
        <br>
        <select id="cancelReason" name="cancelReason" required>
            <option value="Overbook">Overbook</option>
            <option value="No doctor">No doctor</option>
            <option value="Other">Other</option>
        </select>
        <br>
        <button onclick="closeCancelModal()" type="button">Close</button>
        <button type="submit" id="cancelBtn">Cancel</button>
    </form>
</dialog>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('cancelBtn').addEventListener('click', function (event) {
            event.preventDefault();

            fetch('lib/cancelAppointment.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams(new FormData(document.getElementById('cancelForm'))),
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

    const cancel = document.getElementById("cancelAppointment");

    function openCancelModal(appointmentId) {
        document.getElementById('cancelAppointmentId').value = appointmentId;
        cancel.showModal();
    }

    function closeCancelModal() {
        cancel.close();
    }
</script>