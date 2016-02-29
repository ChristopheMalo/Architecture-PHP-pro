<?php
/**
 * MicroCMS
 * =========================================================================================================
 *
 * Gestion des routes de l'application - Itération 3 du projet<br>
 * Routes = Points d'entrées dans l'application
 * 
 * @author      Christophe Malo
 * @date        29/02/2016
 * @version     1.0.0
 * @copyright   OpenClassrooms - Baptiste Pesquet
 * 
 * 
 * @commentaire     La fonction anonyme associé à la route de la page d'accueil
 *                  utilise la fonction getArticles (définie dans model.php)
 *                  pour récupérer la liste des articles
 * 
 * @upgrade         
 * 
 */

// Page d'accueil -> route correspondant à l'URL racine de l'application ('/')
$app->get('/', function() {
    require '../src/model.php';
    $articles = getArticles();
    
    // Le couple ob_start et ob_get_clean récupère le résultat de l'appel à require
    // c'est à dire, la vue HTML générée, dans la variable $view
    // La variable $view est ranvoyé par le contrôleur
    ob_start();                     // Enclenche la temporisation de sortie HTML
    require '../views/view.php';
    $view = ob_get_clean();         // Lit le contenu courant du tampon en l'assignant à $view puis l'efface
    
    return $view;
});