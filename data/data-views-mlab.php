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
    <!--les graphiques-->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <script src="https://cdn.jsdelivr.net/npm/luxon@1.24.1"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.0-beta.3/dist/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-luxon@0.2.1"></script>
    <script src="includes/chartjs-chart-financial.js" type="text/javascript"></script>
    <!--les graphiques-->
    <link rel="stylesheet" href="../HTWF/style.css">
    <link rel="stylesheet" href="../HTWF/scripts/php/contact-form.css">
    <link rel="stylesheet" href="../HTWF/css/content-box.css">
    <link rel="stylesheet" href="../HTWF/scripts/magnific-popup.css">
    <link rel="stylesheet" href="../HTWF/css/animations.css">
    <link rel="stylesheet" href="../HTWF/scripts/jquery.bootgrid.css">
    <link rel="stylesheet" href="../HTWF/css/components.css">
    <link rel="icon" href="../images/favicon.png"><link rel="stylesheet" href="../skin.css">
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
    </div>
    <div class="header-base" style="padding-top:10px;padding-bottom:0px;">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <div class="title-base text-left">
                        <h1>Visualisation des Stats suivant M-Lab</h1>
                        <p>Cette Visualisation des données de mesure de l'état de la connexion au Bénin est basée sur les données de mesure collectées par M-Labs et recupérées directement depuis BigQuery.</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <ol class="breadcrumb b white">
                        <li><a href="index.php">Accueil</a></li>
                        <li class="active">data-views-mlab</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="section-bg-image bg-top" style="background-image:url(../images/bg-3.jpg);">
        <div class="container"  style="padding-top:50px;">
        <div class="row vertical-row">
                <div class="row">
                    <div class="col-md-3 boxed shadow-1 white">
                        <div class="icon-box icon-box-top-bottom">
                            <div class="icon-box-cell">
                                <i class="fa-cloud-upload fa text-xl"></i>
                            </div>
                            <div class="icon-box-cell">
                                <label class="text-m">Upload Speed</label>
                                <label class="text-m"><?php echo substr ($resMoyenneDownloads['moyenneUploads'],0,6); ?> Mbps</label>
                                <p class="text-s">Vitesse Moyenne de Téléversement</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 boxed shadow-1 white">
                        <div class="icon-box icon-box-top-bottom">
                            <div class="icon-box-cell">
                                <i class="fa-cloud-download fa text-xl"></i>
                            </div>
                            <div class="icon-box-cell">
                                <label class="text-m">download speed</label>
                                <label class="text-m"><?php echo substr($resMoyenneDownloads['moyenneDownloads'],0,6); ?> Mbps</label>
                                <p class="text-s">Vitesse Moyenne de Téléchargement</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 boxed shadow-1 white">
                        <div class="icon-box icon-box-top-bottom">
                            <div class="icon-box-cell">
                                <i class="fa-refresh fa text-xl"></i>
                            </div>
                            <div class="icon-box-cell">
                                <label class="text-m">Moyenne RTT</label>
                                <label class="text-m"><?php echo substr($resMoyenneDownloads['rtt'],0,6); ?> ms</label>
                                <p class="text-s">La Moyenne du Round Trip Time (RTT)</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 boxed shadow-1 white bg-color">
                        <div class="icon-box icon-box-top-bottom">
                            <div class="icon-box-cell">
                                <i class="fa-warning fa text-xl"></i>
                            </div>
                            <div class="icon-box-cell">
                                <label class="text-m">Taux de Perte</label>
                                <label class="text-m"><?php $varA = substr($resMoyenneDownloads['rate'],0,6); echo $varA; ?> %</label>
                                <p class="text-s">Moyenne de perte de packets lors des test</p>
                            </div>
                        </div>
                    </div>
                </div>    
            </div>
            
        </div>
    </div>
    <!--debut du graphique-->
    <div class="section-bg-image bg-top" style="background-image:url(../images/bg-8.jpg);">
        <div class="container" style="padding-top:30px;">
            <div class="row">
                <div class="col-md-12 col-center text-center">  
                    <h2 style="font-family: 'Times New Roman', Times, serif;"> Graphique 2020</h2>
                    <hr class="space" />
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 text-center">
                    <canvas id="Downloads" height="150"></canvas>
                    <h4 style="font-family: 'Times New Roman', Times, serif;"> Download Speed (10 dernières semaines)</h4>
                </div>
                <div class="col-md-6 text-center">
                    <canvas id="Uploads" height="150"></canvas>
                    <h4 style="font-family: 'Times New Roman', Times, serif;">Upload Speed (10 dernières semaines)</h4>
                </div>
                <div class="col-md-6 text-center">
                    <canvas id="Drtt" height="150"></canvas>
                    <h4 style="font-family: 'Times New Roman', Times, serif;">Round Trip Time en milliseconde (10 dernières semaines)</h4>
                </div>
                <div class="col-md-6 text-center">
                    <canvas id="lost" height="150"></canvas>
                    <h4 style="font-family: 'Times New Roman', Times, serif;">Taux de Perte en % (10 dernières semaines)</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="section-bg-image bg-top" style="background-image:url(../images/bg-9.jpg);">
        <div class="container" style="padding-top:30px;">
            <div class="row">
                <div class="col-md-12 col-center text-center">  
                    <h3 style="font-family: 'Times New Roman', Times, serif;"> Evolution du Nombre de Test de l'année 2020</h3>
                    <hr class="space" />
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                    <canvas id="chart" height="80"></canvas>
                    <h4 style="font-family: 'Times New Roman', Times, serif;">Abscisse : en semaine  || Ordonnée : en Nombre de test</h4>
                </div>
            </div>
        </div>
    </div>
    <!--fin du graphique-->
    <!--tableau de distribution statistique-->
    <div class="section-bg-image bg-top" style="background-image:url(../images/bg-9.jpg);">
        <div class="container" style="padding-top:30px;">
            <div class="row">
                <div class="col-md-12 col-center text-center">  
                    <h2 style="font-family: 'Times New Roman', Times, serif;">Tableau Statistique</h2>
                    <hr class="space" />
                </div>
            </div>
            <div class="row">
                <table class="grid-table border-table" data-anima="fade-bottom" data-timeline="asc">
                    
                    <tbody>
                        <tr>
                            <td><img class="anima" src="../images/logos/logo_test.png" data-toggle="tooltip" data-placement="top" title="Magestic Silver" alt=""></td>
                            <td><img class="anima" src="../images/logos/dlspeed.png" data-toggle="tooltip" data-placement="top" title="Oliver Rolled" alt=""></td>
                            <td><img class="anima" src="../images/logos/frequence.png" data-toggle="tooltip" data-placement="top" title="NHV" alt=""></td>
                            <td><img class="anima" src="../images/logos/upspeed.png" data-toggle="tooltip" data-placement="top" title="Myte SRL" alt=""></td>
                            <td><img class="anima" src="../images/logos/frequence.png" data-toggle="tooltip" data-placement="top" title="NHV" alt=""></td>
                        </tr>
                        <tr>
                            <td>[ 0, 3 [</td>
                            <?php
                                $statTotalDwnL= $connexion->prepare('SELECT COUNT(id) AS total FROM `downloads` ');
                                $statTotalDwnL->execute();
                                $TotalDwnL=$statTotalDwnL->fetch();
                                $statTotalupL= $connexion->prepare('SELECT COUNT(id) AS total FROM `uploads` ');
                                $statTotalupL->execute();
                                $TotalupL=$statTotalupL->fetch();

                                $stat= $connexion->prepare('SELECT COUNT(id) AS nombre FROM `downloads` WHERE debit BETWEEN "0" and "3" ');
                                $stat->execute();
                                $resstat=$stat->fetch();

                                $ustat= $connexion->prepare('SELECT COUNT(id) AS nombre FROM `uploads` WHERE debit BETWEEN "0" and "3" ');
                                $ustat->execute();
                                $uresstat=$ustat->fetch();
                            ?>
                            <td><?php echo $resstat['nombre']; ?> test</td>
                            <td><?php $freqd= ($resstat['nombre']/$TotalDwnL['total'])*100; echo substr($freqd,0,7); ?> %</td>
                            <td><?php echo $uresstat['nombre']; ?> test</td>
                            <td><?php $frequ= ($uresstat['nombre']/$TotalupL['total'])*100; echo substr($frequ,0,7); ?> %</td>
                        </tr>
                        <tr>
                            <td>[ 3, 9 [</td>
                            <?php
                                $stat1= $connexion->prepare('SELECT COUNT(id) AS nombre FROM `downloads` WHERE debit BETWEEN "3" and "9" ');
                                $stat1->execute();
                                $resstat1=$stat1->fetch();

                                $ustat1= $connexion->prepare('SELECT COUNT(id) AS nombre FROM `uploads` WHERE debit BETWEEN "3" and "9" ');
                                $ustat1->execute();
                                $uresstat1=$ustat1->fetch();
                            ?>
                            <td><?php echo $resstat1['nombre']; ?> test</td>
                            <td><?php $freqd1= ($resstat1['nombre']/$TotalDwnL['total'])*100; echo substr($freqd1,0,7); ?> %</td>
                            <td><?php echo $uresstat1['nombre']; ?> test</td>
                            <td><?php $frequ1= ($uresstat1['nombre']/$TotalupL['total'])*100; echo substr($frequ1,0,7); ?> %</td>
                        </tr>
                        <tr>
                            <td>[ 9, 18 [</td>
                            <?php
                                $stat2= $connexion->prepare('SELECT COUNT(id) AS nombre FROM `downloads` WHERE debit BETWEEN "9" and "18" ');
                                $stat2->execute();
                                $resstat2=$stat2->fetch();

                                $ustat2= $connexion->prepare('SELECT COUNT(id) AS nombre FROM `uploads` WHERE debit BETWEEN "9" and "18" ');
                                $ustat2->execute();
                                $uresstat2=$ustat2->fetch();
                            ?>
                            <td><?php echo $resstat2['nombre']; ?> test</td>
                            <td><?php $freqd2= ($resstat2['nombre']/$TotalDwnL['total'])*100; echo substr($freqd2,0,7); ?> %</td>
                            <td><?php echo $uresstat2['nombre']; ?> test</td>
                            <td><?php $frequ2= ($uresstat2['nombre']/$TotalupL['total'])*100; echo substr($frequ2,0,7); ?> %</td>
                        </tr>
                        <tr>
                            <td>[ 18, 36 [</td>
                            <?php
                                $stat3= $connexion->prepare('SELECT COUNT(id) AS nombre FROM `downloads` WHERE debit BETWEEN "18" and "36" ');
                                $stat3->execute();
                                $resstat3=$stat3->fetch();

                                $ustat3= $connexion->prepare('SELECT COUNT(id) AS nombre FROM `uploads` WHERE debit BETWEEN "18" and "36" ');
                                $ustat3->execute();
                                $uresstat3=$ustat3->fetch();
                            ?>
                            <td><?php echo $resstat3['nombre']; ?> test</td>
                            <td><?php $freqd3= ($resstat3['nombre']/$TotalDwnL['total'])*100; echo substr($freqd3,0,7); ?> %</td>
                            <td><?php echo $uresstat3['nombre']; ?> test</td>
                            <td><?php $frequ3= ($uresstat3['nombre']/$TotalupL['total'])*100; echo substr($frequ3,0,7); ?> %</td>
                        </tr>
                        <tr>
                            <td>[ 36, 50 [</td>
                            <?php
                                $stat4= $connexion->prepare('SELECT COUNT(id) AS nombre FROM `downloads` WHERE debit BETWEEN "36" and "50" ');
                                $stat4->execute();
                                $resstat4=$stat4->fetch();

                                $ustat4= $connexion->prepare('SELECT COUNT(id) AS nombre FROM `uploads` WHERE debit BETWEEN "36" and "50" ');
                                $ustat4->execute();
                                $uresstat4=$ustat4->fetch();
                            ?>
                            <td><?php echo $resstat4['nombre']; ?> test</td>
                            <td><?php $freqd4= ($resstat4['nombre']/$TotalDwnL['total'])*100; echo substr($freqd4,0,7); ?> %</td>
                            <td><?php echo $uresstat4['nombre']; ?> test</td>
                            <td><?php $frequ4= ($uresstat4['nombre']/$TotalupL['total'])*100; echo substr($frequ4,0,7); ?> %</td>
                        </tr>
                        <tr>
                            <td>[ 50, 100 [</td>
                            <?php
                                $stat5= $connexion->prepare('SELECT COUNT(id) AS nombre FROM `downloads` WHERE debit BETWEEN "50" and "100" ');
                                $stat5->execute();
                                $resstat5=$stat5->fetch();

                                $ustat5= $connexion->prepare('SELECT COUNT(id) AS nombre FROM `uploads` WHERE debit BETWEEN "50" and "100" ');
                                $ustat5->execute();
                                $uresstat5=$ustat5->fetch();
                            ?>
                            <td><?php echo $resstat5['nombre']; ?> test</td>
                            <td><?php $freqd5= ($resstat5['nombre']/$TotalDwnL['total'])*100; echo substr($freqd5,0,7); ?> %</td>
                            <td><?php echo $uresstat5['nombre']; ?> test</td>
                            <td><?php $frequ5= ($uresstat5['nombre']/$TotalupL['total'])*100; echo substr($frequ5,0,7); ?> %</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!--tableau de distribution statistique-->
    
    <!-- ici repose le footer.. Ameen-->
    <?php include('includes/footer.php'); ?>
    <!-- ici repose le footer.. Ameen-->
    <!--script graphe-->
    <script>
        var ctx = document.getElementById('Downloads').getContext('2d');
        var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'bar',

            // The data for our dataset
            <?php
                
                //asn 28683
                $grapheparASN1=$connexion->prepare("SELECT * FROM (SELECT AVG(debit) AS moyenneDownSpeed, Week(date) AS Semaine, asn FROM downloads WHERE asn='28683' GROUP BY Week(date),asn ORDER BY Week(date) DESC LIMIT 10) tmp ORDER BY Semaine");
                $grapheparASN1->execute();
                while($resGrapheparASN1= $grapheparASN1->fetch()){
                    $data[] = $resGrapheparASN1['moyenneDownSpeed'];
                }
                //asn 37424
                $grapheparASN2=$connexion->prepare("SELECT * FROM (SELECT AVG(debit) AS moyenneDownSpeed, Week(date) AS Semaine, asn FROM downloads WHERE asn='37424' GROUP BY Week(date),asn ORDER BY Week(date) DESC LIMIT 10) tmp ORDER BY Semaine");
                $grapheparASN2->execute();
                while($resGrapheparASN2= $grapheparASN2->fetch()){
                    $data2[] = $resGrapheparASN2['moyenneDownSpeed'];
                }
                //asn 37136
                $grapheparASN3=$connexion->prepare("SELECT * FROM (SELECT AVG(debit) AS moyenneDownSpeed, Week(date) AS Semaine, asn FROM downloads WHERE asn='37136' GROUP BY Week(date),asn ORDER BY Week(date) DESC LIMIT 10) tmp ORDER BY Semaine");
                $grapheparASN3->execute();
                while($resGrapheparASN3= $grapheparASN3->fetch()){
                    $data3[] = $resGrapheparASN3['moyenneDownSpeed'];
                }
                //asn 328228
                $grapheparASN4=$connexion->prepare("SELECT * FROM (SELECT AVG(debit) AS moyenneDownSpeed, Week(date) AS Semaine, asn FROM downloads WHERE asn='328228' GROUP BY Week(date),asn ORDER BY Week(date) DESC LIMIT 10) tmp ORDER BY Semaine");
                $grapheparASN4->execute();
                while($resGrapheparASN4= $grapheparASN4->fetch()){
                    $data4[] = $resGrapheparASN4['moyenneDownSpeed'];
                }
                //asn 37090
                $grapheparASN5=$connexion->prepare("SELECT * FROM (SELECT AVG(debit) AS moyenneDownSpeed, Week(date) AS Semaine, asn FROM downloads WHERE asn='37090' GROUP BY Week(date),asn ORDER BY Week(date) DESC LIMIT 10) tmp ORDER BY Semaine");
                $grapheparASN5->execute();
                while($resGrapheparASN5= $grapheparASN5->fetch()){
                    $data5[] = $resGrapheparASN5['moyenneDownSpeed'];
                }
                //asn 37292
                $grapheparASN6=$connexion->prepare("SELECT * FROM (SELECT AVG(debit) AS moyenneDownSpeed, Week(date) AS Semaine, asn FROM downloads WHERE asn='37292' GROUP BY Week(date),asn ORDER BY Week(date) DESC LIMIT 10) tmp ORDER BY Semaine");
                $grapheparASN6->execute();
                while($resGrapheparASN6= $grapheparASN6->fetch()){
                    $data6[] = $resGrapheparASN6['moyenneDownSpeed'];
                }
                //les semaines
                $qLabel=$connexion->prepare("SELECT * FROM (SELECT Week(date) AS Semaine FROM downloads GROUP BY Week(date) ORDER BY Week(date) DESC LIMIT 10) tmp ORDER BY Semaine");
                $qLabel->execute();
                while($resLabel= $qLabel->fetch()){
                    $dataL[] = $resLabel['Semaine'];
                }
            ?>     
            data: {
                labels: <?=json_encode($dataL);?>,
                datasets: [
                    
                    {
                        label: 'AS28683',
                        backgroundColor: 'rgba(10, 99, 132,0.5)',
                        borderColor: 'rgb(10, 99, 132)',
                        data: <?=json_encode($data);?>
                    },
                    {
                        label: 'AS37424',
                        backgroundColor: 'rgba(10, 209, 132,0.5)',
                        borderColor: 'rgb(10, 209, 132)',
                        data: <?=json_encode($data2);?>
                    },
                    {
                        label: 'AS37136',
                        backgroundColor: 'rgba(10, 209, 13,0.5)',
                        borderColor: 'rgb(10, 209, 13)',
                        data: <?=json_encode($data3);?>
                    },
                    {
                        label: 'AS328228',
                        backgroundColor: 'rgba(10, 209, 229,0.5)',
                        borderColor: 'rgb(10, 209, 229)',
                        data: <?=json_encode($data4);?>
                    },
                    {
                        label: 'AS37090',
                        backgroundColor: 'rgba(100, 19, 229,0.5)',
                        borderColor: 'rgb(100, 19, 229)',
                        data: <?=json_encode($data5);?>
                    },
                    {
                        label: 'AS37292',
                        backgroundColor: 'rgba(200, 254, 5,0.5)',
                        borderColor: 'rgb(200, 254, 5)',
                        data: <?=json_encode($data6);?>
                    }
                    //fin boucle
                    
                ]
                
            },
            
            // Configuration options go here
            options: {}
        });
        
    </script>
    <!--UPLOAD GRAPHE-->
    <script>
        var ctx = document.getElementById('Uploads').getContext('2d');
        var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'bar',

            // The data for our dataset
            <?php
                
                //asn 28683
                $UgrapheparASN1=$connexion->prepare("SELECT * FROM (SELECT AVG(debit) AS moyenneUpSpeed, Week(date) AS Semaine, asn FROM uploads WHERE asn='28683' GROUP BY Week(date),asn ORDER BY Week(date) DESC LIMIT 10) tmp ORDER BY Semaine");
                $UgrapheparASN1->execute();
                while($UresGrapheparASN1= $UgrapheparASN1->fetch()){
                    $Udata[] = $UresGrapheparASN1['moyenneUpSpeed'];
                }
                //asn 37424
                $UgrapheparASN2=$connexion->prepare("SELECT * FROM (SELECT AVG(debit) AS moyenneUpSpeed, Week(date) AS Semaine, asn FROM uploads WHERE asn='37424' GROUP BY Week(date),asn ORDER BY Week(date) DESC LIMIT 10) tmp ORDER BY Semaine");
                $UgrapheparASN2->execute();
                while($UresGrapheparASN2= $UgrapheparASN2->fetch()){
                    $Udata2[] = $UresGrapheparASN2['moyenneUpSpeed'];
                }
                //asn 37136
                $UgrapheparASN3=$connexion->prepare("SELECT * FROM (SELECT AVG(debit) AS moyenneUpSpeed, Week(date) AS Semaine, asn FROM uploads WHERE asn='37136' GROUP BY Week(date),asn ORDER BY Week(date) DESC LIMIT 10) tmp ORDER BY Semaine");
                $UgrapheparASN3->execute();
                while($UresGrapheparASN3= $UgrapheparASN3->fetch()){
                    $Udata3[] = $UresGrapheparASN3['moyenneUpSpeed'];
                }
                //asn 328228
                $UgrapheparASN4=$connexion->prepare("SELECT * FROM (SELECT AVG(debit) AS moyenneUpSpeed, Week(date) AS Semaine, asn FROM uploads WHERE asn='328228' GROUP BY Week(date),asn ORDER BY Week(date) DESC LIMIT 10) tmp ORDER BY Semaine");
                $UgrapheparASN4->execute();
                while($UresGrapheparASN4= $UgrapheparASN4->fetch()){
                    $Udata4[] = $UresGrapheparASN4['moyenneUpSpeed'];
                }
                //asn 37090
                $UgrapheparASN5=$connexion->prepare("SELECT * FROM (SELECT AVG(debit) AS moyenneUpSpeed, Week(date) AS Semaine, asn FROM uploads WHERE asn='37090' GROUP BY Week(date),asn ORDER BY Week(date) DESC LIMIT 10) tmp ORDER BY Semaine");
                $UgrapheparASN5->execute();
                while($UresGrapheparASN5= $UgrapheparASN5->fetch()){
                    $Udata5[] = $UresGrapheparASN5['moyenneUpSpeed'];
                }
                //asn 37292
                $UgrapheparASN6=$connexion->prepare("SELECT * FROM (SELECT AVG(debit) AS moyenneUpSpeed, Week(date) AS Semaine, asn FROM uploads WHERE asn='37292' GROUP BY Week(date),asn ORDER BY Week(date) DESC LIMIT 10) tmp ORDER BY Semaine");
                $UgrapheparASN6->execute();
                while($UresGrapheparASN6= $UgrapheparASN6->fetch()){
                    $Udata6[] = $UresGrapheparASN6['moyenneUpSpeed'];
                }
                //les semaines
                $quLabel=$connexion->prepare("SELECT * FROM (SELECT Week(date) AS Semaine FROM downloads GROUP BY Week(date) ORDER BY Week(date) DESC LIMIT 10) tmp ORDER BY Semaine");
                $quLabel->execute();
                while($resuLabel= $quLabel->fetch()){
                    $datauL[] = $resuLabel['Semaine'];
                }
            ?>     
            data: {
                labels: <?=json_encode($datauL);?>,
                datasets: [
                    
                    {
                        label: 'AS28683',
                        backgroundColor: 'rgba(10, 99, 132,0.5)',
                        borderColor: 'rgb(10, 99, 132)',
                        data: <?=json_encode($Udata);?>
                    },
                    {
                        label: 'AS37424',
                        backgroundColor: 'rgba(10, 209, 132,0.5)',
                        borderColor: 'rgb(10, 209, 132)',
                        data: <?=json_encode($Udata2);?>
                    },
                    {
                        label: 'AS37136',
                        backgroundColor: 'rgba(10, 209, 13,0.5)',
                        borderColor: 'rgb(10, 209, 13)',
                        data: <?=json_encode($Udata3);?>
                    },
                    {
                        label: 'AS328228',
                        backgroundColor: 'rgba(10, 209, 229,0.5)',
                        borderColor: 'rgb(10, 209, 229)',
                        data: <?=json_encode($Udata4);?>
                    },
                    {
                        label: 'AS37090',
                        backgroundColor: 'rgba(100, 19, 229,0.5)',
                        borderColor: 'rgb(100, 19, 229)',
                        data: <?=json_encode($Udata5);?>
                    },
                    {
                        label: 'AS37292',
                        backgroundColor: 'rgba(200, 254, 5,0.5)',
                        borderColor: 'rgb(200, 254, 5)',
                        data: <?=json_encode($Udata6);?>
                    }
                    //fin boucle
                    
                ]
                
            },
            
            // Configuration options go here
            options: {}
        });
        
    </script>
    <script>
        var ctx = document.getElementById('chart').getContext('2d');
        var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'line',

            // The data for our dataset
            <?php
                
                
                //asn 37292
                $NombreQ=$connexion->prepare("SELECT COUNT(id) AS Nombre, Week(date) AS Semaine FROM downloads GROUP BY Week(date)");
                $NombreQ->execute();
                while($resNombreQ= $NombreQ->fetch()){
                    $dataNombre[] = $resNombreQ['Nombre'];
                }
                //les semaines
                $qaLabel=$connexion->prepare("SELECT COUNT(id) AS Nombre, Week(date) AS Semaine FROM downloads GROUP BY Week(date)");
                $qaLabel->execute();
                while($resaLabel= $qaLabel->fetch()){
                    $dataaL[] = $resaLabel['Semaine'];
                }
            ?>     
            data: {
                labels: <?=json_encode($dataaL);?>,
                datasets: [
                    
                    {
                        label: '',
                        backgroundColor: 'rgba(10, 99, 132,0.5)',
                        borderColor: 'rgb(10, 99, 132)',
                        data: <?=json_encode($dataNombre);?>,
                        
                    },
                    
                    
                    //fin boucle
                    
                ]
                
            },
            
            // Configuration options go here
            options: {}
        });
        
    </script>
    <!--fin script graphe-->
    <!--graphe rtt et lost rate-->
    <!--<script>
        var ctx = document.getElementById('Urtt').getContext('2d');
        var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'line',

            // The data for our dataset
            <?php
                
                //asn 28683
                $UgrapheparASN1=$connexion->prepare("SELECT * FROM (SELECT AVG(minRTT) AS rttupload, Week(date) AS Semaine, asn FROM uploads WHERE asn='28683' GROUP BY Week(date),asn ORDER BY Week(date) DESC LIMIT 10) tmp ORDER BY Semaine");
                $UgrapheparASN1->execute();
                while($UresGrapheparASN1= $UgrapheparASN1->fetch()){
                    $Udatartt[] = $UresGrapheparASN1['rttupload'];
                }
                //asn 37424
                $UgrapheparASN2=$connexion->prepare("SELECT * FROM (SELECT AVG(minRTT) AS rttupload, Week(date) AS Semaine, asn FROM uploads WHERE asn='37424' GROUP BY Week(date),asn ORDER BY Week(date) DESC LIMIT 10) tmp ORDER BY Semaine");
                $UgrapheparASN2->execute();
                while($UresGrapheparASN2= $UgrapheparASN2->fetch()){
                    $Udatartt2[] = $UresGrapheparASN2['rttupload'];
                }
                //asn 37136
                $UgrapheparASN3=$connexion->prepare("SELECT * FROM (SELECT AVG(minRTT) AS rttupload, Week(date) AS Semaine, asn FROM uploads WHERE asn='37136' GROUP BY Week(date),asn ORDER BY Week(date) DESC LIMIT 10) tmp ORDER BY Semaine");
                $UgrapheparASN3->execute();
                while($UresGrapheparASN3= $UgrapheparASN3->fetch()){
                    $Udatartt3[] = $UresGrapheparASN3['rttupload'];
                }
                //asn 328228
                $UgrapheparASN4=$connexion->prepare("SELECT * FROM (SELECT AVG(minRTT) AS rttupload, Week(date) AS Semaine, asn FROM uploads WHERE asn='328228' GROUP BY Week(date),asn ORDER BY Week(date) DESC LIMIT 10) tmp ORDER BY Semaine");
                $UgrapheparASN4->execute();
                while($UresGrapheparASN4= $UgrapheparASN4->fetch()){
                    $Udatartt4[] = $UresGrapheparASN4['rttupload'];
                }
                //asn 37090
                $UgrapheparASN5=$connexion->prepare("SELECT * FROM (SELECT AVG(minRTT) AS rttupload, Week(date) AS Semaine, asn FROM uploads WHERE asn='37090' GROUP BY Week(date),asn ORDER BY Week(date) DESC LIMIT 10) tmp ORDER BY Semaine");
                $UgrapheparASN5->execute();
                while($UresGrapheparASN5= $UgrapheparASN5->fetch()){
                    $Udatartt5[] = $UresGrapheparASN5['rttupload'];
                }
                //asn 37292
                $UgrapheparASN6=$connexion->prepare("SELECT * FROM (SELECT AVG(minRTT) AS rttupload, Week(date) AS Semaine, asn FROM uploads WHERE asn='37292' GROUP BY Week(date),asn ORDER BY Week(date) DESC LIMIT 10) tmp ORDER BY Semaine");
                $UgrapheparASN6->execute();
                while($UresGrapheparASN6= $UgrapheparASN6->fetch()){
                    $Udatartt6[] = $UresGrapheparASN6['rttupload'];
                }
                //les semaines
                
            ?>     
            data: {
                labels: <?=json_encode($datauL);?>,
                datasets: [
                    
                    {
                        label: 'AS28683',
                        backgroundColor: 'rgba(10, 99, 132,0.5)',
                        borderColor: 'rgb(10, 99, 132)',
                        data: <?=json_encode($Udatartt);?>,
                        fill:'false'
                    },
                    {
                        label: 'AS37424',
                        backgroundColor: 'rgba(10, 209, 132,0.5)',
                        borderColor: 'rgb(10, 209, 132)',
                        data: <?=json_encode($Udatartt2);?>,
                        fill:'false'
                    },
                    {
                        label: 'AS37136',
                        backgroundColor: 'rgba(10, 209, 13,0.5)',
                        borderColor: 'rgb(10, 209, 13)',
                        data: <?=json_encode($Udatartt3);?>,
                        fill:'false'
                    },
                    {
                        label: 'AS328228',
                        backgroundColor: 'rgba(10, 209, 229,0.5)',
                        borderColor: 'rgb(10, 209, 229)',
                        data: <?=json_encode($Udatartt4);?>,
                        fill:'false'
                    },
                    {
                        label: 'AS37090',
                        backgroundColor: 'rgba(100, 19, 229,0.5)',
                        borderColor: 'rgb(100, 19, 229)',
                        data: <?=json_encode($Udatartt5);?>,
                        fill:'false'
                    },
                    {
                        label: 'AS37292',
                        backgroundColor: 'rgba(200, 254, 5,0.5)',
                        borderColor: 'rgb(200, 254, 5)',
                        data: <?=json_encode($Udatartt6);?>,
                        fill:'false'
                    }
                    //fin boucle
                    
                ]
                
            },
            
            // Configuration options go here
            options: {}
        });
        
    </script>-->
    <script>
        var ctx = document.getElementById('Drtt').getContext('2d');
        var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'line',

            // The data for our dataset
            <?php
                
                //asn 28683
                $grapheparASN1=$connexion->prepare("SELECT * FROM (SELECT AVG(downloads.minRTT) AS Drtt, AVG(uploads.minRTT) AS urtt, AVG(downloads.minRTT + uploads.minRTT) AS rtt, Week(downloads.date) AS Semaine, downloads.asn FROM downloads, uploads WHERE downloads.asn='28683' AND uploads.asn='28683' GROUP BY Week(downloads.date),asn ORDER BY Week(downloads.date) DESC LIMIT 10) tmp ORDER BY Semaine");
                $grapheparASN1->execute();
                while($resGrapheparASN1= $grapheparASN1->fetch()){
                    $datartt[] = $resGrapheparASN1['rtt'];
                }
                //asn 37424
                $grapheparASN2=$connexion->prepare("SELECT * FROM (SELECT AVG(downloads.minRTT) AS Drtt, AVG(uploads.minRTT) AS urtt, AVG(downloads.minRTT + uploads.minRTT) AS rtt, Week(downloads.date) AS Semaine, downloads.asn FROM downloads, uploads WHERE downloads.asn='37424' AND uploads.asn='37424' GROUP BY Week(downloads.date),asn ORDER BY Week(downloads.date) DESC LIMIT 10) tmp ORDER BY Semaine");
                $grapheparASN2->execute();
                while($resGrapheparASN2= $grapheparASN2->fetch()){
                    $datartt2[] = $resGrapheparASN2['rtt'];
                }
                //asn 37136
                $grapheparASN3=$connexion->prepare("SELECT * FROM (SELECT AVG(downloads.minRTT) AS Drtt, AVG(uploads.minRTT) AS urtt, AVG(downloads.minRTT + uploads.minRTT) AS rtt, Week(downloads.date) AS Semaine, downloads.asn FROM downloads, uploads WHERE downloads.asn='37136' AND uploads.asn='37136' GROUP BY Week(downloads.date),asn ORDER BY Week(downloads.date) DESC LIMIT 10) tmp ORDER BY Semaine");
                $grapheparASN3->execute();
                while($resGrapheparASN3= $grapheparASN3->fetch()){
                    $datartt3[] = $resGrapheparASN3['rtt'];
                }
                //asn 328228
                $grapheparASN4=$connexion->prepare("SELECT * FROM (SELECT AVG(downloads.minRTT) AS Drtt, AVG(uploads.minRTT) AS urtt, AVG(downloads.minRTT + uploads.minRTT) AS rtt, Week(downloads.date) AS Semaine, downloads.asn FROM downloads, uploads WHERE downloads.asn='328228' AND uploads.asn='328228' GROUP BY Week(downloads.date),asn ORDER BY Week(downloads.date) DESC LIMIT 10) tmp ORDER BY Semaine");
                $grapheparASN4->execute();
                while($resGrapheparASN4= $grapheparASN4->fetch()){
                    $datartt4[] = $resGrapheparASN4['rtt'];
                }
                //asn 37090
                $grapheparASN5=$connexion->prepare("SELECT * FROM (SELECT AVG(downloads.minRTT) AS Drtt, AVG(uploads.minRTT) AS urtt, AVG(downloads.minRTT + uploads.minRTT) AS rtt, Week(downloads.date) AS Semaine, downloads.asn FROM downloads, uploads WHERE downloads.asn='37090' AND uploads.asn='37090' GROUP BY Week(downloads.date),asn ORDER BY Week(downloads.date) DESC LIMIT 10) tmp ORDER BY Semaine");
                $grapheparASN5->execute();
                while($resGrapheparASN5= $grapheparASN5->fetch()){
                    $datartt5[] = $resGrapheparASN5['rtt'];
                }
                //asn 37292
                $grapheparASN6=$connexion->prepare("SELECT * FROM (SELECT AVG(downloads.minRTT) AS Drtt, AVG(uploads.minRTT) AS urtt, AVG(downloads.minRTT + uploads.minRTT) AS rtt, Week(downloads.date) AS Semaine, downloads.asn FROM downloads, uploads WHERE downloads.asn='37292' AND uploads.asn='37292' GROUP BY Week(downloads.date),asn ORDER BY Week(downloads.date) DESC LIMIT 10) tmp ORDER BY Semaine");
                $grapheparASN6->execute();
                while($resGrapheparASN6= $grapheparASN6->fetch()){
                    $datartt6[] = $resGrapheparASN6['rtt'];
                }
                //les semaines
                
            ?>     
            data: {
                labels: <?=json_encode($datauL);?>,
                datasets: [
                    
                    {
                        label: 'AS28683',
                        backgroundColor: 'rgba(10, 99, 132,0.5)',
                        borderColor: 'rgb(10, 99, 132)',
                        data: <?=json_encode($datartt);?>,
                        fill:'false'
                    },
                    {
                        label: 'AS37424',
                        backgroundColor: 'rgba(10, 209, 132,0.5)',
                        borderColor: 'rgb(10, 209, 132)',
                        data: <?=json_encode($datartt2);?>,
                        fill:'false'
                    },
                    {
                        label: 'AS37136',
                        backgroundColor: 'rgba(10, 209, 13,0.5)',
                        borderColor: 'rgb(10, 209, 13)',
                        data: <?=json_encode($datartt3);?>,
                        fill:'false'
                    },
                    {
                        label: 'AS328228',
                        backgroundColor: 'rgba(10, 209, 229,0.5)',
                        borderColor: 'rgb(10, 209, 229)',
                        data: <?=json_encode($datartt4);?>,
                        fill:'false'
                    },
                    {
                        label: 'AS37090',
                        backgroundColor: 'rgba(100, 19, 229,0.5)',
                        borderColor: 'rgb(100, 19, 229)',
                        data: <?=json_encode($datartt5);?>,
                        fill:'false'
                    },
                    {
                        label: 'AS37292',
                        backgroundColor: 'rgba(200, 254, 5,0.5)',
                        borderColor: 'rgb(200, 254, 5)',
                        data: <?=json_encode($datartt6);?>,
                        fill:'false'
                    }

                    //fin boucle
                    
                ]
                
            },
            
            // Configuration options go here
            options: {
                
            }
        });
        
    </script>
    <script>
        var ctx = document.getElementById('lost').getContext('2d');
        var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'line',

            // The data for our dataset
            <?php
                
                //asn 28683
                $grapheparASN1=$connexion->prepare("SELECT * FROM (SELECT AVG(downloads.lostRate) AS Dlost, AVG(uploads.lostRate) AS ulost, AVG(downloads.lostRate + uploads.lostRate) AS lost, Week(downloads.date) AS Semaine, downloads.asn FROM downloads, uploads WHERE downloads.asn='28683' AND uploads.asn='28683' GROUP BY Week(downloads.date),asn ORDER BY Week(downloads.date) DESC LIMIT 10) tmp ORDER BY Semaine");
                $grapheparASN1->execute();
                while($resGrapheparASN1= $grapheparASN1->fetch()){
                    $datalost[] = $resGrapheparASN1['lost'];
                }
                //asn 37424
                $grapheparASN2=$connexion->prepare("SELECT * FROM (SELECT AVG(downloads.lostRate) AS Dlost, AVG(uploads.lostRate) AS ulost, AVG(downloads.lostRate + uploads.lostRate) AS lost, Week(downloads.date) AS Semaine, downloads.asn FROM downloads, uploads WHERE downloads.asn='37424' AND uploads.asn='37424' GROUP BY Week(downloads.date),asn ORDER BY Week(downloads.date) DESC LIMIT 10) tmp ORDER BY Semaine");
                $grapheparASN2->execute();
                while($resGrapheparASN2= $grapheparASN2->fetch()){
                    $datalost2[] = $resGrapheparASN2['lost'];
                }
                //asn 37136
                $grapheparASN3=$connexion->prepare("SELECT * FROM (SELECT AVG(downloads.lostRate) AS Dlost, AVG(uploads.lostRate) AS ulost, AVG(downloads.lostRate + uploads.lostRate) AS lost, Week(downloads.date) AS Semaine, downloads.asn FROM downloads, uploads WHERE downloads.asn='37136' AND uploads.asn='37136' GROUP BY Week(downloads.date),asn ORDER BY Week(downloads.date) DESC LIMIT 10) tmp ORDER BY Semaine");
                $grapheparASN3->execute();
                while($resGrapheparASN3= $grapheparASN3->fetch()){
                    $datalost3[] = $resGrapheparASN3['lost'];
                }
                //asn 328228
                $grapheparASN4=$connexion->prepare("SELECT * FROM (SELECT AVG(downloads.lostRate) AS Dlost, AVG(uploads.lostRate) AS ulost, AVG(downloads.lostRate + uploads.lostRate) AS lost, Week(downloads.date) AS Semaine, downloads.asn FROM downloads, uploads WHERE downloads.asn='328228' AND uploads.asn='328228' GROUP BY Week(downloads.date),asn ORDER BY Week(downloads.date) DESC LIMIT 10) tmp ORDER BY Semaine");
                $grapheparASN4->execute();
                while($resGrapheparASN4= $grapheparASN4->fetch()){
                    $datalost4[] = $resGrapheparASN4['lost'];
                }
                //asn 37090
                $grapheparASN5=$connexion->prepare("SELECT * FROM (SELECT AVG(downloads.lostRate) AS Dlost, AVG(uploads.lostRate) AS ulost, AVG(downloads.lostRate + uploads.lostRate) AS lost, Week(downloads.date) AS Semaine, downloads.asn FROM downloads, uploads WHERE downloads.asn='37090' AND uploads.asn='37090' GROUP BY Week(downloads.date),asn ORDER BY Week(downloads.date) DESC LIMIT 10) tmp ORDER BY Semaine");
                $grapheparASN5->execute();
                while($resGrapheparASN5= $grapheparASN5->fetch()){
                    $datalost5[] = $resGrapheparASN5['lost'];
                }
                //asn 37292
                $grapheparASN6=$connexion->prepare("SELECT * FROM (SELECT AVG(downloads.lostRate) AS Dlost, AVG(uploads.lostRate) AS ulost, AVG(downloads.lostRate + uploads.lostRate) AS lost, Week(downloads.date) AS Semaine, downloads.asn FROM downloads, uploads WHERE downloads.asn='37292' AND uploads.asn='37292' GROUP BY Week(downloads.date),asn ORDER BY Week(downloads.date) DESC LIMIT 10) tmp ORDER BY Semaine");
                $grapheparASN6->execute();
                while($resGrapheparASN6= $grapheparASN6->fetch()){
                    $datalost6[] = $resGrapheparASN6['lost'];
                }
                //les semaines
                
            ?>     
            data: {
                labels: <?=json_encode($datauL);?>,
                datasets: [
                    
                    {
                        label: 'AS28683',
                        backgroundColor: 'rgba(10, 99, 132,0.5)',
                        borderColor: 'rgb(10, 99, 132)',
                        data: <?=json_encode($datalost);?>,
                        fill:'false'
                    },
                    {
                        label: 'AS37424',
                        backgroundColor: 'rgba(10, 209, 132,0.5)',
                        borderColor: 'rgb(10, 209, 132)',
                        data: <?=json_encode($datalost2);?>,
                        fill:'false'
                    },
                    {
                        label: 'AS37136',
                        backgroundColor: 'rgba(10, 209, 13,0.5)',
                        borderColor: 'rgb(10, 209, 13)',
                        data: <?=json_encode($datalost3);?>,
                        fill:'false'
                    },
                    {
                        label: 'AS328228',
                        backgroundColor: 'rgba(10, 209, 229,0.5)',
                        borderColor: 'rgb(10, 209, 229)',
                        data: <?=json_encode($datalost4);?>,
                        fill:'false'
                    },
                    {
                        label: 'AS37090',
                        backgroundColor: 'rgba(100, 19, 229,0.5)',
                        borderColor: 'rgb(100, 19, 229)',
                        data: <?=json_encode($datalost5);?>,
                        fill:'false'
                    },
                    {
                        label: 'AS37292',
                        backgroundColor: 'rgba(200, 254, 5,0.5)',
                        borderColor: 'rgb(200, 254, 5)',
                        data: <?=json_encode($datalost6);?>,
                        fill:'false'
                    }

                    //fin boucle
                    
                ]
                
            },
            
            // Configuration options go here
            options: {
            }
        });
        
    </script>
    <!--fin graphe rtt et lost rate-->
</body>