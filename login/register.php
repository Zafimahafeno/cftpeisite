<!doctype html>
<html lang="en">
  <head>
    <title>Créer un compte</title>
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
              <h3 class="mb-4 text-center">Veuillez remplir les champs</h3>
              <form action="register_back.php" method="post" enctype="multipart/form-data" class="signin-form">
                <div class="form-group">
                  <input type="text" class="form-control" placeholder="Nom" required name="nom">
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" placeholder="Prénom" required name="prenom">
                </div>
                
                
                
                <style>
                  .form-control option {
                    background-color: #000000;
                    color: #ffffff;
                  }
                </style>
                <div class="form-group">
                  <input id="mail_employeur-field" type="email" class="form-control" placeholder="Mail" required name="email">
                </div>
                <div class="form-group">
                  <input id="password-field" type="password" class="form-control" placeholder="Mot de passe" required name="motDePasse">
                  <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                </div>
                
	            <div class="form-group">
	            	<button type="submit" class="form-control btn btn-primary submit px-3">Valider</button>
	            </div>
              <p class="w-100 text-center">&mdash; Vous avez déjà un compte ? &mdash;</p>
	          <div class="social d-flex text-center" style="justify-content: center;">
	          	<a href="index.php" class="px-2 py-2 mr-md-1 rounded" style="width: 200px;text-align: center;"><span class="ion-logo-facebook mr-2"></span>Se connecter</a>
	          </div>
                
                <style>
                  /*.btn {
                    display: inline-block;
                    padding: 8px 16px;
                    margin-right: 8px;
                    text-decoration: none;
                    color: #ffffff;
                    background-color: #4B70E2;
                    border-radius: 8px;
                    font-size: 16px;
                    font-weight: bold;
                    border: none;
                    transition: background-color 0.3s ease;
                  }*/
                  .btn:hover {
                    background-color: #325bb3;
                  }
                </style>
              </form>
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
