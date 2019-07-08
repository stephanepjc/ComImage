<?php
//=======================================================================//
// 1er fonctionnalité php: Récupérer la liste des sous categories------ START
//=======================================================================//
if(isset($_POST['categorie']) AND !empty($_POST['categorie']) AND isset($_POST['step']) AND $_POST['step'] == '1'){
  // apres avoir vérifier qu on a bien recu un post nommé categorie et que celui ci n est pas vide et qu on a bien recu le verificateur step de la veleur equivalente a 1
  // on ajoute la connxion au serveur a l aide d un require car on ne peut pas contoiner sans le fichier de connxion au data base
  require('connexion.php');
  // on cree notre requete Sql stocké dans la variable requeteSql
  $requeteSql = 'SELECT designation, id FROM scategorie WHERE idcategorie = :idcategorie';
  // on se connecte a la base de donnees en PDO et en requete preparer (afin de passer les information de maniere propre ) en passant la requete Sql
  $reponses = $bdd->prepare($requeteSql);
  // on execute notre requete en passant la valeur de l id a retrouver
  $reponses->execute(array(
    'idcategorie' => $_POST['categorie'],
  ));
  //on creer un variable pour incrementer le rendu des option a passer dans la page html
  $render = '';
  //on lance une boucle pour récuperer chaque ligne de notre tableau de données qui match notre requete sql
  while($reponse = $reponses->fetch()) {
      // a chaque fois que ca match on incremente un nouveau tag <option> avec les bonnes valeur a notre variables $render
      $render .= "<option value='".$reponse['id']."'>".$reponse['designation']."</option>";
  }
  // on oublie pas de stopper le curseur a la fin de notre boucle !!
  $reponses->closeCursor();
  // on echo (écrit) notre variable generer par notre boucle qui incremente les option dans la variable $render
  // ceci est récupérer en tant que valeur de texte plain par la requete ajax jQuery
  echo $render;
}
//=======================================================================//
// 1er fonctionnalité php: Récupérer la liste des sous categories------ END
//=======================================================================//






//=======================================================================//
// 2eme fonctionnalité php: Récupérer les images relative ------ START
//=======================================================================//
elseif (isset($_POST['sousCategorie']) AND !empty($_POST['sousCategorie']) AND isset($_POST['step']) AND $_POST['step'] == '2') {
  // apres avoir vérifier qu on a bien recu un post nommé sousCategorie et que celui ci n est pas vide et qu on a bien recu le verificateur step de la valeur equivalente a 2
  // on ajoute la connexion au serveur a l aide d un require car on ne peut pas continuer sans le fichier de connexion au data base
  require('connexion.php');//le require qui prend le fichier connexion.php

  //on lance un requete pour retrouver l id de la categorie relative
  $requeteSql = 'SELECT designation, idcategorie FROM scategorie WHERE id = :id';//la requete Sql stocké dans la variable requeteSql
  $reponses = $bdd->prepare($requeteSql); // initiation de la requete vers la base de donnees
  //execution de la requete en passant l id a retrouver
  $reponses->execute(array(
    'id' => $_POST['sousCategorie'],
  ));
  // Si on trouve quelque chose suite a notre requete :
  if($reponse = $reponses->fetch()){
    // on place le nom de la designation dans la categorie dans la variable info1 dans le but de retrouver plus tard le nom de la categorie et de deja fermer notre connexion au database
    $info1 = $reponse['designation'];
  }
  // on ferme la connexion au serveur avec ou sans l $info1
  $reponses->closeCursor();


  //on lance la deuxieme requete pour retrouver la designaton de la categorie
  $requeteSql2 = 'SELECT designation FROM categorie WHERE id = :id';
  // on initie la requete vers la base de donnees
  $reponses2 = $bdd->prepare($requeteSql2);
  //execution de la requete en passant l id a retrouver
  $reponses2->execute(array(
    'id' => $reponse['idcategorie'],
  ));
  // Si on trouve quelque chose suite a notre requete :
  if($reponse2 = $reponses2->fetch()){
    // on place le nom de la designation de la categorie dans la variable info2 dans le but de retrouver plus tard le nom de la categorie et de deja fermer notre connexion au database
    $info2 = $reponse2['designation'];
  }
  // on ferme la connexion au serveur avec ou sans l $info2
  $reponses->closeCursor();
  // on creer le rendu du tag  html <img src="x" alt="x"> en y passant les bonnes valeurs et en le placant dans la variable $render
  $render = '<img alt="'.$info2.'_'.$info1.'" src="imgIcones/'.$info2.'_'.$info1.'.png" />';
  // on echo (écrit) notre variable generer par notre requete qui contient l image en html
  // ceci est récupérer en tant que valeur de type texte plain par la requete ajax jQuery
  echo $render;
}
//=======================================================================//
// 2eme fonctionnalité php: Récupérer les images relative ------ END
//=======================================================================//






