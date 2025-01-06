<?php
session_start();
if (isset($_SESSION['message'])) {
    $type = $_SESSION['message_type'] ?? 'info';
    echo "<div class='alert alert-$type'>{$_SESSION['message']}</div>";
    unset($_SESSION['message']);
    unset($_SESSION['message_type']);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CFTPEI</title>

  <!-- Favicon -->
  <link href="img/logo.png" rel="icon">

  <!-- Google Web Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&display=swap" rel="stylesheet">

  <!-- Icon Font Stylesheet -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

  <!-- Libraries Stylesheet -->
  <link href="lib/animate/animate.min.css" rel="stylesheet">
  <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

  <!-- Customized Bootstrap Stylesheet -->
  <link href="css/bootstrap.min.css" rel="stylesheet">

  <!-- Template Stylesheet -->
  <link href="css/style.css" rel="stylesheet">


  <style>
       /* Effet Glassmorphisme */
.form-container {
    max-width: 600px;
    margin: 50px auto;
    padding: 20px;
    background: rgba(7, 116, 206, 0.8);
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    backdrop-filter: blur(10px);
    border-radius: 12px;
    border: 1px solid rgba(255, 255, 255, 0.4);
    animation: fadeIn 1s ease-in-out;
}

/* Animation pour l'apparition */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Titre animé */
.form-container h2 {
    text-align: center;
    margin-bottom: 20px;
    color: #333;
    background: linear-gradient(90deg,rgb(53, 113, 218), #2575fc);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    animation: gradientMove 3s infinite linear;
}

/* Animation gradient mouvant */
@keyframes gradientMove {
    0% { background-position: 0%; }
    100% { background-position: 100%; }
}

/* Champs de formulaire */
.form-group input,
.form-group select {
    width: 100%;
    padding: 10px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 4px;
    background: rgba(255, 255, 255, 0.6);
    backdrop-filter: blur(5px);
    transition: border-color 0.3s ease, transform 0.3s ease;
}

.form-group input:focus,
.form-group select:focus {
    border-color: #6a11cb;
    outline: none;
    transform: scale(1.02);
}

/* Bouton animé */
.submit-btn {
    width: 100%;
    padding: 12px;
    font-size: 16px;
    color: #fff;
    background: linear-gradient(90deg, #6a11cb, #2575fc);
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: transform 0.3s ease, background 0.3s ease;
}

.submit-btn:hover {
    background: linear-gradient(90deg, #2575fc, #6a11cb);
    transform: translateY(-2px);
}

/* Animation responsive */
@media (max-width: 768px) {
    .form-container {
        padding: 15px;
    }

    .form-group input,
    .submit-btn {
        font-size: 14px;
    }
}



    </style>
</head>
<body>
  <!-- Spinner Start -->
  <!-- <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
    <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
        <span class="sr-only">Loading...</span>
    </div>
  </div> -->
  <!-- Spinner End -->


  <!-- Navbar Start -->
  <nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
    <a href="index.html" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
        <img src="img/logo.png" alt="Logo eLearning" style="max-height: 50px;">
    </a>

    <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto p-4 p-lg-0">
            <a href="index.html" class="nav-item nav-link ">Accueil</a>
            <a href="about.html" class="nav-item nav-link">A propos</a>
            <a href="courses.html" class="nav-item nav-link">Nos cours</a>
            <a href="admission.html" class="nav-item nav-link ">Coût et admission</a>
            <a href="contact.html" class="nav-item nav-link">Contact</a>
        </div>
        <a href="https://buildplateformcftpei2.vercel.app" class="btn btn-primary py-4 px-lg-5 d-none d-lg-block">Commencez votre apprentissage<i class="fa fa-arrow-right ms-3"></i></a>
    </div>
  </nav>
  <!-- Navbar End -->

  <!-- Header Start -->
  <div class="container-fluid bg-primary py-5 mb-5 page-header-dts">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10 text-center">
                <h1 class="text-white animated slideInDown">Validez votre inscription</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center">
                        <!-- <li class="breadcrumb-item"><a class="text-white" href="#">aCCUEIL</a></li>
                        <li class="breadcrumb-item"><a class="text-white" href="#">Pages</a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page">About</li> -->
                    </ol>
                </nav>
            </div>
        </div>
    </div>
  </div>
  
  <!-- Header End -->
  <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">formulaire d'inscription</h6>
                <h1 class="mb-5">Vous pouvez procéder à remplir le formulaire ci-dessous pour valider votre inscription en ligne</h1>
  </div>
  <div class="container-fluid min-vh-100 d-flex align-items-center justify-content-center">
    
    <div class="row w-100 shadow-lg rounded" style="max-width: 1000px; background-color: #112031;">

        <!-- Section Gauche -->
        <div class="col-md-6 d-flex align-items-center p-5 text-white" style="background-color: #06BBCC;">
            <div>
                <img src="img/inscription.png" class="img-fluid rounded" alt="Image Placeholder">
            </div>
        </div>

        <!-- Section Droite -->
        <div class="col-md-6 p-5 text-white">
            
            <form action="uploads.php" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nom">Nom</label>
                        <input type="text" id="nom" name="nom" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="prenom">Prénom</label>
                        <input type="text" id="prenom" name="prenom" class="form-control" required>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="date_naissance">Date de naissance</label>
                        <input type="date" id="date_naissance" name="date_naissance" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="lieu_naissance">Lieu de naissance</label>
                        <input type="text" id="lieu_naissance" name="lieu_naissance" class="form-control" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="ville_origin">Ville d'origine</label>
                        <input type="text" id="ville_origin" name="ville_origin" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="mail">Email</label>
                        <input type="email" id="mail" name="mail" class="form-control" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="contact">Contact</label>
                        <input type="text" id="contact" name="contact" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="cin">CIN</label>
                        <input type="text" id="cin" name="cin" class="form-control" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Sexe</label>
                        <div>
                            <label class="mr-2">
                                <input type="radio" name="sexe" value="Homme" required> Homme
                            </label>
                            <label>
                                <input type="radio" name="sexe" value="Femme" required> Femme
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="situation">Situation matrimoniale</label>
                        <select id="situation" name="situation" class="form-control" required>
                            <option value="">-- Sélectionnez --</option>
                            <option value="Célibataire">Célibataire</option>
                            <option value="Marié(e)">Marié(e)</option>
                            <option value="Divorcé(e)">Divorcé(e)</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="loisir">Loisirs</label>
                        <input type="text" id="loisir" name="loisir" class="form-control">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="cv">Télécharger le CV</label>
                        <input type="file" id="cv" name="cv" class="form-control-file" accept=".pdf,.doc,.docx">
                    </div>
                </div>

                <div class="row">
               <div class="col-12 col-md-12">
                <button type="submit" class="btn btn-primary w-100">S'inscrire</button>
              </div>
</div>



            </form>
        </div>
    </div>
</div>




<!-- Alertes dynamiques -->
<script>
    // Fonction pour récupérer les paramètres GET de l'URL
    function getQueryParam(param) {
        const urlParams = new URLSearchParams(window.location.search);
        return urlParams.get(param);
    }

    // Vérifier si un statut existe dans l'URL et afficher une alerte
    document.addEventListener("DOMContentLoaded", function() {
        const status = getQueryParam('status');
        
        if (status === 'success') {
            alert('Inscription réussie ! Votre formulaire a bien été enregistré.');
        } else if (status === 'error') {
            alert('Erreur lors de l\'inscription. Veuillez réessayer.');
        }
    });
</script>


  <!-- Footer Start -->
  <div class="container-fluid bg-dark text-light footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container py-5">
        <div class="row g-5">
            
            <div class="col-lg-3 col-md-6">
                <h4 class="text-white mb-3">Contact</h4>
                <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>Ampopoka Golf, Fianarantsoa, Madagascar</p>
                <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+261 34 55 967 96</p>
                <p class="mb-2"><i class="fa fa-envelope me-3"></i>andryrb6@gmail.com</p>
                <div class="d-flex pt-2">
                    <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-twitter"></i></a>
                    <a class="btn btn-outline-light btn-social" href="https://www.facebook.com/profile.php?id=61565917521613" target="_blank"><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-youtube"></i></a>
                    <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <h4 class="text-white mb-3">Galerie</h4>
                <div class="row g-2 pt-2">
                    <div class="col-4">
                        <img class="img-fluid bg-light p-1" src="img/course-1.jpg" alt="">
                    </div>
                    <div class="col-4">
                        <img class="img-fluid bg-light p-1" src="img/course-2.jpg" alt="">
                    </div>
                    <div class="col-4">
                        <img class="img-fluid bg-light p-1" src="img/course-3.jpg" alt="">
                    </div>
                    <div class="col-4">
                        <img class="img-fluid bg-light p-1" src="img/course-2.jpg" alt="">
                    </div>
                    <div class="col-4">
                        <img class="img-fluid bg-light p-1" src="img/course-3.jpg" alt="">
                    </div>
                    <div class="col-4">
                        <img class="img-fluid bg-light p-1" src="img/course-1.jpg" alt="">
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    <div class="container">
        <div class="copyright">
            <div class="row">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    &copy; <a class="border-bottom" href="#">CFTPEI ||</a>, Tous droits réservés.

                    <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                    Dévéloppé par  <a class="border-bottom">Origami Tech</a>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <div class="footer-menu">
                        <a href="index.html">Accueil</a>
                        <a href="about.html">A propos</a>
                        <a href="courses.html">Nos Cours</a>
                        <a href="contact.html">Contact</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
  <!-- Footer End -->


  <!-- Back to Top -->
  <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>


  <!-- JavaScript Libraries -->
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="lib/wow/wow.min.js"></script>
  <script src="lib/easing/easing.min.js"></script>
  <script src="lib/waypoints/waypoints.min.js"></script>
  <script src="lib/owlcarousel/owl.carousel.min.js"></script>

  <!-- Template Javascript -->
  <script src="js/main.js"></script>
</body>
</html>