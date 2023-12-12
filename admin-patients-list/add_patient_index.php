<?php
include "db_conn.php";
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

  <style>
    .table-container {
      width: 100%;
      overflow-x: auto;
      max-height: 400px; 
    }
  </style>
</head>

<body>
  
  <nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color: #00ff5573;">
    Manange Patient Info
  </nav>

  <div class="container">
    <?php
    if (isset($_GET["msg"])) {
      $msg = $_GET["msg"];
      echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" style="margin-left: 7rem; width: 97%;" >
      ' . $msg . '
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }
    ?>
    <a href="add-new.php" class="btn btn-dark mb-3" style="margin-left: 7rem;">Add New</a>

    <div class="table-container" style="margin-left: 7rem; width: 97%; max-height: 525px;">
    <table class="table table-hover text-center">
      <thead class="table-dark">
        <tr>
          <th scope="col">ID</th>
          <th scope="col">First Name</th>
          <th scope="col">Last Name</th>
          <th scope="col">Birthdate</th>
          <th scope="col">Gender</th>
          <th scope="col">Address</th>
          <th scope="col">Contact Number</th>
          <th scope="col">Email</th>
          <th scope="col">Password</th>
          <th scope="col">Med Info 1</th>
          <th scope="col">Med Info 2</th>
          <th scope="col">Med Info 3</th>
          <th scope="col">Med Info 4</th>
          <th scope="col">Med Info 5</th>
          <th scope="col">Med Info 6</th>
          <th scope="col">Med Info 7</th>
          <th scope="col">Med Info 8</th>
          <th scope="col">Med Info 9</th>
          <th scope="col">Med Info 10</th>
          <th scope="col">Vkey</th>
          <th scope="col">Verified</th>
          <th scope="col">Create Date</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $sql = "SELECT * FROM `patients_table1`";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
        ?>
          <tr>
            <td><?php echo $row["id"] ?></td>
            <td><?php echo $row["first_name"] ?></td>
            <td><?php echo $row["last_name"] ?></td>
            <td><?php echo $row["birthdate"] ?></td>
            <td><?php echo $row["gender"] ?></td>
            <td><?php echo $row["address"] ?></td>
            <td><?php echo $row["contact_number"] ?></td>
            <td><?php echo $row["active_gmail"] ?></td>
            <td><?php echo $row["password"] ?></td>
            <td><?php echo $row["med_info_1"] ?></td>
            <td><?php echo $row["med_info_2"] ?></td>
            <td><?php echo $row["med_info_3"] ?></td>
            <td><?php echo $row["med_info_4"] ?></td>
            <td><?php echo $row["med_info_5"] ?></td>
            <td><?php echo $row["med_info_6"] ?></td>
            <td><?php echo $row["med_info_7"] ?></td>
            <td><?php echo $row["med_info_8"] ?></td>
            <td><?php echo $row["med_info_9"] ?></td>
            <td><?php echo $row["med_info_10"] ?></td>
            <td><?php echo $row["vkey"] ?></td>
            <td><?php echo $row["verified"] ?></td>
            <td><?php echo date('Y-m-d', strtotime($row["create_date"])) ?></td>
            <td>
              <div class="d-flex">
                <a href="edit.php?id=<?php echo $row["id"] ?>" class="link-dark me-3"><i class="fa-solid fa-pen-to-square fs-5"></i></a>
                <a href="delete.php?id=<?php echo $row["id"] ?>" class="link-dark"><i class="fa-solid fa-trash fs-5"></i></a>
              </div>
            </td>
          </tr>
        <?php
        }
        ?>
      </tbody>
    </table>
    </div>
    
  </div>

  <!-- Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>