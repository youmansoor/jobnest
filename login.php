<?php
session_start();
include 'config.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['Email'] ?? '';
    $password = $_POST['Password'] ?? '';

    $stmtUser = $conn->prepare("SELECT * FROM users WHERE Email = ?");
    $stmtUser->execute([$email]);
    $user = $stmtUser->fetch();
    
    $stmtEmp = $conn->prepare("SELECT * FROM empolyee WHERE Email = ?");
    $stmtEmp->execute([$email]);
    $emp = $stmtEmp->fetch();

    $stmtadmin = $conn->prepare("SELECT * FROM admin WHERE Email = ?");
    $stmtadmin->execute([$email]);
    $admin = $stmtadmin->fetch();

    if ($user && $password === $user['Password']) {
        $_SESSION['user'] = [
            'id'    => $user['id'],
            'Name'  => $user['Name'],
            'Email' => $user['Email'],
        ];
        header("Location: jobs.php");
        exit;
    }
    elseif ($admin && $password === $admin['Password']) {
        $_SESSION['user'] = [
            'id'    => $admin['id'],
            'Name'  => $admin['Name'],
            'Email' => $admin['Email'],
        ];
        header("Location: admin.php");
        exit;
    }
     elseif ($emp && $password === $emp['Password']) {
        $_SESSION['empolyee'] = [
            'id'    => $emp['id'],
            'Name'  => $emp['Name'],
            'Email' => $emp['Email'],
        ];
        header("Location: employer.php");
        exit;
    }
     else {
        $error = "Invalid email or password.";
    }
}
?>
<?php
$clientID = '616789096867-e4u3neirjcags706l4b0qfjjdprn2m37.apps.googleusercontent.com';
$redirectURI = 'http://localhost/jobnest/google_callback.php';

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
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login - JobNest</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body, html {
            height: 100%;
            background-color: #f4f6f8;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        header {
            background: linear-gradient(90deg, #004080, #007acc);
            color: white;
            padding: 20px 0;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .container {
            max-width: 1200px;
            margin: auto;
            padding: 0 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
        }

        .logo {
            font-size: 28px;
            font-weight: bold;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn {
            background: white;
            color: #004080;
            padding: 8px 15px;
            border-radius: 4px;
            text-decoration: none;
            font-weight: bold;
            transition: all 0.3s ease;
            border: 2px solid transparent;
            white-space: nowrap;
        }

        .btn:hover {
            background: transparent;
            color: white;
            border: 2px solid white;
        }

        main {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px 20px;
        }

        .login-box {
            background: #fff;
            padding: 40px 30px;
            border-radius: 10px;
            max-width: 400px;
            width: 100%;
            box-shadow: 0 0 15px rgba(0, 98, 255, 0.1);
            animation: fadeIn 0.5s ease forwards;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-box h2 {
            text-align: center;
            color: #004080;
            margin-bottom: 25px;
            font-size: 28px;
        }

        .login-box label {
            display: block;
            margin-bottom: 6px;
            font-weight: 600;
            font-size: 16px;
            color: #333;
        }

        .login-box input {
            width: 100%;
            padding: 14px 12px;
            margin-bottom: 20px;
            border: 1.5px solid #ccc;
            border-radius: 6px;
            font-size: 16px;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .login-box input:focus {
            outline: none;
            border-color: #007acc;
            box-shadow: 0 0 8px rgba(0, 122, 204, 0.3);
        }

        .login-box button,
        .login-box input[type="submit"] {
            width: 100%;
            padding: 14px;
            background: linear-gradient(to right, #004080, #007acc);
            color: #fff;
            font-weight: bold;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 18px;
            transition: background 0.3s ease;
        }

        .login-box button:hover,
        .login-box input[type="submit"]:hover {
            background: linear-gradient(to right, #003366, #005fa3);
        }

        .error {
            color: red;
            text-align: center;
            margin-bottom: 20px;
            font-size: 16px;
            font-weight: 600;
        }
        @media (max-width: 768px) {
            .login-box {
                max-width: 350px;
                padding: 35px 25px;
            }

            .login-box h2 {
                font-size: 24px;
            }

            .login-box label,
            .login-box input,
            .login-box button {
                font-size: 15px;
            }
        }

        @media (max-width: 480px) {
            .container {
                flex-direction: column;
                gap: 10px;
                text-align: center;
            }

            .btn {
                padding: 10px 20px;
                font-size: 16px;
            }

            .login-box {
                margin: 0 10px;
                padding: 30px 20px;
                max-width: 100%;
            }

            .login-box h2 {
                font-size: 22px;
            }
        }
        @media (min-width: 1600px) {
            .login-box {
                max-width: 450px;
                padding: 50px 40px;
            }

            .login-box h2 {
                font-size: 36px;
            }

            .login-box label {
                font-size: 18px;
            }

            .login-box input {
                font-size: 18px;
                padding: 18px 16px;
            }

            .login-box button {
                font-size: 20px;
                padding: 18px;
            }

            .btn {
                font-size: 18px;
                padding: 12px 25px;
            }
        }

        @media (min-width: 1920px) {
            .login-box {
                max-width: 500px;
                padding: 60px 50px;
            }

            .login-box h2 {
                font-size: 40px;
            }

            .login-box label {
                font-size: 20px;
            }

            .login-box input {
                font-size: 20px;
                padding: 20px 18px;
            }

            .login-box button {
                font-size: 22px;
                padding: 20px;
            }

            .btn {
                font-size: 20px;
                padding: 14px 30px;
            }
        }
    </style>
</head>
<body>

<header>
    <div class="container">
        <div class="logo"><i class="fas fa-briefcase"></i> JobNest</div>
        <a href="index.php" class="btn">Back to Home</a>
    </div>
</header>

<main>
    <div class="login-box" role="main" aria-labelledby="loginTitle">
        <h2 id="loginTitle">Login</h2>

        <?php if ($error): ?>
            <p class="error" role="alert"><?php echo $error;?></p>
        <?php endif; ?>

        <form method="POST" action="login.php" aria-describedby="loginHelp">
            <label for="email">Email:</label>
            <input type="email" id="email" name="Email" required autocomplete="email" />

            <label for="password">Password:</label>
            <input type="password" id="password" name="Password" required autocomplete="current-password" />
            <label for="role">Login as:</label>
<select id="role" name="Role" required>
  <option value="user">User (Freelancer)</option>
  <option value="empolyee">Employer</option>
</select>

            <input type="submit" name="save" value="Login" />
            <a id="googleLoginLink" href="<?php echo $google_login_url;?>" style="display: block; margin-top: 15px; color:#007acc; font-weight:bold; text-decoration:none;">
    <i class="fab fa-google"></i> Login with Google
</a>
        </form>
    </div>
</main>

<?php include 'footer.php';?>

<script>
    const clientId = '616789096867-e4u3neirjcags706l4b0qfjjdprn2m37.apps.googleusercontent.com';
    const redirectUri = 'http://localhost/jobnest/google_callback.php';

    function updateGoogleLoginLink() {
        const roleSelect = document.getElementById('role');
        const role = roleSelect.value;

        const baseUrl = 'https://accounts.google.com/o/oauth2/v2/auth';
        const params = new URLSearchParams({
            client_id: clientId,
            redirect_uri: redirectUri,
            response_type: 'code',
            scope: 'openid email profile',
            access_type: 'offline',
            prompt: 'consent',
            state: role
        });

        const googleLoginLink = document.getElementById('googleLoginLink');
        googleLoginLink.href = `${baseUrl}?${params.toString()}`;
        googleLoginLink.textContent = `Login with Google as ${role.charAt(0).toUpperCase() + role.slice(1)}`;
    }

    document.getElementById('role').addEventListener('change', updateGoogleLoginLink);
    updateGoogleLoginLink();
</script>
</body>
</html>