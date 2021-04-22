<!DOCTYPE html>

<html lang="fr">
<!-- ici repose le header -->
<?php include('includes/header.php') ?>
<!-- fin repose le header -->

<body class="transparent-header">
    <div id="preloader"></div>
    <header class="fixed-top scroll-change bg-transparent menu-transparent" data-menu-anima="fade-bottom">
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
    <div style="padding-top: 130px;" class="section-bg-image parallax-window text-center section-middle-img" data-natural-height="1080" data-natural-width="1920" data-parallax="scroll" data-image-src="../images/hd-2.jpg">
        <div class="container content">
            <hr class="space" />
            <h1 class="white">Plateforme de mesure des indicateurs de la connexion internet au BENIN</h1>
            <p class="text-l">Tester l'état de votre connexion internet maintenant</p>
            <hr class="space" />
            <a href="#" class="circle-button btn btn-lg">Lancer un Test</a>
            <hr class="space s" />
        </div>
    </div>
    <div class="section-empty">
        <div class="container content">
            <div class="row">
                <div class="col-md-4">
                    <div class="advs-box advs-box-top-icon" data-anima="scale-up" data-trigger="hover">
                        <i class="fa fa-pie-chart icon circle anima"></i>
                        <h3>Etat de la Connectivité d'internet</h3>
                        <p>
                            Consulter les Statistiques montrant l'état de la connexion internet au Bénin suivant les différents Fournisseurs d'Accès Internet (FAI).
                        </p>
                        <a href="data-views.php" class="circle-button btn-border btn btn-lg">Consulter Maintenant</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="advs-box advs-box-top-icon" data-anima="scale-up" data-trigger="hover">
                        <i class="fa fa-podcast icon circle anima"></i>
                        <h3>Les Autonomous System Numbers (ASN)</h3>
                        <p>
                            En Français "Système Autonome", est un ensemble de réseaux informatique IP intégré à Internet et dont le contrôle est géré par une organisation unique telle que les FAI. 
                        </p>
                        <a href="#" class="circle-button btn-border btn btn-lg">Consulter Maintenant</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="advs-box advs-box-top-icon" data-anima="scale-up" data-trigger="hover">
                        <i class="fa fa-file-zip-o icon circle anima"></i>
                        <h3>Statistiques des sites sous Régistrat ".bj"</h3>
                        <p>
                            Présentation de la liste de tout les sites internets sous registrats .bj leurs adresses IP, la localisation des serveurs d'hebergement etc...
                        </p>
                        <a href="#" class="circle-button btn-border btn btn-lg">Consulter Maintenant</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="section-bg-image bg-top no-paddings-y" style="background-image: url(../images/bg-gradient.png)">
        
    </div>
    <div style="padding-top: 80px;" class="section-bg-image parallax-window white" data-natural-height="1080" data-natural-width="1920" data-parallax="scroll" data-image-src="../images/hd-1.jpg">
        <div class="container content">
            <div class="row">
                <div class="col-md-7">
                    <img src="../images/box-2.png" alt="" />
                </div>
                <div class="col-md-5">
                    <div class="flexslider slider visible-dir-nav nav-bottom-left" data-options="controlNav:false,directionNav:true">
                        <ul class="slides">
                            <li>
                                <h2>Mesure d'Internet</h2>
                                <p>Le Download Speed est la vitesse de téléchargement de données entre un serveur et le client durant un laps de temps.</p>
                                <p>Le Upload Speed est la vitesse de televersement de données enntre un serveur et le client durant un temps déterminé. </p>
                            </li>
                            <li>
                                <h2>Mesure d'Internet</h2>
                                <p>Le Round Trip Time (RTT) est le temps en milisecondes (ms) nécessaire pour qu'une requête réseau passe d'un point de départ vers une destination et retourne au point de départ. </p>
                                <p> RTT est une métrique importante pour déterminer l'état de santé d'une connexion sur un réseau local ou sur Internet, et est couramment utilisé pour diagnostiquer la vitesse et la fiabilité des connexions réseau. </p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="section-bg-image bg-bottom text-center" style="background-image: url(../images/hd-3.jpg)">
        <div class="container content">
            <div class="row">
                <div class="col-md-10 col-center">
                    <h2>Plateforme de Mesure d'Internet</h2>
                    <p>
                        Nos données sont basées sur deux principaux plateforme de mesure dont Measurement Lab (MLab) et RIPE-Atlas de RIPE NCC.
                    </p>
                </div>
            </div>
            <hr class="space" />
            <div class="row">
                <div class="section-pins" style="height:300px">
                    
                    <div class="box-pin">
                        <h3>MEASUREMENT LAB</h3>
                        <p>
                            Mesurez Internet, enregistrez les données et rendez-le universellement accessible et utile.
                        </p>
                    </div>
                    <div class="box-pin box-pin-right">
                        <h3>RIPE-ATLAS</h3>
                        <p>
                            Nous développons RIPE Atlas en coopération avec la communauté Internet et nous voulons savoir ce que vous en pensezs.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- ici repose le footer.. Ameen-->
    <?php include('includes/footer.php'); ?>
    <!-- ici repose le footer.. Ameen-->
</body>
</html>
