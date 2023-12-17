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
            color: yellow;
        }

        /* customize edit icon hover */
        .d-flex .edit:hover{
            color: orange;
        }

        /* customize info icon */
         .d-flex .info{
            color:#0E6116;
        }

        /* customize info icon hover*/
        .d-flex .info:hover{
            color:yellowgreen;
        }

         /* customize delete icon */
         .d-flex .delete{
            color:red;
        }

        /* customize delete icon hover*/
        .d-flex .delete:hover{
            color:maroon;
        }





    </style>
</head>
<body>
    <?php include('admin-header.php');?> 

    <div class="patRecHistory-container">
        <div class="container">
            <h1>Manage Patients</h1>

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

            <div class="add_p">
                <p> <a href="">Add patient</a></p>
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
                            echo "
                                <td>
                                    <div class='d-flex'>
                                        <a href='more-info.php?active_gmail=" . $email . "&first_name=" . $first_name . "&last_name=" . $last_name . "' class='link-dark'><i class='bx bx-info-circle info'></i></a>
                                        <a href='edit.php?id=" . $row['id'] . "'><i class='bx bxs-edit edit'></i></a>
                                        <a href='delete.php?id=" . $row['id'] . "'><i class='bx bxs-trash delete' ></i></a>
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

