<?php

namespace MicroCMS\Tests;

require_once __DIR__.'/../../vendor/autoload.php';

use Silex\WebTestCase;

/**
 * MicroCMS
 * =========================================================================================================
 *
 * Méthode permettant de tester toutes les URLs de l'application avec un jeu de test unitaire
 * 
 * @author      Christophe Malo
 * @date        06/02/2016
 * @update     
 * @version     1.0.0
 * @copyright   OpenClassrooms - Baptiste Pesquet
 * 
 * @commentaire Utiliser la config Prod pour les tests unitaires
 *              La config Dev (monolog info + debug) génère des erreurs avec phpunit
 */

class AppTest extends WebTestCase
{
    
    /** 
     * Tests fonctionnels de base, inspiré par les 'best practice' de symfony.
     * vérifie simplement que toutes les URL de l'application se chargent avec succès.
     * Pendant l'exécution de test , cette méthode est appelée pour chaque URL renvoyée par la méthode provideUrls.
     *
     * @dataProvider provideUrls 
     */
    public function testPageIsSuccessful($url)
    {
        $client = $this->createClient();
        $client->request('GET', $url);

        $this->assertTrue($client->getResponse()->isSuccessful());
    }

    /**
     * {@inheritDoc}
     */
    public function createApplication()
    {
        // Instantie, configure et renvoit l'application
        $app = new \Silex\Application();
        
        require __DIR__.'/../../app/config/prod.php'; // Pour php unit
        require __DIR__.'/../../app/app.php';
        require __DIR__.'/../../app/routes.php';
        
        // Génère des exceptions brutes au lieu de pages HTML si des erreurs se produisent
        $app['exception_handler']->disable();
        // Simule une session pour le test
        $app['session.test'] = true;
        // Active un accès anonyme à la partie administration
        $app['security.access_rules'] = array();

        return $app;
    }

    /**
     * Fournit toutes les URL d'applications valides.
     *
     * @return array La liste de toutes les URL valides de l'application
     */
    public function provideUrls()
    {
        return array(
            array('/'),
            array('/article/1'),
            array('/login'),
            array('/admin'),
            array('/admin/article/add'),
            array('/admin/article/1/edit'),
            array('/admin/comment/1/edit'),
            array('/admin/user/add'),
            array('/admin/user/1/edit'),
            array('/api/articles'),
            array('/api/article/1'),
        ); 
    }
    
}
