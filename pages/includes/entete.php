<div class="navbar-header">
                        <button type="button" class="navbar-toggle">
                            <i class="fa fa-bars"></i>
                        </button>
                        <a class="navbar-brand scroll-hide" href="index.html">
                            <?php
                                $url = substr($_SERVER['PHP_SELF'], strrpos($_SERVER['PHP_SELF'], '/'));
                                if($url=='/index.php' or $url=='/') {
                                    ?>
                                    <img class="logo-default" src="../images/logo.png" alt="logo" />
                                    <img class="logo-retina" src="../images/logo-retina.png" alt="logo" />
                                    <?php
                                }else{
                                    ?>
                                    <img class="logo-default" src="../images/logo-black.png" alt="logo" />
                                    <img class="logo-retina" src="../images/logo-retina-black.png" alt="logo" />
                                    <?php
                                }
                            ?>
                        </a>
                        <a class="navbar-brand scroll-show" href="index.html">
                            <img class="logo-default" src="../images/logo-black.png" alt="logo" />
                            <img class="logo-retina" src="../images/logo-retina-black.png" alt="logo" />
                        </a>
                    </div>
                    <div class="collapse navbar-collapse">
                        <div class="nav navbar-nav navbar-right">
                            <ul class="nav navbar-nav">
                                <li class="dropdown active">
                                    <a href="index.php" class="dropdown-toggle" data-toggle="dropdown" role="button">Accueil <span class="caret"></span></a>
                                </li>
                                <li class="dropdown">
                                    <a href="test.php" class="dropdown-toggle" data-toggle="dropdown" role="button">Test <span class="caret"></span></a>
                                    
                                </li>
                                <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">Données de Mesures <span class="caret"></span></a>
                                    <ul class="dropdown-menu multi-level">
                                        <li class="dropdown dropdown-submenu">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Suivant M-Lab</a>
                                            <ul class="dropdown-menu">
                                                <li><a href="data-views-mlab.php">Statistique Générale</a></li>
                                                <li><a href="data-view-mlab-asn.php">Statistique par ASN</a></li>
                                                <li><a href="data-views-mlab-ville.php">Statistique par Ville</a></li>
                                            </ul>
                                        </li>
                                        <li class="dropdown dropdown-submenu">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Suivant RIPE-Atlas</a>
                                            <ul class="dropdown-menu">
                                            <li><a href="data-views-ripe.php">Statistique Générale</a></li>
                                                <li><a href="data-views-ripe-asn.php">Statistique par ASN</a></li>
                                                <li><a href="data-views-ripe-ville.php">Statistique par Ville</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li class="dropdown">
                                    <a href="documentation.php" class="dropdown-toggle" data-toggle="dropdown" role="button">Documentation <span class="caret"></span></a>
                                    
                                </li>
                                <li class="dropdown mega-dropdown mega-tabs">
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="contact.php">Nous Contactez! <span class="caret"></span></a>
                                    
                                </li>
                            </ul>
                        </div>
                    </div>