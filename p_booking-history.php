<?php
include('dbconn.php')
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Booking History</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
</head>
<body>
    <h1>Patient's Booking History</h1>
    <h3><?php if(isset($_GET['first_name'])){
        $first_name = $_GET['first_name'];
        $last_name = $_GET['last_name'];
        echo $first_name . ' ' . $last_name;
    }?></h3>

    <table class="table table-striped">
        <thead>
          <tr>
            <th>Date</th>
            <th>Time</th>
            <th>Service</th>
            <th>Date Created</th>
          </tr>
        </thead>
       
        <tbody id="showdata">
            <?php  
                if(isset($_GET['active_gmail'])){
                    $active_gmail = $_GET['active_gmail'];

                    $sql = "SELECT * FROM appointments WHERE active_gmail = '$active_gmail' ";
                    $query = mysqli_query($conn,$sql);
        
                    while($row = mysqli_fetch_assoc($query))
                    {
                        echo"<tr>"; 
                        echo"<td><h6>".$row['date']."</h6></td>";
                        echo"<td><h6>".$row['time']."</h6></td>";
                        echo"<td>".$row['service']."</td>";
                        echo"<td>".$row['date_created']."</td>";
                        echo"</tr>";   
                    }
                }
            ?>
        </tbody>
    </table>
    
</body>
</html>