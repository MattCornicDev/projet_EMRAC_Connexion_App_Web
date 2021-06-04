<?php
session_start();
if(!isset($_SESSION['pseudo'])){
    header('location: index.php');
}else{
    if(empty($_SESSION['pseudo'])){
        header('location: index.php');
    }else{
        $pseudo = $_SESSION['pseudo'];
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>emrac-connexion</title>
    <link href="css/main.css" rel="stylesheet">
</head>
<body>
<header>
    <h1>Bienvenue <?php echo $pseudo; ?> sur l'application de communication EMRAC connexion</h1>
</header>
<section>
    <div id="contacts">

    </div>
    <div id="messages">

    </div>
</section>
</body>
</html>