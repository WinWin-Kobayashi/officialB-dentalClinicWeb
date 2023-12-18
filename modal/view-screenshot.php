<dialog id="viewScreenshot" class="modal">
    <div>View Screenshot</div>
    <form id="viewScreenshotForm" method="POST">
        <input type="hidden" id="viewScreenshotId" name="viewScreenshotId" readonly>
        <img id="screenshotImgView" alt="Screenshot" style="max-width: 100%; max-height: 200px;">
        <br>
        <button onclick="closeViewScreenshotModal()" type="button">Close</button>
    </form>
</dialog>

<script>
    // AJAX Request to accpet the appoitment
    // document.addEventListener('DOMContentLoaded', function () {
    //     document.getElementById('submitBtn').addEventListener('click', function (event) {
    //         event.preventDefault();

    //         fetch('lib/acceptAppointment.php', {
    //             method: 'POST',
    //             headers: {
    //                 'Content-Type': 'application/x-www-form-urlencoded',
    //             },
    //             body: new URLSearchParams(new FormData(document.getElementById('viewScreenshotForm'))),
    //         })
    //         .then(response => response.text())
    //         .then(data => {
    //             alert(data);
    //             setTimeout(function () {
    //                 window.location.reload();
    //             }, 100);
    //         })
    //         .catch(error => {
    //             console.error('Fetch Error:', error);
    //         });
    //     });
    // });

    // Open/Close Modal + get patient data base on ID
    const view_screenshot = document.getElementById("viewScreenshot");

    function openViewScreenshotModal(appointmentId) {
        document.getElementById('viewScreenshotId').value = appointmentId;

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
                    const screenshotImg = document.getElementById('screenshotImgView');
                    const screenshotPath = 'screenshots/' + appointmentDetails.screenshot;
                    screenshotImg.src = screenshotPath;
                } else {
                    console.error('Error fetching appointment details');
                }
            }
        };

        xhr.send('appointmentId=' + encodeURIComponent(appointmentId));

        view_screenshot.showModal();
    }

    function closeViewScreenshotModal() {
        view_screenshot.close();
    }
</script>
