<?php
include "db_conn.php";

if (isset($_POST["submit"])) {
   $first_name = $_POST['first_name'];
   $last_name = $_POST['last_name'];
   $birthdate = $_POST['birthdate'];
   $gender = $_POST['gender'];
   $address = $_POST['address'];
   $contact_number = $_POST['contact_number'];
   // $active_gmail = $_POST['active_gmail'];
   $med_info_1 = $_POST['med_info_1'];
   $med_info_2 = $_POST['med_info_2'];
   $med_info_3 = $_POST['med_info_3'];
   $med_info_4 = $_POST['med_info_4'];
   $med_info_5 = $_POST['med_info_5'];
   $med_info_6 = $_POST['med_info_6'];
   $med_info_7 = $_POST['med_info_7'];
   $med_info_8 = $_POST['med_info_8'];
   $med_info_9 = $_POST['med_info_9'];
   $med_info_10 = $_POST['med_info_10'];
   $sql = "INSERT INTO `patients_table1`(
      `id`, `first_name`, `last_name`, `birthdate`, `gender`, `address`, `contact_number`, `med_info_1`, `med_info_2`, `med_info_3`, `med_info_4`, `med_info_5`, `med_info_6`, `med_info_7`, `med_info_8`, `med_info_9`, `med_info_10`, `verified`, `vkey`, `create_date`)
      VALUES (NULL,'$first_name','$last_name','$birthdate','$gender', '$address', '$contact_number', '$med_info_1', '$med_info_2', '$med_info_3', '$med_info_4', '$med_info_5', '$med_info_6', '$med_info_7', '$med_info_8', '$med_info_9', '$med_info_10', '1', 'NULL', NOW())";

   $result = mysqli_query($conn, $sql);

   if ($result) {
      header("Location: add_patient_index.php?msg=New record created successfully");
   } else {
      echo "Failed: " . mysqli_error($conn);
   }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">

   <!-- Bootstrap -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

   <!-- Font Awesome -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

   <title>Manage Patient Info</title>
</head>

<body>
   <nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color: #00ff5573;">
      Manage Patient Info
   </nav>

   
   <div class="container d-flex justify-content-center">

<!-- FORM -->
<form action="" method="post" style="width:50vw; min-width:300px;">

   <!-- row container for First Name and Last Name -->
   <div class="row mb-3">
      <div class="col">
         <label class="form-label">First Name:</label>
         <input type="text" class="form-control" name="first_name" placeholder="Albert" required>
      </div>
      <div class="col">
         <label class="form-label">Last Name:</label>
         <input type="text" class="form-control" name="last_name" placeholder="Einstein" required>
      </div>
   </div>

   <!-- Birthdate and Gender -->
   <div class="row mb-3">
      <div class="col">
         <label class="form-label">Birthdate:</label>
         <input type="date" class="form-control" name="birthdate" placeholder="Birthdate" required>
      </div>
      <div class="col">
         <label class="form-label d-block">Gender:</label>
         <div class="form-check form-check-inline">
            <input type="radio" class="form-check-input" name="gender" id="male" value="Male" required>
            <label for="male" class="form-check-label">Male</label>
         </div>
         <div class="form-check form-check-inline">
            <input type="radio" class="form-check-input" name="gender" id="female" value="Female" required>
            <label for="female" class="form-check-label">Female</label>
         </div>
      </div>
   </div>


     <!-- Address and Contact Number -->
     <div class="row mb-3">
         <div class="col">
            <label class="form-label">Address:</label>
            <input type="text" class="form-control" name="address" placeholder="Address" required>
         </div>
         <div class="col">
            <label class="form-label">Contact Number:</label>
            <input type="text" class="form-control" name="contact_number" placeholder="Contact Number" required>
         </div>
      </div>

      <!-- Email -->
     <!-- <div class="row mb-3">
         <div class="col">
            <label class="form-label">Email:</label>
            <input type="email" class="form-control" name="active_gmail" placeholder="Email" value="NOEMAIL">
         </div>
      </div> -->

      <br>
      <h4>Patient's Health Record: </h4>
      <br>

      <!-- Row 1 -->
     <div class="row mb-3">
         <div class="col">
            <label class="form-label">Medical Information #1:</label>
            <input type="text" class="form-control" name="med_info_1" placeholder="Medical Information 1">
         </div>
         <div class="col">
            <label class="form-label">Medical Information #2:</label>
            <input type="text" class="form-control" name="med_info_2" placeholder="Medical Information #2">
         </div>
      </div>

      <!-- Row 2 -->
     <div class="row mb-3">
         <div class="col">
            <label class="form-label">Medical Information #3:</label>
            <input type="text" class="form-control" name="med_info_3" placeholder="Medical Information #3">
         </div>
         <div class="col">
            <label class="form-label">Medical Information #4:</label>
            <input type="text" class="form-control" name="med_info_4" placeholder="Medical Information #4">
         </div>
      </div>

      <!-- Row 3 -->
     <div class="row mb-3">
         <div class="col">
            <label class="form-label">Medical Information #5:</label>
            <input type="text" class="form-control" name="med_info_5" placeholder="Medical Information #5">
         </div>
         <div class="col">
            <label class="form-label">Medical Information #6:</label>
            <input type="text" class="form-control" name="med_info_6" placeholder="Medical Information #6">
         </div>
      </div>

      <!-- Row 4 -->
     <div class="row mb-3">
         <div class="col">
            <label class="form-label">Medical Information #7:</label>
            <input type="text" class="form-control" name="med_info_7" placeholder="Medical Information #7">
         </div>
         <div class="col">
            <label class="form-label">Medical Information #8:</label>
            <input type="text" class="form-control" name="med_info_8" placeholder="Medical Information #8">
         </div>
      </div>

      <!-- Row 5 -->
     <div class="row mb-3">
         <div class="col">
            <label class="form-label">Medical Information #9:</label>
            <input type="text" class="form-control" name="med_info_9" placeholder="Medical Information #9">
         </div>
         <div class="col">
            <label class="form-label">Medical Information #10:</label>
            <input type="text" class="form-control" name="med_info_10" placeholder="Medical Information #10">
         </div>
      </div>

   </div>
  </div>

   <!-- Buttons -->
   <div class="d-flex justify-content-center">
      <button type="submit" class="btn btn-success" name="submit">Save</button>
      <a href="index.php" class="btn btn-danger ms-2">Cancel</a>
   </div>
</form>
</div>



   <!-- Bootstrap -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>