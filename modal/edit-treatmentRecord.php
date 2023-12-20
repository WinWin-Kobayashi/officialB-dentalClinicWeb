<?php 

    $error = NULL;
    $date = NULL;
    $tooth_number = NULL;
    $procedures_performed = NULL;
    $amount_charged = NULL;
    $amount_paid = NULL;

    if(isset($_POST['editTreatmentRecord'])){
        //get form data
        $treatment_id = $_POST['editTreatmentRecordId'];
        $date = $_POST['eDate'];
        $tooth_number = $_POST['eToothNumber'];
        $procedures_performed = $_POST['eProceduresPerformed'];
        $amount_charged = $_POST['eAmountCharged'];
        $amount_paid = $_POST['eAmountPaid'];

        //form is valid

        //so connect to database >>>
        $mysqli = new mysqli('localhost', 'root', '', 'dental_clinic_db');

        //update record into database >>>
        $update = $mysqli->query("UPDATE treatment_records SET date = '$date', tooth_number = '$tooth_number', procedures_performed = '$procedures_performed', amount_charged = '$amount_charged', amount_paid = '$amount_paid' WHERE id = ' $treatment_id'");

        if($update){
            try{
                echo "<script>alert('successfully updated treatment record');  edit_treatment_record.close(); </script>";
            }
            catch (Exception $e){
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        }
    }
?>

<dialog id="editTreatmentRecord" class="modal modal-view">
    <!-- <div class="text">View Screenshot</div> -->
    <form id="editTreatmentRecordForm" method="POST">
        <!-- treatment id -->
        <input type="hidden" id="editTreatmentRecordId" name="editTreatmentRecordId">
        <br>

        <!-- date -->
        <label for="eDate"> <b>Date:</b> </label>
        <input type="date" id="eDate" name="eDate" placeholder="Date"><br>

        <!-- tooth number -->
        <label for="eToothNumber"> <b>Tooth #:</b> </label>
        <input type="text" id="eToothNumber" name="eToothNumber" placeholder="Tooth Number"><br>

        <!-- procedures performed -->
        <label for="eProceduresPerformed"> <b>Procedures Performed:</b> </label> 
        <input type="text" id="eProceduresPerformed" name="eProceduresPerformed" placeholder="Procedures Performed"><br>

        <!-- amount charged -->
        <label for="eAmountCharged"> <b>Amount Charged:</b> </label>
        <input type="text" id="eAmountCharged" name="eAmountCharged" placeholder="Amount Charged"><br>

        <!-- amount paid -->
        <label for="eAmountPaid"> <b>Amount Paid:</b> </label> 
        <input type="text" id="eAmountPaid" name="eAmountPaid" placeholder="Amount Paid"><br>
       
        <!-- buttons -->
        <button type="submit" id="editTreatmentRecord" class="okay-modal" name="editTreatmentRecord">OK</button>
        <button onclick="closeeditTreatmentRecordModal()" type="button" class="close-modal">Close</button>
    </form>

</dialog>

<script>
    // Open/Close Modal + get patient data base on ID
    const edit_treatment_record = document.getElementById("editTreatmentRecord");

    function openeditTreatmentRecordModal(treatmentRecordId) {
        document.getElementById('editTreatmentRecordId').value = treatmentRecordId;

        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'lib/getTreatmentRecordDetails.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    const treatmentDetails = JSON.parse(xhr.responseText);

                    // Display details in textbox
                    document.getElementById('eDate').value = treatmentDetails.date;
                    document.getElementById('eToothNumber').value = treatmentDetails.tooth_number;
                    document.getElementById('eProceduresPerformed').value = treatmentDetails.procedures_performed;
                    document.getElementById('eAmountCharged').value = treatmentDetails.amount_charged;
                    document.getElementById('eAmountPaid').value = treatmentDetails.amount_paid;

                } else {
                    console.error('Error fetching appointment details');
                }
            }
        };

        xhr.send('treatmentRecordId=' + encodeURIComponent(treatmentRecordId));

        edit_treatment_record.showModal();
    }

    function closeeditTreatmentRecordModal() {
        edit_treatment_record.close();
    }
</script>
