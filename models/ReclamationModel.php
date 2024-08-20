<?php
require_once '../config/config.php';

function addReclamation($description, $date, $id_client) {
    global $conn;
    $sql = "INSERT INTO reclamation (description, date, statut, id_user) VALUES (?, ?, 'En attente', ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $description, $date, $id_client);
    return $stmt->execute();
}
?>
