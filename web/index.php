<?php
/**
 * micro-CMS
 * =========================================================================================================
 *
 * Contrôleur frontal / Page d'accueil - Itération 3 du projet<br>
 * Ce fichier centralise la gestion des requêtes HTTP entrantes<br>
 * L'objet Silex principal $app est instancié dans ce fichier<br>
 * Inclusion des routes de l'application
 * 
 * @author          Christophe Malo
 * @started         29/02/2016
 * @updated         
 * @project         micro-CMS
 * @namefile        index.php
 * @fileversion     1.0.0
 * @phpversion      5.6.10
 * @htmlversion     HTML5
 * @cssversion      CSS3
 * @jqueryversion   
 * 
 * @commentaire     
 * 
 * @upgrade         
 * 
 */

require_once __DIR__ . '/../vendor/autoload.php';

$app = new Silex\Application();

require __DIR__ . '/../app/routes.php';

$app->run();