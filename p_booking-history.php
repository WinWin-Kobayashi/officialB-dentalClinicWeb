<?php
include('dbconn.php')
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('globalHead.php'); ?>
    <link rel="stylesheet" href="book-history.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
</head>
<body>

    <h1 style="text-align: center; margin-top: 1rem;">Patient's Booking History</h1>
    <h3><?php if(isset($_GET['first_name'])){
        $first_name = $_GET['first_name'];
        $last_name = $_GET['last_name'];
        echo $first_name . ' ' . $last_name;
    }?></h3>

    <div class="table-container">
        <table class="table">
            <thead class="thead">
                 <tr>
                    <th>Id</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Service</th>
                    <th>Date Created</th>
                    <th>Status</th>
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
                        echo"<td><h6>".$row['id']."</h6></td>";
                        echo"<td><h6>".date('F j, Y', strtotime($row['date'])) ."</h6></td>";
                        echo"<td><h6>".date('h:i A', strtotime($row['time']))."</h6></td>";
                        echo"<td>".$row['service']."</td>";
                        echo"<td>".date("F d, Y \a\\t h:i A", strtotime($row["date_created"]))."</td>";
                        echo "<td>" . $row["status"] . "</td>";
                        echo"</tr>";   
                    }
                }
            ?>
            </tbody>
        </table>
    </div>
</body>
</html>



