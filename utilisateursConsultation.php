<?php
include_once '._debut.inc.php';
?>
<br />
<br />
<br />
<!-- Une div contenant la class "container" préfixe obligatoirement les lignes (div de class=row) -->
<div class="container">
    <!-- ligne principale -->
    <div class="row "> 
        <!-- première colonne (s'étend sur de 3 colonnes sur 12 possibles) -->
        <div class="col-md-3 border">
            <br />
            <div id="menuGauche" class="btn-group-vertical btn-block">

                <a href="utilisateursConsultation.php" class="btn btn-primary ">
                    CONSULTER</a>
                <a href="utilisateurCreation.php" class="btn btn-primary  ">
                    AJOUTER</a>

                <a href="#" class="btn btn-primary btn-block">
                    RECHERCHER</a>
            </div> 
            <img src="img/clefmusique.gif" class="img-responsive" alt="Responsive image">
        </div>
        <!-- deuxième colonne (s'étend sur 7 colonnes sur 12 possibles à partir de la 3) -->
        <div class="col-md-7 border">
            <h1 class="text-center">Liste des utilisateurs</h1>
            <br />
            <!-- une ligne dans une colonne -->
            <div class="row">
                <?php
                $listeUtilisateurs = listeUtilisateurs();
                foreach ($listeUtilisateurs as $utilisateur):
                    ?>
                    <div class="col-md-6">
                        <article class="panel panel-default articleEtablissement bgColorTheme">
                            <p> Nom :  <?php echo $utilisateur["user_name"] ?> </p>
                        <!--<p> Mot de passe : <?php echo $utilisateur["user_password"] ?> </p> -->
                            <p> Email : <?php echo $utilisateur["user_email"] ?> </p>
                            <ol class="breadcrumb">
                                <li> 
                                    <a href="utilisateurModification.php?numUtilisateur=<?php echo $utilisateur["user_id"] ?>">modifier

                                    </a>
                                </li>
                                <li> 
                                    <a href="utilisateurDetail.php?numEtablissement=<?php echo $utilisateur["user_id"] ?>">Détail
                                    </a>
                                </li>
                                 <li> 
                                        <a>
                                            <form method="post" action="utilisateurSuppression.traitement.php" class="delete_form">
                                                <input type="hidden" name="user_id" value="<?php echo $utilisateur["user_id"] ?>"/>
                                                <input  type="submit" name="valider" class="delete" value="Supprimer" />
                                            </form>
                                        </a>
                                    </li>
                            </ol>
                        </article>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <hr>
    <footer>
        <p>&copy; EPMI 2019</p>
    </footer>
</div> <!-- /container -->
<?php include("_fin.inc.php"); ?>


