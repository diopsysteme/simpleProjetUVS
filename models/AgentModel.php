<?php
require_once '../config/config.php';

function getAgentByEmail($email) {
    global $conn;
    $sql = "SELECT * FROM user WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}
?>
