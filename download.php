<?php
// Chemin du dossier des fichiers uploadés
$uploadDir = __DIR__ . '/uploads/';

if (isset($_GET['file'])) {
    $filename = basename($_GET['file']);
    $filePath = $uploadDir . $filename;

    if (file_exists($filePath)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filePath));
        readfile($filePath);
        exit;
    } else {
        die("Fichier non trouvé.");
    }
}