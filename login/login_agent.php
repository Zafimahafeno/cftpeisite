
<!doctype html>
<html lang="en">
  <head>
  	<title>Login 10</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="css/style.css">

	</head>
	<body class="img js-fullheight" style="background-image: url(images/bg.jpg);">
	<section class="ftco-section">
		<div class="container">
			
			<div class="row justify-content-center">
				<div class="col-md-6 col-lg-4">
					<div class="login-wrap p-0">
		      	<h3 class="mb-4 text-center">Have an account?</h3>
		      	<form action="login_back-candidat.php" class="signin-form">
		      		<div class="form-group">
		      			<input type="mail" class="form-control" placeholder="Votre mail" required name="mail">
		      		</div>
	            <div class="form-group">
	              <input id="password-field" type="password" class="form-control" placeholder="mot de passe" required name="password">
	              <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
	            </div>
	            <div class="form-group">
	            	<button type="submit" class="form-control btn btn-primary submit px-3">Sign In</button>
	            </div>
	            <div class="form-group d-md-flex">
	            	<div class="w-50">
		            	<label class="checkbox-wrap checkbox-primary">Remember Me
									  <input type="checkbox" checked>
									  <span class="checkmark"></span>
									</label>
								</div>
								
	            </div>
	          </form>
	          <p class="w-100 text-center">&mdash; Créer un compte &mdash;</p>
	          <div class="social d-flex text-center">
	          	<a href="register.php" class="px-2 py-2 mr-md-1 rounded"><span class="ion-logo-facebook mr-2"></span>Récruteur</a>
	          	<a href="register_candidat.php" class="px-2 py-2 mr-md-1 rounded"><span class="ion-logo-facebook mr-2"></span>Candidat</a>
				<a href="register_agent.php" class="px-2 py-2 mr-md-1 rounded"><span class="ion-logo-facebook mr-2"></span>Agent</a>
		      </div>
				</div>
			</div>
		</div>
	</section>

	<script src="js/jquery.min.js"></script>
  <script src="js/popper.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>
  <script>
    // Vérifier si l'alerte doit être affichée
    var mail = "<?php echo isset($_SESSION['mail']) ? $_SESSION['mail'] : ''; ?>";
    if (mail !== '') {
        alert("Employeur connecté avec succès.");
        // Réinitialiser la variable de session pour éviter que l'alerte ne soit affichée à nouveau
        <?php unset($_SESSION['mail']); ?>
    }
    </script>
	</body>
</html>

