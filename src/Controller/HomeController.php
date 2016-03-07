<?php

namespace MicroCMS\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use MicroCMS\Domain\Comment;
use MicroCMS\Form\Type\CommentType;

/**
 * MicroCMS
 * =========================================================================================================
 * 
 * Classe gérant les contrôleurs accessibles depuis la page d'accueil
 * 
 *
 * @author      Christophe Malo
 * @date        06/02/2016
 * @version     1.0.0
 * @copyright   OpenClassrooms - Baptiste Pesquet
 */

class HomeController {

    /**
     * Contrôleur de la page d'accueil
     *
     * @param Application $app L'application Silex
     * @return View index
     */
    public function indexAction(Application $app)
    {
        // Utilisation du service dao.article enregistré dans app/app.php
        // Cet appel à $app['dao.article'] renvoie un objet de la class ArticleDAO
        // Ensuite on peut utiliser une des méthodes de l'objet,
        // ici findAll pour récupérer la liste des articles
        $articles = $app['dao.article']->findAll();
        
        // Le service Twig ($app['twig'] génère le template index.html.twig en lui passant des données dynamiques,
        // ici la variable articles (array d'objets de la classe Article)
        return $app['twig']->render('index.html.twig', array('articles' => $articles));
    }

    /**
     * Contrôleur d'un article détaillé
     * Accessible par un clic sur le titre de l'article
     *
     * @param int $id Lidentifiant de l'article
     * @param Request $request La requête entrante
     * @param Application $app L'application Silex
     * @return View article détaillé
     */
    public function articleAction($id, Request $request, Application $app)
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
            $commentForm = $app['form.factory']->create(new CommentType(), $comment);
            $commentForm->handleRequest($request); // Form submission
            if ($commentForm->isSubmitted() && $commentForm->isValid())
            {
                $app['dao.comment']->save($comment);
                $app['session']->getFlashBag()->add('success', 'Your comment was succesfully added.');
            }
            $commentFormView = $commentForm->createView();
        }
        $comments = $app['dao.comment']->findAllByArticle($id);
        return $app['twig']->render('article.html.twig', array(
            'article' => $article, 
            'comments' => $comments,
            'commentForm' => $commentFormView));
    }

    /**
     * Contrôleur du formulaire de connexion d'un utilisateur
     *
     * @param Request $request Requête entrante
     * @param Application $app L'application Silex
     * @return View login
     */
    public function loginAction(Request $request, Application $app)
    {
        return $app['twig']->render('login.html.twig', array(
            'error'         => $app['security.last_error']($request),
            'last_username' => $app['session']->get('_security.last_username'),
            ));
    }
    
}
