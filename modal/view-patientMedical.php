<dialog id="viewPatientMedicalInfo" class="modal">
    <!-- <div class="text">View Screenshot</div> -->
    <form id="viewPatientMedicalInfoForm" method="POST">
        <input type="hidden" id="viewPatientMedicalInfoId" name="viewPatientMedicalInfoId" readonly>
        <br>
        <!-- first name -->
        <label for="patientFirstNameMedical"> <b>First Name:</b> </label>
        <input type="text" id="patientFirstNameMedical" name="firstName" placeholder="First Name" readonly><br>
        <!-- last name -->
        <label for="patientLastNameMedical"> <b>Last Name:</b> </label> 
        <input type="text" id="patientLastNameMedical" name="lastName" placeholder="Last Name" readonly><br>

        <!-- medInfo1 -->
        <label for="medInfo1"> <b>Medical Info 1:</b> </label> 
        <input type="text" id="medInfo1" name="medInfo1" placeholder="Medical Info 1" readonly><br>

        <!-- medInfo2 -->
        <label for="medInfo2"> <b>Medical Info 2:</b> </label> 
        <input type="text" id="medInfo2" name="medInfo2" placeholder="Medical Info 2" readonly><br>

        <!-- medInfo3 -->
        <label for="medInfo3"> <b>Medical Info 3:</b> </label> 
        <input type="text" id="medInfo3" name="medInfo3" placeholder="Medical Info 3" readonly><br>

        <!-- medInfo4 -->
        <label for="medInfo4"> <b>Medical Info 4:</b> </label> 
        <input type="text" id="medInfo4" name="medInfo4" placeholder="Medical Info 4" readonly><br>

        <!-- medInfo5 -->
        <label for="medInfo5"> <b>Medical Info 5:</b> </label> 
        <input type="text" id="medInfo5" name="medInfo5" placeholder="Medical Info 5" readonly><br>

        <!-- medInfo6 -->
        <label for="medInfo6"> <b>Medical Info 7:</b> </label> 
        <input type="text" id="medInfo6" name="medInfo6" placeholder="Medical Info 6" readonly><br>

        <!-- medInfo7 -->
        <label for="medInfo7"> <b>Medical Info 7:</b> </label> 
        <input type="text" id="medInfo7" name="medInfo7" placeholder="Medical Info 7" readonly><br>

        <!-- medInfo8 -->
        <label for="medInfo8"> <b>Medical Info 8:</b> </label> 
        <input type="text" id="medInfo8" name="medInfo8" placeholder="Medical Info 8" readonly><br>

        <!-- medInfo9 -->
        <label for="medInfo9"> <b>Medical Info 9:</b> </label> 
        <input type="text" id="medInfo9" name="medInfo9" placeholder="Medical Info 9" readonly><br>

        <!-- medInfo10 -->
        <label for="medInfo10"> <b>Medical Info 10:</b> </label> 
        <input type="text" id="medInfo10" name="medInfo10" placeholder="Medical Info 10" readonly><br>
      
        <button onclick="closeviewPatientMedicalInfoModal()" type="button" class="close-modal-full">Close</button>
    </form>
</dialog>

<script>
    // Open/Close Modal + get patient data base on ID
    const view_patient_medical_info = document.getElementById("viewPatientMedicalInfo");

    function openviewMedicalInfoModal(patientId) {
        document.getElementById('viewPatientMedicalInfoId').value = patientId;

        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'lib/getPatientDetails.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    const patientDetails = JSON.parse(xhr.responseText);

                    // Display details in textbox
                    document.getElementById('patientFirstNameMedical').value = patientDetails.first_name;
                    document.getElementById('patientLastNameMedical').value = patientDetails.last_name;
                    document.getElementById('medInfo1').value = patientDetails.med_info_1;
                    document.getElementById('medInfo2').value = patientDetails.med_info_2;
                    document.getElementById('medInfo3').value = patientDetails.med_info_3;
                    document.getElementById('medInfo4').value = patientDetails.med_info_4;
                    document.getElementById('medInfo5').value = patientDetails.med_info_5;
                    document.getElementById('medInfo6').value = patientDetails.med_info_6;
                    document.getElementById('medInfo7').value = patientDetails.med_info_7;
                    document.getElementById('medInfo8').value = patientDetails.med_info_8;
                    document.getElementById('medInfo9').value = patientDetails.med_info_9;
                    document.getElementById('medInfo10').value = patientDetails.med_info_10;
                } else {
                    console.error('Error fetching appointment details');
                }
            }
        };

        xhr.send('patientId=' + encodeURIComponent(patientId));

        view_patient_medical_info.showModal();
    }

    function closeviewPatientMedicalInfoModal() {
        view_patient_medical_info.close();
    }
</script>
