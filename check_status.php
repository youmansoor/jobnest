<?php
require_once 'header.php';
require_once 'config.php';

$applicant = null;
$error = '';
$searched = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $applicantId = $_POST['applicant_id'] ?? '';

    if (!empty($applicantId) && is_numeric($applicantId)) {
        $stmt = $conn->prepare("SELECT * FROM applicants WHERE id = ?");
        $stmt->execute([$applicantId]);
        $applicant = $stmt->fetch();
        $searched = true;

        if (!$applicant) {
            $error = "No application found with ID: " . htmlspecialchars($applicantId);
        }
    } else {
        $error = "Please enter a valid numeric ID.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Check Application Status</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #f4f6f8;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 700px;
            margin: 40px auto;
            background: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 12px rgba(0,0,0,0.1);
        }
        h2 {
            color: #004080;
        }
        label {
            font-weight: bold;
        }
        input[type="text"] {
            width: 100%;
            padding: 12px;
            margin-top: 8px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }
        .btn {
            background: #004080;
            color: #fff;
            border: none;
            padding: 12px 20px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 20px;
        }
        .btn:hover {
            background: #005fa3;
        }
        .error {
            color: #cc0000;
            margin-top: 15px;
        }
        .result {
            margin-top: 30px;
        }
        .result h3 {
            color: #004080;
        }
        .resume-link {
            margin-top: 10px;
            display: block;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Check Your Application Status</h2>

    <form method="POST">
        <label for="applicant_id">Enter Your Application ID:</label>
        <input type="text" name="applicant_id" id="applicant_id" required>
        <button type="submit" class="btn">Check Status</button>
    </form>

    <?php if ($error): ?>
        <p class="error"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <?php if ($applicant): ?>
        <div class="result">
            <h3>Application Details</h3>
            <p><strong>Application ID:</strong> <?= htmlspecialchars($applicant['id']) ?></p>
            <p><strong>Job Title:</strong> <?= htmlspecialchars($applicant['job_title']) ?></p>
            <p><strong>Cover Letter:</strong><br><?= nl2br(htmlspecialchars($applicant['cover_letter'])) ?></p>
            <?php if (!empty($applicant['resume_path'])): ?>
                <a href="<?= htmlspecialchars($applicant['resume_path']) ?>" target="_blank" class="resume-link">View Uploaded Resume</a>
            <?php endif; ?>

            <?php if (isset($applicant['status'])): ?>
                <p><strong>Status:</strong> <?= htmlspecialchars(ucfirst($applicant['status'])) ?></p>
            <?php else: ?>
                <p><strong>Status:</strong> <em>Pending review</em></p>
            <?php endif; ?>
        </div>
    <?php elseif ($searched && !$applicant): ?>
        <p class="error">No application found with that ID.</p>
    <?php endif; ?>
</div>

<?php include 'footer.php'; ?>
</body>
</html>