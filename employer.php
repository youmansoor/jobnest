<?php
session_start();
require_once 'header.php';
require_once 'config.php';

if (!isset($_SESSION['empolyee'])) {
    header("Location: login.php?redirect=" . urlencode($_SERVER['REQUEST_URI']));
    exit;
}

$employer = $_SESSION['empolyee'];
$employerEmail = $employer['Email'];

$error = '';
$success = '';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $company = trim($_POST['company']);
    $location = trim($_POST['location']);
    $sector = trim($_POST['sector']);
    $description = trim($_POST['description']);

    if (!$title || !$company || !$location || !$description) {
        $error = "Please fill in all required fields.";
    } else {
        $stmt = $conn->prepare("INSERT INTO jobs (title, company, location, sector, description, employer_email) VALUES (?, ?, ?, ?, ?, ?)");
        if ($stmt->execute([$title, $company, $location, $sector, $description, $employerEmail])) {
            $success = "Job posted successfully!";
        } else {
            $error = "Failed to post job. Please try again.";
        }
    }
}

$stmt = $conn->prepare("SELECT * FROM jobs WHERE employer_email = ? ORDER BY id");
$stmt->execute([$employerEmail]);
$jobs = $stmt->fetchAll();

$appStmt = $conn->prepare("SELECT * FROM applicants ORDER BY id");
$appStmt->execute();
$applicants = $appStmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Employer Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #f0f2f5;
            margin: 0;
        }

        .container {
            max-width: 1000px;
            margin: 50px auto;
            background: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.08);
        }

        h2 {
            color: #003366;
            margin-bottom: 25px;
        }

        form input, form textarea {
            width: 100%;
            padding: 12px 15px;
            margin-bottom: 20px;
            border-radius: 6px;
            border: 1px solid #ccc;
            font-size: 15px;
        }

        form textarea {
            min-height: 120px;
            resize: vertical;
        }

        form button {
            background: #004080;
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
        }

        form button:hover {
            background: #0059b3;
        }

        .error, .success {
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 6px;
        }

        .error { background: #ffe6e6; color: #cc0000; }
        .success { background: #e6ffea; color: #007a3d; }

        .job-listing {
            background: #fafafa;
            border: 1px solid #ddd;
            padding: 20px;
            margin-bottom: 25px;
            border-radius: 8px;
        }

        .job-listing h3 {
            margin: 0;
            color: #004080;
            font-size: 20px;
        }

        .job-meta {
            font-size: 14px;
            color: #666;
            margin: 10px 0;
        }

        .job-description {
            color: #444;
            margin-bottom: 15px;
        }

        .job-listing ul {
            list-style: none;
            padding-left: 0;
        }

        .job-listing ul li {
            background: #f1f5f9;
            padding: 15px;
            margin-bottom: 10px;
            border-left: 5px solid #007acc;
            border-radius: 5px;
        }

        .job-listing ul li strong {
            color: #003366;
        }

        .job-listing ul li a {
            color: #007acc;
            text-decoration: none;
        }

        .job-listing ul li a:hover {
            text-decoration: underline;
        }

        hr {
            border: none;
            height: 1px;
            background-color: #ddd;
            margin: 40px 0;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Post a New Job</h2>

    <?php if ($error): ?>
        <div class="error"><?php echo $error;?></div>
    <?php endif; ?>

    <?php if ($success): ?>
        <div class="success"><?php echo $success;?></div>
    <?php endif; ?>

    <form method="POST">
        <input type="text" name="title" placeholder="Job Title" required>
        <input type="text" name="company" placeholder="Company Name" required>
        <input type="text" name="location" placeholder="Location" required>
        <input type="text" name="sector" placeholder="Sector (Optional)">
        <textarea name="description" placeholder="Job Description" required></textarea>
        <button type="submit">Post Job</button>
    </form>

    <hr>

    <h2>Your Posted Jobs</h2>

    <?php if ($jobs): ?>
        <?php foreach ($jobs as $job): ?>
            <div class="job-listing">
                <h3><?php echo $job['title'];?></h3>
                <div class="job-meta">
                    <strong>Company:</strong> <?php echo $job['company'];?> 
                    <strong>Location:</strong> <?php echo $job['location'];?> 
                    <strong>Sector:</strong> <?php echo $job['sector'];?>
                </div>
                <div class="job-description"><?php echo $job['description'];?></div>

                <?php
                    $jobApplicants = array_filter($applicants, fn($app) => $app['job_title'] === $job['title']);
                ?>

                <?php if (!empty($jobApplicants)): ?>
                    <h4>Applicants</h4>
                    <ul>
                        <?php foreach ($jobApplicants as $app): ?>
                            <li>
                                <h4>Applied on <?= date('M d, Y', strtotime($app['applied_at'] ?? 'now')) ?></h4><br>
                                <?php echo $app['cover_letter'];?>
                                <?php if (!empty($app['resume_path'])): ?>
                                    <br><a href="<?php echo $app['resume_path'];?>" target="_blank">View Resume</a>
                                <?php endif; ?>
                            </li>
                            <form action="status.php" method="POST">
                                <button type="submit" name="hire" value="<?php echo $app['id'];?>">Hire</button>
                                <button type="submit" name="reject" value="<?php echo $app['id'];?>">Reject</button>
                            </form>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p><em>No applicants yet for this job.</em></p>
                <?php endif; ?>
            </div>
            <form action="delete.php" method="POST">
                <button type="Submit" name="delete" value="<?php echo $job['id']; ?>">Delete</button>
            </form>
        <?php endforeach; ?>
    <?php else: ?>
        <p>You haven’t posted any jobs yet.</p>
    <?php endif; ?>
</div>

<?php include 'footer.php'; ?>
</body>
</html>