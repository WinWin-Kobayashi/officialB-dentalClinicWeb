<dialog id="cancelAppointment" class="modal modal-view">
    <div class="text">Confirm Cancellation</div>
    <form id="cancelForm" method="post" style="width: 300px;">
        <input type="hidden" id="cancelAppointmentId" name="cancelAppointmentId" readonly>
        <label>Reason</label>
        <br>
        <select id="cancelReason" name="cancelReason" required>
            <option value="Overbooking">Overbooking</option>
            <option value="Time slot taken">Time slot taken</option>
            <option value="Clinic is closed on booked date">Clinic is closed on booked date</option>
            <option value="Other">Other</option>
        </select>
        <br>
        <br>
        <button onclick="closeCancelModal()" type="button" class="close-modal">Close</button>
        <button type="submit" id="cancelBtn" class="okay-modal">OK</button>
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