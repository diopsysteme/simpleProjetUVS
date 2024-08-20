<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réclamations</title>
    <link rel="stylesheet" href="../../public/style.css">
</head>
<body>
    <main>
        <h2>Réclamations pour <?php echo htmlspecialchars($client['nom'] . ' ' . $client['prenom']); ?></h2>
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Objet</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($reclamations as $reclamation): ?>
                <tr>
                    <td><?php echo htmlspecialchars($reclamation['date']); ?></td>
                    <td><?php echo htmlspecialchars($reclamation['objet']); ?></td>
                    <td><?php echo htmlspecialchars($reclamation['description']); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="index.php?route=agent_dashboard" class="button">Retour à la liste des clients</a>
    </main>
</body>
</html>
