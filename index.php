<?php
session_start();
require_once 'config.php';

if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: index.php");
    exit;
}

$user = null;
$name = '';
$email = '';
$role = '';

if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
    $name = $user['Name'];
    $email = $user['Email'];
    $role = 'User';
} elseif (isset($_SESSION['empolyee'])) { // Note: kept the typo as used in login.php
    $user = $_SESSION['empolyee'];
    $name = $user['Name'];
    $email = $user['Email'];
    $role = 'Employer';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Job Nest</title>
  <link rel="stylesheet" href="style.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <!-- <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <style>
    .hero {
  position: relative;
  background: url('https://images.unsplash.com/photo-1498050108023-c5249f4df085?fit=crop&w=1600') no-repeat center center/cover;
  min-height: 90vh;
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 0 20px;
  color: #fff;
  font-family: 'Poppins', sans-serif;
}

.hero-overlay {
  position: absolute;
  inset: 0;
  background: linear-gradient(135deg, rgba(0, 64, 128, 0.7), rgba(0, 30, 60, 0.9));
  z-index: 1;
  border-radius: 12px;
}

.hero-content {
  position: relative;
  z-index: 2;
  max-width: 650px;
  text-align: center;
  animation: fadeInUp 1.2s ease;
  background: rgba(0, 0, 0, 0.35);
  padding: 40px 30px;
  border-radius: 12px;
  box-shadow: 0 8px 20px rgba(0, 0, 0, 0.5);
}

.hero-content h1 {
  font-size: 3rem;
  font-weight: 700;
  margin-bottom: 16px;
  letter-spacing: 1.2px;
  text-shadow: 1px 1px 5px rgba(0,0,0,0.6);
}

.hero-content p {
  font-size: 1.25rem;
  margin-bottom: 24px;
  font-weight: 500;
  text-shadow: 1px 1px 4px rgba(0,0,0,0.5);
}

.hero-benefits {
  list-style: none;
  padding: 0;
  margin-bottom: 30px;
  display: flex;
  justify-content: center;
  gap: 20px;
  flex-wrap: wrap;
}

.hero-benefits li {
  font-weight: 600;
  font-size: 1rem;
  display: flex;
  align-items: center;
  gap: 8px;
  color: #cce6ff;
  text-shadow: 0 0 6px rgba(0, 122, 204, 0.7);
}

.hero-benefits li i {
  color: #00aaff;
  font-size: 1.3rem;
}

.hero-btn {
  background: #00aaff;
  color: white;
  padding: 16px 40px;
  border-radius: 50px;
  font-weight: 700;
  font-size: 1.1rem;
  text-decoration: none;
  box-shadow: 0 6px 15px rgba(0, 170, 255, 0.6);
  transition: background-color 0.3s ease, box-shadow 0.3s ease;
  display: inline-flex;
  align-items: center;
  gap: 10px;
}

.hero-btn:hover {
  background-color: #007acc;
  box-shadow: 0 8px 20px rgba(0, 122, 204, 0.9);
}

@media (max-width: 768px) {
  .hero-content h1 {
    font-size: 2.2rem;
  }
  
  .hero-benefits {
    flex-direction: column;
    gap: 12px;
  }
}

  </style>
</head>
<body>

<?php include 'header.php';?>

  <section class="hero">
  <div class="hero-overlay"></div>
  <div class="hero-content">
    <h1>Connecting Talent With Opportunity</h1>
    <p>Your journey to a better career starts here.</p>
    <ul class="hero-benefits">
      <li><i class="fas fa-check-circle"></i> Thousands of Verified Jobs</li>
      <li><i class="fas fa-check-circle"></i> Personalized Job Matches</li>
      <li><i class="fas fa-check-circle"></i> Easy Application Process</li>
    </ul>
    <a href="jobs.php" class="hero-btn"><i class="fas fa-rocket"></i> Browse Jobs</a>
  </div>
</section>

  <?php include 'footer.php';?>

</body>
</html>