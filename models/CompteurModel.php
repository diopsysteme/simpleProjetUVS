<?php
require_once '../config/config.php';

function getCompteurByNumero($numero) {
    global $conn;
    $sql = "SELECT * FROM compteur WHERE numero = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $numero);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

function addCompteur($numero, $id_client) {
    global $conn;
    $sql = "INSERT INTO compteur (numero, id_client) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $numero, $id_client);
    return $stmt->execute();
}

function getCompteursByClientId($id_client) {
    global $conn;
    $sql = "SELECT * FROM compteur WHERE id_client = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_client);
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}
?>
