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
        <div class="col-md-8 col-lg-6">
          <div class="login-wrap p-0">
            <h3 class="mb-4 text-center">Veuillez remplir les champs</h3>
            <form action="register_candidat_back.php" method="post" enctype="multipart/form-data" class="signin-form">
              <div class="form-group row">
                <div class="col-md-6">
                  <input type="text" class="form-control" placeholder="Votre Nom" required name="nom_candidat">
                </div>
                <div class="col-md-6">
                  <input type="text" class="form-control" placeholder="Votre Prénom" required name="prenom_candidat">
                </div>
              </div>
              <div class="form-group row">
              <div class="col-md-6">
                  <label for="photo_candidat">Photo</label>
                  <input type="file" class="form-control" required name="photo_candidat" id="photo_candidat">
                </div>
                <div class="col-md-6">
                  <label for="cv_candidat">CV</label>
                  <input type="file" class="form-control" required name="cv_candidat" id="cv_candidat">
                </div>
              </div>

              <div class="form-group row">
              <div class="col-md-6">
                  <input type="text" class="form-control" placeholder="Diplome" required name="diplome_candidat">
                </div>
                
                <div class="col-md-6">
                  <input id="mail-field" type="email" class="form-control" placeholder="Votre adresse mail" required name="mail_candidat">
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-6">
                  <input id="password-field" type="password" class="form-control" placeholder="Votre mot de passe" required name="password_candidat">
                  <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                </div>
                <div class="col-md-6">
                  <input id="titre-field" type="text" class="form-control" placeholder="Saisir l'emploi : Rédacteur/Développeur/Assistant" required name="titre_candidat">
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-12">
                  <select id="type_compte" class="form-control" required name="type_compte">
                    <option value="">Choisir une option</option>
                    <option value="candidat">JE CHERCHE UN EMPLOI</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <button type="submit" class="form-control btn btn-primary submit px-3">Valider</button>
              </div>
              <a href="index.php" class="btn px-2 py-2 mr-md-1 rounded">Se connecter</a>
              <style>
                .btn {
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
                }
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
