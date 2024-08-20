<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Tableau de Bord Client</title>

</head>
<body>
    <h2>Bienvenue sur votre tableau de bord</h2>
    
    <h3>Vos Relevés</h3>
    <table>
        <thead>
            <tr>
                <th>N° Relevé</th>
                <th>Tarif</th>
                <th>Date d'Enregistrement</th>
                <th>Délai de Paiement</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <!-- Boucle pour afficher chaque relevé -->
            <?php foreach (getRelevesByClientId($_SESSION['user']) as $releve): ?>
                <?php 
                    // Calculer la date limite de paiement
                    $dateEnregistrement = new DateTime($releve['date']);
                    $delaiPaiement = $dateEnregistrement->modify('+2 weeks')->format('d/m/Y');
                ?>
                <tr>
                    <td><?= $releve['id'] ?></td>
                    <td><?= $releve['consommation']*100 ?> FR</td>
                    <td><?= date('d/m/Y', strtotime($releve['date_enregistrement'])) ?></td>
                    <td><?= $delaiPaiement ?></td>
                    <td>
                        <a href="index.php?route=reclamation&idReleve=<?= $releve['id'] ?>">
                            Faire une réclamation
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
