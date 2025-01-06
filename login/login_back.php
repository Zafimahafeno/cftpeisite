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
    if (!isset($_POST['email']) || !isset($_POST['motDePasse']) || empty(trim($_POST['email'])) || empty(trim($_POST['motDePasse']))) {
        header("Location: index.php?error=missing_fields");
        exit();
    }

    $email = trim($_POST['email']);
    $motDePasse = trim($_POST['motDePasse']);

    // Préparation de la requête SQL pour vérifier l'utilisateur
    $sql = "SELECT * FROM admin WHERE email = ?";
    
    if ($stmt = $pdo->prepare($sql)) {
        $stmt->bindParam(1, $email, PDO::PARAM_STR); // Utiliser bindParam pour PDO

        if ($stmt->execute()) {
            $result = $stmt->fetch(PDO::FETCH_ASSOC); // Utiliser fetch avec PDO pour obtenir une ligne

            if ($result) {
                // Vérification du mot de passe
                if (password_verify($motDePasse, $result['motDePasse'])) {
                    $_SESSION["loggedin"] = true;
                    $_SESSION["id"] = $result['id'];
                    $_SESSION["prenom"] = $result['prenom'];
                    $_SESSION["email"] = $result['email'];

                    // Rediriger vers l'admin
                    header("Location: ../admin.php");
                    exit();
                } else {
                    header("Location: index.php?error=password");
                    exit();
                }
            } else {
                header("Location: index.php?error=email");
                exit();
            }
        } else {
            echo "Erreur lors de l'exécution de la requête : " . $pdo->errorInfo();
        }
    } else {
        echo "Erreur lors de la préparation de la requête : " . $pdo->errorInfo();
    }
}
?>
