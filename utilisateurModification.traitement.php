<?php
include_once '_debut.inc.php';
$user_id=$_SESSION['user_id'];
$pdo = gestionnaireDeConnexion();
if (isset ($_REQUEST)) {
	$id = $user_id;
 	$nom = $_REQUEST['user_name'];
 	$email = $_REQUEST['user_email'];
 	$mdp = md5($_REQUEST['user_password']);
	$mdp2 = md5($_REQUEST['confirm_password']);
 	if($mdp == $mdp2) {
 		modifierUtilisateur($id, $nom, $email, $mdp);
		header("Location:utilisateursGestion.php?id=".$user_id);
 	}else {
 		header("Location:utilisateursGestion.php?id=".$user_id);
 	}
 }
?>