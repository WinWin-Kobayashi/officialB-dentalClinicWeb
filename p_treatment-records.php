<?php
include('dbconn.php')
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('globalHead.php'); ?>
    <link rel="stylesheet" href="style/p_treatment-records.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
</head>
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
