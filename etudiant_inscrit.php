<?php
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

// Variables pour les messages
$message = '';
$messageType = 'success';

// Gestion des actions
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (isset($_POST['action'])) {
    $action = $_POST['action'];
    if ($action == 'add') {
      // Validation des champs
      if (!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['email']) && !empty($_POST['contact'])) {
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $email = $_POST['email'];
        $contact = $_POST['contact'];

        try {
          $stmt = $pdo->prepare("INSERT INTO register (nom, prenom, email, contact) VALUES (?, ?, ?, ?)");
          $stmt->execute([$nom, $prenom, $email, $contact]);
          $message = "Étudiant ajouté avec succès !";
          $messageType = 'success';
        } catch (Exception $e) {
          $message = "Erreur lors de l'ajout de l'étudiant : " . $e->getMessage();
          $messageType = 'danger';
        }
      } else {
        $message = "Tous les champs sont obligatoires.";
        $messageType = 'danger';
      }
    } elseif ($action == 'delete') {
      $id = $_POST['id_register'];
      try {
        $stmt = $pdo->prepare("DELETE FROM register WHERE id_register = ?");
        $stmt->execute([$id]);
        $message = "Étudiant supprimé avec succès !";
        $messageType = 'success';
      } catch (Exception $e) {
        $message = "Erreur lors de la suppression : " . $e->getMessage();
        $messageType = 'danger';
      }
    }
  }
}

// Télechargement cv

// Récupération des notifications récentes (étudiants inscrits récemment)
$notifications = $pdo->query("SELECT nom_register, prenom_register, date_inscription FROM register ORDER BY date_inscription DESC LIMIT 5")->fetchAll(PDO::FETCH_ASSOC);



// Récupération des étudiants
$etudiants = $pdo->query("SELECT nom_register,prenom_register,cv_register FROM register")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>CFTPEI</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="img/logo.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link
    href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
    rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <style>
    @media (max-width: 768px) {
      datatable {
        font-size: 14px;
      }

      table th,
      table td {
        display: block;
        width: 100%;
      }

      th,
      td {
        padding: 8px;
      }

      /* Empêcher le contenu du tableau de déborder */
      table,
      th,
      td {
        display: block;
        width: 100%;
      }
    }
  </style>
  <!-- =======================================================
  * Template Name: NiceAdmin
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Updated: Apr 20 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

<div class="d-flex align-items-center justify-content-between">
  <a href="admin.html" class="logo d-flex align-items-center">
    <img src="img/logo.png" alt="">
    <span class="d-none d-lg-block">CFTPEI</span>
  </a>
  <i class="bi bi-list toggle-sidebar-btn"></i>
</div><!-- End Logo -->

<div class="search-bar">
  <form class="search-form d-flex align-items-center" method="POST" action="#">
    <input type="text" name="query" placeholder="Search" title="Enter search keyword">
    <button type="submit" title="Search"><i class="bi bi-search"></i></button>
  </form>
</div><!-- End Search Bar -->

