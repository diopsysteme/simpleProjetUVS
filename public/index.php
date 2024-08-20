
<style>
    <?php
    require_once "style.css";
    ?>
</style>
<?php
require_once '../config/config.php';
require_once '../models/AgentModel.php';
require_once '../models/ClientModel.php';

// Fonction pour vérifier si l'utilisateur est authentifié
function isAuthenticated() {
    return isset($_SESSION['user']);
}

// Fonction pour obtenir le rôle de l'utilisateur
function getUserRole() {
    return isset($_SESSION['role']) ? $_SESSION['role'] : null;
}

// Définition des routes et des vues associées
$views = [
    'login' => '../views/login.php',
    'reclamation' => '../views/client/reclamation.php',
    'dashboard' => '../views/client/dashboard.php',
    'agent_dashboard' => '../views/agent/dashboard.php',
    'upload_releve' => '../views/agent/upload_releve.php',
    'client_releves' => '../views/agent/releves_client.php',
    'client_reclamations' => '../views/agent/reclamations_client.php',
    'create_user' => '../views/agent/register_client.php' // Nouvelle route pour la création d'utilisateur
];

// Fonction pour vérifier l'accès à une route spécifique
function checkAccess($route) {
    $role = getUserRole();
    if (in_array($route, ['login', 'reclamation'])) {
        return true; // Accès ouvert pour login et reclamation
    }

    if (in_array($route, ['dashboard'])) {
        return isAuthenticated() && $role === 'client'; // Accès pour les clients
    }

    if (in_array($route, ['agent_dashboard', 'upload_releve', 'create_user'])) {
        return isAuthenticated() && $role === 'agent'; // Accès pour les agents, incluant la nouvelle route
    }

    if (in_array($route, ['client_releves', 'client_reclamations'])) {
        return isAuthenticated() && $role === 'agent'; // Accès pour les agents
    }

    return false; // Accès refusé par défaut
}

// Obtention de la route actuelle et du paramètre d'ID client
$route = isset($_GET['route']) ? $_GET['route'] : 'login';
$clientId = isset($_GET['id']) ? (int)$_GET['id'] : null;

// Vérification de l'accès et inclusion de la vue correspondante
if (array_key_exists($route, $views) && checkAccess($route)) {
    include $views[$route];
} else {
    // Redirection vers la page de connexion en cas d'accès non autorisé
    header('Location: ../public/index.php?route=login');
    exit;
}
?>
