<dialog id="addPatient" class="modal">
    <div class="modal-container">
        <div class="text">Register Form<div>
        <form action="" style="width: 500px;">
            <input type="text" id="pFirstName" name="firstName" placeholder="First Name"><br>
            <input type="text" id="pLastName" name="lastName" placeholder="Last Name"><br>
            <input type="text" id="pbirthdate" name="birthdate" placeholder="Birthdate"><br>
            <input type="text" id="pgender" name="gender" placeholder="Gender"><br>
            <input type="text" id="paddress" name="address" placeholder="Address"><br>
            <input type="text" id="pcontactNumber" name="contactNumber" placeholder="Contact Number"><br>

            <input type="text" id="pMedicalInfo1" name="medInfo1" placeholder="Medical Info 1"><br>
            <input type="text" id="pMedicalInfo2" name="medInfo2" placeholder="Medical Info 2"><br>
            <input type="text" id="pMedicalInfo3" name="medInfo3" placeholder="Medical Info 3"><br>
            <input type="text" id="pMedicalInfo4" name="medInfo4" placeholder="Medical Info 4"><br>
            <input type="text" id="pMedicalInfo5" name="medInfo5" placeholder="Medical Info 5"><br>
            <input type="text" id="pMedicalInfo6" name="medInfo6" placeholder="Medical Info 6"><br>
            <input type="text" id="pMedicalInfo7" name="medInfo7" placeholder="Medical Info 7"><br>
            <input type="text" id="pMedicalInfo8" name="medInfo8" placeholder="Medical Info 8"><br>
            <input type="text" id="pMedicalInfo9" name="medInfo9" placeholder="Medical Info 9"><br>
            <input type="text" id="pMedicalInfo10" name="medInfo10" placeholder="Medical Info 10"><br>

        </form>
    </div>

    <button onclick="closeAddPatientModal()" type="button" class="close-modal">Close</button>
    <button type="submit" id="submitPatient" class="okay-modal">Submit</button>
</dialog>

<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        // Open/Close Modal + get patient data base on ID
        const add_patient = document.getElementById("addPatient");

        window.openAddPatientModal = function() {
            add_patient.showModal();
        }

        window.closeAddPatientModal = function() {
            add_patient.close();
        }
    });
</script>
