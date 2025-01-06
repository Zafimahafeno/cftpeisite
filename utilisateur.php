<?php
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

// Récupérer les utilisateurs depuis la base de données
try {
    $stmt = $pdo->query("SELECT id, nom, prenom, email FROM admin");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erreur lors de la récupération des utilisateurs : " . $e->getMessage());
}

// Ajouter, modifier ou supprimer un utilisateur
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['password'])) {
        if (isset($_POST['id']) && !empty($_POST['id'])) {  // Modification
            $stmt = $pdo->prepare("UPDATE admin SET nom = ?, prenom = ?, email = ?, motDePasse = ? WHERE id = ?");
            $stmt->execute([$_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['password'], $_POST['id']]);
        } else {  // Ajout
            $stmt = $pdo->prepare("INSERT INTO admin (nom, prenom, email, motDePasse) VALUES (?, ?, ?, ?)");
            $stmt->execute([$_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['password']]);
        }
        header("Location: utilisateur.php");
        exit;
    } elseif (isset($_POST['delete']) && !empty($_POST['delete'])) {  // Suppression
        $stmt = $pdo->prepare("DELETE FROM admin WHERE id = ?");
        $stmt->execute([$_POST['delete']]);
        header("Location: utilisateur.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>CFTPEI</title>

  <link href="img/logo.png" rel="icon">
  <link href="assets/css/style.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <style>
    #sidebar {
      width: 250px;
      position: fixed;
      height: 100%;
    }

    main.container {
      margin-left: 260px;
      padding-top: 20px;
    }

    @media (max-width: 768px) {
      #sidebar {
        width: 100%;
        position: relative;
      }

      main.container {
        margin-left: 0;
      }

      .search-bar {
        width: 100%;
      }

      .table-responsive {
        overflow-x: auto;
      }
    }
  </style>
</head>

<body>
  <!-- Header -->
  <header id="header" class="header fixed-top d-flex align-items-center">
    <div class="d-flex align-items-center justify-content-between">
      <a href="admin.php" class="logo d-flex align-items-center">
        <img src="img/logo.png" alt="">
        <span class="d-none d-lg-block">CFTPEI</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div>
  </header>

  <!-- Sidebar -->
  <aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
      <li class="nav-item">
        <a class="nav-link collapsed" href="admin.php">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="etudiant_inscrit.php">
          <i class="bi bi-grid"></i>
          <span>Etudiant inscrit</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="utilisateur.php">
          <i class="bi bi-grid"></i>
          <span>Utilisateur</span>
        </a>
      </li>
    </ul>
  </aside>

  <!-- Main Content -->
  <main class="container mt-6">
    <h1>Gestion des Utilisateurs</h1>

    <!-- Recherche -->
    <div class="mb-3">
      <input type="text" id="searchInput" class="form-control" placeholder="Rechercher un utilisateur...">
    </div>

    <!-- Ajouter -->
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#userModal">Ajouter un utilisateur</button>

    <!-- Tableau des utilisateurs -->
    <div class="table-responsive">
      <table class="table table-bordered" id="userTable">
        <thead>
          <tr>
            <th>Numéro</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Email</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($users as $user) : ?>
            <tr>
              <td><?= htmlspecialchars($user['id']) ?></td>
              <td><?= htmlspecialchars($user['nom']) ?></td>
              <td><?= htmlspecialchars($user['prenom']) ?></td>
              <td><?= htmlspecialchars($user['email']) ?></td>
              <td>
                <button class="btn btn-sm btn-danger delete-btn" data-id="<?= $user['id'] ?>" data-bs-toggle="modal" data-bs-target="#deleteModal">Supprimer</button>
                <button class="btn btn-sm btn-warning edit-btn" data-id="<?= $user['id'] ?>" data-nom="<?= $user['nom'] ?>" data-prenom="<?= $user['prenom'] ?>" data-email="<?= $user['email'] ?>" data-bs-toggle="modal" data-bs-target="#userModal">Modifier</button>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>

    <!-- Modal Ajouter / Modifier -->
    <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <form id="userForm" method="POST">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="userModalLabel">Ajouter un utilisateur</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <input type="hidden" id="userId" name="id">
              <div class="mb-3">
                <label for="userName" class="form-label">Nom</label>
                <input type="text" class="form-control" id="userName" name="nom" required>
              </div>
              <div class="mb-3">
                <label for="userPrenom" class="form-label">Prénom</label>
                <input type="text" class="form-control" id="userPrenom" name="prenom" required>
              </div>
              <div class="mb-3">
                <label for="userEmail" class="form-label">Email</label>
                <input type="email" class="form-control" id="userEmail" name="email" required>
              </div>
              <div class="mb-3">
                <label for="userPassword" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" id="userPassword" name="password" required>
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Enregistrer</button>
            </div>
          </div>
        </form>
      </div>
    </div>

    <!-- Modal Suppression -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <form id="deleteForm" method="POST">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="deleteModalLabel">Confirmer la suppression</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              Êtes-vous sûr de vouloir supprimer cet utilisateur ?
              <input type="hidden" id="deleteId" name="delete">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
              <button type="submit" class="btn btn-danger">Supprimer</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </main>

  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script>
    document.querySelectorAll('.delete-btn').forEach(button => {
      button.addEventListener('click', e => {
        const id = e.target.getAttribute('data-id');
        document.getElementById('deleteId').value = id;
      });
    });

    document.querySelectorAll('.edit-btn').forEach(button => {
      button.addEventListener('click', e => {
        document.getElementById('userId').value = e.target.getAttribute('data-id');
        document.getElementById('userName').value = e.target.getAttribute('data-nom');
        document.getElementById('userPrenom').value = e.target.getAttribute('data-prenom');
        document.getElementById('userEmail').value = e.target.getAttribute('data-email');
      });
    });
  </script>
</body>

</html>
