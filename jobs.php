<?php
session_start();
require_once 'header.php';
require_once 'config.php';

$title = isset($_GET['title']) ? trim($_GET['title']) : '';
$location = isset($_GET['location']) ? trim($_GET['location']) : '';
$sector = isset($_GET['sector']) ? trim($_GET['sector']) : '';

$query = "SELECT * FROM jobs WHERE 1=1";
$params = [];

if ($title !== '') {
    $query .= " AND title LIKE :title";
    $params[':title'] = "%$title%";
}
if ($location !== '') {
    $query .= " AND location = :location";
    $params[':location'] = $location;
}
if ($sector !== '') {
    $query .= " AND sector = :sector";
    $params[':sector'] = $sector;
}

$query .= " ORDER BY id";

$job = $conn->prepare($query);
$job->execute($params);
$jobs = $job->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Find Jobs - Job Nest</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet" />
    <style>
        * {
            box-sizing: border-box;
            margin: 0; padding: 0;
            font-family: 'Poppins', sans-serif;
        }
        body {
            background: #f4f6f8;
        }
        .jobboard {
      text-align: center;
      padding: 70px 20px;
      background-color: #fff;
    }
    .jobboard h2 {
      font-size: 28px;
      margin-bottom: 20px;
    }
    .jobboard span {
      color: #007acc;
      font-weight: bold;
    }
    .search-box {
      display: flex;
      justify-content: center;
      flex-wrap: wrap;
      gap: 15px;
      margin-top: 30px;
    }
    .search-box input,
    .search-box select {
      padding: 12px;
      width: 220px;
      border: 1px solid #ccc;
      border-radius: 5px;
      transition: 0.3s;
    }
    .search-box input:focus,
    .search-box select:focus {
      border-color: #007acc;
      outline: none;
      box-shadow: 0 0 5px rgba(0,122,204,0.3);
    }
    .search-box .btn {
      background-color: #007acc;
      color: white;
      padding: 12px 25px;
      border-radius: 5px;
      border: none;
      cursor: pointer;
      font-weight: bold;
      transition: background-color 0.3s ease;
    }
    .search-box .btn:hover {
      background-color: #005f99;
    }
    @media (max-width: 768px) {
      .search-box input,
      .search-box select {
        width: 100%;
      }
    }
        .container {
            display: flex;
            height: 100vh;
            overflow: hidden;
        }
        .job-list {
            width: 35%;
            background: #fff;
            padding: 20px;
            border-right: 1px solid #ccc;
            overflow-y: auto;
        }
        .job-item {
            background: #f1f1f1;
            padding: 15px;
            margin-bottom: 10px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .job-item:hover {
            background: #e0e0e0;
        }
        .job-item h4 {
            color: #004080;
            font-size: 18px;
            margin-bottom: 4px;
        }
        .job-item small {
            color: #666;
        }
        .job-detail {
            width: 65%;
            background: #fff;
            padding: 30px;
            overflow-y: auto;
        }
        .job-detail h2 {
            color: #004080;
            margin-bottom: 15px;
        }
        .job-detail p {
            margin: 10px 0;
            color: #333;
        }
        .btn-apply {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 18px;
            background: #004080;
            color: #fff;
            border-radius: 4px;
            font-weight: bold;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }
        .btn-apply:hover {
            background: #007acc;
        }
        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }
            .job-list, .job-detail {
                width: 100%;
                height: auto;
            }
        }
    </style>
</head>
<body>
<section class="jobboard">
  <h2>Search Between More Than <span>50,000</span> Open Jobs.</h2>
  <form method="GET" action="jobs.php" class="search-box">
    <input type="text" name="title" placeholder="Job Title, Keywords, or Phrase" />
    <select name="location">
      <option value="">Select City</option>
      <option>Karachi</option>
      <option>Lahore</option>
      <option>Islamabad</option>
    </select>
    <select name="sector">
      <option value="">Select Sector</option>
      <option>Manufacturing</option>
      <option>Legal</option>
      <option>Engineering</option>
      <option>Finance</option>
    </select>
    <button type="submit" class="btn"><i class="fas fa-search"></i> Find Job</button>
  </form>
</section>
<div class="container">
    <div class="job-list" id="jobList">
        <?php if (count($jobs) > 0): ?>
    <?php foreach ($jobs as $job): ?>
        <div class="job-item" data-job='<?php echo json_encode($job);?>'>
            <h4><?php echo $job['title'];?></h4>
            <small><?php echo $job['company'];?> - <?php echo $job['location'];?></small>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <p>No jobs available matching your search criteria.</p>
<?php endif; ?>

    </div>

    <div class="job-detail" id="jobDetail">
        <h2>Select a job to see details</h2>
        <p>Click on a job from the list to view its full description and apply.</p>
    </div>
</div>

<script>
    const jobItems = document.querySelectorAll('.job-item');
    const jobDetail = document.getElementById('jobDetail');
    const isLoggedIn = <?php echo json_encode(isset($_SESSION['user']));?>;

    jobItems.forEach(item => {
        item.addEventListener('click', () => {
            const job = JSON.parse(item.getAttribute('data-job'));
            const applyUrl = `apply.php?job_id=${job.id}`;

            jobDetail.innerHTML = `
                <h2>${job.title}</h2>
                <p><strong>Company:</strong> ${job.company}</p>
                <p><strong>Location:</strong> ${job.location}</p>
                <p><strong>Sector:</strong> ${job.sector}</p>
                <p><strong>Description:</strong><br>${job.description.replace(/\n/g, '<br>')}</p>
                <a href="${applyUrl}" class="btn-apply">Apply Now</a>
            `;
        });
    });
</script>

<?php include 'footer.php'; ?>
</body>
</html>