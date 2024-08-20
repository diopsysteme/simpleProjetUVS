<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord de l'Agent</title>
    <link rel="stylesheet" href="../../public/style.css">
</head>
<body>
    <header>
        <h1>Tableau de Bord de l'Agent</h1>
        <nav>
            <a href="index.php?route=upload_releve">Télécharger les Relevés</a>
            <!-- Lien pour la création d'un utilisateur -->
            <a href="index.php?route=create_user">Créer un Utilisateur</a>
        </nav>
    </header>
    <main>
        <h2>Liste des Clients</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Téléphone</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach (getAllClients() as $client): ?>
                <tr>
                    <td><?php echo htmlspecialchars($client['id']); ?></td>
                    <td><?php echo htmlspecialchars($client['nom']); ?></td>
                    <td><?php echo htmlspecialchars($client['prenom']); ?></td>
                    <td><?php echo htmlspecialchars($client['email']); ?></td>
                    <td><?php echo htmlspecialchars($client['telephone']); ?></td>
                    <td>
                        <!-- Bouton Détails pour les relevés -->
                        <a href="index.php?route=client_releves&id=<?php echo htmlspecialchars($client['id']); ?>" class="button">Voir Relevés</a>
                        <!-- Bouton Détails pour les réclamations -->
                        <a href="index.php?route=client_reclamations&id=<?php echo htmlspecialchars($client['id']); ?>" class="button">Voir Réclamations</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>
</body>
</html>
