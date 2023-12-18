<dialog id="viewPatientInfo" class="modal">
    <!-- <div class="text">View Screenshot</div> -->
    <form id="viewPatientInfoForm" method="POST">
        <input type="hidden" id="viewPatientInfoId" name="viewPatientInfoId" readonly>
        <br>
        <!-- first name -->
        <label for="patientFirstName"> <b>First Name:</b> </label>
        <input type="text" id="patientFirstName" name="firstName" placeholder="First Name" readonly><br>
        <!-- last name -->
        <label for="patientLastName"> <b>Last Name:</b> </label> 
        <input type="text" id="patientLastName" name="lastName" placeholder="Last Name" readonly><br>
        <!-- birthdate -->
        <label for="patientBirthdate"> <b>Birthdate:</b> </label>
        <input type="text" id="patientBirthdate" name="birthdate" placeholder="Birthdate" readonly><br>
        <!-- gender -->
        <label for="patientGender"> <b>Gender:</b> </label>
        <input type="text" id="patientGender" name="gender" placeholder="Gender" readonly><br>
        <!-- address -->
        <label for="patientAddress"> <b>Address:</b> </label>
        <input type="text" id="patientAddress" name="address" placeholder="Address" readonly><br>
        <!-- contact number -->
        <label for="patientContact"> <b>Contact Number:</b> </label>
        <input type="text" id="patientContact" name="contactNumber" placeholder="Contact Number" readonly><br>
        <!-- active Gmail -->
        <label for="patientGmail"> <b>Active Gmail:</b> </label>
        <input type="text" id="patientGmail" name="gmail" placeholder="Active Gmail" readonly><br>

        <button onclick="closeviewPatientInfoModal()" type="button" class="close-modal-full">Close</button>
    </form>
</dialog>

<script>
    // Open/Close Modal + get patient data base on ID
    const view_basic_patient_info = document.getElementById("viewPatientInfo");

    function openviewPatientInfoModal(patientId) {
        document.getElementById('viewPatientInfoId').value = patientId;

        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'lib/getPatientDetails.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    const patientDetails = JSON.parse(xhr.responseText);

                    // Display details in textbox
                    document.getElementById('patientFirstName').value = patientDetails.first_name;
                    document.getElementById('patientLastName').value = patientDetails.last_name;
                    document.getElementById('patientBirthdate').value = patientDetails.birthdate;
                    document.getElementById('patientGender').value = patientDetails.gender;
                    document.getElementById('patientAddress').value = patientDetails.address;
                    document.getElementById('patientContact').value = patientDetails.contact_number;
                    document.getElementById('patientGmail').value = patientDetails.active_gmail;

                } else {
                    console.error('Error fetching appointment details');
                }
            }
        };

        xhr.send('patientId=' + encodeURIComponent(patientId));

        view_basic_patient_info.showModal();
    }

    function closeviewPatientInfoModal() {
        view_basic_patient_info.close();
    }
</script>
