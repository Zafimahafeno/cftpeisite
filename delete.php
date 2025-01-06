<?php
// Connexion à la base de données
$host = 'mysql-mahafeno.alwaysdata.net';
$dbname = 'mahafeno_cfptei';
$username = 'mahafeno';
$password = 'antso0201';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Suppression d'un utilisateur si l'ID est défini
if (isset($_POST['delete']) && !empty($_POST['delete'])) {
    try {
        $stmt = $pdo->prepare("DELETE FROM admin WHERE id = ?");
        $stmt->execute([$_POST['delete']]);
        header("Location: utilisateur.php");  // Redirige après suppression
        exit;
    } catch (PDOException $e) {
        die("Erreur lors de la suppression : " . $e->getMessage());
    }
} else {
    die("ID utilisateur manquant pour la suppression.");
}
?>
