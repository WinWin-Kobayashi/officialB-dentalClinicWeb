<dialog id="modal">
    <div>This is a modal</div>
    <form id="appointmentForm" method="POST">
        <input type="text" id="appointmentIdInput" name="appointmentId" readonly>
        <button onclick="closeModal()" type="button">Close</button>
        <button type="submit" id="submitBtn">Submit</button>
    </form>
</dialog>

<script>
    // AJAX Request
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('submitBtn').addEventListener('click', function (event) {
            event.preventDefault();

            fetch('lib/accept-appointment.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams(new FormData(document.getElementById('appointmentForm'))),
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

    // Open/Close Modal
    const modal = document.getElementById("modal");

        function openModal(appointmentId) {
            document.getElementById('appointmentIdInput').value = appointmentId;
            document.getElementById('modal').showModal();
        }

        function closeModal() {
            modal.close();
        }
</script>
