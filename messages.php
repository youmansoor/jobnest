<?php
include 'config.php';
require_once 'adminheader.php';

// Delete message
if (isset($_POST['delete'])) {
    $id = $_POST['delete'];
    $stmt = $conn->prepare("DELETE FROM messages WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: messages.php");
    exit;
}

// Fetch all messages with applicant info
$stmt = $conn->prepare("
    SELECT m.*, a.id AS applicant_id, a.job_title
    FROM messages m
    LEFT JOIN applicants a ON m.applicant_id = a.id
    ORDER BY a.id ASC, m.sent_at ASC
");
$stmt->execute();
$allMessages = $stmt->fetchAll();

// Group messages by applicant
$groupedMessages = [];
foreach ($allMessages as $msg) {
    $applicantId = $msg['applicant_id'];
    $groupedMessages[$applicantId]['job_title'] = $msg['job_title'] ?? 'N/A';
    $groupedMessages[$applicantId]['messages'][] = $msg;
}
?>

<div class="main-content" style="margin-left:10; padding: 20px;">
    <h2 class="mb-4"><i class="fas fa-comments me-2"></i> Messages</h2>

    <?php if (!empty($groupedMessages)): ?>
        <?php foreach ($groupedMessages as $applicantId => $data): ?>
            <div class="card mb-3">
                <div class="card-header bg-light">
                    <a 
                        class="text-decoration-none d-block" 
                        data-bs-toggle="collapse" 
                        href="#chat-<?= $applicantId ?>" 
                        role="button" 
                        aria-expanded="false" 
                        aria-controls="chat-<?= $applicantId ?>"
                    >
                        <strong>Applicant ID:</strong> <?= $applicantId ?> — <strong>Job Title:</strong> <?= htmlspecialchars($data['job_title']) ?>
                        <span class="float-end"><i class="fas fa-chevron-down"></i></span>
                    </a>
                </div>

                <div class="collapse" id="chat-<?= $applicantId ?>">
                    <div class="card-body" style="background-color: #f9f9f9;">
                        <?php foreach ($data['messages'] as $msg): ?>
                            <div class="mb-3 p-3 border-start" style="border-left: 4px solid <?= $msg['sender'] === 'employer' ? '#0d6efd' : '#198754' ?>; background: #fff; border-radius: 5px;">
                                <p><strong><?= ucfirst($msg['sender']) ?>:</strong> <?= nl2br(htmlspecialchars($msg['message'])) ?></p>
                                <small class="text-muted">Sent at: <?= $msg['sent_at'] ?></small>
                                <form method="POST" class="mt-2">
                                    <input type="hidden" name="delete" value="<?= $msg['id'] ?>">
                                    <button class="btn btn-sm btn-outline-danger">Delete</button>
                                </form>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="alert alert-info">No messages found.</div>
    <?php endif; ?>
</div>

<?php include 'adminfooter.php'; ?>