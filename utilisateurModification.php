<?php
include_once '_debut.inc.php';
// Recupere les information de l'utilisateur lié à l'id
if(isset($_GET['id']) AND $_GET['id'] > 0) {
   $getid = intval($_GET['id']);
   $requser = $pdo->prepare('SELECT * FROM user WHERE user_id = ?');
   $requser->execute(array($getid));
   $userinfo = $requser->fetch();
}
// FIN Recupere les information de l'utilisateur lié à l'id
?>
<form method='post' action='utilisateurModification.traitement.php'>
<link href="bootstrap/css/stylesPageProfil.css" rel="stylesheet">
<div class="container">
    <div class="view-account">
        <section class="module">
            <div class="module-inner">
                <div class="side-bar">
                    <div class="user-info">
                        <img class="img-profile img-circle img-responsive center-block" src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="">
                        <ul class="meta list list-unstyled">
                            <li class="name"><?php echo $userinfo['user_name']; ?>
                        </li>
                        <li class="email"><a href="#"><?php echo $_SESSION["user_email"]?></a></li>
                    </ul>
                </div>
                <nav class="side-menu">
                    <ul class="nav">
                        <li class="active"><a href="#"><span class="fa fa-user"></span> Modification de profil</a></li>
                        <li><a href="#"><span class="fa fa-cog"></span> Profil</a></li>
                        <li ><a href="questionsGestion.php?id=<?php echo $_SESSION["user_id"]?>"><span class="fa fa-user"></span> Gestion des questions</a></li>            
                    </ul>
                    <img src="img/comImage.png" class="img-responsive" alt="Responsive image">
                </nav>
            </div>
            <div class="content-panel">
                <h2 class="title">Profile de <?php echo $userinfo['user_name'];?><span class="pro-label label label-warning"> TEST</span></h2>
                <form class="form-horizontal">
                    <fieldset class="fieldset">
                        <!-- <h3 class="fieldset-title">Bonjour</h3> -->
                        <div class="form-group avatar">
                            <figure class="figure col-md-2 col-sm-3 col-xs-12">
                                <img class="img-rounded img-responsive" src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="">
                            </figure>
                            <div class="form-inline col-md-10 col-sm-9 col-xs-12">
                                <input type="file" class="file-uploader pull-left">
                                <button type="submit" class="btn btn-sm btn-default-alt pull-left">Update Image</button>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="fieldset">
                        <h3 class="fieldset-title">Information contact</h3>
                        <div class="form-group">
                            <label class="col-md-2 col-sm-3 col-xs-12 control-label">Nom</label>
                            <div class="col-md-10 col-sm-9 col-xs-12">
                                <input type="text" class="form-control" value="<?php echo $userinfo['user_name']; ?>" name="user_name" title="Saisir 1 caractères au minimum" required>                      
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2  col-sm-3 col-xs-12 control-label">Email</label>
                            <div class="col-md-10 col-sm-9 col-xs-12">
                                <input type="email" class="form-control" value="<?php echo $userinfo['user_email']; ?>" name="user_email" title="Saisir 1 caractères au minimum" required>
                                <p class="help-block">Ceci est l'email lié au compte </p>
                            </div>
                        </div>
                    </fieldset>
                    <hr>
                                        <fieldset class="fieldset">
                        <h3 class="fieldset-title">Modifier son mot de passe</h3>
                        <div class="form-group">
                            <label class="col-md-2 col-sm-3 col-xs-12 control-label">mot de passe</label>
                            <div class="col-md-10 col-sm-9 col-xs-12">
                                <input type="password" class="form-control" value="" name="user_password" title="Saisir 1 caractères au minimum">                          
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2  col-sm-3 col-xs-12 control-label">Confirmez votre mot de passe</label>
                            <div class="col-md-10 col-sm-9 col-xs-12">
                                <input type="password" class="form-control" value="" name="confirm_password" title="Saisir 1 caractères au minimum" >
                                <p class="help-block">Les mots de passes saisient doivent correspondre </p>
                            </div>
                        </div>
                    </fieldset>
                    <div class="form-group">
                        <div class="col-md-10 col-sm-9 col-xs-12 col-md-push-2 col-sm-push-3 col-xs-push-0">
                            <input class="btn btn-primary" type="submit" value="Mise a jour du profil">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <?php include_once '_fin.inc.php'; ?>
</div>
</div><!-- /container -->
