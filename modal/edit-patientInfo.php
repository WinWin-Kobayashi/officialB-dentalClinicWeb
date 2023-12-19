<?php 

    $error = NULL;

    $first_name = NULL;
    $last_name = NULL;
    $birthdate = NULL;
    $gender = NULL;
    $address = NULL;
    $contact_number = NULL;
    $medical_info_1 = NULL;
    $medical_info_2 = NULL;
    $medical_info_3 = NULL;
    $medical_info_4 = NULL;
    $medical_info_5 = NULL;
    $medical_info_6 = NULL;
    $medical_info_7 = NULL;
    $medical_info_8 = NULL;
    $medical_info_9 = NULL;
    $medical_info_10 = NULL;


    if(isset($_POST['editPatient'])){
        //get form data
        $patient_id = $_POST['editPatientInfoId'];
        $first_name = $_POST['eFirstName'];
        $last_name = $_POST['eLastName'];
        $birthdate = $_POST['eBirthdate'];
        $gender = $_POST['eGender'];
        $address = $_POST['eAddress'];
        $contact_number = $_POST['eContact'];
        $medical_info_1 = $_POST['eMedInfo1'];
        $medical_info_2 = $_POST['eMedInfo2'];
        $medical_info_3 = $_POST['eMedInfo3'];
        $medical_info_4 = $_POST['eMedInfo4'];
        $medical_info_5 = $_POST['eMedInfo5'];
        $medical_info_6 = $_POST['eMedInfo6'];
        $medical_info_7 = $_POST['eMedInfo7'];
        $medical_info_8 = $_POST['eMedInfo8'];
        $medical_info_9 = $_POST['eMedInfo9'];
        $medical_info_10 = $_POST['eMedInfo10'];

        //form is valid

        //so connect to database >>>
        $mysqli = new mysqli('localhost', 'root', '', 'dental_clinic_db');

        //update record into database >>>
        $update = $mysqli->query("UPDATE patients_table1 SET first_name = '$first_name', last_name = '$last_name', birthdate = '$birthdate', gender = '$gender', address = '$address', contact_number = '$contact_number',
                                     med_info_1 = '$medical_info_1', med_info_2 = '$medical_info_2', med_info_3 = '$medical_info_3', med_info_4 = '$medical_info_4', med_info_5 = '$medical_info_5', med_info_6 = '$medical_info_6', med_info_7 = '$medical_info_7', med_info_8 = '$medical_info_8', med_info_9 = '$medical_info_9', med_info_10 = '$medical_info_10', verified = 1 WHERE id = ' $patient_id'");

        if($update){
            try{
                echo "<script>alert('successfully updated patient');  edit_patient_info.close(); </script>";
            }
            catch (Exception $e){
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        }
    }
?>

<dialog id="editPatientInfo" class="modal modal-view">
    <!-- <div class="text">View Screenshot</div> -->
    <form id="editPatientInfoForm" method="POST">
        <input type="hidden" id="editPatientInfoId" name="editPatientInfoId">
        <br>
        <!-- first name -->
        <label for="eFirstName"> <b>First Name:</b> </label>
        <input type="text" id="eFirstName" name="eFirstName" placeholder="First Name"><br>
        <!-- last name -->
        <label for="eLastName"> <b>Last Name:</b> </label> 
        <input type="text" id="eLastName" name="eLastName" placeholder="Last Name"><br>
        <!-- birthdate -->
        <label for="eBirthdate"> <b>Birthdate:</b> </label>
        <input type="date" id="eBirthdate" name="eBirthdate" placeholder="Birthdate"><br>

        <!-- gender -->
        <label for="eGender"> <b>Gender:</b> </label>
        <!-- <input type="text" id="eGender" name="gender" placeholder="Gender"><br> -->

        <select id="eGender" name="eGender" placeholder="Gender">
                <option value="" selected disabled>Select Gender</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
        </select><br>


        <!-- address -->
        <label for="eAddress"> <b>Address:</b> </label>
        <input type="text" id="eAddress" name="eAddress" placeholder="Address"><br>
        <!-- contact number -->
        <label for="eContact"> <b>Contact Number:</b> </label>
        <input type="text" id="eContact" name="eContact" placeholder="Contact Number"><br>
        <!-- active Gmail -->
        <label for="eGmail"> <b>Active Gmail:</b> </label>
        <input type="text" id="eGmail" name="eGmail" placeholder="Active Gmail"><br>

        <!-- medInfo1 -->
        <label for="eMedInfo1"> <b>Medical Info 1:</b> </label> 
        <input type="text" id="eMedInfo1" name="eMedInfo1" placeholder="Medical Info 1"><br>

        <!-- medInfo2 -->
        <label for="eMedInfo2"> <b>Medical Info 2:</b> </label> 
        <input type="text" id="eMedInfo2" name="eMedInfo2" placeholder="Medical Info 2"><br>

        <!-- medInfo3 -->
        <label for="eMedInfo3"> <b>Medical Info 3:</b> </label> 
        <input type="text" id="eMedInfo3" name="eMedInfo3" placeholder="Medical Info 3"><br>

        <!-- medInfo4 -->
        <label for="eMedInfo4"> <b>Medical Info 4:</b> </label> 
        <input type="text" id="eMedInfo4" name="eMedInfo4" placeholder="Medical Info 4"><br>

        <!-- medInfo5 -->
        <label for="eMedInfo5"> <b>Medical Info 5:</b> </label> 
        <input type="text" id="eMedInfo5" name="eMedInfo5" placeholder="Medical Info 5"><br>

        <!-- medInfo6 -->
        <label for="eMedInfo6"> <b>Medical Info 7:</b> </label> 
        <input type="text" id="eMedInfo6" name="eMedInfo6" placeholder="Medical Info 6"><br>

        <!-- medInfo7 -->
        <label for="eMedInfo7"> <b>Medical Info 7:</b> </label> 
        <input type="text" id="eMedInfo7" name="eMedInfo7" placeholder="Medical Info 7"><br>

        <!-- medInfo8 -->
        <label for="eMedInfo8"> <b>Medical Info 8:</b> </label> 
        <input type="text" id="eMedInfo8" name="eMedInfo8" placeholder="Medical Info 8"><br>

        <!-- medInfo9 -->
        <label for="eMedInfo9"> <b>Medical Info 9:</b> </label> 
        <input type="text" id="eMedInfo9" name="eMedInfo9" placeholder="Medical Info 9"><br>

        <!-- eMedInfo10 -->
        <label for="eMedInfo10"> <b>Medical Info 10:</b> </label> 
        <input type="text" id="eMedInfo10" name="eMedInfo10" placeholder="Medical Info 10"><br>

        <button type="submit" id="editPatient" class="okay-modal" name="editPatient">Submit</button>
        <button onclick="closeeditPatientInfoModal()" type="button" class="close-modal">Close</button>
    </form>

</dialog>

<script>
    // Open/Close Modal + get patient data base on ID
    const edit_patient_info = document.getElementById("editPatientInfo");

    function openeditPatientInfoModal(patientId) {
        document.getElementById('editPatientInfoId').value = patientId;

        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'lib/getPatientDetails.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    const patientDetails = JSON.parse(xhr.responseText);

                    // Display details in textbox
                    document.getElementById('eFirstName').value = patientDetails.first_name;
                    document.getElementById('eLastName').value = patientDetails.last_name;
                    document.getElementById('eBirthdate').value = patientDetails.birthdate;
                    document.getElementById('eGender').value = patientDetails.gender;
                    document.getElementById('eAddress').value = patientDetails.address;
                    document.getElementById('eContact').value = patientDetails.contact_number;
                    document.getElementById('eGmail').value = patientDetails.active_gmail;
                    document.getElementById('eMedInfo1').value = patientDetails.med_info_1;
                    document.getElementById('eMedInfo2').value = patientDetails.med_info_2;
                    document.getElementById('eMedInfo3').value = patientDetails.med_info_3;
                    document.getElementById('eMedInfo4').value = patientDetails.med_info_4;
                    document.getElementById('eMedInfo5').value = patientDetails.med_info_5;
                    document.getElementById('eMedInfo6').value = patientDetails.med_info_6;
                    document.getElementById('eMedInfo7').value = patientDetails.med_info_7;
                    document.getElementById('eMedInfo8').value = patientDetails.med_info_8;
                    document.getElementById('eMedInfo9').value = patientDetails.med_info_9;
                    document.getElementById('eMedInfo10').value = patientDetails.med_info_10;

                } else {
                    console.error('Error fetching appointment details');
                }
            }
        };

        xhr.send('patientId=' + encodeURIComponent(patientId));

        edit_patient_info.showModal();
    }

    function closeeditPatientInfoModal() {
        edit_patient_info.close();
    }
</script>
