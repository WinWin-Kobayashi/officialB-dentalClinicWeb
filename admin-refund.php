<!-- ESTABLISH A CONNECTION -->
<?php
    include('dbconn.php')
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('globalHead.php'); ?>
    <!-- Google Font Link for Icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style/admin-refund.css">
    <!-- to enable live search -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
</head>
<body>
    <?php include('admin-sidebar.php');?> 

    <section class="dashboard" id="dashboard">
        <div class="patRecHistory-container">
            <div class="container">

                <!-- include the send refund modal -->
                <?php require_once('modal/send-refund.php');?>
                <?php require_once('modal/view-screenshot.php');?>

                <!-- display appointment table's cancelled appointments -->
                <table class="table table-striped" style="margin-top: 1.5rem;">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Service</th>
                            <!-- <th>Status</th> -->
                            <!-- <th>Refunded</th> -->
                            <th>Screenshot</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                
                    <tbody id="showdata">
                    <?php  

                            $sql = "SELECT * FROM appointments WHERE status = 'Cancelled' AND `refunded` = '0' ORDER BY ID DESC LIMIT 15";
                            $query = mysqli_query($conn,$sql);

                            while($row = mysqli_fetch_assoc($query))
                            {
                            $id = $row['id'];
                            $first_name = $row['first_name'];
                            $last_name = $row['last_name'];
                            $email = $row['active_gmail'];
                            $service = $row['service'];
                            // $status = $row['status'];
                            $screenshot = $row['screenshot'];
                            // $status = $row['refunded'];
                         

                            echo"<tr>";
                                echo"<td><h4>".$row['id']."</h4></td>";
                                echo"<td> <h4>".$row['first_name']. ' '. $row['last_name']."</h4> </td>";
                                echo"<td> <h4>".$row['active_gmail']." <h4> </td>";
                                echo"<td> <h4> ".$row['service']." <h4> </td>";
                                // echo"<td>".$row['status']."</td>";
                                // echo"<td>".$row['refunded']."</td>";
                                echo "<td> <button class='button' id='viewss' onclick='openViewScreenshotModal(" . $row['id'] . ")'>View</button></td>";
                                echo "
                                    <td>
                                        <div class='d-flex'>
                                            <i class='bx bxs-send' id='sendRefund' onclick='openSendRefundModal(" . $row['id'] . ")'></i>
                                        </div>
                                    </td>";
                            echo"</tr>"; 
                            }
                        ?>
                    </tbody>
                </table>
            </div>

        </div>
    </section>
</body>
</html>

