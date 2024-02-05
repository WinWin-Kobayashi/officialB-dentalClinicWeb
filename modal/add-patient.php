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


    if(isset($_POST['submitPatient'])){
        //get form data
        $first_name = $_POST['firstName'];
        $last_name = $_POST['lastName'];
        $birthdate = $_POST['birthdate'];
        $gender = $_POST['gender'];
        $address = $_POST['address'];
        $contact_number = $_POST['contactNumber'];

        $medical_info_1 = $_POST['medInfo1'];
        $medical_info_2 = $_POST['medInfo2'];
        $medical_info_3 = $_POST['medInfo3'];
        $medical_info_4 = $_POST['medInfo4'];
        $medical_info_5 = $_POST['medInfo5'];
        $medical_info_6 = $_POST['medInfo6'];
        $medical_info_7 = $_POST['medInfo7'];
        $medical_info_8 = $_POST['medInfo8'];
        $medical_info_9 = $_POST['medInfo9'];
        $medical_info_10 = $_POST['medInfo10'];

        //form is valid

        //so connect to database >>>
        $mysqli = new mysqli('localhost', 'root', '', 'dental_clinic_db');

        //sanitize the form data >>>
        $first_name = $mysqli->real_escape_string($first_name); 
        $last_name = $mysqli->real_escape_string($last_name); 
        $birthdate = $mysqli->real_escape_string($birthdate); 
        $gender = $mysqli->real_escape_string($gender); 
        $address = $mysqli->real_escape_string($address); 
        $contact_number = $mysqli->real_escape_string($contact_number); 

        $medical_info_1 = $mysqli->real_escape_string($medical_info_1); 
        $medical_info_2 = $mysqli->real_escape_string($medical_info_2); 
        $medical_info_3 = $mysqli->real_escape_string($medical_info_3); 
        $medical_info_4 = $mysqli->real_escape_string($medical_info_4); 
        $medical_info_5 = $mysqli->real_escape_string($medical_info_5); 
        $medical_info_6 = $mysqli->real_escape_string($medical_info_6); 
        $medical_info_7 = $mysqli->real_escape_string($medical_info_7); 
        $medical_info_8 = $mysqli->real_escape_string($medical_info_8); 
        $medical_info_9 = $mysqli->real_escape_string($medical_info_9); 
        $medical_info_10 = $mysqli->real_escape_string($medical_info_10);
        
        // Check if patient already exists
        $checkNameQuery = "SELECT * FROM patients_table1 WHERE first_name = '$first_name' AND last_name =  '$last_name'";

        $result = $mysqli->query($checkNameQuery);

        if ($result->num_rows > 0) {
            // patient already exists, handle the error
            $error .= "<div style='background: pink; padding: 1rem; color: maroon;'> <p> This patient is already registered. Please look for the patient in your existing records. </p> </div>";
            echo $error;
        }else{
            //insert record into database >>>
            $insert = $mysqli->query("INSERT INTO patients_table1(first_name, last_name, birthdate, gender, address, contact_number, med_info_1, med_info_2, med_info_3, med_info_4, med_info_5, med_info_6, med_info_7, med_info_8, med_info_9, med_info_10, verified)
                                   VALUES('$first_name','$last_name','$birthdate','$gender', '$address',  '$contact_number', '$medical_info_1', '$medical_info_2', '$medical_info_3', '$medical_info_4', '$medical_info_5', '$medical_info_6', '$medical_info_7', '$medical_info_8', '$medical_info_9', '$medical_info_10', 1 )");

            if($insert){
                try{
                    ?>
                        <script>
                            alert('successfully added patient');
                            add_patient.close();
                        </script>
                    <?php
                }
                catch (Exception $e){
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }
            }
        }
    }
?>

<dialog id="addPatient" class="modal">
    <div class="modal-container">
        <div class="text">Register Patient Form<div>
        <form action="" style="width: 500px;" method="POST">
            <input type="text" id="pFirstName" name="firstName" placeholder="First Name"><br>
            <input type="text" id="pLastName" name="lastName" placeholder="Last Name"><br>
            <input type="date" id="pbirthdate" name="birthdate" placeholder="Birthdate"><br>
            <select id="pGender" name="gender" placeholder="Gender">
                <option value="" selected disabled>Select Gender</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="other">Other</option>
            </select><br>
            <input type="text" id="paddress" name="address" placeholder="Address"><br>
            <input type="text" id="pcontactNumber" name="contactNumber" placeholder="Contact Number"><br>

            <input type="text" id="pMedicalInfo1" name="medInfo1" placeholder="Any allergies to medications? If yes, please list them"><br>
            <input type="text" id="pMedicalInfo2" name="medInfo2" placeholder="Any chronic medical conditions? If yes, please list them"><br>
            <input type="text" id="pMedicalInfo3" name="medInfo3" placeholder="Currently taking any medication? If yes, please list them"><br>
            <input type="text" id="pMedicalInfo4" name="medInfo4" placeholder="Pregnant or Nursing? Yes or no"><br>
            <input type="text" id="pMedicalInfo5" name="medInfo5" placeholder="History of heart problems, HBP? Yes or no"><br>
            <input type="text" id="pMedicalInfo6" name="medInfo6" placeholder="Smoking or tobacco use? Yes or no"><br>
            <input type="text" id="pMedicalInfo7" name="medInfo7" placeholder="Alcoholic? Yes or no"><br>
            <input type="text" id="pMedicalInfo8" name="medInfo8" placeholder="Have bleeding disorders? Yes or no"><br>
            <input type="text" id="pMedicalInfo9" name="medInfo9" placeholder="Experienced anxiety during dental appointments? Yes or no"><br>
            <input type="text" id="pMedicalInfo10" name="medInfo10" placeholder="Has many major surguries? Yes or no"><br>

            <button type="submit" id="submitPatient" class="okay-modal" name="submitPatient">Submit</button>
        </form>
    </div>

    <button onclick="closeAddPatientModal()" type="button" class="close-modal">Close</button>
</dialog>

<script>

    // show modal for patient registration
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
