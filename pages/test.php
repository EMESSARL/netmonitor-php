<?php 
    include('includes/connexion.php');
    if(isset($_GET['test'])){
        $requete=$connexion->prepare("
        SHOW TABLES;

    ");
    $requete->execute();
    //$res = $requete->fetch();
    while ($row = $requete->fetch(PDO::FETCH_NUM)) {
        echo $row[0].' ';
        }
    
    }else{
        echo'HI';
    }
    