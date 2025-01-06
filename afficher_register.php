<?php
session_start();
require 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $date_naissance = $_POST['date_naissance'];
    $lieu_naissance = $_POST['lieu_naissance'];
    $ville_origin = $_POST['ville_origin'];
    $email = $_POST['mail'];
    $contact = $_POST['contact'];
    $cin = $_POST['cin'];
    $situation = $_POST['situation'];
    $sexe = $_POST['sexe'];
    $loisir = $_POST['loisir'];
    $cv = $_POST['cv'];

    $sql = "SELECT * FROM register ";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bindParam(':email', $email);

        if ($stmt->execute()) {
            if ($stmt->rowCount() == 1) {
                $stmt->bindColumn(1, $id);
                $stmt->bindColumn(2, $hashed_password);
                $stmt->bindColumn(3, $prenom);
                $stmt->bindColumn(4, $email);
                $stmt->fetch(PDO::FETCH_BOUND);

                if (password_verify($motDePasse, $hashed_password)) {
                    $_SESSION["loggedin"] = true;
                    $_SESSION["id"] = $id;
                    $_SESSION["prenom"] = $prenom;
                    $_SESSION["email"] = $email;

                    header("Location: ../admin/index.php");
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
            echo "Erreur lors de l'exécution de la requête: " . implode(" ", $stmt->errorInfo());
        }
    } else {
        echo "Erreur lors de la préparation de la requête: " . implode(" ", $conn->errorInfo());
    }

    $conn = null;
}
?>
