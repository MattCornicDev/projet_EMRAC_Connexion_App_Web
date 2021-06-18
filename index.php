<?php
session_start();
//on verifie si une session existe
//si formulaire posté et non vide
if (isset($_POST) && !empty($_POST)) {
    $email = $_POST['email'];
    $password = $_POST['password'];


    if (!empty($email)  && !empty($password) ) {

        //si login valide et email valide et mot de passe valide et mot mot de passe identique à sa confirmation,  on essaie de se connecter à la BDD

        require 'inc/config-bdd.php';

        //On essaie de se connecter à la BDD
        try {
            $conn = new PDO($dsn, $user, $pass);
            //On définit le mode d'erreur de PDO sur Exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            //vérification en base de données
            $verifbdd=$conn->prepare("SELECT email, pseudo, password  FROM users WHERE email= ?");
            $verifbdd->execute(array("$email"));
            $resultat=$verifbdd->fetch();


            if (strlen($resultat['email']) != 0){
                // si le mail entré et le mail de la requête résultat sont identique et
                // si le password entré transformé en hash et le password de la requête résultat sont identique
                if (($email === $resultat['email']) && (password_verify($password,$resultat['password']))){

                    // enregistre le mail comme variable de session
                    $_SESSION['email']=$email;
                    // enregistre le mdp comme variable de session
                    $_SESSION['password']=$password;
                    // enregistre le pseudo comme variable de session
                    $_SESSION['pseudo']=$resultat['pseudo'];
                    header('location: appli.php');
                }else echo "le mot de passe associé à cet identifiant est incorrecte";
            }
            else{
                echo "identifiant et (ou) mot de passe incorrect";
            }


            /*$resultat = $verifbdd->rowCount();*/

            //si le login est déjà connu en base de données car la variable est pleine

            /*$requete=$conn->prepare("INSERT INTO user (login,password,email,date_inscription) VALUES (?,?,?,?)");
            $passwordmasque=password_hash("$password",PASSWORD_DEFAULT);
            $requete->execute(array("$login","$passwordmasque","$email",'2020-03-02 13:00:00'));*/


        }
        catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
        //ferme la connexion à la base de donnée
        $conn = null;

        // applique ci-dessous si au moins un des champs du formulaire est vide
    } else {
        if (empty($email)) {
            ?>
            <div style="color: red;text-align: center" xmlns="http://www.w3.org/1999/html"><?php echo "veuillez compléter le champs Email <br/>"; ?></div><?php
        }

        if (empty($password)) {
            ?> <div style="color: red;text-align: center"><?php echo "veuillez compléter le champs password <br/>";?></div><?php
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
    <link rel="stylesheet" href="css/OnOffSwitch.css">
</head>
<body>



<main style="height: 15vh">
    <div class="mt-4 d-flex justify-content-center">
        <img src="images/logo.png" alt="patte-ours" width="72" height="57">
        <img src="images/titreLogo.png" height="100" width="300" alt="logo-titre"/>
    </div>
</main>

<div class="container h-100">

    <div class="row h-100 justify-content-center align-items-center">

        <form id="cadre_interne" action="" method="post" class="needs-validation border border border-dark " style="height: 600px; width: 500px; background-color: #005a9e;" novalidate>
            <h2 class="text-center mt-2 mb-5 text-white">S'authentifier</h2>

            <!--    on/off-->
            <div class="row col-12">
                <p class="col-9"></p>
                <div class="onoffswitch col-3" id="positionSwitch">
                    <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch" tabindex="0" checked>
                    <label class="onoffswitch-label" for="myonoffswitch">
                        <span class="onoffswitch-inner"></span>
                        <!--               <span class="onoffswitch-switch"></span>-->
                    </label>
                </div>
            </div>


            <div class="form-group d-flex flex-column align-items-center mt-3" >
                <div class="col-md-8">
                    <label for="email" class="text-white">Email :</label>
                    <input type="text" class="form-control border border-dark" id="email" name="email" value="<?php if (isset($email)){echo $email;}?>" placeholder="exemple@gmail.com" minlength="6" maxlength="15" required>
                    <div class="invalid-feedback text-center">
                        Merci de compléter le champ pseudo.
                    </div>
                </div>
                <div class="col-md-8">
                    <label for="password" class="text-white">Mot de passe :</label>
                    <input type="password" class="form-control border border-dark" id="password" name="password" value="<?php if (isset($password)){echo $password;}?>" minlength="8" maxlength="15" required>
                    <div class="invalid-feedback text-center">
                        Merci de compléter le champ mot de passe.
                    </div>
                </div>
            </div>
            <div class="text-center mb-2">
                <a href="motDePasse.php" class="text-white">Mot de passe oublié ?</a>
            </div>

            <div class="text-center mt-4">
                <button type="submit" id="form-submit" class="btn btn-primary btn-lg pull-right bg-white text-dark border border-dark">Connexion</button>
            </div>

            <!--    <div class="text-center mt-5 d-flex ">-->

            <p class="text-white d-flex justify-content-left ml-3 mt-5">Pas encore inscrit ?</p>
            <a class="btn btn-primary btn-lg bg-white text-dark border border-dark justify-content-left ml-3" href="inscription.php" role="button">S'inscrire</a>
            <!--    </div>-->
        </form>
    </div></div>

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
<script src="Javascript/index.js"></script>
</body>
</html>
