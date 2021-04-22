<!DOCTYPE html>

<html lang="fr">
<!-- ici repose le header -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BIM - Data Views</title>
    <meta name="description" content="Multipurpose HTML template.">
    <script src="../HTWF/scripts/jquery.min.js"></script>
    <link rel="stylesheet" href="../HTWF/scripts/bootstrap/css/bootstrap.css">
    <script src="../HTWF/scripts/script.js"></script>
    <link rel="stylesheet" href="../HTWF/style.css">
    <link rel="stylesheet" href="../HTWF/css/content-box.css">
    <link rel="stylesheet" href="../HTWF/css/image-box.css">
    <link rel="stylesheet" href="../HTWF/css/animations.css">
    <link rel="stylesheet" href="../HTWF/css/components.css">
    <link rel="stylesheet" href="../HTWF/scripts/flexslider/flexslider.css">
    <link rel="stylesheet" href="../HTWF/scripts/magnific-popup.css">
    <link rel="stylesheet" href="../HTWF/scripts/php/contact-form.css">
    <link rel="stylesheet" href="../HTWF/scripts/social.stream.css">
    <link rel="icon" href="../images/favicon.png">
    <link rel="stylesheet" href="../skin.css">
</head>
<!-- fin repose le header -->

<body class="transparent-header">
<div id="preloader"></div>
    <header class="fixed-top scroll-change" data-menu-anima="fade-bottom">
        <div class="navbar navbar-default mega-menu-fullwidth navbar-fixed-top" role="navigation">
            <div class="navbar navbar-main">
                <div class="container">
                    <!-- ici repose l'entete du site -->
                    <?php include('includes/entete.php'); ?>
                    <!-- fin entete du site -->
                </div>
            </div>
        </div>
    </header>
    <div class="section-bg-image bg-top" style="background-image:url(../images/long-1.jpg)">
        <div class="container content">
            <div class="row">
                <div class="col-md-10 col-center text-center" data-anima="fade-in" data-time="1000">
                    <hr class="space m" />
                    <h1>Visualisation des indicateurs de Performance d'Internet</h1>
                    <hr class="space" />
                    <a href="data-views-mlab.php" class="circle-button btn btn-lg shadow-1">Statistiques suivant M-Lab</a><span class="space"></span>
                    <a href="#" class="circle-button btn btn-border btn-lg"><i class="fa fa-play"></i>Statistiques suivant RIPE-Atlas</a>
                </div>
            </div>
            <hr class="space" />
            <div class="row vertical-row">
                <div class="col-md-6">
                    <img src="../images/box-1.png" alt="" data-anima="fade-left" data-time="1000" />
                </div>
                <div class="col-md-6">
                    <h4>Statistiques suivant Measurement Lab</h4>
                    <p>
                        M-Lab est un Projet Open Source avec des contributeurs de la société civile, d'etablissement d'enseignement et d'entreprise privé qui a pour but de fournir une plateforme de mesure
                        ouverte et vérifiable pour les performances du reseau Internet Mondial et permettre à tout le monde de pouvoir visualisé l'ensemble des données de performance.
                    </p>
                    <a href="#" class="circle-button btn btn-sm">Visualisation des données du Bénin</a>
                </div>
            </div>
            <hr class="space" />
        </div>
    </div>
    <div class="section-bg-image bg-top" style="background-image:url(../images/long-2.jpg)">
    <div class="container content">
        <div class="row vertical-row">
            <div class="col-md-6">
                <h4>Statistiques suivant RIPE-Atlas</h4>
                <p>
                RIPE Atlas est le principal système de collecte de données Internet de RIPE NCC. Il s'agit d'un réseau mondial d'appareils, appelés sondes, qui mesurent activement la connectivité Internet. 
                Tout le monde peut accéder à ces données via des cartes de trafic Internet, des visualisations de données en continu. Les utilisateurs de RIPE Atlas peuvent également effectuer des mesures 
                personnalisées pour obtenir des données précieuses sur leurs propres réseaux.
                </p>
                <hr class="space s" />
                <a href="#" class="circle-button btn btn-sm">Visualisation des données du Bénin</a><span class="space"></span>
                <a href="#" class="circle-button btn btn-border btn-sm">En savoir plus</a>
            </div>
            <div class="col-md-6">
                <img src="../images/box-2.png" alt="" data-anima="fade-right" data-time="1000" />
            </div>
        </div>
    </div>
    
    
    <!-- ici repose le footer.. Ameen-->
    <?php include('includes/footer.php'); ?>
    <!-- ici repose le footer.. Ameen-->
</body>
</html>