<?php
/**
 * micro-CMS
 * =========================================================================================================
 *
 * Model : fichier d'accès aux données - Itération 2 du projet
 * Remplacer les données d'accès d'exemple de l'utilisateur par vos propres données
 * 
 * @author          Christophe Malo
 * @started         29/02/2016
 * @updated         
 * @project         micro-CMS
 * @namefile        model.php
 * @fileversion     1.0.0
 * @phpversion      5.6.10
 * @htmlversion     HTML5
 * @cssversion      CSS3
 * @jqueryversion   
 * 
 * @commentaire     
 * 
 * @upgrade         
 * 
 */

function getArticles()
{
    // Accès aux données
    $bdd = new PDO('mysql:host=localhost;dbname=microcms;charset=utf8', 'votre_user_name_user_db', 'votre_mot_de_passe');
    $articles = $bdd->query('SELECT * FROM t_article ORDER BY art_id DESC');
    return $articles;
}