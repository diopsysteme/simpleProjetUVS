<?php
require_once '../models/AgentModel.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    unset($_SESSION["errorLogin"]);
    $email = $_POST['email'];
    $mot_de_passe = $_POST['mot_de_passe'];

    $agent = getAgentByEmail($email);

    if ($agent && password_verify($mot_de_passe, $agent['mot_de_passe'])) {
        $_SESSION['user'] = $agent['id'];
        $_SESSION['role'] = $agent['role'];
        print_r($_SESSION);
        if($agent['role']=="client")
            header("Location:../public/index.php?route=dashboard");
        header('Location:../public/index.php?route=agent_dashboard');
    } else {
        $_SESSION["errorLogin"] ="Incorrect username or password";
        header('Location:../public/index.php?route=login');
    }
}
?>
