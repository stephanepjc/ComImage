<?php
try
{
	// Ceci est une connexion en PDO Programmation Oriente Objet
	// A chaque fois que l on souhaite se connceter a la base de donnees
	// il suffit d utiliser la variable $bdd
	$bdd = new PDO('mysql:host=localhost;dbname=terreplurielle;charset=utf8', 'root', '');
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}
?>
