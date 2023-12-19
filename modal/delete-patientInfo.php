<?php 

    $error = NULL;

    $first_name = NULL;
    $last_name = NULL;


    if(isset($_POST['deletePatient'])){
        //get form data
        $patient_id = $_POST['deletePatientInfoId'];
       
        //form is valid

        //so connect to database >>>
        $mysqli = new mysqli('localhost', 'root', '', 'dental_clinic_db');

        //update record into database >>>
        $delete = $mysqli->query("DELETE FROM patients_table1 WHERE id = $patient_id");

        if($delete){
            try{
                echo "<script>alert('successfully deleted patient');  delete_patient_info.close(); </script>";
            }
            catch (Exception $e){
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        }
    }
?>

<dialog id="deletePatientInfo" class="modal modal-view">
    <!-- <div class="text">View Screenshot</div> -->
    <form id="deletePatientInfoForm" method="POST">
        <input type="hidden" id="deletePatientInfoId" name="deletePatientInfoId">
        <br>

        <h3 style="color: red; font-size: 25px;">Confirm deletion of patient:</h3> <br>
        <b>  <h3 id="deletePatientInfoName"></h3> </b>
        <!-- first name -->
        <!-- <input type="text" id="dFirstName" name="dFirstName" placeholder="First Name"> -->
        <!-- last name -->
        <!-- <input type="text" id="dLastName" name="dLastName" placeholder="Last Name"><br> -->
        
        <button type="submit" id="deletePatient" class="okay-modal" name="deletePatient">Delete</button>
        <button onclick="closedeletePatientInfoModal()" type="button" class="close-modal">Cancel</button>
    </form>

</dialog>

<script>
    // Open/Close Modal + get patient data base on ID
    const delete_patient_info = document.getElementById("deletePatientInfo");

    function opendeletePatientInfoModal(patientId) {
        document.getElementById('deletePatientInfoId').value = patientId;

        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'lib/getPatientDetails.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    const patientDetails = JSON.parse(xhr.responseText);

                    // Concatenate the first name and last name
                    const fullName = patientDetails.first_name + ' ' + patientDetails.last_name;

                    // Display concatenated name in <h3> tag
                    document.getElementById('deletePatientInfoName').innerHTML = fullName;

                } else {
                    console.error('Error fetching appointment details');
                }
            }
        };

        xhr.send('patientId=' + encodeURIComponent(patientId));

        delete_patient_info.showModal();
    }

    function closedeletePatientInfoModal() {
        delete_patient_info.close();
    }
</script>
