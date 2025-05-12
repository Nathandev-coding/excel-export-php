<?php
// Include the database connection file
include_once '../../config/database.php';
// Include the Excel library

// Include the patient class file
include_once 'getPatient.php';
// Create a new database connection
$db = new Database();
$conn = $db->getConnection();
// Create a new instance of the Patient class
$patient = new Patient($conn);
// Get all patients
$patients = $patient->getAllPatients();
// Check if the export button is clicked

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Affichage de tout le patient avec un bouton export excel </title>
           <!-- script tailwindcss-->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- font awensone -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <section class="flex justify-center items-center h-screen">
        <div class="bg-white shadow-md rounded-lg p-6 ">
            <h1 class="text-2xl font-bold mb-4">Liste des patients</h1>
            <form action="export_excel.php" method="post">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                    Exporter vers Excel
                </button>
            </form>
            <table class="min-w-full bg-white border border-gray-300">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b">ID</th>
                        <th class="py-2 px-4 border-b">Nom</th>
                        <th class="py-2 px-4 border-b">Prenom</th>
                        <th class="py-2 px-4 border-b">Date de naissance</th>
                        <th class="py-2 px-4 border-b">Sexe</th>
                        <th class="py-2 px-4 border-b">Adresse</th>
                        <th class="py-2 px-4 border-b">Telephone</th>
                       
                        <th class="py-2 px-4 border-b">Date d'ajout</th>
                    </tr>
                </thead>
                <tbody>
                  
                    <?php foreach ($patients as $pat): ?>
                        <tr>
                            <td class="py-2 px-4 border-b"><?php echo htmlspecialchars($pat['id']); ?></td>
                            <td class="py-2 px-4 border-b"><?php echo $pat['nom']; ?></td>
                            <td class="py-2 px-4 border-b"><?php echo $pat['prenom']; ?></td>
                            <td class="py-2 px-4 border-b"><?php echo $pat['age']; ?></td>
                            <td class="py-2 px-4 border-b"><?php echo $pat['sexe']; ?></td>
                            <td class="py-2 px-4 border-b"><?php echo $pat['adresse']; ?></td>
                            <td class="py-2 px-4 border-b"><?php echo $pat['telephone']; ?></td>
                            
                            <td class="py-2 px-4 border-b"><?php echo $pat['created_at']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                   

                </tbody>
            </table>
                
                  

    </section>
    
</body>
</html>