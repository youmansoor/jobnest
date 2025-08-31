<?php
include 'config.php';
require_once 'adminheader.php';

if (isset($_POST['save'])) {
    $roleid=$_POST['id'];
    $roleName = $_POST['role_name'];

    $role = $conn->query("INSERT INTO roles (id, role_name) VALUES ('$roleid', '$roleName')");

    if ($role) {
        // echo "Role added successfully.";
    } else {
        // echo "Error adding role.";
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
$user = $_SESSION['user'] ?? $_SESSION['empolyee'] ?? null;
$name = $user['Name'] ?? 'Admin';
$email = $user['Email'] ?? 'admin@gmail.com';
$role = 'Admin';
?>
<style>
  .content {
    margin-left: 110px;
    padding: 15px;
  }
</style>
<!-- Main Content -->
<div class="content">
<h4 class="mb-3">USER MANAGEMENT</h4>
<button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addRoleModal">
  <i class="fas fa-plus-circle"></i> Add Role
</button>
<h4>ADD USER</h4>
<button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addUserModal">
  <i class="fas fa-user-plus"></i> Add User
</button>

<!-- Modal for Add Role -->
<div class="modal fade" id="addRoleModal" tabindex="-1" aria-labelledby="addRoleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form class="modal-content" method="POST" action="role.php" onsubmit="return submitRole(event)">
      <div class="modal-header">
        <h5 class="modal-title" id="addRoleModalLabel">Add New Role</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Role Name -->
        <div class="mb-3">
          <label for="roleName" class="form-label">Role Id</label>
          <input type="text" class="form-control" id="roleName" name="id" required>
          <label for="roleName" class="form-label">Role Name</label>
          <input type="text" class="form-control" id="roleName" name="role_name" required>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success" name="save">Add Role</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
      </div>
    </form>
  </div>
</div>
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form class="modal-content" method="POST" action="role.php">
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
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const userNameBtn = document.getElementById('user-name-btn');
    const dropdown = document.getElementById('user-dropdown');

    if (userNameBtn) {
      userNameBtn.addEventListener('click', function (e) {
        e.stopPropagation();
        dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
      });

      document.addEventListener('click', function () {
        dropdown.style.display = 'none';
      });
    }
  });
</script> -->
<?php include 'adminfooter.php'; ?>