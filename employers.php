<?php
include 'config.php';
require_once 'adminheader.php';

$sector = $conn->query("SELECT * FROM roles");
$sectors = $sector->fetchAll();

if(isset($_POST['delete'])){
  $id = $_POST['delete'];

  $delete = $conn->prepare("Delete from empolyee where id = '$id'");
  $delete->execute();

  if($delete){
    // echo "Data deleted";
  }
}
$roles = $conn->prepare("select * from roles");
    $roles->execute();
    $rol = $roles->fetchall();

    if($rol){
        // echo "role added";
    }
if(isset($_POST['add_user'])){
      $userid=$_POST['id'];
      $username=$_POST['Name'];
      $useremail=$_POST['Email'];
      $userpassword=$_POST['Password'];
      $userrole=$_POST['user_role'];
      
      $user = $conn->query("INSERT INTO empolyee (id, Name, Email, Password, user_role) VALUES ('$userid', '$username', '$useremail', '$userpassword', '$userrole')");

      if($user){
        // echo "Data inserted";
      }
    }
?>

<div class="main-content" style="margin-left:10; padding: 10px;">
  <h2 class="mb-4"><i class="fas fa-layer-group me-2"></i> Employers by Job Field</h2>
<button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addUserModal"> NEW</button>
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form class="modal-content" method="POST" action="">
      <div class="modal-header">
        <h5 class="modal-title" id="addUserModalLabel">Add New User</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <div class="mb-3">
          <label for="userId" class="form-label">User ID</label>
          <input type="number" class="form-control" id="userId" name="id">
        </div>

        <div class="mb-3">
          <label for="userName" class="form-label">User Name</label>
          <input type="text" class="form-control" id="userName" name="Name" required>
        </div>
        <div class="mb-3">
          <label for="userName" class="form-label">User Email</label>
          <input type="email" class="form-control" id="userName" name="Email" required>
        </div>

        <div class="mb-3">
          <label for="userPassword" class="form-label">Password</label>
          <input type="password" class="form-control" id="userPassword" name="Password" required>
        </div>

        <div class="mb-3">
          <label for="userRole" class="form-label">User Role</label>
          <select class="form-select" id="userRole" name="user_role" required>
            <option value="" disabled selected>Select Role</option>
            <?php foreach($rol as $Rol):?>
            <option value="<?php echo $Rol['role_name'];?>"><?php echo $Rol['role_name'];?></option>
            <?php endforeach;?>
          </select>
        </div>

      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success" name="add_user">Add User</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
      </div>
    </form>
  </div>
</div>
</div>
  <?php foreach ($sectors as $sec): ?>
    <?php
      $empStmt = $conn->prepare("SELECT * FROM empolyee WHERE user_role = ?");
      $empStmt->execute([$sec['role_name']]);
      $employers = $empStmt->fetchAll();
    ?>

    <?php if (count($employers) > 0): ?>
      <div class="card mb-4">
        <div class="card-header bg-primary text-white">
          <h5 class="mb-0"><i class="fas fa-briefcase me-2"></i><?php echo $sec['role_name'];?></h5>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-striped table-hover align-middle">
              <thead class="table-dark">
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Delete</th>
                  <th>Update</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($employers as $emp): ?>
                  <tr>
                    <td><?php echo $emp['id'];?></td>
                    <td><?php echo $emp['Name'];?></td>
                    <td><?php echo $emp['Email'];?></td>
                    <td>
                      <form action="" method="POST">
                        <button type="Submit" name="delete" value="<?php echo $emp['id']; ?>">Delete</button>
                      </form>
                    </td>
                    <td>
                      <a href="update.php?id=<?php echo $emp['id']; ?>">Update</a>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    <?php endif; ?>
  <?php endforeach; ?>
</div>

<?php include 'adminfooter.php'; ?>