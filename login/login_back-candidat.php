<?php
// Inclusion du fichier de configuration de la base de données
include 'config.php';

// Vérification si la méthode de requête est POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupération des données du formulaire
    $mail = $_POST['mail'];
    $password = $_POST['password'];
    $remember = isset($_POST['remember']) ? $_POST['remember'] : false;

    // Requête SQL pour vérifier l'employeur
    $sql = "SELECT id_employeur, mail_employeur, password_employeur FROM employeur WHERE mail_employeur = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $mail);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // Employeur trouvé dans la base de données
        $row = $result->fetch_assoc();
        $id_employeur = $row['id_employeur'];
        $hashed_password = $row['password_employeur'];

        // Vérification du mot de passe
        if (password_verify($password, $hashed_password)) {
            // Authentification réussie
            session_start();
            $_SESSION['mail'] = $mail;
            $_SESSION['type_compte'] = 'recruteur'; // Type de compte (employeur)
            
            if ($remember) {
                // Si l'utilisateur a coché "Remember Me", définir un cookie
                setcookie('mail', $mail, time() + (10 * 365 * 24 * 60 * 60)); // 10 ans de durée pour le cookie
            }

            // Redirection vers le tableau de bord de l'employeur
            header("Location: dashboard_employeur.php");
            exit();
        } else {
            // Mot de passe incorrect
            echo "Mot de passe incorrect pour l'employeur.";
        }
    } else {
        // Aucun employeur trouvé avec cette adresse e-mail
        echo "Aucun employeur trouvé avec cette adresse e-mail.";
    }

    // Fermeture de la connexion à la base de données
    $conn->close();
} else {
    // Redirection si la méthode de requête n'est pas POST
    header("Location: ../index.html"); // Redirection vers la page d'accueil si la méthode n'est pas POST
    exit();
}
?>
