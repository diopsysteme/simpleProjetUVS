<?php
require_once '../models/ClientModel.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $email = $_POST['email'];
    $mot_de_passe = $_POST['mot_de_passe'];

    $client = getClientByEmail($email);

    if ($client && password_verify($mot_de_passe, $client['mot_de_passe'])) {
        session_start();
        $_SESSION['client_id'] = $client['id'];
        header('Location:../public/index.php?route=agent_dashboard');
    } else {
        echo "Email ou mot de passe incorrect";
    }
}

else if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $mot_de_passe = "passer";
    $role = $_POST["role"]; 

    var_dump($_POST);
    $isClientAdded = addClient($nom, $prenom, $email, $telephone, $mot_de_passe, $role);

    if ($isClientAdded) {
        $client = getClientByEmail($email);

        if ($client) {
            $client_id = $client['id'];

            $compteur = generateUniqueCompteur();

            $isCompteurAdded = addCompteur($client_id, $compteur);

            if ($isCompteurAdded) {
                session_start();
                $_SESSION['client_id'] = $client_id;
                header('Location: ');
            } else {
                echo "Erreur lors de l'enregistrement du compteur";
            }
        } else {
            echo "Erreur lors de la récupération du client";
        }
    } else {
        echo "Erreur lors de l'enregistrement du client";
    }
}
?>
