<?php
include('dbconn.php')
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Basic Info</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
</head>
<body>
    <h1>Basic Info</h1>
    <h3><?php if(isset($_GET['first_name'])){
        $first_name = $_GET['first_name'];
        $last_name = $_GET['last_name'];
        echo $first_name . ' ' . $last_name;
    }?></h3>

    <table class="table table-striped">
        <thead>
          <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Birthdate</th>
            <th>Gender</th>
            <th>Address</th>
            <th>Contact Number</th>
            <th>Active Gmail</th>
          </tr>
        </thead>
       
        <tbody id="showdata">
            <?php  
                if(isset($_GET['active_gmail'])){
                    $active_gmail = $_GET['active_gmail'];

                    $sql = "SELECT * FROM patients_table1 WHERE active_gmail = '$active_gmail' ";
                    $query = mysqli_query($conn,$sql);
        
                    while($row = mysqli_fetch_assoc($query))
                    {
                        echo"<tr>"; 
                        echo"<td><h6>".$row['id']."</h6></td>";
                        echo"<td><h6>".$row['first_name']."</h6></td>";
                        echo"<td>".$row['last_name']."</td>";
                        echo"<td>".$row['birthdate']."</td>";
                        echo"<td>".$row['gender']."</td>";
                        echo"<td>".$row['address']."</td>";
                        echo"<td>".$row['contact_number']."</td>";
                        echo"<td>".$row['active_gmail']."</td>";
                        echo"</tr>";   
                    }
                }
            ?>
        </tbody>
    </table>
    
</body>
</html>