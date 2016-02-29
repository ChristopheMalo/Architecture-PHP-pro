<?php
/**
 * micro-CMS
 * =========================================================================================================
 *
 * Page d'accueil - Itération 2 du projet
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

// Affichage de la vue avec les données
require 'model/model.php';
$articles = getArticles();
require 'view/view.php';