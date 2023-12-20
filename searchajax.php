<?php

  $first_name = '';
  include('dbconn.php');

  $first_name = $_POST['name'];
  
   $sql = "SELECT * FROM patients_table1 WHERE first_name LIKE '$first_name%' AND VERIFIED = 1 ORDER BY ID DESC";  
   $query = mysqli_query($conn,$sql);
   $data='';
   while($row = mysqli_fetch_assoc($query))
   {

    $email = $row['active_gmail'];
    $first_name = $row['first_name'];
    $last_name = $row['last_name'];
    $patient_id = $row['id'];

    $data .=  "<tr>
                <td>" .$row['id']." </td>
                <td>" .$row['first_name']. ' '. $row['last_name']."</td>
                <td>" .$row['active_gmail']."</td>
                <td><a class='anchor3' href='p_treatment-records.php?id=$patient_id&first_name=$first_name&last_name=$last_name'>Treatment Records</a></td>
                <td><a class='anchor2' href='p_booking-history.php?active_gmail=$email&first_name=$first_name&last_name=$last_name'>Booking History</a></td>
              </tr>";
   }
    
   echo $data;
 ?>
