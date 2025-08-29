<?php
include 'config.php';
require_once 'adminheader.php';

$sector = $conn->query("SELECT * FROM roles");
$sectors = $sector->fetchAll();
?>

<div class="main-content" style="margin-left:10; padding: 10px;">
  <h2 class="mb-4"><i class="fas fa-layer-group me-2"></i> Employers by Job Field</h2>

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
                </tr>
              </thead>
              <tbody>
                <?php foreach ($employers as $emp): ?>
                  <tr>
                    <td><?php echo $emp['id'];?></td>
                    <td><?php echo $emp['Name'];?></td>
                    <td><?php echo $emp['Email'];?></td>
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