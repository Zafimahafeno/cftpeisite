<?php
include 'config.php';

// Créer une connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Vérifier si les données du formulaire sont envoyées
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $nom = trim($_POST['nom']);
    $prenom = trim($_POST['prenom']);
    $type_compte = trim($_POST['type_compte']);
    $mail = trim($_POST['mail']);
    $password = password_hash(trim($_POST['password']), PASSWORD_DEFAULT); // Hacher le mot de passe

    // Préparer et exécuter la requête SQL
    $sql = "INSERT INTO register (nom, prenom, type_compte, mail, password) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $nom, $prenom, $type_compte, $mail, $password);

    if ($stmt->execute()) {
        echo "Compte créé avec succès !";
        header("Location: index.php"); // Rediriger vers la page de connexion
        exit();
    } else {
        echo "Erreur : " . $stmt->error;
    }

    // Fermer la déclaration
    $stmt->close();
}

// Fermer la connexion
$conn->close();
?>
