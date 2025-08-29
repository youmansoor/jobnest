<?php
require_once 'config.php'; // Your DB connection here

$message = '';
if (isset($_POST['add_user'])) {
    $id = $_POST['user_id'];
    $name = $_POST['user_name'];
    $password = password_hash($_POST['user_password'], PASSWORD_DEFAULT);
    $role = $_POST['user_role'];

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO users (id, Name, Password, Role) VALUES ('$id', '$name', '$password', '$role)')");
    if ($stmt) {
        // $stmt->bind_param("isss", $id, $name, $password, $role);
        if ($stmt) {
            $message = "User added successfully.";
        } else {
            $message = "Error: " ;
        }
    } else {
        $message = "Prepare failed: ";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Modal Test</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>

<button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addUserModal">
  Add User
</button>

<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form class="modal-content" method="POST" action="user.php">
      <div class="modal-header">
        <h5 class="modal-title" id="addUserModalLabel">Add New User</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <div class="mb-3">
          <label for="userId" class="form-label">User ID</label>
          <input type="number" class="form-control" id="userId" name="user_id" required>
        </div>

        <div class="mb-3">
          <label for="userName" class="form-label">User Name</label>
          <input type="text" class="form-control" id="userName" name="user_name" required>
        </div>

        <div class="mb-3">
          <label for="userPassword" class="form-label">Password</label>
          <input type="password" class="form-control" id="userPassword" name="user_password" required>
        </div>

        <div class="mb-3">
          <label for="userRole" class="form-label">User Role</label>
          <select class="form-select" id="userRole" name="user_role" required>
            <option value="" disabled selected>Select Role</option>
            <option value="Admin">Admin</option>
            <option value="User">User</option>
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
