<?php
// $password = 'password123';
// $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
// echo "Password: ". $password. "<br>";
// echo "Hashed Password: ". $hashedPassword. "<br>";
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-container {
            background-color: #fff;
            padding: 20px 40px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        .login-container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
            font-size: 24px;
        }

        .login-container form {
            display: flex;
            flex-direction: column;
        }

        .login-container input[type="text"],
        .login-container input[type="password"] {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            width: 100%;
            box-sizing: border-box;
        }

        .login-container button {
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .login-container button:hover {
            background-color: #0056b3;
        }

        .error-message {
            color: red;
            margin-bottom: 15px;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <h2>Connexion</h2>
        <div class="error-message"><?= $_SESSION["errorLogin"] ?? '' ?></div>
        <form method="POST" action="../controllers/UserController.php">
            <input type="text" name="email" placeholder="Email" required value="<?= $_POST["email"] ?? '' ?>">
            <input type="password" name="mot_de_passe" placeholder="Mot de passe" required>
            <button type="submit" name="login">Connexion</button>
        </form>
    </div>
</body>

</html>
