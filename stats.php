<?php
require "db.php";

$type = $_GET['type'] ?? 'mois';

if ($type == 'jour') {
    $query = $pdo->query("
        SELECT DATE(date_inscription) AS periode, COUNT(*) AS nombre
        FROM register
        GROUP BY DATE(date_inscription)
        ORDER BY periode
    ");
} elseif ($type == 'annee') {
    $query = $pdo->query("
        SELECT YEAR(date_inscription) AS periode, COUNT(*) AS nombre
        FROM register
        GROUP BY YEAR(date_inscription)
        ORDER BY periode
    ");
} else {
    $query = $pdo->query("
        SELECT MONTH(date_inscription) AS periode, COUNT(*) AS nombre
        FROM register
        GROUP BY MONTH(date_inscription)
        ORDER BY periode
    ");
}

$data = $query->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($data);
?>
