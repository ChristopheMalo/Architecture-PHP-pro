<?php
/**
 * MicroCMS
 * =========================================================================================================
 *
 * Model : fichier d'accès aux données - Itération 2 du projet
 * 
 * @author      Christophe Malo
 * @date        29/02/2016
 * @version     1.0.0
 * @copyright   OpenClassrooms - Baptiste Pesquet
 */

function getArticles()
{
    // Accès aux données
    $bdd = new PDO('mysql:host=localhost;dbname=microcms;charset=utf8', 'votre_user_name_user_db', 'votre_mot_de_passe');
    $articles = $bdd->query('SELECT * FROM t_article ORDER BY art_id DESC');
    return $articles;
}