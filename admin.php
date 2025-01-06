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

// Total Etudiants inscrits
$query = $pdo->query("SELECT COUNT(*) AS totalUsers FROM register");
$result = $query->fetch(PDO::FETCH_ASSOC);
$totalUsers = $result['totalUsers']; // Remarque : Utilisation de 'totalUsers' ici

// Total cours
$query = $pdo->query("SELECT COUNT(*) AS total_cours FROM cours");
$result = $query->fetch(PDO::FETCH_ASSOC);
$totalCours = $result['total_cours'];

// Récupérer les notifications depuis la table register
$sql = "SELECT * FROM register ORDER BY date_inscription DESC LIMIT 5";  // Limite à 5 notifications
$stmt = $pdo->query($sql);
$notifications = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Compter le nombre de notifications
$totalNotifications = count($notifications);

// Requête SQL pour regrouper les inscriptions par mois
$query = $pdo->query("
    SELECT MONTH(date_inscription) AS mois, COUNT(*) AS nombre
    FROM register
    GROUP BY MONTH(date_inscription)
    ORDER BY mois
");
$etudiantsParMois = $query->fetchAll(PDO::FETCH_ASSOC);

// Préparer les données pour le graphique
$mois = [];
$nombreInscriptions = [];

foreach ($etudiantsParMois as $row) {
  $moisInt = (int) $row['mois']; // S'assurer que le mois est un entier
  if ($moisInt > 0 && $moisInt <= 12) {
    $moisNom = DateTime::createFromFormat('!m', $moisInt);
    if ($moisNom !== false) {
      $mois[] = $moisNom->format('F'); // Convertir le mois en texte
    } else {
      $mois[] = "Inconnu"; // Si erreur dans la conversion
    }
  } else {
    $mois[] = "Invalide"; // Mois hors de l'intervalle 1-12
  }
  $nombreInscriptions[] = $row['nombre'];
}

// Convertir en JSON pour JavaScript
$moisJson = json_encode($mois);
$nombreInscriptionsJson = json_encode($nombreInscriptions);

// Fermer la connexion
$stmt = null;
$pdo = null;
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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">


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
            <li>
              <hr class="dropdown-divider">
            </li>
            <?php foreach ($notifications as $notification): ?>
              <li class="notification-item">
                <i class="bi bi-person-plus text-success"></i>
                <div>
                  <h4><?= htmlspecialchars($notification['nom_register'] . ' ' . $notification['prenom_register']) ?></h4>
                  <p>Inscrit le <?= date('d/m/Y', strtotime($notification['date_inscription'])) ?></p>
                </div>
              </li>
              <li>
                <hr class="dropdown-divider">
              </li>
            <?php endforeach; ?>
            <li class="dropdown-footer">
              <a href="#">Afficher toutes les notifications</a>
            </li>
          </ul><!-- End Notification Dropdown Items -->
        </li><!-- End Notification Nav -->

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
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                <i class="bi bi-person"></i>
                <span>Mon Profil</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                <i class="bi bi-gear"></i>
                <span>Paramètres du compte</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="pages-faq.html">
                <i class="bi bi-question-circle"></i>
                <span>Besoin d'aide ?</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

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
        <a class="nav-link " href="admin.php">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-layout-text-window-reverse"></i><span>Etudiant inscrit</span><i
            class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">

          <li>
            <a href="etudiant_inscrit.php">
              <i class="bi bi-circle"></i><span>Listes</span>
            </a>
          </li>
        </ul>
      </li><!-- End Tables Nav -->



    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="admin.php">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">
        <!-- Sales Card -->
        <div class="col-md-4">
          <div class="card info-card sales-card">
            <div class="filter">
              <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
              <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <li class="dropdown-header text-start">
                  <h6>Filtre</h6>
                </li>
                <li><a class="dropdown-item" href="#">Aujourd'hui</a></li>
                <li><a class="dropdown-item" href="#">Mois</a></li>
                <li><a class="dropdown-item" href="#">Année</a></li>
              </ul>
            </div>
            <div class="card-body">
              <h5 class="card-title">Nombres des etudiants <span>|</span></h5>
              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-people"></i>
                </div>
                <div class="ps-3">
                  <h6><?= $totalUsers ?></h6>

                </div>
              </div>
            </div>
          </div>
        </div><!-- End Sales Card -->

        <!-- Revenue Card -->
        <div class="col-md-4">
          <div class="card info-card revenue-card">
            <div class="filter">
              <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
              <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <li class="dropdown-header text-start">
                  <h6>Filtre</h6>
                </li>
                <li><a class="dropdown-item" href="#">Aujourd'hui</a></li>
                <li><a class="dropdown-item" href="#">Mois</a></li>
                <li><a class="dropdown-item" href="#">Année</a></li>
              </ul>
            </div>
            <div class="card-body">
              <h5 class="card-title">Total cours <span>| </span></h5>
              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-book"></i>
                </div>
                <div class="ps-3">
                  <h6><?= $totalCours ?></h6>

                </div>
              </div>
            </div>
          </div>
        </div><!-- End Revenue Card -->

        <!-- Customers Card -->
        <div class="col-md-4">
          <div class="card info-card customers-card">
            <div class="filter">
              <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
              <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <li class="dropdown-header text-start">
                  <h6>Filtre</h6>
                </li>
                <li><a class="dropdown-item" href="#">Today</a></li>
                <li><a class="dropdown-item" href="#">This Month</a></li>
                <li><a class="dropdown-item" href="#">This Year</a></li>
              </ul>
            </div>
            <div class="card-body">
              <h5 class="card-title">Revenue <span>| </span></h5>
              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-people"></i>
                </div>
                <div class="ps-3">
                  <h6>1244</h6>

                </div>
              </div>
            </div>
          </div>
        </div><!-- End Customers Card -->



        <!-- Reports -->
        <div class="col-12">
          <div class="card">

            <div class="filter">
              <label for="statsFilter">Filtrer par :</label>
              <select id="statsFilter">
                <option value="jour">Jour</option>
                <option value="mois" selected>Mois</option>
                <option value="annee">Année</option>
              </select>
            </div>

            <div class="card-body">
              <h5 class="card-title">Rapports </h5>

              <!-- Line Chart -->
              <div id="reportsChart"></div>

              <script>
                document.addEventListener("DOMContentLoaded", () => {
                  const filterSelect = document.getElementById("statsFilter");
                  const chartElement = document.querySelector("#reportsChart");
                  let chart;

                  function fetchAndRenderData(filterType) {
                    fetch(`stats.php?type=${filterType}`)
                      .then(response => response.json())
                      .then(data => {
                        const categories = data.map(item => item.periode);
                        const values = data.map(item => item.nombre);

                        if (chart) {
                          chart.updateOptions({
                            xaxis: { categories },
                            series: [{ name: "Nombre d'étudiants", data: values }]
                          });
                        } else {
                          chart = new ApexCharts(chartElement, {
                            series: [{ name: "Nombre d'étudiants", data: values }],
                            chart: { height: 350, type: "bar" },
                            xaxis: { categories, title: { text: "Période" } },
                            yaxis: { title: { text: "Nombre d'étudiants" } }
                          });
                          chart.render();
                        }
                      })
                      .catch(error => console.error("Erreur lors de la récupération des données :", error));
                  }

                  // Charger les données par défaut (mois)
                  fetchAndRenderData("mois");

                  // Mettre à jour les données en fonction du filtre sélectionné
                  filterSelect.addEventListener("change", (event) => {
                    fetchAndRenderData(event.target.value);
                  });
                });
              </script>


              <!-- End Line Chart -->

            </div>

          </div>
        </div><!-- End Reports -->
      </div>
      </div><!-- End Left side columns -->


  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>CFTPEI</span></strong>. Tous droits réservés
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