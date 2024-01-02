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
    <link rel="stylesheet" href="style/admin-p_management.css">
    <!-- to enable live search -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
</head>
<body>
    <?php include('admin-sidebar.php');?> 

    <section class="dashboard" id="dashboard">
        <div class="patRecHistory-container">
            <div class="container">
                <h1>Manage Patients</h1>

                <div class="row-container">
                    <!-- <div class="row one">
                        <h3><b>Search Patient:</b></h3>
                    </div> -->

                    <div class="row two">
                        <!-- get user input -->

                        <div class="input-box search-container">
                            <i class="fa fa-search icon"></i>
                            <input type="text" id="getName" placeholder="Search patient">
                        </div>

                    </div>
                </div>

                <!-- include the add-patient modal -->
                <?php require_once('modal/add-patient.php');?>
                <?php require_once('modal/view-patientInfo.php');?>
                <?php require_once('modal/edit-patientInfo.php');?>
                <?php require_once('modal/delete-patientInfo.php');?>

                <!-- button to toggle add-patient modal -->
                <div class="add_p" style="display: flex; align-items: center; justify-content: center;">
                    <button class='button addPatient' id='addPatient' onclick='openAddPatientModal()' style="margin-top: 0.5rem; margin-bottom: 1rem;">Add Patient</button>
                </div>
            
                <!-- display patients_table1's data that are from verified accounts -->
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                
                    <tbody id="showdata">
                    <?php  

                            $sql = "SELECT * FROM patients_table1 WHERE verified = 1 ORDER BY ID DESC LIMIT 8";
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
                                echo "
                                    <td>
                                        <div class='d-flex'>
                                            <i class='bx bx-info-circle info' id='viewInfo' onclick='openviewPatientInfoModal(" . $row['id'] . ")'></i>
                                            <i class='bx bxs-edit edit' id='editInfo' onclick='openeditPatientInfoModal(" . $row['id'] . ")'></i>
                                            <i class='bx bxs-trash delete' id='deleteInfo' onclick='opendeletePatientInfoModal(" . $row['id'] . ")'></i>
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

    <!-- connected to searchajax2.php -->
<script>
    $(document).ready(function(){
    $('#getName').on("keyup", function(){
        var getName = $(this).val();
        $.ajax({
        method:'POST',
        url:'searchajax2.php',
        data:{name:getName},
        success:function(response)
        {
            $("#showdata").html(response);
        } 
        });
    });
    });
</script>
</body>
</html>

