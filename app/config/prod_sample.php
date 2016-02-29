<?php

/**
 * MicroCMS
 * =========================================================================================================
 *
 * Fichier de configuration du paramétrage de la connexion à la DB via Doctrine DBAL
 * Renommer le fichier prod_sample.php en prod.php
 * 
 * @author      Christophe Malo
 * @date        29/02/2016
 * @version     1.0.0
 * @copyright   OpenClassrooms - Baptiste Pesquet
 */
// Connexion à la DB avec Doctrine
$app['db.options'] = array(
    'driver'    => 'pdo_mysql',
    'charset'   => 'utf8',
    'host'      => 'localhost',
    'port'      => '3306',
    'dbname'    => 'microcms',
    'user'      => 'votre_user_name_user_db',
    'password'  => 'votre_mot_de_passe',
);