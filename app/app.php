<?php

use Symfony\Component\Debug\ErrorHandler;
use Symfony\Component\Debug\ExceptionHandler;

/**
 * MicroCMS
 * =========================================================================================================
 *
 * Fichier contenant le paramétrage de l'application Silex
 * 
 * @author      Christophe Malo
 * @date        29/02/2016
 * @update      02/03/2016
 * @version     1.0.2
 * @copyright   OpenClassrooms - Baptiste Pesquet
 * 
 * @commentaire v1.0.1 du 01/03/2016 : intégrer moteur template Twig au projet
 *              v1.0.2 du 02/03/2016 : enregistrer le service d'accès aux commentaires
 */

/**
 * Configuration de Silex pour gérer les potentielles erreurs
 * pendant l'execution de l'application
 */
ErrorHandler::register();
ExceptionHandler::register();


/**
 * Enregistrement des fournisseurs de services
 * 
 * 
 */

/**
 * Enregistre le fournisseur de services associé à DBAL -> DoctrineServiceProvider
 */
$app->register(new Silex\Provider\DoctrineServiceProvider());

/**
 * Enregistre Twig vers le chemin du dossier de templates (views) 
 */
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__ . '/../views',
));

/**
 * Enregistre le fournisseur de service Url associé au composant twig-bridge
 */
$app->register(new Silex\Provider\UrlGeneratorServiceProvider());



/**
 * Enregistrement des services
 * 
 * 
 */

/**
 * Enregistre un service (dao.article) sous forme
 * d'une instance partagée de la classe ArticleDAO
 */
$app['dao.article'] = $app->share(function ($app)
{
    return new MicroCMS\DAO\ArticleDAO($app['db']);
});

/**
 * Enregistre le service d'accès aux commentaires
 */
$app['dao.comment'] = $app->share(function ($app) {
    $commentDAO = new MicroCMS\DAO\CommentDAO($app['db']);
    $commentDAO->setArticleDAO($app['dao.Article']);
    return $commentDAO;
});