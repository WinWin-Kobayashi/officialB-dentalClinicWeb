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
    </style>
</head>
<body>
    <?php include('admin-sidebar.php');?> 

    <div class="patRecHistory-container">
        <div class="container">
            <h1>Patient Records and History</h1>

            <div class="row-container">
                <div class="row one">
                    <h3><b>Search Patient:</b></h3>
                </div>

                <div class="row two">
                    <!-- get user input -->
                    <div class="input-box">
                        <input type="text" id="getName">
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
                            echo "<td><a class='anchor3' href='p_basic-info.php?active_gmail=$email&first_name=$first_name&last_name=$last_name'>Basic Info</a></td>";
                            echo "<td><a class='anchor1' href='more-info.php?active_gmail=$email&first_name=$first_name&last_name=$last_name'>Medical Info</a></td>";
                            echo "<td><a class='anchor2' href='p_booking-history.php?active_gmail=$email&first_name=$first_name&last_name=$last_name'>Booking History</a></td>";
                        echo"</tr>";   
                        }
                    ?>
                </tbody>
            </table>
        </div>

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

