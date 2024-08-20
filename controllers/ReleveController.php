<?php
require_once '../models/ReleveModel.php';
require_once '../models/CompteurModel.php';
require_once '../vendor/autoload.php';
require_once '../models/ClientModel.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['upload_releve'])) {
    $file = $_FILES['excel_file']['tmp_name'];
    $spreadsheet = IOFactory::load($file);
    $worksheet = $spreadsheet->getActiveSheet();

    $id_agent = $_SESSION['user'];

    $dateFormat = 'Y-m-d'; // Format de la date attendu (exemple : '2024-08-18')
    $errorMessages = [];

    foreach ($worksheet->getRowIterator() as $row) {
        $numero_compteur = $worksheet->getCell('A' . $row->getRowIndex())->getValue();
        $consommation = $worksheet->getCell('B' . $row->getRowIndex())->getValue();
        $date = $worksheet->getCell('C' . $row->getRowIndex())->getValue();

        if (is_numeric($date)) {
            $date = excelDateToDateTime($date);
        }
        
        $dateObject = DateTime::createFromFormat($dateFormat, $date);
        if (!$dateObject || $dateObject->format($dateFormat) !== $date) {
            $errorMessages[] = "La date '$date' sur la ligne {$row->getRowIndex()} n'est pas valide. Format attendu : $dateFormat.";
            continue;
        }

        if (!is_numeric($consommation) || $consommation <= 0) {
            $errorMessages[] = "La consommation '$consommation' sur la ligne {$row->getRowIndex()} n'est pas valide. Elle doit être un nombre positif.";
            continue;
        }

        $compteur = getCompteurByNumero($numero_compteur);

        if ($compteur) {
            addReleve($consommation, $date, $compteur['id'], $id_agent);
            $client=getClientById($compteur["id_user"]);
            $pdfContent = creerFacturePDF($client, $consommation, $date);
        $objet = "Votre Facture de Consommation";
        $message = "Cher client, veuillez trouver ci-joint votre facture de consommation.";
        var_dump($client["email"]);
       
        envoyerEmailAvecPDF($client["email"], $objet, $message, $pdfContent);
        } else {
            $errorMessages[] = "Le numéro de compteur '$numero_compteur' sur la ligne {$row->getRowIndex()} n'existe pas.";
        }
    }

    if (empty($errorMessages)) {
        $_SESSION["reussi"] = "Insertion réussie.";
    } else {
        $_SESSION["error"] = $errorMessages;
    }

    header('Location:../public/index.php?route=agent_dashboard');
}


