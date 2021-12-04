<?php
session_start();
require 'inc/fonction.php';
//si formulaire posté et non vide
if (isset($_POST) && !empty($_POST)) {
    $pseudo = $_POST['pseudo'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmepassword = $_POST['confirmepassword'];

    if (!empty($pseudo) && !empty($email) && !empty($password) && !empty($confirmepassword)) {
        if ((checkInput('#^\w{6,12}$#',$pseudo)) && (checkInput('#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#',$email)) &&
            (checkInput('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).{8,15}$#',$password)) && ($password === $confirmepassword)){
            //si login valide et email valide et mot de passe valide et mot mot de passe identique à sa confirmation,  on essaie de se connecter à la BDD

            require 'inc/config-bdd.php';

            if(!empty($_POST['nom'])){
                $nom = $_POST['nom'];
            }else{
                $nom = "NULL";
            }

            if(!empty($_POST['prenom'])){
                $prenom = $_POST['prenom'];
            }else{
                $prenom = "NULL";
            }

            //On essaie de se connecter à la BDD
            try {
                $conn = new PDO($dsn, $user, $pass);
                //On définit le mode d'erreur de PDO sur Exception
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


                //vérification en base de données
                $verifbdd=$conn->prepare("SELECT email FROM users WHERE email= ?");
                $verifbdd->execute(array("$email"));
                $resultat = $verifbdd->rowCount();

                //si le login est déjà connu en base de données car la variable est pleine
                if ($resultat){
                    ?><div style="color: red; text-align: center"> <?php echo "attention l'email est déjà utilisé, veuillez en selectionner un autre <br>";?></div><?php
                }
                else{
                    ?><div style="color: green; text-align: center"> <?php echo "le login est disponible <br>";?></div><?php
                    //requete d'insertion de code en bdd
                    $requete=$conn->prepare("INSERT INTO users (pseudo, Prenom, Nom, password, email) VALUES (?,?,?,?,?)");
                    $passwordmasque=password_hash("$password",PASSWORD_DEFAULT);
                    $requete->execute(array("$pseudo", "$prenom", "$nom", "$passwordmasque", "$email"));
                    // enregistre le login comme variable de session
                    $_SESSION['pseudo']=$pseudo;
                    // enregistre le mdp comme variable de session
                    //$_SESSION['password']=$password;
                    header('location: appli.php');
                }

            }
            catch (PDOException $e) {
                echo "Erreur : " . $e->getMessage();
            }
            //ferme la connexion à la base de donnée
            $conn = null;

        } else {

            //affiche le message si les critères de validation des inputs ne sont pas réunies
            if (!checkInput('#^\w{6,12}$#',$pseudo)) {
                ?><div style="text-align: center; color:red"><?php echo("le speudo ne doit comporter que des caractéres alphanumérique"); ?></div><?php
            }
            if (!checkInput('#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#',$email)){
                ?><div style="text-align: center; color:red"><?php echo("Merci de saisir un email valide"); ?></div><?php
            }
            if(!checkInput('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).{8,15}$#',$password)){
                ?><div style="text-align: center; color:red"><?php echo("mot de passe incorrect, il doit oligatoirement comporter une majuscule, une minuscule, un chifre et un caractère spéciale"); ?></div><?php
            }
            if($password != $confirmepassword){
                ?><div style="text-align: center; color:red"><?php echo("confirmation du mot de passe incorrect, il doit obligatoirement être identique au mot de passe"); ?></div><?php
            }

        }
        // applique ci-dessous si au moins un des champs du formulaire est vide
    } else {
        if (empty($pseudo)) {
            ?> <div style="color: red;text-align: center"><?php echo "veuillez compléter le champs pseudo <br/>"; ?></div><?php
        }
        if (empty($email)) {
            ?> <div style="color: red;text-align: center"><?php echo "veuillez compléter le champs email <br/>";?></div><?php
        }
        if (empty($password)) {
            ?> <div style="color: red;text-align: center"><?php echo "veuillez compléter le champs password <br/>";?></div><?php
        }
        if (empty($confirmepassword)){
            ?> <div style="color: red;text-align: center"><?php echo "veuillez compléter le champs confirmer le mot de passe <br/>";?></div><?php
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>

    <main style="height: 10vh">
            <div class="mt-4 d-flex justify-content-center">
                <img src="images/logo.png" alt="patte-ours" width="72" height="57">
                <img src="images/titreLogo.png" height="100" width="300" alt="logo-titre"/>
            </div>
    </main>

    <div class="container h-100">

     <div class="row h-100 justify-content-center align-items-center">


    <form action="" method="post" class="needs-validation border border border-dark" style="height: 835px; width: 500px; background-color: #005a9e;" novalidate>
        <h2 class="text-center mt-2 mb-3 text-white">Page d'inscription</h2>
        <h6 class="text-center text-white mb-4">Créer votre profil</h6>
        <div class="form-group d-flex flex-column align-items-center mt-2" >
            <div class="col-md-8">
                <label for="email" class="text-white">Email*: </label>
                <input type="email" class="form-control" name="email" id="email" value="<?php if (isset($email)){echo $email;}?>" placeholder="email" required/>
                <div class="invalid-feedback text-center">
                    Merci de mettre un email valide.
                </div>
            </div>
            <div class="col-md-8">
                <label for="pseudo" class="text-white">Pseudo*: (entre 6  et 12 caractères)</label>
                <input type="text" class="form-control" id="pseudo" name="pseudo" value="<?php if (isset($pseudo)){echo $pseudo;}?>" placeholder="Pseudo" minlength="6" maxlength="12" required/>
                <div class="invalid-feedback text-center">
                    Merci de mettre un pseudo valide.
                </div>
            </div>
            <div class="col-md-8">
                <label for="nom" class="text-white">Nom :</label>
                <input type="text" class="form-control" id="nom" name="nom" minlength="8" maxlength="15" placeholder="Nom" />
                <div class="invalid-feedback text-center">
                </div>
            </div>
            <div class="col-md-8">
                <label for="nom" class="text-white">Prénom :</label>
                <input type="text" class="form-control" id="prenom" name="prenom" minlength="8" maxlength="15" placeholder="Prénom"/>
                <div class="invalid-feedback text-center">
                </div>
            </div>
            <div class="col-md-8">
                <label for="password" class="text-white">Mot de passe*:</label>
                <input type="password" class="form-control" id="password" name="password" minlength="8" maxlength="15" required/>
                <div class="invalid-feedback text-center">
                    Le mot de passe et sa confirmation doivent être identiques.
                </div>
            </div>
            <div class="col-md-8">
                <label for="confirmepassword" class="text-white">Confirmer le mot de passe*:</label>
                <input type="password" class="form-control" id="confirmepassword" name="confirmepassword" minlength="8" maxlength="15" required/>
                <div class="invalid-feedback text-center">
                    Le mot de passe et sa confirmation doivent être identiques.
                </div>
            </div>
            <div class="col-md-8 mt-1">
                <label for="formFile" class="form-label text-white">Photo : </label>
                <input type="file" id="fichier" name="fichier" style="color: #FFFFFF" >
                <p>* Champs obligatoires</p>
            </div>


        </div>
        <div class="d-flex justify-content-center">
        <button type="submit" id="form-submit" class="btn btn-primary btn-lg pull-right bg-white text-dark" >S'inscrire</button>
        </div>

        <div class="text-center mt-4 ">
            Déjà inscrit ? <a class="text-white text-center mt-5" href="index.php" role="button">M'identifier</a>
        </div>
    </form>

            <br/><br/>


    <script>  //script bootstrap pour formulaire
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>

</body>
</html>