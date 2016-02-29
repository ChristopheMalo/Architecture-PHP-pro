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
 * @version     1.0.0
 * @copyright   OpenClassrooms - Baptiste Pesquet
 */

// Inclure la configuration de production
require __DIR__ . '/prod.php';

// Active le mode de débogage
$app['debug'] = true;