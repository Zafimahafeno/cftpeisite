<?php
 session_start();
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

// Récupérer les données du formulaire
$nom = htmlspecialchars($_POST['nom'] ?? null);
$prenom = htmlspecialchars($_POST['prenom'] ?? null);
$date_naissance = htmlspecialchars($_POST['date_naissance'] ?? null);
$lieu_naissance = htmlspecialchars($_POST['lieu_naissance'] ?? null);
$mail = filter_var($_POST['mail'] ?? null, FILTER_VALIDATE_EMAIL);
$ville_origin = htmlspecialchars($_POST['ville_origin'] ?? null);
$contact = htmlspecialchars($_POST['contact'] ?? null);
$cin = htmlspecialchars($_POST['cin'] ?? null);
$situation = htmlspecialchars($_POST['situation'] ?? null);
$sexe = htmlspecialchars($_POST['sexe'] ?? null);
$loisir = htmlspecialchars($_POST['loisir'] ?? null);

// Vérification de la méthode et de la présence d'un fichier
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['cv'])) {
    $uploadDir = __DIR__ . '/uploads/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true); // Créer le dossier s'il n'existe pas
    }

    // Validation du fichier uploadé
    $allowedTypes = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
    $fileType = mime_content_type($_FILES['cv']['tmp_name']);
    $filename = uniqid() . "_" . basename($_FILES['cv']['name']);
    $cheminPhoto = $uploadDir . $filename;

    if (in_array($fileType, $allowedTypes)) {
        if (move_uploaded_file($_FILES['cv']['tmp_name'], $cheminPhoto)) {
            // Enregistrer le fichier dans la base de données
            try {
                $stmt = $pdo->prepare("INSERT INTO register (nom_register, prenom_register, date_naissance, lieu_naissance, mail_register, ville_origine, contact_register, cin_register, situation_register, sexe_register, loisir_register, cv_register, date_inscription)
                    VALUES (:nom, :prenom, :date_naissance, :lieu_naissance, :mail, :ville_origin, :contact, :cin, :situation, :sexe, :loisir, :cv, NOW())");

                $stmt->execute([
                    ':nom' => $nom,
                    ':prenom' => $prenom,
                    ':date_naissance' => $date_naissance,
                    ':lieu_naissance' => $lieu_naissance,
                    ':mail' => $mail,
                    ':ville_origin' => $ville_origin,
                    ':contact' => $contact,
                    ':cin' => $cin,
                    ':situation' => $situation,
                    ':sexe' => $sexe,
                    ':loisir' => $loisir,
                    ':cv' => $filename,
                ]);

                $_SESSION['message'] = "Fichier uploadé et données enregistrées avec succès.";
                $_SESSION['message_type'] = "success";
            } catch (PDOException $e) {
                $_SESSION['message'] = "Erreur lors de l'enregistrement des données : " . $e->getMessage();
                $_SESSION['message_type'] = "error";
            }
        } else {
            $_SESSION['message'] = "Erreur lors de l'upload du fichier.";
            $_SESSION['message_type'] = "error";
        }
    } else {
        $_SESSION['message'] = "Type de fichier non autorisé. Seuls les fichiers PDF, DOC, et DOCX sont acceptés.";
        $_SESSION['message_type'] = "error";
    }

    // Redirection vers register.php
    header("Location: register.php");
    exit;
}
?>
