<?php
/**
 * MicroCMS
 * =========================================================================================================
 *
 * Fichier de configuration pour la phase de développement
 * Ce fichier inclut le fichier de configuration de production
 * Il paramètre Silex pour afficher des informations de débogage détaillées en cas d'erreur
 * 
 * @author      Christophe Malo
 * @date        29/02/2016
 * @update      06/02/2016
 * @version     1.0.1
 * @copyright   OpenClassrooms - Baptiste Pesquet
 * 
 * @commentaire v1.0.1 du 06/02/2016 : intégrer config pour tests unitaires - identique à prod sous MAMP
 */
// Doctrine (db)
$app['db.options'] = array(
    'driver'    => 'pdo_mysql',
    'charset'   => 'utf8',
    'host'      => 'localhost',
    'port'      => '3306',
    'dbname'    => 'microcms',
    'user'      => 'microcms_user',
    'password'  => 'mdb_secret_cms',
);

// Active le mode de débogage
$app['debug'] = true;

// Définit le niveau des logs
$app['monolog.level'] = 'INFO';