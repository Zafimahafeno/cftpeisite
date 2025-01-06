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

// Ajouter ou modifier un utilisateur
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    if ($id) {
        $stmt = $pdo->prepare("UPDATE admin SET nom = ?, prenom = ?, email = ?, password = ? WHERE id = ?");
        $stmt->execute([$nom, $prenom, $email, $password, $id]);
    } else {
        $stmt = $pdo->prepare("INSERT INTO admin (nom, prenom, email, password) VALUES (?, ?, ?, ?)");
        $stmt->execute([$nom, $prenom, $email, $password]);
    }

    echo "Succès";
    exit;
}

// Supprimer un utilisateur
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    parse_str(file_get_contents("php://input"), $_DELETE);
    $id = $_DELETE['id'];

    $stmt = $pdo->prepare("DELETE FROM admin WHERE id = ?");
    $stmt->execute([$id]);

    echo "Supprimé";
    exit;
}
?>
