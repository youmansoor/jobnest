<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
include 'config.php';

$clientID = '272700466901-3se78dol9g318ljcka0bplvlsu8h2h71.apps.googleusercontent.com';
$clientSecret = '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';
$redirectURI = 'http://localhost/jobnest/google_callback.php';

if (!isset($_GET['code'])) {
    die('No code provided');
}

$role = $_GET['state'] ?? 'user'; // user or empolyee
$code = $_GET['code'];

// 1. Exchange code for access token
$token_request = curl_init();
curl_setopt($token_request, CURLOPT_URL, "https://oauth2.googleapis.com/token");
curl_setopt($token_request, CURLOPT_POST, true);
curl_setopt($token_request, CURLOPT_POSTFIELDS, http_build_query([
    'code' => $code,
    'client_id' => $clientID,
    'client_secret' => $clientSecret,
    'redirect_uri' => $redirectURI,
    'grant_type' => 'authorization_code',
]));
curl_setopt($token_request, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($token_request);
if ($response === false) {
    die('Curl error: ' . curl_error($token_request));
}
curl_close($token_request);
$data = json_decode($response, true);

if (!isset($data['access_token'])) {
    die('Failed to get access token');
}

$accessToken = $data['access_token'];

// 2. Fetch user info
$userinfo = file_get_contents("https://www.googleapis.com/oauth2/v2/userinfo?access_token=" . $accessToken);
$user = json_decode($userinfo, true);

if (!$user || !isset($user['email'])) {
    die('Failed to get user info');
}

$email = $user['email'];
$name = $user['name'] ?? '';
$profile_pic = $user['picture'] ?? '';

// 3. Check in users or empolyee table
if ($role === 'user') {
    $stmt = $conn->prepare("SELECT * FROM users WHERE Email = ?");
} else {
    $stmt = $conn->prepare("SELECT * FROM empolyee WHERE Email = ?");
}
$stmt->execute([$email]);
$existingUser = $stmt->fetch();

// 4. If user doesn't exist, create
if (!$existingUser) {
    if ($role === 'user') {
        $stmt = $conn->prepare("INSERT INTO users (Name, Email, Password) VALUES (?, ?, '')");
    } else {
        $stmt = $conn->prepare("INSERT INTO empolyee (Name, Email, Password) VALUES (?, ?, '')");
    }
    $stmt->execute([$name, $email]);
    $user_id = $conn->lastInsertId();
} else {
    $user_id = $existingUser['id'];
    $name = $existingUser['Name'];
}

// 5. Set session
if ($role === 'user') {
    $_SESSION['user'] = [
        'id'    => $user_id,
        'Name'  => $name,
        'Email' => $email,
    ];
    header("Location: jobs.php"); // user dashboard
} else {
    $_SESSION['empolyee'] = [
        'id'    => $user_id,
        'Name'  => $name,
        'Email' => $email,
    ];
    header("Location: employers.php"); // employer dashboard
}
exit;