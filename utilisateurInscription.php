<br />
<br />
<br />
<!-- Include_once permet d’appeler une fois les fonctions que contient _debut.inc.php. Cette page PHP renvoie à une page db.php qui possède la fonction gestionnaireDeConnexion qui permet la connexion à la base MySQL. $pdo est une variable qui contient cette fonction. -->
<?php include_once '_debut.inc.php'; ?>
<?php
$pdo = gestionnaireDeConnexion();
// isset détermine si la variable est déclarée et est différente de NULL
if(isset($_POST['forminscription'])) {
  // on recupere les données saisient par l'utilisateur dans les differents champs prevu respectivement a cette effet
   $nom = htmlspecialchars($_POST['user_name']);
   $mail = htmlspecialchars($_POST['user_email']);
   $mail2 = htmlspecialchars($_POST['user_email2']);
   // les mots de passes sont directement haché en md5.
   $mdp = md5($_POST['user_password']);
   $mdp2 = md5($_POST['user_password2']);
   // Cette condition permet de verifier que les champs a saisir ne sont pas vides.
   if(!empty($_POST['user_name']) AND !empty($_POST['user_email']) AND !empty($_POST['user_email2']) AND !empty($_POST['user_password']) AND !empty($_POST['user_password2'])) {
      $nomlength = strlen($nom);
      // La longueur du nom ne peut depasser 100 caracteres
      if($nomlength <= 100) {
        // verifie si les deux mails saisient sont identiques
         if($mail == $mail2) {
          //verifie si le mail saisie est un vrai mail.
            if(filter_var($mail, FILTER_VALIDATE_EMAIL)) {
              //prepare la resquete sql pour verifier si le mail est deja existant dans la bdd
               $reqmail = $pdo->prepare("SELECT * FROM user WHERE user_email = ?");
               //stock le mail saisie dans la variable
               $reqmail->execute(array($mail));
               //crée un compteur
               $mailexist = $reqmail->rowCount();
               //si la variable mailexist est a 0 , c'est a dire que le mail n'est pas present dans la bdd
               if($mailexist == 0) {
                //et si les deux mots de passe saisient sont identiques
                  if($mdp == $mdp2) {
                    //on prepare la requete d'insertion de donnée dans la base de donnée avec les variables recuperé
                     $insertmbr = $pdo->prepare("INSERT INTO user(user_name, user_email, user_password) VALUES(?, ?, ?)");
                     $insertmbr->execute(array($nom, $mail, $mdp));
                     //on confirme la creation de compte utilisateur
                     $erreur = "Votre compte a bien été créé !";
                     // Sinon on affiche les erreurs que l'utilisateur a pu rencontrer en remplissant le formulaire d'inscription
                  } else {
                     $erreur = "ATTENTION : Vos mots de passes ne correspondent pas !";
                  }
               } else {
                  $erreur = "ATTENTION : Adresse mail déjà utilisée !";
               }
            } else {
               $erreur = "ATTENTION :  Votre adresse mail n'est pas valide !";
            }
         } else {
            $erreur = "ATTENTION : Vos adresses mail ne correspondent pas !";
         }
      } else {
         $erreur = "ATTENTION : Votre pseudo ne doit pas dépasser 100 caractères !";
      }
   } else {
      $erreur = "ATTENTION : Tous les champs doivent être complétés !";
   }
} 
?>
<br />
<?php if (!empty($errors)): ?>
  <div class="alert alert-danger">
    <p>Vous n'avez pas rempli le formulaire correctement</p>
    <ul>
      <?php foreach ($errors as $error): ?>
        <li> <?= $error; ?></li>
      <?php endforeach; ?>
    </ul>
  </div>
