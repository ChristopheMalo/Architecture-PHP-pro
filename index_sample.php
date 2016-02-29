<?php
/**
 * micro-CMS
 * =========================================================================================================
 *
 * Page d'accueil d'exemple avec accès fictifs - Itération 1 du projet
 * 
 * @author          Christophe Malo
 * @started         29/02/2016
 * @updated         
 * @project         micro-CMS
 * @namefile        index_sample.php
 * @fileversion     1.0.0
 * @phpversion      5.6.10
 * @htmlversion     HTML5
 * @cssversion      CSS3
 * @jqueryversion   
 * 
 * @commentaire     Ce fichier contient des accès fictif à une DB
 *                  Il faut les rempalcer par vos propres accès
 *                  Vous pouvez également supprimer le _sample derrière index 
 * 
 * @upgrade         
 * 
 */
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>micro-CMS - Page d'accueil</title>
        <link href="microcms.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <header>
            <h1>micro-CMS</h1>
        </header>
        
        <section>
            <?php
            $bdd = new PDO('mysql:host=localhost;dbname=microcms;charset=utf8', 'votre_user_name_user_db', 'votre_mot_de_passe');
            $articles = $bdd->query('SELECT * FROM t_article ORDER BY art_id DESC');

            foreach ($articles as $article):
            ?>
            <article>
                <h2><?php echo $article['art_title']; ?></h2>
                <p><?php echo $article['art_content'] ?></p>
            </article>
            <?php endforeach ?>
        </section>
        
        <footer class="footer">
            <a href="https://github.com/ChristopheMalo/micro-CMS">micro-CMS</a> est un CMS minimaliste construit comme une vitrine pour montrer les aspects d'un développement PHP moderne..
        </footer>
        
    </body>
</html>