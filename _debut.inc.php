<?php
include_once 'db.php';


// Debut Deconnexion 
if (session_status() == PHP_SESSION_NONE) {
	session_start();}
	include_once 'db.php';
	if (isset($_REQUEST["logout"])) {
		session_unset();
		$_SESSION['flash']['success']='Vous etes maintenant deconnecté';
		header('Location: index.php');
	}
  // Fin Deconnexion 

	$pdo = gestionnaireDeConnexion();

// Debut SaisieConnexion
	// Permet de déterminer si ‘forminscription’, c’est-à-dire le contenu du formulaire, est diffèrent de NULL.
	if(isset($_POST['formconnexion'])) {
// on recupere le mail et le mot de passe des champs de connexion
		$mailconnect = htmlspecialchars($_POST['mailconnect']);
		$mdpconnect = md5($_POST['mdpconnect']);
		// On verifie que ces deux champs ne sont pas null
		if(!empty($mailconnect) AND !empty($mdpconnect)) {
			// on prepare la requete qui va verifier que le mail et le mot de passe saisient existent dans la bdd et sont bon
			$requser = $pdo->prepare("SELECT * FROM user WHERE user_email = ? AND user_password = ?");
			$requser->execute(array($mailconnect, $mdpconnect));
			// on attribut un compteur à userexist
			$userexist = $requser->rowCount();
			// si userexist vaut 1 , alors les identifiants existent et donc on se connecte.
			if($userexist == 1) {
				$userinfo = $requser->fetch();
				$_SESSION['user_id'] = $userinfo['user_id'];
				$_SESSION['user_name'] = $userinfo['user_name'];
				$_SESSION['user_email'] = $userinfo['user_email'];

				header("Location: utilisateursGestion.php?id=".$_SESSION['user_id']);
				// Sinon on indique une erreur
			} else {
				$erreur = "Mauvais mail ou mot de passe !";
			}
		} else {
			$erreur = "Tous les champs doivent être complétés !";
		}
	}
// Fin SaisieConnexion
	?>




	<!DOCTYPE html>
	<html lang="fr">
	<head>
		<meta charset="utf-8">

		<title>Terre Plurielle : ComImage</title>

		<link rel="shortcut icon" href="img/terreplurielleicon.png">

		<!-- Bootstrap itself -->
		<link href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" type="text/css">
		<!-- Icons -->
		<link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet"> 
		<!-- Fonts -->
		<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700"> 
		<!-- Custom styles -->
		<link rel="stylesheet" href="bootstrap/css/styles.css">

		<script src="bootstrap/js/html5shiv.js"></script>


		<body>
			<!-- bandeau haut de page-->
			<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
				<div class="container">
					<div id="navbar" class="navbar-collapse collapse">

						<!-- tant que l'utilisateur n'est pas connecté, affiche acceuil, et champs d'authentifications -->
						<?php if (!isset($_SESSION["user_email"])): ?> 

							<form  method="post" class="navbar-form navbar-center"  role="form" action="index.php">

								<div class="navbar-header"><a class="navbar-brand" href="index.php">Acceuil</a></div> 
								<div class="form-group">
									<input name="mailconnect" type="email" placeholder="Email" class="form-control">
								</div>
								<div class="form-group">
									<input name="mdpconnect" type="password" placeholder="Mot de passe" class="form-control">
								</div>
								<button name="formconnexion" type="submit" class="btn btn-lg btn-default">S'authentifier</button>
								<a class="btn btn-lg btn-defaul" href="utilisateurInscription.php">S'inscrire</a >
							</form>
							<?php if (isset($erreur)) {
								echo '<div class="text-center" background-color="red">' . $erreur . "</div>";
							} ?>
							<!-- Fin  -->

							<!-- Si utilisateur connecter  -->
							<?php else: ?> 

								<?php  
								$id = $_SESSION["user_id"];
								$name = $_SESSION["user_name"];
								$email = $_SESSION["user_email"]; 
								?>

								<!-- des que l'utilisateur est connecté, affiche sont email   -->                             
								<div class="navbar-header">
									<div>
										<a class="navbar-brand" href="index.php">Acceuil</a>
										<a class="navbar-brand" href="utilisateursGestion.php?id=<?php  echo $_SESSION['user_id']; ?>">Mon profil</a>
										<a class="navbar-brand" href="questionsGestion.php?id=<?php  echo $_SESSION['user_id']; ?>">Mes questions</a>
									</div>
								</div>
								<br>

								<div>
									<div class="row">
										<div class="col-md-2 col-lg-offset-1" style="color:grey">
											<p class="white">
												<span class="glyphicon glyphicon-user"  aria-hidden="true"></span> 
												<span class="text-center">Bonjour <?php echo $_SESSION["user_name"]; ?></span>
											</p>
										</div>
										<div class="col-md-2 white">
											<a href="<?php echo $_SERVER["PHP_SELF"]; ?>?logout" class="white">
												<span class="glyphicon glyphicon-log-out " aria-hidden="true" title="log-out" href="/terreplurielleV0/index.php">
												</span>    
											</a>
										</div>
									<?php endif; ?>
									<!--    Fin -->

									
								</div>
							</div><!--/.navbar-collapse -->
						</div>
					</nav>

					<br />