//=======================================================================//
// 3eme fonctionnalité php: enregistrer les information du formulaire dans la data base ------ START
//=======================================================================//
elseif (isset($_POST['question']) AND !empty($_POST['question']) ){
  // apres avoir vérifier qu on a bien recu un post nommé question et que celui ci n est pas vide
  // on ajoute la connexion au serveur a l aide d un require car on ne peut pas continuer sans le fichier de connexion au data base
  require('connexion.php');
  //on place dans la variable question la valeur de la question
  $question = $_POST['question'];
  // ensuite on prend le tableau/ array générer par les different input categorie (   pour faire cela on a ajouté [] a la suite du nom de l input --> exemple  recapitulatif -><select name="categorie[]">  )
  $categories = $_POST['categorie'];
  // on fait la meme chose pour les sous categories
  $souscategorie = $_POST['sous_categorie'];
  //on prpare un variablespor acceuillir la liste des nom d images relative au choix de categories et de sous categories
  $icones = '';
  // on va lancer une boucle qui vas passer dans le tableau categorie et prendre la designation relative et ensuite aller chercher dans le tableau souscategorie et prendre la deignatiojn relative aussi (en gros array 1 on prend le [1]=> somthing  du coup array 2 on prend le [1] => something)
  // pour faire ca on lance une boucle de type foreach/pourchaque ou on place le tableau/array categorie
  // traduction: pour chaque : (element du tableau 'categories') EN TANT QUE $key(nom de variable) et $categorie(la valeur de la variable)
  foreach ($categories as $key => $categorie) {
    //on lance la 1er requete pour retrouver la designaton de la categorie en fonction de l id (car on veux la designation de la categorie et a designation de la sous categorie pour creer le lien de l image)
    $requeteSql = 'SELECT designation FROM categorie WHERE id = :id';
    $reponses = $bdd->prepare($requeteSql);
    $reponses->execute(array(
      'id' => $categorie,
    ));
    // Si on trouve quelque chose suite a notre requete :
    if($reponse = $reponses->fetch()){
      // on place le nom de la designation de la categorie dans la variable $nomCategorie dans le but de la retenir pour l enregistrer dans la data base
      $nomCategorie = $reponse['designation'];
    }else{
      // si on trouve rien on l appel inconnu
      $nomCategorie = 'inconnu';
    }
    //on ferme la connexion a la data base
    $reponses->closeCursor();

    //on cree une variable($idSousCategorie) pour prendre la valeur de l information(id) stocker dans le tableu souscategorie du formulaire envoyer qui est relative a la ligne du tableau categorie que nous sommes entrain de lire
    $idSousCategorie = $souscategorie[$key];
    //la requete sql qui va chercher la designation de la sous categorie en se basant sur l id trouver et retenu dans $idSousCategorie
    $requeteSql2 = 'SELECT designation FROM scategorie WHERE id = :id';
    $reponses2 = $bdd->prepare($requeteSql2);
    $reponses2->execute(array(
      'id' => $idSousCategorie,
    ));
    // si on a un match :
    if($reponse2 = $reponses2->fetch()){
      // on retien le nom de la designation de la sous categorie
      $nomSousCategorie = $reponse2['designation'];
    }else{
      //sinon on retien une sous categorie 'inconnu'
      $nomSousCategorie = 'inconnu';
    }
    // on ferme le contact avec la base de donnee
    $reponses2->closeCursor();
    // a chaque tour de notre foreach() on incrémente le nom de l image suivit de ', ' (une virgule et un espace )
    $icones .=  $nomCategorie. '_'.$nomSousCategorie.'.png, ';
  }
  // une fois tous les liens vers les images incremente dans la variables $icones  on lance notre requete SQL
  // on insert a l interieur de la table de donnees question les informations de "textQuestion" et les information d "icones"
  $requeteSql3 = 'INSERT INTO question(textQuestion, icones) VALUES(:textQuestion, :icones)';
  //on initie la requete
  $executeur = $bdd->prepare($requeteSql3);
  // on execiute la requet eave les valeur associer a enregistrer dans la base de donnees
  $executeur->execute(array(
  	'textQuestion' => $question,
  	'icones' => $icones,
	));



    // START -- CECI EST UN PLUS AFIN D INTERACTIVEMENT AJOUTER LA NOUVELLE QUESTIOn DANS LA LISTE QUI est ELLE AUSSI UN PLUS
    // on selectionne dans la data base le tableau question pour retrouver notre nouvelle ligne afain de recuperer les information et recreer une ligne a injecter dans le tableau des question
    $requeteSql4 = 'SELECT * FROM question WHERE textQuestion = "'. $question .'" AND icones = "'. $icones .'" ';
    $reponses4 = $bdd->query($requeteSql4);
    // si on retrouve les informations on creer une ligne
    if($reponse4 = $reponses4->fetch()) {
      // pour creer une ligne on incremente dans la variable $render les tag html <li> et les different <span>
      $render ='<li><span class="id_question">';
      $render .= $reponse4['idQuestion'].'</span>';
      $render .= '<span class="texte_question">'.$reponse4['textQuestion'].'</span><span class="toutes_les_images">';
      // on divise la variable des icones en la separant par chaque ', ' et ceci creer un tableau
      $imagesNames = explode(", ",$reponse4['icones']);
      // pour chaque element de ce nouveau tableau de valeur on cree une nouvelle image
      foreach($imagesNames as $imagename ){
        // on verifie que l information n est pas vide
        if($imagename != ''){
          //si ce n est pas vide on incremente la nouvelle image
          $render .= '<img src="imgIcones/'.$imagename.'" alt="'.$imagename.'">';
        }

      }
      // fin de la boucle
      // on fini l incrementation de la ligne avec le bouton de suppression
      $render .=  '</span><span class="delete_question" data_id_question="'.$reponse4['idQuestion'].'" >X</span></li>';
    }
    else{
      // si on ne trouve rien le render est vide
      $render = '';
    }
    // on termine notre connexion au sereur
    $reponses4->closeCursor();
    // on echo (écrit) notre variable generer par notre requete qui contient la ligne de la nouvelles question
    // ceci est récupérer en tant que valeur de type texte plain par la requete ajax jQuery
    echo $render;
    // FIN -- CECI EST UN PLUS AFIN D INTERACTIVEMENT AJOUTER LA NOUVELLE QUESTIOn DANS LA LISTE QUI est ELLE AUSSI UN PLUS
}
//=======================================================================//
// 3eme fonctionnalité php: enregistrer les information du formulaire dans la data base ------ END
//=======================================================================//



// START -- CECI EST UN PLUS POUR SUPPRIMER UNE LIGNE
//=======================================================================//
// 4eme fonctionnalité php: supprimer les informations de la base de donnees ------ START
//=======================================================================//
elseif (isset($_POST['supprimer']) AND !empty($_POST['supprimer'])) {
    // on ouvre notre connexion au serveur car sans cela on ne peut pas contineur
      require('connexion.php');
      // on delete du tableau question la lignerelative a l id envoyer par la requete ajax
      $req = $bdd->prepare('DELETE FROM question WHERE idQuestion = :idQuestion');
      $req->execute(array(
      	'idQuestion' => $_POST['supprimer']
      	));
      //  on echo/ecrit l id de l element qui a ete supprimer
      echo $_POST['supprimer'];
}
// END -- CECI EST UN PLUS POUR SUPPRIMER UNE LIGNE
//=======================================================================//
// 4eme fonctionnalité php: supprimer les informations de la base de donnees ------ END
//=======================================================================//

?>
