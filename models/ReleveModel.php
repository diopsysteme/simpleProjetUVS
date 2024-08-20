<?php
require_once '../config/config.php';

function addReleve($consommation, $date, $id_compteur, $id_agent) {
    global $conn;
    $sql = "INSERT INTO releve (consommation, date, id_compteur, id_user) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("dsii", $consommation, $date, $id_compteur, $id_agent);
    return $stmt->execute();
}
?>
