<?php
include "db_conn.php";
$id = $_GET["id"];

if (isset($_POST["submit"])) {
  $first_name = $_POST['first_name'];
  $last_name = $_POST['last_name'];
  $active_gmail = $_POST['active_gmail'];
  $gender = $_POST['gender'];

  $sql = "UPDATE `patients_table1` SET `first_name`='$first_name',`last_name`='$last_name',`active_gmail`='$active_gmail',`gender`='$gender' WHERE id = $id";

  $result = mysqli_query($conn, $sql);

  if ($result) {
    header("Location: add_patient_index.php?msg=Data updated successfully");
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

  <title>PHP CRUD Application</title>
</head>

<body>
  <nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color: #00ff5573;">
    PHP Complete CRUD Application
  </nav>

  <div class="container">
    <div class="text-center mb-4">
      <h3>Edit User Information</h3>
      <p class="text-muted">Click update after changing any information</p>
    </div>

    <?php
    $sql = "SELECT * FROM `patients_table1` WHERE id = $id LIMIT 1";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    ?>

    <div class="container d-flex justify-content-center">
      <form action="" method="post" style="width:50vw; min-width:300px;">

        <!-- first name and last name -->
        <div class="row mb-3">
          <div class="col">
            <label class="form-label">First Name:</label>
            <input type="text" class="form-control" name="first_name" value="<?php echo $row['first_name'] ?>">
          </div>

          <div class="col">
            <label class="form-label">Last Name:</label>
            <input type="text" class="form-control" name="last_name" value="<?php echo $row['last_name'] ?>">
          </div>
        </div>

        <!-- birthdate and gender -->
        <div class="row mb-3">
          <div class="col">
            <label class="form-label">Birthdate:</label>
            <input type="date" class="form-control" name="birthdate" value="<?php echo $row['birthdate'] ?>">
          </div>

          <div class="col">
            <label class="form-label d-block">Gender:</label>
            <div class="form-check form-check-inline">
              <input type="radio" class="form-check-input" name="gender" id="male" value="Male" <?php echo ($row['gender'] == 'Male') ? 'checked' : ''; ?> required>
              <label for="male" class="form-check-label">Male</label>
            </div>
            <div class="form-check form-check-inline">
              <input type="radio" class="form-check-input" name="gender" id="female" value="Female" <?php echo ($row['gender'] == 'Female') ? 'checked' : ''; ?> required>
              <label for="female" class="form-check-label">Female</label>
            </div>
          </div>
        </div>

         <!-- address and contact number -->
         <div class="row mb-3">
          <div class="col">
            <label class="form-label">Address:</label>
            <input type="text" class="form-control" name="address" value="<?php echo $row['address'] ?>">
          </div>

          <div class="col">
            <label class="form-label">Contact Number</label>
            <input type="text" class="form-control" name="contact_number" value="<?php echo $row['contact_number'] ?>">
          </div>
        </div>

        <!-- email -->
        <div class="mb-3">
          <label class="form-label">Email:</label>
          <input type="active_gmail" class="form-control" name="active_gmail" value="<?php echo $row['active_gmail'] ?>">
        </div>


        <!-- medical info row1 -->
        <div class="row mb-3">
          <div class="col">
            <label class="form-label">Medical Info 1:</label>
            <input type="text" class="form-control" name="med_info_1" value="<?php echo $row['med_info_1'] ?>">
          </div>

          <div class="col">
            <label class="form-label">Medical Info 2:</label>
            <input type="text" class="form-control" name="med_info_2" value="<?php echo $row['med_info_2'] ?>">
          </div>
        </div>

        <!-- medical info row2 -->
         <div class="row mb-3">
          <div class="col">
            <label class="form-label">Medical Info 3:</label>
            <input type="text" class="form-control" name="med_info_3" value="<?php echo $row['med_info_3'] ?>">
          </div>

          <div class="col">
            <label class="form-label">Medical Info 4:</label>
            <input type="text" class="form-control" name="med_info_4" value="<?php echo $row['med_info_4'] ?>">
          </div>
        </div>

         <!-- medical info row3 -->
         <div class="row mb-3">
          <div class="col">
            <label class="form-label">Medical Info 5:</label>
            <input type="text" class="form-control" name="med_info_5" value="<?php echo $row['med_info_5'] ?>">
          </div>

          <div class="col">
            <label class="form-label">Medical Info 6:</label>
            <input type="text" class="form-control" name="med_info_6" value="<?php echo $row['med_info_6'] ?>">
          </div>
        </div>

         <!-- medical info row4 -->
         <div class="row mb-3">
          <div class="col">
            <label class="form-label">Medical Info 7:</label>
            <input type="text" class="form-control" name="med_info_7" value="<?php echo $row['med_info_7'] ?>">
          </div>

          <div class="col">
            <label class="form-label">Medical Info 8:</label>
            <input type="text" class="form-control" name="med_info_8" value="<?php echo $row['med_info_8'] ?>">
          </div>
        </div>

         <!-- medical info row5 -->
         <div class="row mb-3">
          <div class="col">
            <label class="form-label">Medical Info 9:</label>
            <input type="text" class="form-control" name="med_info_9" value="<?php echo $row['med_info_9'] ?>">
          </div>

          <div class="col">
            <label class="form-label">Medical Info 10:</label>
            <input type="text" class="form-control" name="med_info_10" value="<?php echo $row['med_info_10'] ?>">
          </div>
        </div>

       <!-- buttons -->
        <div>
          <button type="submit" class="btn btn-success" name="submit">Update</button>
          <a href="index.php" class="btn btn-danger">Cancel</a>
        </div>
      </form>
    </div>
  </div>

  <!-- Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>