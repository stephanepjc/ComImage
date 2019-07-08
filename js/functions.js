//Apres que le document soit pret onlace les fonctions suivantes (tous en jquery)
$(document).ready(function() {
  // quand on clique dans le document sur un element '.select_categorie option' on lance la fonction
  $(document).on("click", ".select_categorie option", function () {
    //on recupere le parent de l element option choisis --> ici le conteneur <select>
    var $this= $(this).parent('.select_categorie');// this represente l objet lancant la fonction
    //on lance la fonction 'envoieDonneesCategorie' en passant la valeur de $this -> ici le conteneur <select>
    envoieDonneesCategorie($this);
  });
  // quand on clique dans le document sur un element '.select_sous_categorie option' on lance la fonction
  $(document).on("click", ".select_sous_categorie option", function () {
    //on recupere le parent de l element option choisis --> ici le conteneur <select>
    var $this= $(this).parent('.select_sous_categorie');
    //on lance la fonction 'envoieDonneesSousCategorie' en passant la valeur de $this -> ici le conteneur <select>
    envoieDonneesSousCategorie($this);
  });
  // quand on submit dans le document le formulaire avec l id: 'formulaire' on lance la fonction
  $(document).on("submit", "#formulaire", function (e) {
    // on arrete tout les fonctionnalité lié a un submit de formulaire
    e.preventDefault();
    //on recupere le formulaire dans la valeur $this
    var $this = $(this);
    //on lance la fonction envoieFormulaire
    envoieFormulaire($this);
  });

  // START -- CECI EST UN PLUS  POUR DELETE LES ELEMENTS DE LA LISTE
  $(document).on("click", ".delete_question", function (){
    var $this = $(this).parent('li');
    var idASupprimer = $(this).attr('data_id_question');
    supprimerDeLaListe(idASupprimer, $this);
  });
  // END   -- CECI EST UN PLUS POUR DELET LES ELEMENTS DE LA LISTE

});
//fin de la function jQuery ready



//Declaration de la fonction d envoie de donnees pour les categories
function envoieDonneesCategorie(categorieSelection){
      //on stock la valeur de l id envoyer pour la fonction dans une variable 'valeurCategorieSelection'
      var valeurCategorieSelection = $(categorieSelection).val();
      // on lance ajax en method post vers l url de fichier de traitement php avec les information (data) passer en variable directe
      $.ajax({
        method: "POST", // la methode post
        url: "php/functions.php", // le fichier de traitement
        data: { categorie: valeurCategorieSelection, step: 1 } // la variable a post et une variable pour verifier de quel fonction on a besoin (step : 1)
      }).done(function( msg ) {
        //une fois l envoie ajax fait avec accusé de reception (bon ou mauvais) on fait :
        // on recupere l information envoyer par le fichier de traitement php et on la place dans la variable 'msg'
        // la valeur retourné est supposé etre le tableau d option pour les sous categorie
        //celle-ci est supposé ressemblé a :
        // <option valeur="x">quelque chose</option>
        //on injecte en remplacant le contenu de l element suivant(le <select class="select_sous_categorie">) en utilisant la fonction jQuery next() et html() le nouveau contenu html
        $(categorieSelection).next().html(msg);
      });
}

//Declaration de la fonction d envoie de donnees sous categorie
function envoieDonneesSousCategorie(sousCategorieSelection){
  //on stock la valeur de l id envoyer pour la fonction dans une variable 'sousCategorieSelection'
      var valeurSousCategorieSelection = $(sousCategorieSelection).val();
      // on lance ajax en method post vers l url de fichier de traitement php avec les information (data) passer en variable directe
      $.ajax({
        method: "POST",// la methode post
        url: "php/functions.php",// le fichier de traitement
        data: { sousCategorie: valeurSousCategorieSelection, step: 2 }// la variable a post et une variable pour verifier de quel fonction on a besoin (step : 2)
      }).done(function( msg ) {
        //une fois l envoie ajax fait avec accusé de reception (bon ou mauvais) on fait :
        // on recupere l information envoyer par le fichier de traitement php et on la place dans la variable 'msg'
        // la valeur retourné est supposé etre le tag html <img /> avec les atribut rempli 'src' et 'alt'
        // celle-ci est supposé ressemblé a :
        // <img src="img/x.png" alt="x"/>
        //on injecte en remplacant le contenu de l element suivant(le <div class="image_resultat">) en utilisant la fonction jQuery next() et html() le nouveau contenu html
        $(sousCategorieSelection).next().html(msg);
      });
}

//Declaration de la fonction d envoie de donnees du formulaire complet en passant le formulaire et son contenu par la variable 'form'
function envoieFormulaire(form){
// on verifie que le formulaire a au moin la question qui est remplie
// pour cela on verifie simplement si la valeur de la question est est differente de ''
    var securityChecker1 = $('#question1').val();
    if (securityChecker1 == ''){
      //si c est vide on le signal mais on ne lance pas ajax
      alert('Le champs de la question doit etre rempli !! ');
    }
    else{
      //si c est remplie de plus de 1 lettre on lance ajax
      $.ajax({
        method: "POST", // la methode post
        url: "php/functions.php",//le fichier de traitement
        data: form.serialize(), // serializes le formulaire et place le formulaire entier en tant  que data
      }).done(function( msg ) {
        // une fois l envoie ajax fait avec accusé de reception (bon ou mauvais) on fait :
        // on recupere l information envoyer par le fichier de traitement php et on la place dans la variable 'msg'
        // la valeur retourné est supposé etre le tag html<li> avec les tag <span> rempli de leurs information
        // celle-ci est supposé ressemblé a :
        //<li><span>A</span><span>B</span><span>C</span><span>X</span></li>
        // On injecte a l aide de la fonction jQuery append() le contenu dans la liste (le principe de append est qu il inject sans remplacer le contenu)
        $('.block_list_question ul').append(msg);
      });
    }

}




//START -- CECI EST UN PLUS POUR SUPPRIMER UNE QUESTION DE LA LISTE ET LA TABLE DANS LA BASE DE DONNEES
function supprimerDeLaListe(idASupprimer, laLigne){
  //la fonction envoie en ajax l id a supprimer et la ligne en question a enlever de la page html de maniere interactive
  $.ajax({
    method: "POST",
    url: "php/functions.php",
    data:  { supprimer: idASupprimer }// id a supprimer
  }).done(function( msg ) {
    $(laLigne).remove(); // on enleve le tag html stocké dans la variable laLigne a l'aide de la fonction jQuery remove()
  });
}
// END CECI EST UN PLUS POUR SUPPRIMER UNE QUESTION DE LA LISTE ET LA TABLE DANS LA BASE DE DONNEES


