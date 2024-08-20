<?php
require_once '../config/config.php';

function getClientByEmail($email) {
    global $conn;
    $sql = "SELECT * FROM user WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}
function getClientById($id) {
    global $conn;
    $sql = "SELECT * FROM user WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $id);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

function addClient($nom, $prenom, $email, $telephone, $mot_de_passe,$role) {
    var_dump("kshd");
    global $conn;
    $hashed_password = password_hash($mot_de_passe, PASSWORD_DEFAULT);
    $sql = "INSERT INTO user (nom, prenom, email, telephone, mot_de_passe,role) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $nom, $prenom, $email, $telephone, $hashed_password,$role);
    return $stmt->execute();
}
function addCompteur($client_id, $compteur) {
    global $conn;
    $sql = "INSERT INTO compteur (id_user, numero) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $client_id, $compteur);
    return $stmt->execute();
}

function getAllClients() {
    global $conn;
    $query = "SELECT id, nom, prenom, email, telephone FROM user where role='client'";

    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();
    $clients = $result->fetch_all(MYSQLI_ASSOC);

    $stmt->close();
    return $clients;
}
function getRelevesByClientId($clientId) {
    global $conn;
    $sql = "
        SELECT r.*, c.numero AS numero_compteur 
        FROM releve r
        JOIN compteur c ON r.id_compteur = c.id
        WHERE c.id_user = ?
    ";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $clientId); // Assuming $clientId is an integer
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}
function getReclamationsByClientId($clientId) {
    global $conn;
    $sql = "SELECT * FROM reclamation WHERE id_user = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $clientId); // Assuming $clientId is an integer
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}


?>
