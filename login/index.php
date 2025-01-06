<!doctype html>
<html lang="en">

<head>
  <title>CFTPEI - Connexion</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="css/style.css">
</head>

<body class="img js-fullheight" style="background-image: url(images/bcblue.jpg);">
  <section class="ftco-section">
    <div class="container" style="margin-top: -45px;">
      <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4">
          <div class="login-wrap p-0">
            <h3 class="mb-4 text-center">Connectez-vous</h3>

            <!-- Affichage des erreurs -->
            <?php if (isset($_GET['error'])): ?>
              <div class="alert alert-danger text-center">
                <?php
                  if ($_GET['error'] == 'missing_fields') {
                    echo "Veuillez remplir tous les champs.";
                  } elseif ($_GET['error'] == 'password') {
                    echo "Le mot de passe est incorrect.";
                  } elseif ($_GET['error'] == 'email') {
                    echo "Aucun utilisateur trouvé avec cet email.";
                  }
                ?>
              </div>
            <?php endif; ?>

            <!-- Formulaire de connexion -->
            <form action="login_back.php" method="POST" class="signin-form">
              <div class="form-group">
                <input type="email" class="form-control" placeholder="Adresse email" required name="email">
              </div>
              <div class="form-group">
                <input id="motDePasse" type="password" class="form-control" placeholder="Mot de passe" required name="motDePasse">
                <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
              </div>
              <div class="form-group">
                <button type="submit" class="form-control btn btn-primary submit px-3">Se connecter</button>
              </div>
            </form>

            <!-- Autres options -->
            <div class="form-group d-md-flex">
              <div class="w-50">
                <label class="checkbox-wrap checkbox-primary">Se souvenir de moi
                  <input type="checkbox">
                  <span class="checkmark"></span>
                </label>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </section>

  <script src="js/jquery.min.js"></script>
  <script src="js/popper.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>
</body>

</html>
