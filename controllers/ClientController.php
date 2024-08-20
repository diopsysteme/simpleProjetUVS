<?php
require_once '../models/ClientModel.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $email = $_POST['email'];
    $mot_de_passe = $_POST['mot_de_passe'];

    $client = getClientByEmail($email);

    if ($client && password_verify($mot_de_passe, $client['mot_de_passe'])) {
        session_start();
        $_SESSION['client_id'] = $client['id'];
        header('Location: ../views/client/dashboard.php');
    } else {
        echo "Email ou mot de passe incorrect";
    }
}
?>
