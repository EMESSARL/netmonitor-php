<?php
    include('includes/connexion.php');
    $reqMoyenneDownloads=$connexion->prepare("SELECT AVG(downloads.debit) AS moyenneDownloads,AVG(uploads.debit) AS moyenneUploads, AVG( downloads.minRTT + uploads.minRTT ) AS rtt, AVG( downloads.lostRate + uploads.lostRate ) AS rate FROM downloads, uploads");
    $reqMoyenneDownloads->execute();
    $resMoyenneDownloads = $reqMoyenneDownloads->fetch();
    
    //requètes suivants les asn
    $reqASN1= $connexion->prepare("SELECT DISTINCT asn FROM downloads ORDER BY asn");
    $reqASN1->execute();
    //requètes des graphes 
    
?>
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
    <div class="header-base" style="padding-top:10px;padding-bottom:0px;">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <div class="title-base text-left">
                        <h1>Visualisation des données par ASN</h1>
                        <p>Cette Visualisation des données de mesure de l'état de la connexion au Bénin suivant chaque ASN est basée sur les données de mesure collectées par M-Labs et recupérées directement depuis BigQuery.</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <ol class="breadcrumb b white">
                        <li><a href="index.php">Accueil</a></li>
                        <li href="data-views-mlab.php">data-views-mlab</li>
                        <li class="active">data-views-mlab-asn</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="section-bg-image bg-top" style="background-image:url(../images/bg-17.png);">
        <div class="container"  style="padding-top:50px;">
            <div class="row" style="margin-top:00px;">
                <div class="col-md-12 col-center text-center" >
                    <h2 style="font-family: 'Times New Roman', Times, serif;">Mesure suivant les ASN (Réseaux)</h2>
                    <hr class="space" />
                </div>
                
            <div class="row">
                <?php
                    
                    while ($resASN1 = $reqASN1->fetch()){
                        $asn=$resASN1['asn'];
                        $reqDeb1= $connexion->prepare('SELECT AVG(downloads.debit) AS moyenneDownParASN, AVG(downloads.minRTT) AS moyenneDownRTT, AVG(uploads.minRTT) AS moyenneUpRTT , AVG(uploads.debit) AS moyenneUpParASN , nom FROM downloads, uploads, asn WHERE asn.id=downloads.asn AND asn.id=uploads.asn AND asn.id='.$asn);
                        $reqDeb1->execute();
                        $resDeb1=$reqDeb1->fetch();
                ?>
                <div class="col-md-4" style="margin-bottom:20px;">
                    <ul class="list-texts list-texts-justified text-left">
                        <li><b>Numéro d'ASN :</b>   <span>AS<?php echo $resASN1['asn']; ?></span></li>
                        <li><b>Nom ASN :</b>   <span><?php echo $resDeb1['nom']; ?></span></li>
                        <li><b>Moyenne Download Speed :</b> <span><?php echo $resDeb1['moyenneDownParASN'] ?></span></li>
                        <li><b>Moyenne Upload Speed :</b> <span><?php echo $resDeb1['moyenneUpParASN'] ?></span></li>
                        <li><b>Moyenne RTT:</b>   <span><?php echo $resRTT= (($resDeb1['moyenneDownRTT']+$resDeb1['moyenneUpRTT'])/2);  ?></span></li>
                        <li><b>En savoir plus :</b>   <span><a href="data-views-mlab-asn-details.php?asn=<?php echo $resASN1['asn']; ?>" style="color:red;">Voir Détail</a></span></li>
                    </ul>
                </div>
                <?php } ?>
            </div>
            </div>
            <hr class="space" />
        </div>
    </div>
    
    
    <!-- ici repose le footer.. Ameen-->
    <?php include('includes/footer.php'); ?>
    <!-- ici repose le footer.. Ameen-->
</body>
</html>