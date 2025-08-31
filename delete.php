<?php
include 'config.php';

if(isset($_POST['delete'])){
  $id = $_POST['delete'];

  $delete = $conn->prepare("Delete from jobs where id = '$id'");
  $delete->execute();

  if($delete){
    // echo "Data deleted";
    header("Location: employer.php");
  }
    else{
        echo "Data not deleted";
    }
}
?>