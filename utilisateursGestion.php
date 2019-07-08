<?php
include_once '_debut.inc.php';

if(isset($_GET['id']) AND $_GET['id'] > 0) {
   $getid = intval($_GET['id']);
   $requser = $pdo->prepare('SELECT * FROM user WHERE user_id = ?');
   $requser->execute(array($getid));
   $userinfo = $requser->fetch();
}
   ?>
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
<!--                             <label class="label label-info">UX Designer</label> -->
                        </li>
                        <li class="email"><a href="#"><?php echo $_SESSION["user_email"]?></a></li>
<!--                         <li class="activity">Last logged in: Today at 2:18pm</li> -->
                    </ul>
                </div>
                <nav class="side-menu">
                    <ul class="nav">
                        <li class="active"><a href="#"><span class="fa fa-user"></span> Profil</a></li>
<!--                         <li><a href="utilisateurModification.php?id=<?php echo $_SESSION["user_id"]?>"><span class="fa fa-cog"></span> Modification de profil</a></li> -->
                        <li ><a href="questionsGestion.php?id=<?php echo $_SESSION["user_id"]?>"><span class="fa fa-user"></span> Gestion des questions</a></li>
<!--                         <li ><a href="questionCreation.php?id=<?php echo $_SESSION["user_id"]?>"><span class="fa fa-user"></span> Ajouter une Question</a></li> -->                                         
                    </ul>
                    <img src="img/comImage.png" class="img-responsive" alt="Responsive image">
                </nav>
            </div>
</br>
</br>
</br>
            <div class="content-panel">
                <h2 class="title">Profile de <?php echo $userinfo['user_name'];?><span class="pro-label label label-warning"> TEST</span></h2>
                <form class="form-horizontal">
                    <fieldset class="fieldset">
                        <!-- <h3 class="fieldset-title">Bonjour</h3> -->
                        <div class="form-group avatar">
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 col-sm-3 col-xs-12 control-label">Nom</label>
                            <div class="col-md-10 col-sm-9 col-xs-12">
                                <span class="form-control"> <?php echo $userinfo['user_name']; ?></span>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="fieldset">
                        <h3 class="fieldset-title">Information contact</h3>
                        <div class="form-group">
                            <label class="col-md-2  col-sm-3 col-xs-12 control-label">Email</label>
                            <div class="col-md-10 col-sm-9 col-xs-12">
                                <span class="form-control"> <?php echo $userinfo['user_email']; ?></span>
                                <p class="help-block">Ce mail est lié au compte </p>
                            </div>
                        </div>
                    </fieldset>
                    <hr>
                                        <div class="form-group">
                        <div class="col-md-10 col-sm-9 col-xs-12 col-md-push-2 col-sm-push-3 col-xs-push-0">
                            <a href="utilisateurModification.php?id=<?php echo $_SESSION["user_id"]?>"><input class="btn btn-primary" type="button" value="Modifier son profil"></a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <?php include_once '_fin.inc.php'; ?>
</div>
</div><!-- /container -->