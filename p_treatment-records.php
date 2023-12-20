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

<style>

    .button{
        padding: 5px 10px 5px 10px;
        font-size: var(--small-font);
        border: none;
        border-radius: 8px;
    }

    .addTreatmentRecord{
        background: #7859B7;
        color: white;
        /* margin-top: 0.5rem; */
        margin-bottom: 1rem;
    }

    .addTreatmentRecord:hover{
        background: #4E308C;
        color: white;
    }

    .add_tr{
        margin-top: 2rem;
        display: flex;
         align-items: center;
        justify-content: center;
    }

    .main-text{
        text-align: center;
        margin-top: -2rem;
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

        /* action buttons row container */
        .d-flex{
            display: flex;
            justify-content: center;
            align-items: center;

        }

        .d-flex .bx{
            margin-left: 7px;
            margin-right: 7px;
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

        label{
            font-size: 18px;
            float: left;
            margin-top: 1rem;
            color: var(--v-dark-purple);
        }

        #editTreatmentRecordForm input{
            border: 2px solid var(--dark-purple);
            padding: 3px;
        }

        .backInfo-container{
            display: inline-block;
            margin-top: 2rem;
            margin-left: 1.7rem;
        }

        .bx-arrow-back {
            font-size: 30px; /* Adjust the size as needed */
        }
</style>
<body>

    <div class="backInfo-container">
        <a href="admin-patRecHistory.php"> <i class='bx bx-arrow-back'></i> </a>
    </div>
 

    <h1 class="main-text">
        <?php if(isset($_GET['first_name'])){
            $first_name = $_GET['first_name'];
            $last_name = $_GET['last_name'];
            echo $first_name . ' ' . $last_name . '\'s ';
        }?> 
        Treatment History
    </h1>

    <!-- include the add-treatmentRecord modal -->
    <?php require_once('modal/add-treatmentRecord.php');?>
    <?php require_once('modal/edit-treatmentRecord.php');?>
    <?php require_once('modal/delete-treatmentRecord.php');?>

    <!-- button to toggle add-treatmentRercord modal -->
    <div class="add_tr">
        <button class='button addTreatmentRecord' id='addTreatmentRecord' onclick='openaddTreatmentRecordModal()'>Add Treatment Record</button>
    </div>

    <div class="table-container">
        <table class="table">
            <thead class="thead">
                 <tr>
                    <th>Treatment Id</th>
                    <th>Date</th>
                    <th>Tooth #</th>
                    <th>Procedures Performed</th>
                    <th>Amount Charged</th>
                    <th>Amount Paid</th>
                    <th colspan="2">Actions</th>
                </tr>
            </thead>

            <tbody id="showdata">
            <?php  
                if(isset($_GET['id'])){
                    $id = $_GET['id'];

                    $sql = "SELECT * FROM treatment_records WHERE patient_id = '$id' ";
                    $query = mysqli_query($conn,$sql);
        
                    while($row = mysqli_fetch_assoc($query))
                    {
                        echo"<tr>"; 
                            echo"<td><h6>".$row['id']."</h6></td>";
                            echo"<td><h6>".date('F j, Y', strtotime($row['date'])) ."</h6></td>";
                            echo"<td><h6>".$row['tooth_number']."</h6></td>";
                            echo"<td><h6>".$row['procedures_performed']."</h6></td>";
                            echo"<td><h6>".$row['amount_charged']."</h6></td>";
                            echo"<td><h6>".$row['amount_paid']."</h6></td>";
                            echo "
                            <td>
                                <div class='d-flex'>
                                    <i class='bx bxs-edit edit' id='editInfo' onclick='openeditTreatmentRecordModal(" . $row['id'] . ")'></i>
                                    <i class='bx bxs-trash delete' id='deleteInfo' onclick='opendeleteTreatmentRecordModal(" . $row['id'] . ")'></i>
                                </div>
                            </td>";
                        echo"</tr>"; 
                    }
                }
            ?>
            </tbody>
        </table>
    </div>
</body>
</html>
