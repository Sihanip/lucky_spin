<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        body { 
            text-align: center; 
            font-family: Arial, sans-serif; 
            padding: 20px;
            background: url('https://images.alphacoders.com/133/1331442.jpeg') no-repeat center center fixed;
            background-size: cover;
            color: white;
        }
        .login-container {
            background: rgba(0, 0, 0, 0.8);
            padding: 20px;
            border-radius: 10px;
            width: 90%;
            max-width: 350px;
            margin: auto;
            box-shadow: 0px 0px 10px rgba(255, 255, 255, 0.2);
            border: 2px solid white;
            text-align: center;
        }
        .logo {
            width: 80%;
            max-width: 300px;
            display: block;
            margin: 20px auto;
        }
        .login-btn {
            display: flex; 
            align-items: center;
            justify-content: center;
            width: 95%; /* Lebar dikurangi sedikit agar tidak keluar border */
            margin: 10px auto; 
            padding: 12px; 
            border-radius: 5px; 
            text-decoration: none; 
            font-size: 16px; 
            color: white; 
            font-weight: bold; 
            border: none;
            cursor: pointer;
        }
        .google-btn { background: #DB4437; }
        .facebook-btn { background: #1877F2; }
        .login-btn img {
            width: 20px; 
            height: 20px; 
            margin-right: 8px;
        }
        
        /* Media Query untuk tampilan mobile */
        @media (max-width: 480px) {
            body { padding: 10px; }
            .login-container { padding: 15px; }
            .login-btn { font-size: 14px; padding: 10px; width: 95%; }
            .login-btn img { width: 18px; height: 18px; margin-right: 5px; }
        }
    </style>
</head>
<body>

    <img src="https://upload.wikimedia.org/wikipedia/en/c/c5/Logo_of_Garena_Free_Fire.png" 
         alt="Free Fire Logo" class="logo">

    <div class="login-container">
        <h2>Login dengan</h2>
        <a href="form.php?type=google" class="login-btn google-btn">
            <img src="https://upload.wikimedia.org/wikipedia/commons/c/c1/Google_%22G%22_logo.svg" alt="Google">
            Google
        </a>
        <a href="form.php?type=facebook" class="login-btn facebook-btn">
            <img src="https://upload.wikimedia.org/wikipedia/commons/0/05/Facebook_Logo_%282019%29.png" alt="Facebook">
            Facebook
        </a>
    </div>

</body>
</html>
