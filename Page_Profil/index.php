<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="css/on-off-style.css">
    <link rel="stylesheet" href="css/style.css">

    <title>Profil</title>

</head>

<body class="d-flex">
    <div class="container">
    <main>
        <div class="py-5 d-flex justify-content-center">
            <img src="images/logo-emrac2.png" alt="patte-ours" width="72" height="57">
            <img src="images/logo-titre.png" height="100" width="300" alt="logo-titre"/>
        </div>

            <div class="border border-dark mx-auto" style="background-color: #005a9e; width: 1000px;">
                <h4 class="d-flex justify-content-center mb-3">Profil</h4>
                    <div class="d-flex justify-content-around">
                        <div class="justify-content-start">
                            <img src="images/profil_clair.png" alt="photo-profil" width="90" height="90">
                        </div>
                        <div class="justify-content-end flex-column">
                            <p>Pseudo</p>
                            <div class="onoffswitch">
                                <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch" tabindex="0" checked>
                                <label class="onoffswitch-label" for="myonoffswitch">
                                    <span class="onoffswitch-inner"></span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <form class="needs-validation mx-auto" style="width: 200px;" novalidate="">
                        <div class="col-md-12 d-flex flex-column justify-content-center">
                            <div class="col-12">
                                <label for="firstName" class="form-label">Nom </label>
                                <input type="text" class="form-control" id="firstName" placeholder="" value="" required="">
                                <div class="invalid-feedback">
                                    Le nom est requis !
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="lastName" class="form-label">Prénom </label>
                                <input type="text" class="form-control" id="lastName" placeholder="" value="" required="">
                                <div class="invalid-feedback">
                                    Le prénom est requis !
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" placeholder="you@example.com">
                                <div class="invalid-feedback">
                                    Merci de saisir une adresse email valide !
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="password" class="form-label">Mot de passe</label>
                                <input type="password" class="form-control" id="password" placeholder="" required="">
                                <div class="invalid-feedback">
                                   Mot de passe requis !
                                </div>
                            </div>

                            <button class="w-100 btn btn-lg" type="submit">Modifier les infos</button>
                            <button class="w-100 btn btn-lg" type="submit">Messagerie</button>
                        </div>


                    </form>
            </div>
    </main>

    <footer class="my-5 pt-5 text-muted text-center text-small">
        <p class="mb-1">© 2021 EMRAC CONNEXION TPCDA</p>
    </footer>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>

</body>
</html>
