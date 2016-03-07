<?php

/**
 * MicroCMS
 * =========================================================================================================
 *
 * Controleur de gestion des routes de l'application - Itération 13 du projet<br>
 * Routes = Points d'entrées dans l'application
 * 
 * @author      Christophe Malo
 * @date        29/02/2016
 * @update      07/03/2016
 * @version     1.0.4
 * @copyright   OpenClassrooms - Baptiste Pesquet
 * 
 * 
 * @commentaire v1.0.1 : intégrer refactor view et commentaire
 *              v1.0.2 : updater la route de l'article pour les commentaires
 *              v1.0.3 : coder les controleurs des routes du back-office
 *              V1.0.4 : Suppression des controleurs dans ce fichier
 *                       réécriture des routes suite création des contrôleurs séparés
 */

// Home page
$app->get('/', "MicroCMS\Controller\HomeController::indexAction")->bind('home');

// Detailed info about an article
$app->match('/article/{id}', "MicroCMS\Controller\HomeController::articleAction")->bind('article');

// Login form
$app->get('/login', "MicroCMS\Controller\HomeController::loginAction")->bind('login');

// Admin zone
$app->get('/admin', "MicroCMS\Controller\AdminController::indexAction")->bind('admin');

// Add a new article
$app->match('/admin/article/add', "MicroCMS\Controller\AdminController::addArticleAction")->bind('admin_article_add');

// Edit an existing article
$app->match('/admin/article/{id}/edit', "MicroCMS\Controller\AdminController::editArticleAction")->bind('admin_article_edit');

// Remove an article
$app->get('/admin/article/{id}/delete', "MicroCMS\Controller\AdminController::deleteArticleAction")->bind('admin_article_delete');

// Edit an existing comment
$app->match('/admin/comment/{id}/edit', "MicroCMS\Controller\AdminController::editCommentAction")->bind('admin_comment_edit');

// Remove a comment
$app->get('/admin/comment/{id}/delete', "MicroCMS\Controller\AdminController::deleteCommentAction")->bind('admin_comment_delete');

// Add a user
$app->match('/admin/user/add', "MicroCMS\Controller\AdminController::addUserAction")->bind('admin_user_add');

// Edit an existing user
$app->match('/admin/user/{id}/edit', "MicroCMS\Controller\AdminController::editUserAction")->bind('admin_user_edit');

// Remove a user
$app->get('/admin/user/{id}/delete', "MicroCMS\Controller\AdminController::deleteUserAction")->bind('admin_user_delete');

// API : get all articles
$app->get('/api/articles', "MicroCMS\Controller\ApiController::getArticlesAction")->bind('api_articles');

// API : get an article
$app->get('/api/article/{id}', "MicroCMS\Controller\ApiController::getArticleAction")->bind('api_article');

// API : create an article
$app->post('/api/article', "MicroCMS\Controller\ApiController::addArticleAction")->bind('api_article_add');

// API : remove an article
$app->delete('/api/article/{id}', "MicroCMS\Controller\ApiController::deleteArticleAction")->bind('api_article_delete');
