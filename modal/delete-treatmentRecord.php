<?php 

    $error = NULL;

    if(isset($_POST['deleteTreatment'])){
        //get form data
        $treatment_id = $_POST['deleteTreatmentRecordId'];
       
        //form is valid

        //so connect to database >>>
        $mysqli = new mysqli('localhost', 'root', '', 'dental_clinic_db');

        //delte record from database >>>
        $delete = $mysqli->query("DELETE FROM treatment_records WHERE id = $treatment_id");

        if($delete){
            try{
                echo "<script>alert('successfully deleted treatment record');  delete_treatment_record.close(); </script>";
            }
            catch (Exception $e){
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        }
    }
?>

<dialog id="deleteTreatmentRecord" class="modal modal-view">

    <form id="deleteTreatmentRecordForm" method="POST">
        <input type="hidden" id="deleteTreatmentRecordId" name="deleteTreatmentRecordId">
        <br>

        <h3 style="color: red; font-size: 25px;">Are you sure you want to delete this?</h3> <br>
        <b>  <h3 id="deleteTreatmentRecordName"></h3> </b>
        
        <button type="submit" id="deleteTreatment" class="okay-modal" name="deleteTreatment">Yes</button>
        <button onclick="closedeleteTreatmentRecordModal()" type="button" class="close-modal">Cancel</button>
    </form>

</dialog>

<script>
    // Open/Close Modal + get patient data base on ID
    const delete_treatment_record = document.getElementById("deleteTreatmentRecord");

    function opendeleteTreatmentRecordModal(treatmentRecordId) {
        document.getElementById('deleteTreatmentRecordId').value = treatmentRecordId;

        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'lib/getPatientDetails.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    const treatmentDetails = JSON.parse(xhr.responseText);

                    // Concatenate the first name and last name
                    const fullName = treatmentDetails.first_name + ' ' + treatmentDetails.last_name;

                    // Display concatenated name in <h3> tag
                    document.getElementById('deleteTreatmentRecordName').innerHTML = fullName;

                } else {
                    console.error('Error fetching appointment details');
                }
            }
        };

        xhr.send('treatmentRecordId=' + encodeURIComponent(treatmentRecordId));

        delete_treatment_record.showModal();
    }

    function closedeleteTreatmentRecordModal() {
        delete_treatment_record.close();
    }
</script>
