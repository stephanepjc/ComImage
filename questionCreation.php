<?php include_once '_debut.inc.php'; 
?> 

<link href="bootstrap/css/stylesPageProfil.css" rel="stylesheet">
<link href="bootstrap/css/stylesTableauIcones.css" rel="stylesheet">

<div class="container">
    <div class="view-account">
        <section class="module">
            <div class="module-inner">
                <div class="side-bar">
                    <div class="user-info">
                        <img class="img-profile img-circle img-responsive center-block" src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="">
                        <ul class="meta list list-unstyled">
                            <li class="name"><?php echo $_SESSION['user_name']; ?>
                        </li>
                        <li class="email"><a href="#"><?php echo $_SESSION["user_email"]?></a></li>
                    </ul>
                </div>
                <nav class="side-menu">
                    <ul class="nav">
                        <li class="active"><a href="#"><span class="fa fa-user"></span> Ajouter une Question</a></li>
                        <li ><a href="questionsGestion.php?id=<?php echo $_SESSION["user_id"]?>"><span class="fa fa-user"></span> Gestion des questions</a></li>
                        <li ><a href="utilisateursGestion.php?id=<?php echo $_SESSION["user_id"]?>" ><span class="fa fa-user"></span> Profil</a></li>
                    </ul>
                    <img src="img/comImage.png" class="img-responsive" alt="Responsive image">
                </nav>
            </div>


            <link href="bootstrap/css/master.css" rel="stylesheet" >
                <div class="content-panel">
                    <div class="col-md-7 border" >
                        <article>
                           <header>
                            <p class="text-uppercase text-center bg-success">
                                Section de gestion des questions
                            </p>
                        </header>
                    </article>

                    <!-- debut du formulaire  les attributs "action" et "method" sont vide car créé en ajax -->
                    <form id="formulaire" action="" method=""><!-- !!!! Un id est unique ===> a n'utiliser qu'une seul fois dans une page Html tres important !!!!-->
                      <h1>Ajouter une question:</h1>
                      <!-- block de la 1er question == START == -->
                      <div class="rowQuestion">
                        <!-- label du champ du formulaire relier avec l'attribut for  -->
                        <label for="question1">Ici votre question : </label>
                        <!-- champs du formulaire de type texte avec un texte pré-écrit et un attribut name OBLIGATOIRE et une valeur vide -->
                        <input id="question1" type="text" name="question" value="" placeholder="exemple: Quel est ton nom ?">
                    </div>
                    <!-- block de la 1er question ==  END  == -->

                    <?php
        // 1) Les Categories:
        //On declare La requete SQL qui dis 'selectionne -> Toute la colonne designation -> Depuis la table de données -> 'categorie'
                    $requeteSql = 'SELECT designation, id FROM categorie';
        //On lance une recherche dans la base de donnees pour avoir les differente categorie
        //Pour se connecter on utilise la methode Query (qui signifie requete, peut etre compris recherche)
        //On place dans la variable $reponsse la/les valeur(s) du resultat de la requete SQL
                    $reponses = $pdo->query($requeteSql);
        //On declare la variable $options qui va acceuillir les differentes <option>
                    $option='';
        //On lance une boucle (while) pour placer chaque resultat de la recherche dans notre template de formulaire (Select-Option)
                    while ($reponse = $reponses->fetch()) {
          //A chaque designation on incremente une nouvelle option avec les valeur de la designation
                      $option .= "<option value='".$reponse['id']."' ";
          //si la designation est egal a Aucune on la met par default
                      if($reponse['designation'] == ''){
                        $option .= 'selected="selected"';
                    }else{
            //sinon on ne fait rien de special
                    }
                    $option .= " >".$reponse['designation']."</option>";
          //on ajoute +1 a la variable d incrementation avant la fin de la Boucle
                }
                $reponses->closeCursor();

        // 2) Les Icones :
        // On utilise une boucle (for) pour placer les diferrentes questions d'icone
        // Declaration d une variable d incrementation $i commencant a 1
        // Declaration d une variable pour le nombre maximum, ici 5
        // A chaque fin de boucle $i augmente de 1
                for ($i = 1; $i <= 5; $i++) {
                  ?>
                  <!-- block de la question d image == START == -->
                  <div class="rowQuestion">
                      <!-- label du champ du formulaire "categorie" relier avec l'attribut for  -->
                      <label for="categorie<?php echo $i; ?>">Icone <?php echo $i; ?> : </label>
                      <!-- champs du formulaire de type dropdown/select-option -->
                      <select id="categorie<?php echo $i; ?>" class="select_categorie" name="categorie[]">
                        <!-- on place les option qu on a pris dans a base de donnees ici -->
                        <?php echo $option; ?>
                    </select>

                    <!-- champs du formulaire de type dropdown/select-option ===> celui-ci eant vide pour etre rempli interactivement avec jQuery -->
                    <select class="select_sous_categorie" name="sous_categorie[]">
                    </select>

                    <!-- block vide en attendant d'etre rempli interactivement avec jQuery  -->
                    <div class="image_resultat">
                    </div>
                </div>
                <!-- block de la question d image == START == -->
                <?php
            }
            ?>

            <!-- bouton de validation d'envoie du formulaire -->
            <input type="submit" name="" value="Valider">

        </form>
        <!-- fin du formulaire -->

<!-- debut lien vers les fichiers javascript -->
<!-- ======================================== -->
<!-- lien vers le fichier jquery -->
<script src="js/jquery.js"></script>
<!-- lien vers les functions de la page -->
<script src="js/functions.js"></script>

<br />
<br />
<br />  
<br />
<br />
<br />  
<?php include_once '_fin.inc.php'; ?>