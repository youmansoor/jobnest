<?php
include 'config.php';
require_once 'adminheader.php';

// Fetch all applicants with their job info directly from applicants table
$sql = "SELECT * FROM applicants";
$stmtApps = $conn->query($sql);
$applicants = $stmtApps->fetchAll();
?>
<?php
include 'config.php';

if(isset($_POST['delete'])){
  $id = $_POST['delete'];

  $delete = $conn->prepare("Delete from applicants where id = '$id'");
  $delete->execute();

  if($delete){
    // echo "Data deleted";
    header("Location: applicants.php");
  }
    else{
        // echo "Data not deleted";
    }
}
?>

<div class="main-content" style="margin-left:10; padding: 10px;">
  <h2 class="mb-4"><i class="fas fa-file-alt me-2"></i> Applicants</h2>

  <div class="table-responsive">
    <table class="table table-striped table-hover align-middle">
      <thead class="table-dark">
        <tr>
          <th>ID</th>
          <th>Job Applied For</th> <!-- Show job info from applicants table -->
          <th>Cover Letter</th>
          <th>Resume</th>
          <th>Status</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($applicants as $app): ?>
        <tr>
          <td><?= htmlspecialchars($app['id']) ?></td>
          <td>
            <?= 
              htmlspecialchars($app['job_title'] ?? $app['job_sector'] ?? 'N/A') 
            ?>
          </td>
          <td><?= nl2br(htmlspecialchars($app['cover_letter'])) ?></td>
          <td>
            <?php if (!empty($app['resume_path']) && file_exists($app['resume_path'])): ?>
              <a href="<?= htmlspecialchars($app['resume_path']) ?>" target="_blank" class="btn btn-sm btn-outline-primary">View Resume</a>
            <?php else: ?>
              <span class="text-muted">No Resume</span>
            <?php endif; ?>
          </td>
          <td><?php echo $app['status'];?></td>
          <td>
            <form action="" method="POST">
                <button type="Submit" name="delete" value="<?php echo $app['id']; ?>">Delete</button>
            </form>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>

<?php include 'adminfooter.php'; ?>
