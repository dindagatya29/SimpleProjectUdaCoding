<?php
include 'db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        $error_message = "Email dan Password harus diisi!";
    } else {
        $sql = "SELECT * FROM admins WHERE email='$email'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $admin = $result->fetch_assoc();
            if (password_verify($password, $admin['password'])) {
                $_SESSION['admin_id'] = $admin['id'];
                header("Location: index.php");
                exit();
            } else {
                $error_message = "Password salah!";
            }
        } else {
            $error_message = "Email tidak ditemukan!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        body {
            background: linear-gradient(to right, #007bff, #00c6ff);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-container {
            background: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }
        .login-container h1 {
            margin-bottom: 20px;
            font-size: 2rem;
            color: #007bff;
            text-align: center;
            position: relative;
        }
        .login-container h1::after {
            content: "";
            position: absolute;
            left: 50%;
            bottom: -10px;
            width: 80px;
            height: 4px;
            background: #007bff;
            transform: translateX(-50%);
            border-radius: 2px;
        }
        .form-control {
            border-radius: 5px;
            box-shadow: inset 0 1px 2px rgba(0,0,0,.1);
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
            border-radius: 5px;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .error-message {
            color: #dc3545;
            margin-bottom: 20px;
        }
        .register-link {
            color: #007bff;
        }
        .register-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="login-container">
    <h1 class="text-center">Login</h1>
    <?php if (isset($error_message)): ?>
        <div class="error-message text-center">
            <?php echo htmlspecialchars($error_message); ?>
        </div>
    <?php endif; ?>
    <form action="login.php" method="POST">
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" name="email" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Login</button>
    </form>
    <p class="text-center mt-3">
        <a href="register.php" class="register-link">Belum punya akun? Daftar di sini</a>
    </p>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
