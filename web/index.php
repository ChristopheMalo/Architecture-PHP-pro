<?php
/**
 * micro-CMS
 * =========================================================================================================
 *
 * Contrôleur frontal / Page d'accueil - Itération 4 du projet<br>
 * Ce fichier centralise la gestion des requêtes HTTP entrantes<br>
 * L'objet Silex principal $app est instancié dans ce fichier<br>
 * Inclusion des routes de l'application
 * 
 * @author          Christophe Malo
 * @started         29/02/2016
 * @updated         
 * @project         micro-CMS
 * @namefile        index.php
 * @fileversion     1.0.1
 * @phpversion      5.6.10
 * @htmlversion     HTML5
 * @cssversion      CSS3
 * @jqueryversion   
 * 
 * @commentaire     1.0.1 : utiliser les nouveaux fichiers de configuration (app et dev)
 * 
 * @upgrade         
 * 
 */

require_once __DIR__ . '/../vendor/autoload.php';

$app = new Silex\Application();

require __DIR__ . '/../app/config/dev.php';
// require __DIR__ . '/../app/config/prod.php'; // use with -> composer install --no-dev - ne pas ftp le composer.lock lors de la mise en ligne
require __DIR__ . '/../app/app.php';
require __DIR__ . '/../app/routes.php';

$app->run();