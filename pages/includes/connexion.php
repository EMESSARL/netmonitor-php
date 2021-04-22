<?php
    session_start();
    try{
        $PARAM_hote='127.0.0.1'; //le chemin vers le serveur
        $PARAM_nom_bd='mnb'; // le nom de la base de données
        $PARAM_utilisateur='root';
        $PARAM_password='';
        $dsn = 'mysql:host='.$PARAM_hote.';dbname='.$PARAM_nom_bd;
        //var_dump($dsn);
        $connexion = new PDO($dsn, $PARAM_utilisateur, $PARAM_password);
        $connexion -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
    }catch(Exception $e){
        echo 'Erreur : '.$e->getMessage().'<br/>';
        echo 'N° : '.$e->getCode();
    }