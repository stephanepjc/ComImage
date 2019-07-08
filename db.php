<?php

//--------verification compte existant-----------
function verification($user_email, $user_password) {
    $compteExistant = false;
    $pdo = gestionnaireDeConnexion();
    if ($pdo != null) {
        $sql = "SELECT count(*) as nb From user  WHERE user_email=:user_email AND user_password=md5(:user_password)";
        $prep = $pdo->prepare($sql);
        $prep->bindParam(':user_email', $user_email, PDO::PARAM_STR);
        $prep->bindParam(':user_password', $user_password, PDO::PARAM_STR);
        $prep->execute();
        $resultat = $prep->fetch();

        if ($resultat["nb"] == 1) {
            $compteExistant = true;
        }

        $prep->closeCursor();
    }
    return $compteExistant;
}
//--------FIN verification compte existant-----------

//--------connexion base de donnée mysql-----------
function gestionnaireDeConnexion() {
    $pdo = null;
    try {
        $pdo = new PDO(
                'mysql:host=localhost;dbname=terreplurielle', 'root', '', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
        );
    } catch (PDOException $err) {
        $messageErreur = $err->getMessage();
        error_log($messageErreur, 0);
    }
    return $pdo;
}
//--------FIN connexion base de donnée mysql-----------


//-------- affiche questions base de donnée mysql-----------
function listeQuestionsIcones() {
    $user_id = $_SESSION["user_id"];
    $lesQuestionsIcones = array(); //fonction de tableau equivalent de new java
    $pdo = gestionnaireDeConnexion(); //C'est une affection qui est un objet
    if ($pdo != NULL) { //si l'instruction est vrai on passe a la suivante
        $req = ("select * from question where question_user_id =$user_id order by question_id"); // appelle la base de données 
        $pdoStatement = $pdo->query($req); // $spdo objet et boite à outils et query outil
        $lesQuestionsIcones = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
    }
    return $lesQuestionsIcones;
}
//-------- FIN affiche questions base de donnée mysql-----------

//-------- Modifie utilisateur base de donnée mysql-----------
function modifierUtilisateur($id, $nom, $email, $mdp) {
    $modification = false;
    $pdo = gestionnaireDeConnexion();

    if ($pdo != null) {
        $id = $pdo->quote($id);
        $nom = $pdo->quote($nom);
        $email = $pdo->quote($email);
        $mdp = $pdo->quote($mdp);
        $req = "update user set user_name=$nom, user_email=$email, user_password=$mdp";
        $resultat = $pdo->exec($req);
        if ($resultat == 1) {
            $modification = true;
        }
    }
    return $modification;
}
//--------FIN Modifie utilisateur base de donnée mysql-----------

?>