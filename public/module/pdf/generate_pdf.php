<?php
// Activer les erreurs PHP pour le débogage
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Inclusion de la configuration et autoload de Dompdf
require_once '../../config/database.php';
require_once '../../../vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

// Connexion à la base de données
$db = new Database();
$conn = $db->getConnection();

// Vérifier si un ID est passé dans l'URL
$id = $_GET['id'] ?? null;

if (!$id) {
    die("ID de réservation manquant.");
}

// Requête SQL pour récupérer les données
$query = "SELECT * FROM reservation WHERE num_reservation = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$reservation = $result->fetch_assoc();

if (!$reservation) {
    die("Aucune réservation trouvée avec cet ID.");
}else {
    // Récupération des données de la réservation
    $id = $reservation['num_reservation'];
    $id_user = $reservation['id_user'];
    $email = $reservation['email'];
    $id_bus = $reservation['num_bus'];
    $id_trajet = $reservation['id_trajet'];
    $date_depart = $reservation['date_depart'];
    $prix = $reservation['prix'];
}

// Configuration Dompdf
$options = new Options();
$options->set('defaultFont', 'Arial');
$dompdf = new Dompdf($options);

// Création du contenu HTML du PDF
$html = "
<!DOCTYPE html>
<html lang='fr'>
<head>
    <meta charset='UTF-8'>
    <title>Confirmation de Réservation</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; }
        h1 { color: red; }
        p { font-size: 14px; line-height: 1.5;text-align:center; }
        .details { margin-top: 20px; }
        .details p { margin: 5px 0; }
    </style>
</head>
<body>
    <h1>Confirmation de Réservation</h1>
    <p>Merci pour votre réservation ! Voici les détails :</p>
    <div class='details'>
        <p><strong>ID de la Réservation :</strong> $id</p>
        <p><strong>ID de l'utilisateur :</strong> $id_user</p>
        <p><strong>Email :</strong> $email</p>
        <p><strong>ID du Bus :</strong> $id_bus</p>
        <p><strong>ID du Trajet :</strong> $id_trajet</p>
        <p><strong>Date de Départ :</strong> $date_depart</p>
        <p><strong>Prix :</strong> $prix FC</p>
    </div>
    <p>Nous vous souhaitons un bon voyage !</p>
    <p>Cordialement,</p>
    <p>L’équipe de réservation</p>
</body>
</html>
";

// Génération du PDF
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();
// Envoi du PDF au navigateur


// Téléchargement automatique du fichier
$dompdf->stream("confirmation_reservation_$id.pdf", ["Attachment" => true]);
