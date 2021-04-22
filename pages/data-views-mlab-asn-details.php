<?php
    include('includes/connexion.php');
    
    //requètes suivants les asn
    $reqASN1= $connexion->prepare("SELECT * FROM asn WHERE id=".$_GET['asn']);
    $reqASN1->execute();
    $resASN = $reqASN1->fetch();
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
                        <h1>Visualisation des données de l'AS<?php echo $resASN['id'] ?></h1>
                        <p>Cette Visualisation des données de mesure de l'état de la connexion au Bénin suivant chaque ASN est basée sur les données de mesure collectées par M-Labs et recupérées directement depuis BigQuery.</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <ol class="breadcrumb b white">
                        <li><a href="index.php">Accueil</a></li>
                        <li href="data-views-mlab.php">mlab</li>
                        <li class="active">AS<?php echo $resASN['id'] ?></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
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
        </div><br/>
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
    
    
    <!-- ici repose le footer.. Ameen-->
    <?php include('includes/footer.php'); ?>
    <!-- ici repose le footer.. Ameen-->


    <script>
        var ctx = document.getElementById('Downloads').getContext('2d');
        var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'bar',

            // The data for our dataset
            <?php
                
                //asn 
                $grapheparASN1=$connexion->prepare("SELECT * FROM (SELECT AVG(debit) AS moyenneDownSpeed, Week(date) AS Semaine, asn FROM downloads WHERE asn='".$_GET['asn']."' GROUP BY Week(date),asn ORDER BY Week(date) DESC LIMIT 10) tmp ORDER BY Semaine");
                $grapheparASN1->execute();
                while($resGrapheparASN1= $grapheparASN1->fetch()){
                    $data[] = $resGrapheparASN1['moyenneDownSpeed'];
                }
                
                //les semaines
                $qLabel=$connexion->prepare("SELECT * FROM (SELECT Week(date) AS Semaine FROM downloads WHERE asn='".$_GET['asn']."' GROUP BY Week(date) ORDER BY Week(date) DESC LIMIT 10) tmp ORDER BY Semaine");
                $qLabel->execute();
                while($resLabel= $qLabel->fetch()){
                    $dataL[] = $resLabel['Semaine'];
                }
            ?>     
            data: {
                labels: <?=json_encode($dataL);?>,
                datasets: [
                    
                    {
                        label: '<?php echo $resASN['nom']; ?>',
                        backgroundColor: 'rgba(177, 58, 58,0.5)',
                        borderColor: 'rgb(177, 58, 58)',
                        data: <?=json_encode($data);?>
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
                $UgrapheparASN1=$connexion->prepare("SELECT * FROM (SELECT AVG(debit) AS moyenneUpSpeed, Week(date) AS Semaine, asn FROM uploads WHERE asn='".$_GET['asn']."' GROUP BY Week(date),asn ORDER BY Week(date) DESC LIMIT 10) tmp ORDER BY Semaine");
                $UgrapheparASN1->execute();
                while($UresGrapheparASN1= $UgrapheparASN1->fetch()){
                    $Udata[] = $UresGrapheparASN1['moyenneUpSpeed'];
                }
                
                //les semaines
                $quLabel=$connexion->prepare("SELECT * FROM (SELECT Week(date) AS Semaine FROM downloads WHERE asn='".$_GET['asn']."' GROUP BY Week(date) ORDER BY Week(date) DESC LIMIT 10) tmp ORDER BY Semaine");
                $quLabel->execute();
                while($resuLabel= $quLabel->fetch()){
                    $datauL[] = $resuLabel['Semaine'];
                }
            ?>     
            data: {
                labels: <?=json_encode($datauL);?>,
                datasets: [
                    
                    {
                        label: '<?php echo $resASN['nom']; ?>',
                        backgroundColor: 'rgba(10, 99, 132,0.5)',
                        borderColor: 'rgb(10, 99, 132)',
                        data: <?=json_encode($Udata);?>
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
                
                
                //asn 
                $NombreQ=$connexion->prepare("SELECT COUNT(id) AS Nombre, Week(date) AS Semaine FROM downloads WHERE asn='".$_GET['asn']."' GROUP BY Week(date)");
                $NombreQ->execute();
                while($resNombreQ= $NombreQ->fetch()){
                    $dataNombre[] = $resNombreQ['Nombre'];
                }
                //les semaines
                $qaLabel=$connexion->prepare("SELECT COUNT(id) AS Nombre, Week(date) AS Semaine FROM downloads WHERE asn='".$_GET['asn']."' GROUP BY Week(date)");
                $qaLabel->execute();
                while($resaLabel= $qaLabel->fetch()){
                    $dataaL[] = $resaLabel['Semaine'];
                }
            ?>     
            data: {
                labels: <?=json_encode($dataaL);?>,
                datasets: [
                    
                    {
                        label: '<?php echo $resASN['nom']; ?>',
                        backgroundColor: 'rgba(10, 99, 132,0.5)',
                        borderColor: 'rgb(10, 99, 132)',
                        data: <?=json_encode($dataNombre);?>,
                        
                    },
                    
                    
                    //fin boucle
                    
                ]
                
            },
            
            // Configuration options go here
            options: {
                yAxes: [{
						gridLines: {
							drawBorder: false
						},
						scaleLabel: {
							display: true,
							labelString: 'Closing price ($)'
						}
					}]
            }
        });
        
    </script>
    <script>
        var ctx = document.getElementById('Drtt').getContext('2d');
        var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'line',

            // The data for our dataset
            <?php
                
                
                //asn 
                $grapheparASN3=$connexion->prepare("SELECT * FROM (SELECT AVG(downloads.minRTT) AS Drtt, AVG(uploads.minRTT) AS urtt, AVG(downloads.minRTT + uploads.minRTT) AS rtt, Week(downloads.date) AS Semaine, downloads.asn FROM downloads, uploads WHERE downloads.asn='".$_GET['asn']."' AND uploads.asn='".$_GET['asn']."' GROUP BY Week(downloads.date),asn ORDER BY Week(downloads.date) DESC LIMIT 10) tmp ORDER BY Semaine");
                $grapheparASN3->execute();
                while($resGrapheparASN3= $grapheparASN3->fetch()){
                    $datartt3[] = $resGrapheparASN3['rtt'];
                }
                
                //les semaines
                
            ?>     
            data: {
                labels: <?=json_encode($datauL);?>,
                datasets: [
                    
                    
                    {
                        label: '<?php echo $resASN['nom']; ?>',
                        backgroundColor: 'rgba(10, 209, 13,0.5)',
                        borderColor: 'rgb(10, 209, 13)',
                        data: <?=json_encode($datartt3);?>,
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
                
                
                //asn 
                $grapheparASN6=$connexion->prepare("SELECT * FROM (SELECT AVG(downloads.lostRate) AS Dlost, AVG(uploads.lostRate) AS ulost, AVG(downloads.lostRate + uploads.lostRate) AS lost, Week(downloads.date) AS Semaine, downloads.asn FROM downloads, uploads WHERE downloads.asn='".$_GET['asn']."' AND uploads.asn='".$_GET['asn']."' GROUP BY Week(downloads.date),asn ORDER BY Week(downloads.date) DESC LIMIT 10) tmp ORDER BY Semaine");
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
                        label: '<?php echo $resASN['nom']; ?>',
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
    <!--fin script graphe-->
</body>
</html>