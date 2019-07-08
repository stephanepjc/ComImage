<?php
include_once '_debut.inc.php';
include_once 'db.php';
?>
<link href="bootstrap/css/stylesPageProfil.css" rel="stylesheet">
<div class="container" style="background:white">
    <div class="view-account">
        <section class="module">
            <div class="module-inner">
                <div class="side-bar"> <!-- Debut barre laterale Gauche -->
                    <div class="user-info">
                        <img class="img-profile img-circle img-responsive center-block" src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="">
                        <ul class="meta list list-unstyled">
                            <li class="name"><?php echo $_SESSION['user_name']; ?>
                            
                        </li>
                        <li class="email"><a href="#"><?php echo $_SESSION["user_email"]?></a></li>
                        <!-- <li class="activity">Last logged in: Today at 2:18pm</li> -->
                    </ul>
                </div>
                <nav class="side-menu">
                    <ul class="nav">
                        <li class="active"><a href="#"><span class="fa fa-user"></span> Gestion des questions</a></li>
                        <li ><a href="questionCreation.php?id=<?php echo $_SESSION["user_id"]?>"><span class="fa fa-user"></span> Ajouter une Question</a></li>
                        <li ><a href="utilisateursGestion.php?id=<?php echo $_SESSION["user_id"]?>"><span class="fa fa-user"></span> Profil</a></li>
                        <!--                         <li><a href="#"><span class="fa fa-cog"></span> Modification de profil</a></li> -->
                    </ul>
                    <img src="img/comImage.png" class="img-responsive" alt="Responsive image">
                </nav>
            </div> <!-- Fin barre laterale gauche -->
            <div class="content-panel">
                <div class="col-md-7 border">
                 <!--  <article> -->
                    <p class="text-uppercase text-center bg-success">
                        Section de gestion des questions
                    </p>
                    <!-- La fonction listeQuesitons se trouve dans db.php  --> 
                    <?php 
                    $listeQuestionsIcones = listeQuestionsIcones();
                        // foreach  permet une boucle dans un tableau et parcour chaques elements
                    foreach ($listeQuestionsIcones as $questionIcones):

                        $question_id=$questionIcones["question_id"];
                        $text_question=$questionIcones["text_question"];
                        $question_user_id=$questionIcones["question_user_id"];
                        $question_picto_un=$questionIcones["question_picto_un"];
                        $question_picto_deux=$questionIcones["question_picto_deux"];
                        $question_picto_trois=$questionIcones["question_picto_trois"];
                        $question_picto_quatre=$questionIcones["question_picto_quatre"];
                        $question_picto_cinq=$questionIcones["question_picto_cinq"];
                        $repertoire="imgIcones/";
                        ?>
                    </br>
                        <article class="panel panel-default articleEtablissement bgColorTheme " style="background:white">
                            <table><tbody>
                                    <p> Question :  <?php echo $text_question ?> </p>
                                    <tr>
                                        <td><?php if (!empty($question_picto_un)) {echo '<td><img src='.$repertoire.$question_picto_un.' height="40" width="40" /></td> ' ;} else { }?></td>
                                        <td><?php if (!empty($question_picto_deux)) {echo '<td><img src='.$repertoire.$question_picto_deux.' height="40" width="40" /></td> ' ;} else {}?></td>
                                        <td><?php if (!empty($question_picto_trois)) {echo '<td><img src='.$repertoire.$question_picto_trois.' height="40" width="40" /></td> ' ;} else{}?></td>
                                        <td><?php if (!empty($question_picto_quatre)) {echo '<td><img src='.$repertoire.$question_picto_quatre.' height="40" width="40" /></td> ' ;} else {}?></td>
                                        <td><?php if (!empty($question_picto_cinq)) {echo '<td><img src='.$repertoire.$question_picto_cinq.' height="40" width="40" /></td> ' ;} else {}?></td>
                                        <tr>
                                        </tr>   
                                    
                                </tbody></table>
                            </br>
                            <table>                      
                                <tr>
                                 <td> <form  method="post" action="questionSuppression.traitement.php" class="delete_form" >
                                    <input  type="submit" name="valider" class="delete" value="Supprimer" />
                                </form></td>
                            </tr>
                        </table>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
</div>
<?php include_once '_fin.inc.php'; ?>