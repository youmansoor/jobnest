<?php
include 'config.php';
if (isset($_POST['hire'])) {
    $applicantId = (int) $_POST['hire'];
    $update = $conn->prepare("UPDATE applicants SET status = 'hired' WHERE id = ?");
    if ($update->execute([$applicantId])) {
        $success = "Applicant #$applicantId has been hired.";
        header("Location: employer.php");
    } else {
        $error = "Failed to update status.";
    }
}

if (isset($_POST['reject'])) {
    $applicantId = (int) $_POST['reject'];
    $update = $conn->prepare("UPDATE applicants SET status = 'rejected' WHERE id = ?");
    if ($update->execute([$applicantId])) {
        $success = "Applicant #$applicantId has been rejected.";
        header("Location: employer.php");
    } else {
        $error = "Failed to update status.";
    }
}
?>