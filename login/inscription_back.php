<?php
session_start();
$host = 'mysql-mahafeno.alwaysdata.net';
$dbname = 'mahafeno_cfptei';
$username = 'mahafeno';
$password = 'antso0201';

try {
    // Création de la connexion PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérification des champs
    if (!isset($_POST['email']) || !isset($_POST['motDePasse']) || !isset($_POST['prenom']) ||
        empty(trim($_POST['email'])) || empty(trim($_POST['motDePasse'])) || empty(trim($_POST['prenom']))) {
        header("Location: inscription.php?error=missing_fields");
        exit();
    }

    $prenom = trim($_POST['prenom']);
    $email = trim($_POST['email']);
    $motDePasse = trim($_POST['motDePasse']);

    // Vérification si l'email existe déjà
    $sql = "SELECT id FROM admin WHERE email = ?";
    if ($stmt = $pdo->prepare($sql)) {
        $stmt->bindParam(1, $email, PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            // L'email existe déjà
            header("Location: inscription.php?error=email_exists");
            exit();
        }
    }

    // Hachage du mot de passe
    $motDePasseHache = password_hash($motDePasse, PASSWORD_DEFAULT);

    // Insertion dans la base de données
    $sql = "INSERT INTO admin (prenom, email, motDePasse) VALUES (?, ?, ?)";
    if ($stmt = $pdo->prepare($sql)) {
        $stmt->bindParam(1, $prenom, PDO::PARAM_STR);
        $stmt->bindParam(2, $email, PDO::PARAM_STR);
        $stmt->bindParam(3, $motDePasseHache, PDO::PARAM_STR);

        if ($stmt->execute()) {
            // Inscription réussie, rediriger vers la page de connexion
            header("Location: index.php?success=registration_success");
            exit();
        } else {
            echo "Erreur lors de l'insertion des données : " . $pdo->errorInfo();
        }
    } else {
        echo "Erreur lors de la préparation de la requête : " . $pdo->errorInfo();
    }
}
?>
