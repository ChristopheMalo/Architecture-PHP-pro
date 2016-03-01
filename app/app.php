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
 * @update      01/03/2016
 * @version     1.0.0
 * @copyright   OpenClassrooms - Baptiste Pesquet
 * 
 * @commentaire update du 01/03/2016 : intégrer moteur template Twig au projet
 */

// Configuration de Silex pour gérer les potentielles erreurs
// pendant l'execution de l'application
ErrorHandler::register();
ExceptionHandler::register();

// Enregistre le fournisseur de services associé à DBAL -> DoctrineServiceProvider
$app->register(new Silex\Provider\DoctrineServiceProvider());

// Enregistre Twig vers le chemin du dossier de templates (views) 
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__ . '/../views',
));

// Enregistre un service (dao.article) sous forme
// d'une instance partagée de la classe ArticleDAO
$app['dao.article'] = $app->share(function ($app)
{
    return new MicroCMS\DAO\ArticleDAO($app['db']);
});