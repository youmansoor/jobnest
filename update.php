<?php
include 'config.php';
require_once 'adminheader.php';

if(isset($_GET['id'])){
    $id = $_GET['id'];

    $update = $conn->prepare("SELECT * FROM empolyee where id = '$id'");
    $update->execute();
    $upd = $update->fetchall();

    $name = $upd[0]['Name'];
    $email = $upd[0]['Email'];
    $password = $upd[0]['Password'];
}

if(isset($_POST['update'])){
  $id = $_POST['update'];
  $name= $_POST['name'];
  $email= $_POST['email'];
  $password= $_POST['password'];

  $update = $conn->prepare("Update empolyee set Name = '$name', Email = '$email', Password = '$password' where id = '$id'");
  $update->execute();

  if($update){
    // echo "Data updated";
    header("Location: employers.php");
  }
    else{
        echo "Data not updated";
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Update Page</title>
</head>
<body>
    <div class="main-content" style="margin-left:10; padding: 10px;">
        <h2 class="mb-4"><i class="fas fa-layer-group me-2"></i> Update Employer Data</h2>
        <form action="" method="POST">
            <label for="name">Name:</label><br>
            <input type="text" value='<?php echo "$name"?>' name="name"><br><br>
            <label for="email">Email:</label><br>
            <input type="email" value='<?php echo "$email"?>' name="email"><br><br>
            <label for="password">Password:</label><br>
            <input type="text" value='<?php echo "$password"?>' name="password"><br><br>
            <button name="update" value='<?php echo "$id"?>'>Update</button>
        </form>
    </div>
</body>
</html>