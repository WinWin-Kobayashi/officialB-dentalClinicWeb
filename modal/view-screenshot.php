<dialog id="viewScreenshot" class="modal">
    <!-- <div class="text">View Screenshot</div> -->
    <form id="viewScreenshotForm" method="POST">
        <input type="hidden" id="viewScreenshotId" name="viewScreenshotId" readonly>
        <img id="screenshotImgView" alt="Screenshot" style="max-width: 100%; max-height: 550px;">
        <br>
        <button onclick="closeViewScreenshotModal()" type="button" class="close-modal-full">Close</button>
    </form>
</dialog>

<script>
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
