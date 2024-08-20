<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion Client</title>
</head>
<body>
    <h2>Connexion Client</h2>
    <form method="POST" action="../../controllers/AgentController.php">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="mot_de_passe" placeholder="Mot de passe" required>
        <button type="submit" name="login">Connexion</button>
    </form>
</body>
</html>
