<?php
session_start();
include('bdd/config-bdd.php');

if (!isset($_SESSION['idusers'])){
    header('Location: index.php');
    exit;
}

// On récupère les informations de l'utilisateur connecté

//variable de connexion à la BDD
$dsn='mysql:dbname=xamaringestioncourse;host=127.0.0.1';
$user='root';
$password='';

//connexion à la BDD et catch des erreurs de connexion
$afficher_profil = $dsn->query("SELECT * FROM users WHERE idusers = ?",
    array($_SESSION['idusers']));
$afficher_profil = $afficher_profil->fetch();

if(!empty($_POST)){
    extract($_POST);
    $valid = true;

    if (isset($_POST['modification'])){
        $nom =$_POST['firstname'];
        $prenom =$_POST['lastname'];
        $mail =$_POST['email'];
        $password =$_POST['password'];

        $nom = htmlentities(trim($nom));
        $prenom = htmlentities(trim($prenom));
        $mail = htmlentities(strtolower(trim($mail)));
        $password = htmlentities(strtolower(trim($password)));

        if(empty($nom)){
            $valid = false;
            $er_nom = "Il faut mettre un nom";
        }

        if(empty($prenom)){
            $valid = false;
            $er_prenom = "Il faut mettre un prénom";
        }

        if(empty($password)){
            $valid = false;
            $er_password = "Il faut mettre un mot de passe";
        }

        if(empty($mail)){
            $valid = false;
            $er_mail = "Il faut mettre un mail";

        }elseif(!preg_match("/^[a-z0-9\-_.]+@[a-z]+\.[a-z]{2,3}$/i", $mail)){
            $valid = false;
            $er_mail = "Le mail n'est pas valide";

        }else{
            $req_mail = $dsn->query("SELECT email FROM users WHERE email = ?",
                array($mail));
            $req_mail = $req_mail->fetch();

            if ($req_mail['email'] <> "" && $_SESSION['email'] != $req_mail['email']){
                $valid = false;
                $er_mail = "Ce mail existe déjà";
            }
        }

        if ($valid){
            $dsn->insert("UPDATE users SET Prenom = ?, Nom = ?, email = ?, password = ?  WHERE idusers = ?",
                array($prenom, $nom,$mail, $password,$_SESSION['id']));
            $_SESSION['nom'] = $nom;
            $_SESSION['prenom'] = $prenom;
            $_SESSION['email'] = $mail;
            $_SESSION['password'] = $mail;
            header('Location:  profil.php');
            exit;
        }
    }
}


