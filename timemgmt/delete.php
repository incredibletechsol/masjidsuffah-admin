<?php
include('database_connection.php');
if(isset($_POST["id"]))
{
 $query = "DELETE FROM salat_times WHERE id = '".$_POST["id"]."'";
 if(mysqli_query($connect, $query))
 {
  echo 'Data Deleted';
 }
}
?>