<?php endif; ?>
<style type="text/css">
  body{
    color: #fff;
    background: #63738a;
    font-family: 'Roboto', sans-serif;
  }
  .form-control{
    height: 40px;
    box-shadow: none;
    color: #969fa4;
  }
  .form-control:focus{
    border-color: #5cb85c;
  }
  .form-control, .btn{        
    border-radius: 3px;
  }
  .signup-form{
    width: 400px;
    margin: 0 auto;
    padding: 30px 0;
  }
  .signup-form h2{
    color: #636363;
    margin: 0 0 15px;
    position: relative;
    text-align: center;
  }
  .signup-form h2:before, .signup-form h2:after{
    content: "";
    height: 2px;
    width: 30%;
    background: #d4d4d4;
    position: absolute;
    top: 50%;
    z-index: 2;
  } 
  .signup-form h2:before{
    left: 0;
  }
  .signup-form h2:after{
    right: 0;
  }
  .signup-form .hint-text{
    color: #999;
    margin-bottom: 30px;
    text-align: center;
  }
  .signup-form form{
    color: #999;
    border-radius: 3px;
    margin-bottom: 15px;
    background: #f2f3f7;
    box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    padding: 30px;
  }
  .signup-form .form-group{
    margin-bottom: 20px;
  }
  .signup-form input[type="checkbox"]{
    margin-top: 3px;
  }
  .signup-form .btn{        
    font-size: 16px;
    font-weight: bold;    
    min-width: 140px;
    outline: none !important;
  }
  .signup-form .row div:first-child{
    padding-right: 10px;
  }
  .signup-form .row div:last-child{
    padding-left: 10px;
  }     
  .signup-form a{
    color: #fff;
    text-decoration: underline;
  }
  .signup-form a:hover{
    text-decoration: none;
  }
  .signup-form form a{
    color: #5cb85c;
    text-decoration: none;
  } 
  .signup-form form a:hover{
    text-decoration: underline;
  }  
</style>
</head>
<body>
<?php if (isset($erreur)) {
  echo '<div class="text-center" background-color="red">' . $erreur . "</div>";
} ?>
  <div class="signup-form">
    <!-- on indique la methode d'envoie de donnée à la partie traitement du formulaire -->
    <form action='' method="post"> 
      <h2>Inscription</h2>
      <p class="hint-text">Créez votre compte, cela ne prendrera que quelques minutes.</p>
      <div class="form-group">
        <div class="row">
          <!-- On crée un champ de saisit 'input' de type text , qu'on rend obligatoire avec l'option required -->
          <div class="col-xs-6"><input type="text" class="form-control" name="user_name" placeholder="Nom" required="required" value="<?php if (isset($_POST['user_name'])){echo $_POST['user_name'];} ?>"></div>
          <div class="col-xs-6"><input type="hidden" class="form-control" name="***" placeholder="***"></div>
        </div>          
      </div>
      <div class="form-group">
        <!-- On crée un champ de saisit 'input' de type email , qu'on rend obligatoire avec l'option required -->
        <input type="email" class="form-control" name="user_email" placeholder="Email" required="required" value="<?php if (isset($_POST['user_email'])){echo $_POST['user_email'];} ?>">
      </div>
      <div class="form-group">
        <!-- Ce champ va etre comparé au champs precedent pour etre sur qu'ils sont tous deux identiques -->
        <input type="email" class="form-control" name="user_email2" placeholder="Confirmez votre email" required="required" value="<?php if (isset($_POST['user_email2'])){echo $_POST['user_email2'];} ?>">
      </div>
      <div class="form-group">
        <!-- On crée un champ de saisit 'input' de type password , qu'on rend obligatoire avec l'option required -->
        <input type="password" class="form-control" name="user_password" placeholder="Mot de passe" required="required">
      </div>
      <div class="form-group">
        <!-- Ce champ va etre comparé au champs precedent pour etre sur qu'ils sont tous deux identiques -->
        <input type="password" class="form-control" name="user_password2" placeholder="Confirmez votre mot de passe" required="required">
      </div>        
    <div class="form-group">
      <!-- on lie le bouton "s'inscrire" à la fonction forminscription qui va traiter les données -->
      <button type="submit" name="forminscription" class="btn btn-success btn-lg btn-block">S'inscrire</button>          
    </div>
  </form>
  <div class="text-center">Vous avec deja un compte ? <a href="index.php">Vous connectez</a></div>
</div>
<br /><br /><br />
</div>
<?php include_once '_fin.inc.php'; ?>




