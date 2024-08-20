<?php
require_once '../models/ReclamationModel.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_reclamation'])) {
    $id=$_POST["submit_reclamation"];
   
    $id_client = $_SESSION['user'];
    $description = $_POST['description'];
    $description.=" la reclamation concerne le releve numero : $id ";
    $date = date('Y-m-d H:i:s');

    addReclamation($description, $date, $id_client);
    header('Location:../public/index.php?route=dashboard');
}
?>
