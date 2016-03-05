<?php

use Symfony\Component\HttpFoundation\Request;
use MicroCMS\Domain\Comment;
use MicroCMS\Form\Type\CommentType;

/**
 * MicroCMS
 * =========================================================================================================
 *
 * Controleur de gestion des routes de l'application - Itération 3 du projet<br>
 * Routes = Points d'entrées dans l'application
 * 
 * @author      Christophe Malo
 * @date        29/02/2016
 * @update      02/03/2016
 * @version     1.0.1
 * @copyright   OpenClassrooms - Baptiste Pesquet
 * 
 * 
 * @commentaire     La fonction anonyme associé à la route de la page d'accueil
 *                  utilise la fonction getArticles (définie dans model.php)
 *                  pour récupérer la liste des articles
 *                  
 *                  v1.0.1 : intégrer refactor view et commentaire
 */

// Page d'accueil -> route correspondant à l'URL racine de l'application ('/')
$app->get('/', function() use ($app)
{
    
    // Utilisation du service dao.article enregistré dans app/app.php
    // Cet appel à $app['dao.article'] renvoie un objet de la class ArticleDAO
    // ENsuite on peut utiliser une des méthodes de l'objet,
    // ici findAll pour récupérer la liste des articles
    $articles = $app['dao.article']->findAll();
    
    // Le couple ob_start et ob_get_clean récupère le résultat de l'appel à require
    // c'est à dire, la vue HTML générée, dans la variable $view
    // La variable $view est ranvoyé par le contrôleur
//    ob_start();                     // Enclenche la temporisation de sortie HTML
//    require '../views/view.php';
//    $view = ob_get_clean();         // Lit le contenu courant du tampon en l'assignant à $view puis l'efface
//    
//    return $view;
    
    // Le service Twig ($app['twig'] génère le template index.html.twig
    // en lui passant des données dynamiques,
    // ici la variable articles (array d'objets de la classe Article
    return $app['twig']->render('index.html.twig', array('articles' => $articles));
})->bind('home');



// Article détaillé avec les commentaires
// match permet de gérer Get et Post
$app->match('/article/{id}', function ($id, Request $request) use ($app)
{
    
    $article = $app['dao.article']->find($id);
    $commentFormView = null;
    
    if ($app['security.authorization_checker']->isGranted('IS_AUTHENTICATED_FULLY'))
    {
        // L'utilisateur est authentifié, il peut commenter
        $comment = new Comment();
        $comment->setArticle($article);
        $user = $app['user'];
        $comment->setAuthor($user);
        $commentForm = $app['form.factory']->create(new CommentType(), $comment); // Création du commentaire
        $commentForm->handleRequest($request); // Soumission du formulaire
        
        if ($commentForm->isSubmitted() && $commentForm->isValid())
        {
            $app['dao.comment']->save($comment);
            $app['session']->getFlashBag()->add('success', 'Votre commentaire a été ajouté');
        }
        
        $commentFormView = $commentForm->createView();
    }
    
    $comments = $app['dao.comment']->findAllByArticle($id);
    
    return $app['twig']->render('article.html.twig', array(
        'article'       => $article,
        'comments'      => $comments,
        'commentForm'   => $commentFormView));
    
})->bind('article');



// Formulaire de login
$app->get('/login', function(Request $request) use ($app)
{
    return $app['twig']->render('login.html.twig', array(
        'error'         => $app['security.last_error']($request),
        'last_username' => $app['session']->get('_security.last_username'),
    ));
})->bind('login');