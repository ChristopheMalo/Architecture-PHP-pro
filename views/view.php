<?php
/**
 * micro-CMS
 * =========================================================================================================
 *
 * Vue index (view) - Itération 2 du projet
 * 
 * @author          Christophe Malo
 * @started         29/02/2016
 * @updated         
 * @project         micro-CMS
 * @namefile        view.php
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
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>micro-CMS - Page d'accueil</title>
        <link href="css/microcms.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <header>
            <h1>micro-CMS</h1>
        </header>
        
        <section>
            <?php foreach ($articles as $article): ?>
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