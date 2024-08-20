<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Faire une Réclamation</title>
</head>
<body>
    <h2>Réclamation</h2>
    <form method="POST" action="../controllers/ReclamationController.php">
        <textarea name="description" placeholder="Décrivez votre réclamation" required></textarea>
        
        <button type="submit" name="submit_reclamation" value="<?=$_GET["idReleve"]?>">Soumettre</button>
    </form>
</body>
</html>
