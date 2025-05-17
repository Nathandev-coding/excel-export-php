<?php
require_once '../../config/database.php';
$id = $_GET['id'] ?? null;
if (!$id) {
    die("ID de réservation manquant.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>confirmation et telechargement du ficher pdf</title>
</head>
<body>
    <section class="w-full d-flex justify-content-center align-items-center flex-column">
        <div class="p-8 bg-white shadow-md rounded-lg">
            <h1 class="text-2xl font-bold mb-4">Confirmation de votre réservation</h1>
            <p>Votre réservation a été effectuée avec succès.</p>
            <p>Vous pouvez télécharger votre confirmation au format PDF en cliquant sur le bouton ci-dessous.</p>
            <a href="generate_pdf.php?id=<?php echo $id; ?>" class="py-4 px-4" target="_blank">Télécharger la confirmation PDF</a>
        </div>
    </section>
    
</body>
</html>