<?php
require_once 'adminheader.php';

$stmt = $conn->query("SELECT * FROM feedback");
$feedbacks = $stmt->fetchAll();
?>

<div class="main-content" style="margin-left:10; padding: 10px;">
  <h2 class="mb-4"><i class="fas fa-comments me-2"></i> Feedback List</h2>

  <div class="table-responsive">
    <table class="table table-striped table-hover align-middle">
      <thead class="table-dark">
        <tr>
          <th>ID</th><th>Name</th><th>Email</th><th>Message</th><th>Date</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($feedbacks as $fb): ?>
        <tr>
          <td><?php echo $fb['id'];?></td>
          <td><?php echo $fb['name'];?></td>
          <td><?php echo $fb['email'];?></td>
          <td><?php echo $fb['message'];?></td>
          <td><?php echo date('Y-m-d H:i');?></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>

<?php include 'adminfooter.php';?>