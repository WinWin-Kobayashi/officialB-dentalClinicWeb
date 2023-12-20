<?php

    $error = NULL;
    $patient_id = NULL;
    $date = NULL;
    $tooth_number = NULL;
    $procedures_performed = NULL;
    $amount_charged = NULL;
    $amount_paid = NULL;

    if(isset($_POST['submitTreatmentRecord'])){
        //get form data
        $patient_id = $_POST['aPatientId'];
        $date = $_POST['aDate'];
        $tooth_number = $_POST['aToothNumber'];
        $procedures_performed = $_POST['aProceduresPerformed'];
        $amount_charged = $_POST['aAmountCharged'];
        $amount_paid = $_POST['aAmountPaid'];

        //form is valid

        //so connect to database >>>
        $mysqli = new mysqli('localhost', 'root', '', 'dental_clinic_db');

        //sanitize the form data >>>
        $patient_id = $mysqli->real_escape_string($patient_id); 
        $date = $mysqli->real_escape_string($date); 
        $tooth_number = $mysqli->real_escape_string($tooth_number); 
        $procedures_performed = $mysqli->real_escape_string($procedures_performed); 
        $amount_charged = $mysqli->real_escape_string($amount_charged); 
        $amount_paid = $mysqli->real_escape_string($amount_paid); 

        //insert treatment record into database >>>
        $insert = $mysqli->query("INSERT INTO treatment_records (patient_id, date, tooth_number, procedures_performed, amount_charged, amount_paid)
        VALUES ('$patient_id', '$date', '$tooth_number', '$procedures_performed', '$amount_charged', '$amount_paid')");


        if($insert){
            try{
                ?>
                    <script>
                        alert('successfully added treatment record');
                        window.close();
                    </script>
                <?php
            }
            catch (Exception $e){
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        }
    }
?>

<dialog id="addTreatmentRecord" class="modal">
    <div class="modal-container">
        <div class="text">Add Treatment Record Form<div>

        <?php if(isset($_GET['first_name'])){
            $first_name = $_GET['first_name'];
            $last_name = $_GET['last_name'];
            $id = $_GET['id'];
            echo $first_name . ' ' . $last_name . '\'s ' .$id;
        }?> 

        <form action="" style="width: 500px;" method="POST">
            <input type="text" id="aPatientId" name="aPatientId" placeholder="Patient Id" value='<?php echo $id ?>' readonly><br>
            <input type="date" id="aDate" name="aDate" placeholder="Treatment Date"><br>
            <input type="text" id="aToothNumber" name="aToothNumber" placeholder="Tooth Number"><br>
            <input type="text" id="aProceduresPerformed" name="aProceduresPerformed" placeholder="Procedures Performed"><br>

            <input type="text" id="aAmountCharged" name="aAmountCharged" placeholder="Amount Charged"><br>
            <input type="text" id="aAmountPaid" name="aAmountPaid" placeholder="Amount Paid"><br>

            <button type="submit" id="submitTreatmentRecord" class="okay-modal" name="submitTreatmentRecord">Add Treatment Record</button>
        </form>
    </div>

    <button onclick="closeaddTreatmentRecordModal()" type="button" class="close-modal">Close</button>
</dialog>

<script>

    // show modal for adding treatment record for patient
    document.addEventListener('DOMContentLoaded', (event) => {
        // Open/Close Modal + get patient data base on ID
        const add_treatment_record = document.getElementById("addTreatmentRecord");

        window.openaddTreatmentRecordModal = function() {
            add_treatment_record.showModal();
        }

        window.closeaddTreatmentRecordModal = function() {
            add_treatment_record.close();
        }
    });

</script>
