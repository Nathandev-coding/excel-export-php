<?php
ob_start(); // démarre la sortie tampon

require_once __DIR__ . '/../../../vendor/autoload.php';
include_once '../../config/database.php';
include_once 'getPatient.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$db = new Database();
$conn = $db->getConnection();
$patient = new Patient($conn);
$patients = $patient->getAllPatients();

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

$sheet->setCellValue('A1', 'ID');
$sheet->setCellValue('B1', 'Nom');
$sheet->setCellValue('C1', 'Prenom');
$sheet->setCellValue('D1', 'Age');
$sheet->setCellValue('E1', 'Sexe');
$sheet->setCellValue('F1', 'Adresse');
$sheet->setCellValue('G1', 'Téléphone');
$sheet->setCellValue('H1', 'Date d\'ajout');

$row = 2;
foreach ($patients as $pat) {
    $sheet->setCellValue('A' . $row, $pat['id']);
    $sheet->setCellValue('B' . $row, $pat['nom']);
    $sheet->setCellValue('C' . $row, $pat['prenom']);
    $sheet->setCellValue('D' . $row, $pat['age']);
    $sheet->setCellValue('E' . $row, $pat['sexe']);
    $sheet->setCellValue('F' . $row, $pat['adresse']);
    $sheet->setCellValue('G' . $row, $pat['telephone']);
    $sheet->setCellValue('H' . $row, $pat['created_at']);
    $row++;
}

// Nettoyage des tampons de sortie
ob_end_clean(); // très important

// Entêtes HTTP
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="patients.xlsx"');
header('Cache-Control: max-age=0');

// Écriture dans le flux de sortie
$writer = new Xlsx($spreadsheet);
$writer->save('php://output');

// Nettoyage
$conn->close();
$spreadsheet->disconnectWorksheets();
unset($spreadsheet);
exit;
