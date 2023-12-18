<?php

    $first_name = '';
    include('dbconn.php');
  
    $first_name = $_POST['name'];
  
    $sql = "SELECT * FROM patients_table1 WHERE first_name LIKE '$first_name%' AND VERIFIED = 1 ORDER BY ID DESC LIMIT 7";  
    $query = mysqli_query($conn,$sql);
    $data='';
    while($row = mysqli_fetch_assoc($query))
    {

        $email = $row['active_gmail'];
        $first_name = $row['first_name'];
        $last_name = $row['last_name'];

        $data .=  "<tr>
                        <td>" .$row['id']." </td>
                        <td>" .$row['first_name']. ' '. $row['last_name']."</td>
                        <td>" .$row['active_gmail']."</td>
                        <td>
                            <div class='d-flex'>
                                <a href='more-info.php?active_gmail=" . $email . "&first_name=" . $first_name . "&last_name=" . $last_name . "' class='link-dark'><i class='bx bx-info-circle info'></i></a>
                                <a href='edit.php?id=" . $row['id'] . "'><i class='bx bxs-edit edit'></i></a>
                                <a href='delete.php?id=" . $row['id'] . "'><i class='bx bxs-trash delete' ></i></a>
                            </div>
                        </td>
                    </tr>"; // Closing </tr> tag added here
    }
    
    echo $data;
?>

<script>
    $.ajax({
    url: 'admin-p.management.php',
    type: 'POST',
    data: {
        name: 'getName'
    },
    success: function(response) {
        // Update your HTML here
        $('#showdata').html(response);

        // Reapply the icon classes
        $('.link-dark').addClass('bx bx-info-circle');
        $('.edit').addClass('bx bxs-edit');
        $('.delete').addClass('bx bxs-trash');
    }
});

</script>
