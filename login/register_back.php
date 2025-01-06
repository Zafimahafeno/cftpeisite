<?php
include 'config.php';

// Créer une connexion
$conn = new mysqli($host, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Vérifier si les données du formulaire sont envoyées
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $nom = trim($_POST['nom']);
    $prenom = trim($_POST['prenom']);
    $email = trim($_POST['email']);
    $motDePasse = password_hash(trim($_POST['motDePasse']), PASSWORD_DEFAULT); // Hacher le mot de passe

    // Préparer et exécuter la requête SQL
    $sql = "INSERT INTO admin (nom, prenom, email, motDePasse) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $nom, $prenom, $email, $motDePasse);

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
