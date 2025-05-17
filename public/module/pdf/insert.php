<?php
 require_once "../../config/database.php";
 $db = new Database();
    $conn = $db->getConnection();

// Récupérer les données du formulaire
if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    require_once '../../config/database.php';
    $db = new Database();
    $conn = $db->getConnection();

  
    $id_user = $_POST['id_user'];
    $email = $_POST['email'];
    $id_bus = $_POST['num_bus'];
    $id_trajet = $_POST['id_trajet'];
    $date_depart = $_POST['date_depart'];
    $prix = $_POST['prix'];

    $query = "INSERT INTO reservation ( id_user, email, num_bus, id_trajet, date_depart, prix) 
              VALUES ( ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssssi", $id_user, $email, $id_bus, $id_trajet, $date_depart, $prix);

    if ($stmt->execute()) {
        // ✅ Récupération correcte du dernier ID inséré
        $id = $conn->insert_id;
        header("Location: confirmation.php?id=$id");
        exit(); // important pour stopper l'exécution après redirection
    } else {
        echo "Erreur lors de l'insertion : " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>