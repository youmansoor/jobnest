<?php
session_start();

$clientID = '616789096867-e4u3neirjcags706l4b0qfjjdprn2m37.apps.googleusercontent.com';
$redirectURI = 'http://localhost/google_callback.php';

$google_login_url = "https://accounts.google.com/o/oauth2/v2/auth?" . http_build_query([
    'client_id' => $clientID,
    'redirect_uri' => $redirectURI,
    'response_type' => 'code',
    'scope' => 'openid email profile',
    'access_type' => 'offline',
    'prompt' => 'consent',
]);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Login with Google</title>
</head>
<body>
    <a href="<?php echo $google_login_url;?>">Login with Google</a>
</body>
</html>