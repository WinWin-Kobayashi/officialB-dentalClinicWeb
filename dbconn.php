<?php 
    $conn = mysqli_connect("localhost", "root", "", "dental_clinic_db");

    // check connection
    if(mysqli_connect_error()){
        echo "Connection to db failed: " . mysqli_connect_error();
        exit;
    }
?>