<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom_candidat = $_POST['nom_candidat'];
    $prenom_candidat = $_POST['prenom_candidat'];
    $diplome_candidat = $_POST['diplome_candidat'];
    $mail_candidat = $_POST['mail_candidat'];
    $password_candidat = password_hash($_POST['password_candidat'], PASSWORD_DEFAULT);
    $titre_candidat = $_POST['titre_candidat'];
    $type_compte = $_POST['type_compte'];
    $cv_candidat = $_FILES['cv_candidat'];
    $photo_candidat = $_FILES['photo_candidat'];

    // Gérer l'upload du CV
    $cv_target_dir = "uploads/";
    $cv_target_file = $cv_target_dir . basename($cv_candidat["name"]);
    $cv_uploadOk = 1;
    $cv_fileType = strtolower(pathinfo($cv_target_file, PATHINFO_EXTENSION));

    // Gérer l'upload de la photo
    $photo_target_dir = "uploads/";
    $photo_target_file = $photo_target_dir . basename($photo_candidat["name"]);
    $photo_uploadOk = 1;
    $photo_fileType = strtolower(pathinfo($photo_target_file, PATHINFO_EXTENSION));

    // Vérifier si les fichiers sont des fichiers réels
    $cv_check = mime_content_type($cv_candidat["tmp_name"]);
    if($cv_check != "application/pdf") {
        echo "Le fichier CV n'est pas un PDF valide.";
        $cv_uploadOk = 0;
    }

    $photo_check = getimagesize($photo_candidat["tmp_name"]);
    if($photo_check !== false) {
        $photo_uploadOk = 1;
    } else {
        echo "Le fichier Photo n'est pas une image.";
        $photo_uploadOk = 0;
    }

    // Vérifier la taille des fichiers
    if ($cv_candidat["size"] > 500000) {
        echo "Désolé, votre fichier CV est trop volumineux.";
        $cv_uploadOk = 0;
    }
// if ($photo_candidat["size"] > 500000) {
//         echo "Désolé, votre fichier Photo est trop volumineux.";
//         $photo_uploadOk = 0;
//     }

    
    // Autoriser certains formats de fichiers pour la photo
    $allowedPhotoExtensions = array("jpg", "jpeg", "png", "gif");
    if (!in_array($photo_fileType, $allowedPhotoExtensions)) {
        echo "Désolé, seuls les fichiers JPG, JPEG, PNG & GIF sont autorisés pour la photo.";
        $photo_uploadOk = 0;
    }

    // Vérifier si $cv_uploadOk et $photo_uploadOk sont à 0 en raison d'une erreur
    if ($cv_uploadOk == 0 || $photo_uploadOk == 0) {
        echo "Désolé, vos fichiers n'ont pas été téléchargés.";
    } else {
        // Déplacer les fichiers téléchargés vers le dossier de destination
        if (move_uploaded_file($cv_candidat["tmp_name"], $cv_target_file) && move_uploaded_file($photo_candidat["tmp_name"], $photo_target_file)) {
            // Insérer les données dans la base de données
            $sql = "INSERT INTO candidat (nom_candidat, prenom_candidat, diplome_candidat, mail_candidat, password_candidat, titre_candidat, cv_candidat, photo_candidat, type_compte)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

            $stmt = $conn->prepare($sql);

            // Vérifier la préparation de la requête
            if (!$stmt) {
                echo "Erreur de préparation de la requête: " . $conn->error;
            } else {
                // Liaison des paramètres
                $stmt->bind_param("sssssssss", $nom_candidat, $prenom_candidat, $diplome_candidat, $mail_candidat, $password_candidat, $titre_candidat, $cv_target_file, $photo_target_file, $type_compte);

                // Exécution de la requête
                if ($stmt->execute()) {
                    header("Location: succes.php");
                    exit();
                } else {
                    echo "Erreur lors de l'enregistrement: " . $stmt->error;
                }
            }

            // Fermer la déclaration préparée
            $stmt->close();
        } else {
            echo "Désolé, une erreur s'est produite lors du téléchargement de vos fichiers.";
        }
    }
}

$conn->close();
?>
