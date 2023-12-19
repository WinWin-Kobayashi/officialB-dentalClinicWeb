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
    <link rel="stylesheet" href="admin-patRecHistory.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha384-oC1QBgqVlAq1J3Ml/73cViXcSfP+2BEz5LcTy5zMIcuciAAx5Bj3BWE2t0IhRFeM" crossorigin="anonymous">


    <!-- to enable live search -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>

    <style>
        .table td .anchor3{
            background: #7859B7;
            color: white;
        }

        .table td .anchor3:hover{
            background: #4E308C;
            color: white;
        }

        thead tr th{
            background: var(--dark-purple);
            border: var(--dark-purple);
        }

        /* styles the modal in the tab Patient Records and History */
       .modal{
            padding: 1rem;
            top: 50%;
            left: 50%;
            translate: -50% -50%;
            background: white;
            border-radius: 0.25rem;
            z-index: 10;
            border: none;
            padding: 1rem;
            box-shadow: 0px 0px 10px grey;
        }

        .close-modal-full{
            margin-top: 1rem;
            width: 100%;
            padding: 5px; 
            border: none; 
            background: #FF6099; 
            color: white; 
            border-radius: 5px;
            font-size: 15px;
        }

        .close-modal-full:hover{
            background: #d92668;
            color: white;
        }

        .modal-container{
            text-align: center;
            color: var(--v-dark-purple);
        }

        input{
            border: none;
            font-size: 18px;
            color: var(--v-dark-purple);
            float: left;
            /* margin-left: 5px; */
            width: 100%;
        }

        .text{
            font-size: 22px;
        }

        label{
            font-size: 18px;
            float: left;
            margin-top: 1rem;
        }

        #viewInfo{
            background: #7859B7;
            color: white;
        }

        #viewMedical{
            background: #90F2AC;
            color: #0E6116;
        }

        #viewBooking{
            background: #FFF27D;
            color: #531A62;
        }

        #viewInfo:hover{
            background: #4E308C;
            color: white;
        }

        #viewMedical:hover{
            background: #0e8730;
            color: white;
        }

        #viewBooking:hover{
            background: #ffe628;
            color: #531A62;
        }

        button{
            padding: 5px;
            border: none;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
            margin-left: 6px;
        }

        .icon {
            position: absolute;
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
            color: #666;
        }

        #getName {
            padding-left: 3rem; /* Adjust the left padding to leave space for the icon */
        }

    </style>
</head>
<body>
    <?php include('admin-sidebar.php');?> 

    <div class="patRecHistory-container">
        <div class="container">
            <h1>Patient Records and History</h1>

            <div class="row-container">
                <!-- <div class="row one">
                    <h3><b>Search Patient:</b></h3>
                </div> -->

                <div class="row two">
                    <!-- get user input -->
                    <!-- <div class="input-box">
                        <input type="text" id="getName" placeholder="Search patient">
                    </div> -->

                    <div class="input-box search-container">
                        <i class="fa fa-search icon"></i>
                        <input type="text" id="getName" placeholder="Search patient">
                    </div>

                </div>
            </div>
           
            <!-- display patients_table1's data that are from verified accounts -->
            <table class="table table-striped">
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
                        $sql = "SELECT * FROM patients_table1 WHERE verified = 1 ORDER BY ID DESC";
                        $query = mysqli_query($conn,$sql);

                        while($row = mysqli_fetch_assoc($query))
                        {
                        $email = $row['active_gmail'];
                        $first_name = $row['first_name'];
                        $last_name = $row['last_name'];

                        echo"<tr>";
                            echo"<td><h6>".$row['id']."</h6></td>";
                            echo"<td> <h6>".$row['first_name']. ' '. $row['last_name']."</h6> </td>";
                            echo"<td>".$row['active_gmail']."</td>";
                            // echo "<td><a class='anchor3' href='p_basic-info.php?active_gmail=$email&first_name=$first_name&last_name=$last_name'>Basic Info</a></td>";
                            // echo "<td><a class='anchor1' href='more-info.php?active_gmail=$email&first_name=$first_name&last_name=$last_name'>Medical Info</a></td>";
                            // echo "<td><a class='anchor2' href='p_booking-history.php?active_gmail=$email&first_name=$first_name&last_name=$last_name'>Booking History</a></td>";
                            // echo "<td> <button class='button patientInfo' id='viewInfo' onclick='openviewPatientInfoModal(" . $row['id'] . ")'>Basic Info</button> </td>";
                            // echo "<td> <button class='button patientMedical' id='viewMedical' onclick='openviewMedicalInfoModal(" . $row['id'] . ")'>Medical Info</button> </td>";
                            // echo "<td> <button class='button patientBooking' id='viewBooking' onclick='openviewBookingHistoryModal(" . $row['id'] . ")'>Booking History</button> </td>";
                            echo "<td><a class='anchor3' href='p_treatment-records.php?active_gmail=$email&first_name=$first_name&last_name=$last_name'>Treatment Records</a></td>";
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


        <!-- connected to searchajax.php -->
        <script>
            $(document).ready(function(){
            $('#getName').on("keyup", function(){
                var getName = $(this).val();
                $.ajax({
                method:'POST',
                url:'searchajax.php',
                data:{name:getName},
                success:function(response)
                {
                        $("#showdata").html(response);
                } 
                });
            });
            });
        </script>
    </div>

</body>
</html>

