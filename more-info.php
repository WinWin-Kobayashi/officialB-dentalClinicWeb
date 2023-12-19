<?php
    include('dbconn.php')
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>More Info</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
</head>
<body>
    <h1>Patient's Health Info</h1>
    <h3><?php if(isset($_GET['first_name'])){
        $first_name = $_GET['first_name'];
        $last_name = $_GET['last_name'];
        echo $first_name . ' ' . $last_name;
    }?></h3>

    <table class="table table-striped">
        <thead>
          <tr>
            <th>Med Info 1</th>
            <th>Med Info 2</th>
            <th>Med Info 3</th>
            <th>Med Info 4</th>
            <th>Med Info 5</th>
            <th>Med Info 6</th>
            <th>Med Info 7</th>
            <th>Med Info 8</th>
            <th>Med Info 9</th>
            <th>Med Info 10</th>
          </tr>
        </thead>
       
        <tbody id="showdata">
            <?php  
                if(isset($_GET['active_gmail'])){
                    $active_gmail = $_GET['active_gmail'];

                    $sql = "SELECT * FROM patients_table1 WHERE (first_name = '$first_name' AND last_name = '$last_name')";                    $query = mysqli_query($conn,$sql);
        
                    while($row = mysqli_fetch_assoc($query))
                    {
                        echo"<tr>"; 
                        echo"<td><h6>".$row['med_info_1']."</h6></td>";
                        echo"<td><h6>".$row['med_info_2']."</h6></td>";
                        echo"<td>".$row['med_info_3']."</td>";
                        echo"<td>".$row['med_info_4']."</td>";
                        echo"<td>".$row['med_info_5']."</td>";
                        echo"<td>".$row['med_info_6']."</td>";
                        echo"<td>".$row['med_info_7']."</td>";
                        echo"<td>".$row['med_info_8']."</td>";
                        echo"<td>".$row['med_info_9']."</td>";
                        echo"<td>".$row['med_info_10']."</td>";
                        echo"</tr>";   
                    }
                }
            ?>
        </tbody>
    </table>

</body>
</html>