<?php
session_start();
require_once __DIR__ . '/../includes/db.php';
$error = "";

if (isset($_POST['login'])) {
    $u = mysqli_real_escape_string($conn, $_POST['username']);
    $p = $_POST['password']; 

    $q = mysqli_query($conn, "SELECT * FROM admin WHERE username='$u' LIMIT 1");

    if ($q && mysqli_num_rows($q) > 0) {
        $row = mysqli_fetch_assoc($q);

        if (password_verify($p, $row['password'])) {
            $_SESSION['admin_id'] = $row['id']; 
            $_SESSION['admin_name'] = $row['username'];
            header("Location: admin_dashboard.php");
            exit;
        } else {
            $error = "Invalid password.";
        }
    } else {
        $error = "Admin not found.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | Custom Creations</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800&family=Lato:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --cyprus: #004643;
            --cyprus-light: #006662;
            --cyprus-dark: #003330;
            --sand-dune: #F0EDE5;
            --sand-light: #FAF8F4;
            --accent-gold: #C9A961;
            --white: #FFFFFF;
            --gradient-primary: linear-gradient(135deg, #004643 0%, #006662 100%);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Lato', sans-serif;
            background: var(--gradient-primary);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 1.5rem;
            position: relative;
            overflow: hidden;
        }

        body::before {
            content: '';
            position: absolute;
            top: -40%;
            right: -20%;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.08) 0%, transparent 70%);
            border-radius: 50%;
        }

        body::after {
            content: '';
            position: absolute;
            bottom: -30%;
            left: -15%;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(201, 169, 97, 0.1) 0%, transparent 70%);
            border-radius: 50%;
        }

        .login-container {
            width: 100%;
            max-width: 480px;
            background: white;
            border-radius: 28px;
            box-shadow: 0 20px 70px rgba(0, 0, 0, 0.25);
            padding: 3.5rem 3rem;
            animation: slideUp 0.6s ease;
            position: relative;
            z-index: 1;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(40px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .logo {
            font-family: 'Playfair Display', serif;
            font-size: 2.8rem;
            color: var(--cyprus);
            margin-bottom: 0.8rem;
            font-weight: 800;
            letter-spacing: -0.5px;
        }

        .logo span {
            color: var(--accent-gold);
        }

        .subtitle {
            color: #666;
            font-size: 1.05rem;
            font-weight: 400;
            margin-top: 0.5rem;
        }

        .form-group {
            margin-bottom: 2rem;
        }

        label {
            display: block;
            margin-bottom: 0.8rem;
            color: var(--cyprus);
            font-weight: 700;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 1.1rem 1.3rem;
            border: 2px solid #E5DFD4;
            border-radius: 14px;
            font-size: 1.05rem;
            font-family: 'Lato', sans-serif;
            transition: all 0.3s ease;
            background: var(--sand-light);
        }

        input[type="text"]:focus,
        input[type="password"]:focus {
            outline: none;
            border-color: var(--cyprus);
            background: white;
            box-shadow: 0 0 0 4px rgba(0, 70, 67, 0.08);
        }

        .login-btn {
            width: 100%;
            padding: 1.2rem;
            background: var(--gradient-primary);
            color: white;
            border: none;
            border-radius: 50px;
            font-size: 1.08rem;
            font-weight: 700;
            letter-spacing: 0.8px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            margin-top: 1.5rem;
            box-shadow: 0 10px 30px rgba(0, 70, 67, 0.25);
        }

        .login-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(0, 70, 67, 0.35);
        }

        .login-btn:active {
            transform: translateY(0);
        }

        .error-message {
            background: #fee;
            color: #c33;
            padding: 1.2rem 1.5rem;
            border-radius: 14px;
            margin-bottom: 2rem;
            border-left: 5px solid #c33;
            animation: shake 0.4s ease;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-8px); }
            75% { transform: translateX(8px); }
        }

        .error-message strong {
            display: block;
            font-weight: 700;
            margin-bottom: 0.4rem;
        }

        .helper-text {
            text-align: center;
            color: #888;
            font-size: 0.9rem;
            margin-top: 2rem;
        }

        /* RESPONSIVE */
        @media (max-width: 480px) {
            .login-container {
                padding: 3rem 2rem;
                border-radius: 24px;
            }

            .logo {
                font-size: 2.2rem;
            }

            .subtitle {
                font-size: 0.95rem;
            }

            label {
                font-size: 0.8rem;
            }

            input[type="text"],
            input[type="password"] {
                padding: 1rem 1.2rem;
                font-size: 16px;
            }

            .login-btn {
                padding: 1.1rem;
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <div class="logo">Custom<span>Creations</span></div>
            <p class="subtitle">Admin Portal Access</p>
        </div>

        <?php if(!empty($error)): ?>
            <div class="error-message">
                <strong>⚠️ Authentication Failed</strong>
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="form-group">
                <label for="username">Username</label>
                <input 
                    type="text" 
                    id="username"
                    name="username" 
                    required 
                    placeholder="Enter your username"
                    autocomplete="username"
                    autofocus
                >
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input 
                    type="password" 
                    id="password"
                    name="password" 
                    required 
                    placeholder="Enter your password"
                    autocomplete="current-password"
                >
            </div>

            <button type="submit" name="login" class="login-btn">Access Dashboard</button>
        </form>

        <div class="helper-text">
            Authorized personnel only
        </div>
    </div>
</body>
</html>