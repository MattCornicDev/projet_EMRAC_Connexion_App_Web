<?php
//session_start();
//if(!isset($_SESSION['pseudo'])){
//    header('location: index.php');
//}else{
//    if(empty($_SESSION['pseudo'])){
//        header('location: index.php');
//    }else{
//        $pseudo = $_SESSION['pseudo'];
//    }
//}
//?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <title>Emrac</title>

    <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="lib/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="css/zabuto_calendar.css">
    <link rel="stylesheet" type="text/css" href="lib/gritter/css/jquery.gritter.css" />
    <link href="css/style.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet">
    <script src="lib/chart-master/Chart.js"></script>
</head>

<body>
<section id="container">

    <header class="header black-bg" >
<!--        Photo de profil en lien vers la page profil -->
        <div class=" col-lg-1 pull-left">
            <img src="images/profil.png" href="" class="img-circle" style="width: 50px; margin-top: 5px">
            <a href="" class="">Pseudo</a>
        </div>

        <div class="sidebar-toggle-box pull-right">
            <div class="fa fa-bars tooltips" data-placement="right"></div>
        </div>

        <div class="nav notify-row">
            <ul class="nav top-menu">
                <li class="dropdown">
                    <a data-toggle="dropdown">
                        <i> Messagerie</i>
                    </a>
                    <ul class="dropdown-menu extended tasks-bar">
                        <li>
                            <p class="green">Bienvenue sur votre messagerie</p>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>

        <div class="top-menu">
            <ul class="nav pull-right top-menu">
                <li><a class="logout" href="index.php">Se déconnecter</a></li>
            </ul>
        </div>
    </header>

    <aside>
        <div id="sidebar" class="nav-collapse">
            <ul class="sidebar-menu" id="nav-accordion">
                <p class="centered"><a href=""><img src="images/logo.png" class="img-circle" width="60"></a></p>
                <h4 class="centered">Mon espace personnel</h4>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-desktop"></i>
                        <span>Mes contacts</span>
                    </a>
                    <ul class="sub">
                        <li><a href="">Contact 1</a></li>
                        <li><a href="">Contact 2</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Mes groupes</span>
                    </a>
                    <ul class="sub">
                        <li><a href="">Groupe 1</a></li>
                        <li><a href="">Groupe 2</a></li>
                    </ul>
                </li>
                <li>
                    <a href="">
                        <i class="fa fa-envelope"></i>
                        <span>Mon profil</span>
                    </a>
                </li>

            </ul>
        </div>
    </aside>

    <section id="main-content">
        <section class="wrapper">
            <div>
                <div class="col-lg-9 main-chart">

                    <h3>Partie messagerie</h3>

                    <form action="chat_post.php" method="post" class="main-chart" >
                        <div class="form-group main-chart">
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Conversation</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="30"></textarea>
                            </div>
                            <input type="text" class="form-control"  name="message" id="message" placeholder="Saisissez votre message ...">
                            <br/>
                            <button type="submit" class="btn btn-primary center-block">Envoyer</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </section>

</section>


<script src="lib/jquery/jquery.min.js"></script>

<script src="lib/bootstrap/js/bootstrap.min.js"></script>
<script class="include" type="text/javascript" src="lib/jquery.dcjqaccordion.2.7.js"></script>
<script src="lib/jquery.scrollTo.min.js"></script>
<script src="lib/jquery.nicescroll.js" type="text/javascript"></script>
<script src="lib/jquery.sparkline.js"></script>
<!--common script for all pages-->
<script src="lib/common-scripts.js"></script>
<script type="text/javascript" src="lib/gritter/js/jquery.gritter.js"></script>
<script type="text/javascript" src="lib/gritter-conf.js"></script>
<!--script for this page-->
<script src="lib/sparkline-chart.js"></script>
<script src="lib/zabuto_calendar.js"></script>

<script type="application/javascript">
    $(document).ready(function() {
        $("#date-popover").popover({
            html: true,
            trigger: "manual"
        });
        $("#date-popover").hide();
        $("#date-popover").click(function(e) {
            $(this).hide();
        });

        $("#my-calendar").zabuto_calendar({
            action: function() {
                return myDateFunction(this.id, false);
            },
            action_nav: function() {
                return myNavFunction(this.id);
            },
            ajax: {
                url: "show_data.php?action=1",
                modal: true
            },
            legend: [{
                type: "text",
                label: "Special event",
                badge: "00"
            },
                {
                    type: "block",
                    label: "Regular event",
                }
            ]
        });
    });

    function myNavFunction(id) {
        $("#date-popover").hide();
        var nav = $("#" + id).data("navigation");
        var to = $("#" + id).data("to");
        console.log('nav ' + nav + ' to: ' + to.month + '/' + to.year);
    }
</script>
</body>

</html>