<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relevés de Consommation</title>
    <link rel="stylesheet" href="../../public/style.css">
</head>
<body>
    <main>
        <h2>Relevés de consommation pour <?php echo htmlspecialchars($client['nom'] . ' ' . $client['prenom']); ?></h2>
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Consommation</th>
                    <th>Agent</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach (getRelevesByClientId($_GET["id"]) as $releve): ?>
                <tr>
                    <td><?php echo htmlspecialchars($releve['date']); ?></td>
                    <td><?php echo htmlspecialchars($releve['consommation']); ?></td>
                    <td><?php echo htmlspecialchars($releve['id_agent']); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="index.php?route=agent_dashboard" class="button">Retour à la liste des clients</a>
    </main>
</body>
</html>
