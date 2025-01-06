<?php
session_start();

// Connexion à la base de données
$host = 'localhost';
$db = 'mahafeno_cftpei';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("<div class='alert alert-danger text-center'>Erreur de connexion : " . $e->getMessage() . "</div>");
}

$errorMessage = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (!empty($email) && !empty($password)) {
        // Vérifier si l'utilisateur existe dans la base de données
        $stmt = $pdo->prepare("SELECT * FROM admins WHERE email = ?");
        $stmt->execute([$email]);
        $admin = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($admin) {
            if (password_verify($password, $admin['password'])) {
                // Authentification réussie
                $_SESSION['admin_id'] = $admin['id'];
                $_SESSION['admin_nom'] = $admin['nom'];

                header("Location: admin.php");
                exit();
            } else {
                // Mot de passe incorrect
                $errorMessage = "Mot de passe incorrect.";
            }
        } else {
            // Utilisateur non trouvé
            $errorMessage = "Aucun utilisateur trouvé avec cet email.";
        }
    } else {
        $errorMessage = "Tous les champs doivent être remplis.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion Admin</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background: url('img/') no-repeat center center fixed;
            background-size: cover;
            color: #ffffff;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            max-width: 400px;
            width: 100%;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.8);
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            padding: 40px;
        }

        .login-card h3 {
            font-weight: 700;
            margin-bottom: 30px;
            text-align: center;
        }

        .form-control {
            border-radius: 10px;
            border: 1px solid #ccc;
            margin-bottom: 15px;
            padding: 10px;
        }

        .form-control:focus {
            border-color: #007bff;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            border-radius: 10px;
            padding: 12px;
            width: 100%;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .alert {
            margin-top: 15px;
            text-align: center;
        }

        .login-card .form-group:last-child {
            margin-bottom: 0;
        }

        /* Responsive adjustments */
        @media (max-width: 576px) {
            .login-card {
                padding: 25px;
            }

            .login-card h3 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="login-card">
            <h3>Connexion Admin</h3>
            <form action="login.php" method="POST">
                <div class="form-group">
                    <label for="email">Adresse Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Entrez votre email" required>
                </div>
                <div class="form-group">
                    <label for="password">Mot de Passe</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Entrez votre mot de passe" required>
                </div>
                <button type="submit" class="btn btn-primary">Se Connecter</button>
            </form>

            <?php if (!empty($errorMessage)) : ?>
                <div class="alert alert-danger mt-3">
                    <?= htmlspecialchars($errorMessage) ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
