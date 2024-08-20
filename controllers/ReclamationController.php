<?php
require_once '../models/ReclamationModel.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_reclamation'])) {

    $id_client = $_SESSION['client_id'];
    $description = $_POST['description'];
    $date = date('Y-m-d H:i:s');

    addReclamation($description, $date, $id_client);
    header('Location:../public/index.php?route=dashboard');
}
?>
