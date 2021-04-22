<?php 
    include('includes/connexion.php');
    if(isset($_GET['test'])){
        $requete=$connexion->prepare("
        
CREATE TABLE `regions` (
  `id` int(11) NOT NULL,
  `coderegion` varchar(255) NOT NULL,
  `libelle` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `regions`
--

INSERT INTO `regions` (`id`, `coderegion`, `libelle`) VALUES
(1, 'AQ', 'Atlantique'),
(2, 'DO', 'Donga');


    
    ");
    $requete->execute();
    
    }else{
        echo'HI';
    }
    