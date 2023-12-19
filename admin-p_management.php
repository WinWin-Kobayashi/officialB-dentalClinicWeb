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
    <link rel="stylesheet" href="admin-p_management.css">

    <!-- to enable live search -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>

    <style>
        .table td .anchor3{
            background: #1149a3;
            color: rgb(226, 212, 229);
        }

        .table td .anchor3:hover{
            background: rgb(57, 195, 229);
            color: #531A62;
        }

        /* action buttons row container */
        .d-flex{
            display: flex;
            justify-content: center;
            align-items: center;

        }

        /* customize all row icons*/
        .d-flex i{
           font-size: 1.5rem;
           color:#531A62;
        }

        /* customize edit icon */
        .d-flex .edit{
            color: orange;
        }

        /* customize edit icon hover */
        .d-flex .edit:hover{
            color: yellow;
        }

        /* customize info icon */
         .d-flex .info{
            color:#85329C;
        }

        /* customize info icon hover*/
        .d-flex .info:hover{
            color:#451651;
        }

         /* customize delete icon */
         .d-flex .delete{
            color:#C13232;
        }

        /* customize delete icon hover*/
        .d-flex .delete:hover{
            color:red;
        }

        /* styles the modal */
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

        .close-modal{
            margin-top: 1rem;
            width: 48%; padding: 5px; 
            border: none; 
            background: #FF6099; 
            color: white; 
            border-radius: 5px;
            font-size: 15px;
        }

        .close-modal:hover{
            background: #d92668;
            color: white;
        }

        .okay-modal{
            margin-top: 1rem;
            width: 48%; padding: 5px; 
            border: none; 
            background: #90F2AC; 
            color: #0E6116; 
            border-radius: 5px;
            font-size: 15px;
            float: right;
        }

        .okay-modal:hover{
            background: #0e8730;
            color: white;
        }

        .button{
            padding: 5px 10px 5px 10px;
            font-size: var(--small-font);
            border: none;
            border-radius: 8px;
        }

        .addPatient{
            background: #7859B7;
            color: white;
        }

        .addPatient:hover{
            background: #4E308C;
            color: white;
        }


        input, select{
            border: none;
            font-size: 18px;
            color: var(--v-dark-purple);
            float: left;
            width: 100%;
            margin-top: 0.5rem;
            border: 2px solid var(--dark-purple);
            border-radius: 8px;
            padding: 5px;
        }

        input:hover{
            border: 2px solid var(--v-dark-purple);
        }

        input::active{
            border: 2px solid var(--v-dark-purple);
        }

        select{
            color: var(--v-dark-purple);
            padding: 2px;
        }

        .text{
            font-size: 22px;
            color:  var(--v-dark-purple);
            text-align: center;
        }

        .modal-view input{
            border: none;
            padding-left: 0px;
            margin-top: 0px;
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

        label{
            font-size: 18px;
            float: left;
            margin-top: 1rem;
        }

        /* h3{
            margin-top: 1rem;

        } */

        .row-container .input-box{
           margin-top: 2rem;
        }

        #editPatientInfoForm input{
            border: 2px solid var(--dark-purple);
            padding: 3px;
        }

        .d-flex .bx{
            margin-left: 7px;
            margin-right: 7px;
        }

        thead tr th{
            background: var(--dark-purple);
            border: 2px solid var(--dark-purple);
        }

    </style>
</head>
<body>
    <?php include('admin-sidebar.php');?> 

    <div class="patRecHistory-container">
        <div class="container">
            <h1>Manage Patients</h1>

            <div class="row-container">
                <!-- <div class="row one">
                    <h3><b>Search Patient:</b></h3>
                </div> -->

                <div class="row two">
                    <!-- get user input -->
                    <div class="input-box">
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

    </div>

</body>
</html>

