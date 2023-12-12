<?php
include "db_conn.php";
$id = $_GET["id"];
$sql = "DELETE FROM `patients_table1` WHERE id = $id";
$result = mysqli_query($conn, $sql);

if ($result) {
  header("Location: add_patient_index.php?msg=Data deleted successfully");
} else {
  echo "Failed: " . mysqli_error($conn);
}
