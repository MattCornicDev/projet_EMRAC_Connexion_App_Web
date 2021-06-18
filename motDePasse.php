

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


        <form action="" method="post" class="needs-validation border border border-dark mt-5" style="height: 400px; width: 500px; background-color: #005a9e;" novalidate>
            <h2 class="text-center mt-2 mb-3 text-white">Mot de passe oublié ?</h2>
            <br>
            <div class="form-group d-flex flex-column align-items-center mt-2" >
                <div class="col-md-10">
                    <label for="email" class="text-white">Entrez votre adresse mail d'inscription : </label>
                    <input type="email" class="form-control" name="email" id="email" value="<?php if (isset($email)){echo $email;}?>" required/>
                    <div class="invalid-feedback text-center">
                        Merci de mettre un email valide.
                    </div>
                </div>
            </div>
            <br>
            <div class="d-flex justify-content-center">
                <button type="submit" id="form-submit" class="btn btn-primary btn-lg pull-right bg-white text-dark" >Valider</button>
            </div>
                <div class="text-left ml-3 mt-5"> <a class="btn btn-primary btn-lg bg-white text-dark border border-dark justify-content-left ml-3" href="index.php" role="button">Retour</a>
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