<nav class="header-nav ms-auto">
  <ul class="d-flex align-items-center">

    <!-- Search Icon (Mobile) -->
    <li class="nav-item d-block d-lg-none">
      <a class="nav-link nav-icon search-bar-toggle" href="#">
        <i class="bi bi-search"></i>
      </a>
    </li><!-- End Search Icon-->

    <!-- Notifications Dropdown -->
    <li class="nav-item dropdown">
      <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
        <i class="bi bi-bell"></i>
        <span class="badge bg-primary badge-number"><?= count($notifications) ?></span>
      </a><!-- End Notification Icon -->
      <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
        <li class="dropdown-header">
          Vous avez <?= count($notifications) ?> nouvelle(s) inscription(s)
          <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">Voir tout</span></a>
        </li>
        <li><hr class="dropdown-divider"></li>
        <?php foreach ($notifications as $notification): ?>
            <li class="notification-item">
                <i class="bi bi-person-plus text-success"></i>
                <div>
                    <h4><?= htmlspecialchars($notification['nom_register'] . ' ' . $notification['prenom_register']) ?></h4>
                    <p>Inscrit le <?= date('d/m/Y', strtotime($notification['date_inscription'])) ?></p>
                </div>
            </li>
            <li><hr class="dropdown-divider"></li>
        <?php endforeach; ?>
        <li class="dropdown-footer">
            <a href="#">Afficher toutes les notifications</a>
        </li>
      </ul><!-- End Notification Dropdown Items -->
    </li><!-- End Notification Nav -->

    <!-- Messages Dropdown (optional) -->
    <!-- Uncomment if you want to include a message dropdown
    <li class="nav-item dropdown">
      <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
        <i class="bi bi-chat-left-text"></i>
        <span class="badge bg-primary badge-number">3</span>
      </a><!-- End Message Icon -->
      <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
        <li class="dropdown-header">
          Vous avez 3 nouveaux messages
          <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">Voir tout</span></a>
        </li>
        <li><hr class="dropdown-divider"></li>
        <li class="message-item">
          <a href="#">
            <div>
              <h4>John Doe</h4>
              <p>Comment allez-vous ?</p>
            </div>
          </a>
        </li>
        <li><hr class="dropdown-divider"></li>
        <li class="dropdown-footer">
          <a href="#">Afficher tous les messages</a>
        </li>
      </ul><!-- End Message Dropdown Items -->
    </li><!-- End Messages Nav -->

    <!-- Profile Dropdown -->
    <li class="nav-item dropdown pe-3">
      <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
        <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
        <span class="d-none d-md-block dropdown-toggle ps-2">K. Anderson</span>
      </a><!-- End Profile Image Icon -->

      <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
        <li class="dropdown-header">
          <h6>Kevin Anderson</h6>
          <span>Web Designer</span>
        </li>
        <li><hr class="dropdown-divider"></li>

        <li>
          <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
            <i class="bi bi-person"></i>
            <span>Mon Profil</span>
          </a>
        </li>
        <li><hr class="dropdown-divider"></li>

        <li>
          <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
            <i class="bi bi-gear"></i>
            <span>Paramètres du compte</span>
          </a>
        </li>
        <li><hr class="dropdown-divider"></li>

        <li>
          <a class="dropdown-item d-flex align-items-center" href="pages-faq.html">
            <i class="bi bi-question-circle"></i>
            <span>Besoin d'aide ?</span>
          </a>
        </li>
        <li><hr class="dropdown-divider"></li>

        <li>
          <a class="dropdown-item d-flex align-items-center" href="#">
            <i class="bi bi-box-arrow-right"></i>
            <span>Se déconnecter</span>
          </a>
        </li>

      </ul><!-- End Profile Dropdown Items -->
    </li><!-- End Profile Nav -->

  </ul>
</nav><!-- End Icons Navigation -->

</header><!-- End Header -->


  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link collapsed" href="admin.php">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->
      <li class="nav-item">
        <a class="nav-link " data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-layout-text-window-reverse"></i><span>Etudiant inscrit</span><i
            class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="tables-nav" class="nav-content collapse show" data-bs-parent="#sidebar-nav">

          <li>
            <a href="etudiant_inscrit.php" class="active">
              <i class="bi bi-circle"></i><span>Listes</span>
            </a>
          </li>
        </ul>
      </li><!-- End Tables Nav -->




    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Etudiant inscrit</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="admin.php">Home</a></li>
          <li class="breadcrumb-item">Etudiant inscrit</li>
          <li class="breadcrumb-item active">Listes</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">


              <!-- Search bar -->
              <div class="mb-3">
                <input type="text" id="searchInput" class="form-control"
                  placeholder="Rechercher un étudiant par nom ou prénom...">
              </div>

              <!-- Modern Table -->
              <div class="table-responsive">
                <table id="studentTable" class="table table-hover align-middle">
                  <thead>
                    <tr>
                      <th>Nom</th>
                      <th>Prénom</th>
                      <th>CV</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($etudiants as $file): ?>
                      <tr>
                        <td><?= htmlspecialchars($file['nom_register']) ?></td>
                        <td><?= htmlspecialchars($file['prenom_register']) ?></td>
                        <td><?= htmlspecialchars(basename($file['cv_register'])) ?></td>
                        <td>
                          <a href="download.php?file=<?= urlencode($file['cv_register']) ?>"
                            class="btn btn-outline-success btn-sm">Télécharger CV</a>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
              <!-- End Modern Table -->

            </div>
          </div>

        </div>
      </div>
    </section>


    <!-- Script for search functionality -->
    <script>
      document.getElementById('searchInput').addEventListener('input', function () {
        const filter = this.value.toLowerCase();
        const rows = document.querySelectorAll('#studentTable tbody tr');

        rows.forEach(row => {
          const cells = row.querySelectorAll('td');
          const match = Array.from(cells).some(cell => cell.textContent.toLowerCase().includes(filter));
          row.style.display = match ? '' : 'none';
        });
      });
    </script>


  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>CFTPEI</span></strong>.Tous droits réservés
    </div>
    <div class="credits">
      <!-- All the links in the footer should remain intact. -->
      <!-- You can delete the links only if you purchased the pro version. -->
      <!-- Licensing information: https://bootstrapmade.com/license/ -->
      <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
      Designer par <a href="">Origami Tech</a>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>