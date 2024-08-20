<?php
$servername = "localhost";
$username = "mhd";
$password = "passer";
$dbname = "dbFactures";
session_start();

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}
use TCPDF;

function creerFacturePDF($client, $consommation, $date) {
    $nomClient = htmlspecialchars($client['nom']); // Utiliser htmlspecialchars pour sécuriser les données
    $dateLimitePaiement = (new DateTime($date))->modify('+2 weeks')->format('Y-m-d');
    
    $tarifParKwh = 100; // Tarif par kWh en Francs CFA
    $montantAPayer = $consommation * $tarifParKwh;
    
    // Création d'une instance TCPDF
    $pdf = new TCPDF();
    
    // Définition des métadonnées du document
    $pdf->SetCreator('Votre Application');
    $pdf->SetAuthor('Votre Société');
    $pdf->SetTitle('Facture de Consommation');
    $pdf->SetSubject('Facture de Consommation');
    
    // Définir les marges
    $pdf->SetMargins(15, 20, 15);
    $pdf->SetAutoPageBreak(TRUE, 20);
    
    // Ajouter une page
    $pdf->AddPage();
    
    // Contenu de la facture
    $html = "
    <style>
        h1 {
            font-size: 24px;
            color: #007bff;
            text-align: center;
            margin-bottom: 20px;
        }
        p {
            font-size: 14px;
            line-height: 1.6;
        }
        .client-info {
            font-size: 16px;
            margin-bottom: 10px;
        }
        .facture-table {
            width: 100%;
            border: 1px solid #007bff;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .facture-table th, .facture-table td {
            padding: 10px;
            border: 1px solid #007bff;
            text-align: left;
        }
        .facture-table th {
            background-color: #007bff;
            color: #fff;
            font-weight: bold;
        }
        .total {
            font-size: 16px;
            font-weight: bold;
            text-align: right;
            margin-top: 20px;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-style: italic;
            color: #555;
        }
    </style>
    
    <h1>Facture de Consommation</h1>
    <p class='client-info'><strong>Client :</strong> $nomClient</p>
    <p class='client-info'><strong>Date :</strong> $date</p>
    
    <table class='facture-table'>
        <tr>
            <th>Consommation</th>
            <td>$consommation kWh</td>
        </tr>
        <tr>
            <th>Montant à Payer</th>
            <td>$montantAPayer Francs CFA</td>
        </tr>
        <tr>
            <th>Date Limite de Paiement</th>
            <td>$dateLimitePaiement</td>
        </tr>
    </table>
    
    <p class='total'>Total à Payer : $montantAPayer Francs CFA</p>
    
    <div class='footer'>
        <p>Merci pour votre confiance.</p>
        <p>Cordialement,</p>
        <p><em>Votre Société</em></p>
    </div>
    ";
    
    // Écrire le contenu HTML dans le PDF
    $pdf->writeHTML($html, true, false, true, false, '');
    
    // Retourner le contenu du PDF en tant que chaîne
    return $pdf->Output('facture.pdf', 'S'); // 'S' retourne le PDF en tant que chaîne
}



use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function envoyerEmailAvecPDF($email, $objet, $message, $pdfContent) {
    $mail = new PHPMailer(true);
   
    try {
        // Configuration SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'diopmail.test@gmail.com';
        $mail->Password = 'anfg kvwo qjof tled'; // Remplacez par le mot de passe correct
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('diopmail.test@gmail.com', 'Mouhamed');

        // Destinataire
        $mail->addAddress($email);

        // Contenu de l'e-mail
        $mail->isHTML(true);
        $mail->Subject = $objet;
        $mail->Body = $message;

            $mail->addStringAttachment($pdfContent, 'facture.pdf');

        $mail->send();
    } catch (Exception $e) {
        echo "Le message n'a pas pu être envoyé. Erreur: {$mail->ErrorInfo}";
    }
}
function excelDateToDateTime($excelDate) {
    $unixDate = ($excelDate - 25569) * 86400; 
    $date = gmdate("Y-m-d", $unixDate);
    return $date;
}
function generateUniqueCompteur() {
    return uniqid('CMPTR_');
}


?>
