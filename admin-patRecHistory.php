
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
    <link rel="stylesheet" href="style/admin-patRecHistory.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha384-oC1QBgqVlAq1J3Ml/73cViXcSfP+2BEz5LcTy5zMIcuciAAx5Bj3BWE2t0IhRFeM" crossorigin="anonymous">
    <!-- to enable live search -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
</head>
<body>
    <?php include('admin-sidebar.php');?> 

    <section class="dashboard" id="dashboard">
        <div class="patRecHistory-container">
            <div class="container">
                <!-- <h1>Patient Records and History</h1> -->

                <div class="row-container">
                    <!-- <div class="row one">
                        <h3><b>Search Patient:</b></h3>
                    </div> -->

                    <div class="row two">
                        <!-- get user input -->
                        <!-- <div class="input-box">
                            <input type="text" id="getName" placeholder="Search patient">
                        </div> -->

                        <div class="input-box search-container" style="">
                            <i class="fa fa-search icon"></i>
                            <input type="text" id="getName" placeholder="Search patient">
                        </div>

                    </div>
                </div>
            
                <!-- display patients_table1's data that are from verified accounts -->
                <table class="table table-striped" style="">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th colspan="3">Actions</th>
                    </tr>
                    </thead>
                
                    <tbody id="showdata">
                    <?php  

                            // SELECT * FROM Customers ORDER BY Country DESC;
                            $sql = "SELECT * FROM patients_table1 WHERE verified = 1 ORDER BY ID DESC LIMIT 15";
                            $query = mysqli_query($conn,$sql);

                            while($row = mysqli_fetch_assoc($query))
                            {
                            $email = $row['active_gmail'];
                            $first_name = $row['first_name'];
                            $last_name = $row['last_name'];
                            $patient_id = $row['id'];

                            echo"<tr>";
                                echo"<td><h4>".$row['id']."</h4></td>";
                                echo"<td> <h4>".$row['first_name']. ' '. $row['last_name']."</h4> </td>";
                                echo"<td> <h4>". $row['active_gmail']." <h4> </td>";
                                // echo "<td><a class='anchor3' href='p_basic-info.php?active_gmail=$email&first_name=$first_name&last_name=$last_name'>Basic Info</a></td>";
                                // echo "<td><a class='anchor1' href='more-info.php?active_gmail=$email&first_name=$first_name&last_name=$last_name'>Medical Info</a></td>";
                                // echo "<td><a class='anchor2' href='p_booking-history.php?active_gmail=$email&first_name=$first_name&last_name=$last_name'>Booking History</a></td>";
                                // echo "<td> <button class='button patientInfo' id='viewInfo' onclick='openviewPatientInfoModal(" . $row['id'] . ")'>Basic Info</button> </td>";
                                // echo "<td> <button class='button patientMedical' id='viewMedical' onclick='openviewMedicalInfoModal(" . $row['id'] . ")'>Medical Info</button> </td>";
                                // echo "<td> <button class='button patientBooking' id='viewBooking' onclick='openviewBookingHistoryModal(" . $row['id'] . ")'>Booking History</button> </td>";
                                echo "<td><a class='anchor3' href='p_treatment-records.php?id=$patient_id&first_name=$first_name&last_name=$last_name'>Treatment Records</a></td>";
                                echo "<td><a class='anchor2' href='p_booking-history.php?active_gmail=$email&first_name=$first_name&last_name=$last_name'>Booking History</a></td>";

                                echo"</tr>";   
                            }
                        ?>
                    </tbody>
                </table>
            </div>

            <!-- include the modal files -->
            <?php require_once('modal/view-patientInfo.php');?>
            <?php require_once('modal/view-patientMedical.php');?>

        </div>
    </section>
    
<!-- connected to searchajax.php -->
    <script>
        $(document).ready(function(){
        $('#getName').on("keyup", function(){
            var getName = $(this).val();
            $.ajax({
            method:'POST',
            url:'searchajax.php',
            data:{name:getName},
            success:function(response) {
                    $("#showdata").html(response);
            } 
            });
        });
        });
    </script>

</body>
</html>
