<?php

use Symfony\Component\HttpFoundation\Request;
use MicroCMS\Domain\Comment;
use MicroCMS\Domain\Article;
use MicroCMS\Form\Type\CommentType;
use MicroCMS\Form\Type\ArticleType;

/**
 * MicroCMS
 * =========================================================================================================
 *
 * Controleur de gestion des routes de l'application - Itération 3 du projet<br>
 * Routes = Points d'entrées dans l'application
 * Ce fichier est composé de l'ensemble des controleurs
 * qui gèrent les routes de l'application (frontend et backend)
 * 
 * @author      Christophe Malo
 * @date        29/02/2016
 * @update      05/03/2016
 * @version     1.0.3
 * @copyright   OpenClassrooms - Baptiste Pesquet
 * 
 * 
 * @commentaire     La fonction anonyme associée à la route de la page d'accueil
 *                  utilise la fonction getArticles (définie dans model.php)
 *                  pour récupérer la liste des articles
 *                  
 *                  v1.0.1 : intégrer refactor view et commentaire
 *                  v1.0.2 : updater la route de l'article pour les commentaires
 *                  v1.0.3 : coder les controleurs des routes du back-office
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


/**
 * Back-office
 */
// Page d'accueil administration
$app->get('/admin', function() use ($app)
{

    $articles = $app['dao.article']->findAll();
    $comments = $app['dao.comment']->findAll();
    $users = $app['dao.user']->findAll();
    return $app['twig']->render('admin.html.twig', array(
        'articles'  => $articles,
        'comments'  => $comments,
        'users'     => $users));
    
})->bind('admin');

/**
 * Back office gestion des articles
 */
// Ajouter un nouvel article
$app->match('/admin/article/add', function(Request $request) use ($app)
{

    $article = new Article();
    $articleForm = $app['form.factory']->create(new ArticleType(), $article);
    $articleForm->handleRequest($request);
    if ($articleForm->isSubmitted() && $articleForm->isValid())
    {
        $app['dao.article']->save($article);
        $app['session']->getFlashBag()->add('success', 'L\'article est bien créé.');
    }
    return $app['twig']->render('article_form.html.twig', array(
        'title' => 'New article',
        'articleForm' => $articleForm->createView()));
    
})->bind('admin_article_add');

// Editer un article existant
$app->match('/admin/article/{id}/edit', function($id, Request $request) use ($app)
{

    $article = $app['dao.article']->find($id);
    $articleForm = $app['form.factory']->create(new ArticleType(), $article);
    $articleForm->handleRequest($request);
    if ($articleForm->isSubmitted() && $articleForm->isValid())
    {
        $app['dao.article']->save($article);
        $app['session']->getFlashBag()->add('success', 'L\'article est bien mis à jour.');
    }
    return $app['twig']->render('article_form.html.twig', array(
        'title' => 'Edit article',
        'articleForm' => $articleForm->createView()));
    
})->bind('admin_article_edit');

// Effacer un article
$app->get('/admin/article/{id}/delete', function($id, Request $request) use ($app)
{
    
    // Effacer les commentaires associées
    $app['dao.comment']->deleteAllByArticle($id);
    // Effacer l'article article
    $app['dao.article']->delete($id);
    $app['session']->getFlashBag()->add('success', 'L\'article est bien supprimé.');
    // Rediriger vers la page d'accueil admin
    return $app->redirect($app['url_generator']->generate('admin'));

})->bind('admin_article_delete');


/**
 * BAckoffice gestion des commentaires
 */
// Editer un commentaire existant
$app->match('/admin/comment/{id}/edit', function($id, Request $request) use ($app)
{

    $comment = $app['dao.comment']->find($id);
    $commentForm = $app['form.factory']->create(new CommentType(), $comment);
    $commentForm->handleRequest($request);
    if ($commentForm->isSubmitted() && $commentForm->isValid())
    {
        $app['dao.comment']->save($comment);
        $app['session']->getFlashBag()->add('success', 'Le commentaire est bien mis à jour.');
    }
    return $app['twig']->render('comment_form.html.twig', array(
        'title' => 'Edit comment',
        'commentForm' => $commentForm->createView()));

})->bind('admin_comment_edit');

// Effacer un commentaire
$app->get('/admin/comment/{id}/delete', function($id, Request $request) use ($app)
{
    
    $app['dao.comment']->delete($id);
    $app['session']->getFlashBag()->add('success', 'le commentaire est bien effacé.');
    // Rediriger vers la page d'acceuil admin
    return $app->redirect($app['url_generator']->generate('admin'));
    
})->bind('admin_comment_delete');