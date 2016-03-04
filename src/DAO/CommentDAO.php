<?php

namespace MicroCMS\DAO;

use MicroCMS\Domain\Comment;

/**
 * MicroCMS
 * =========================================================================================================
 * 
 * Classe représentant le code d'accès aux données d'un commentaire
 * 
 *
 * @author      Christophe Malo
 * @date        02/03/2016
 * @version     1.0.0
 * @copyright   OpenClassrooms - Baptiste Pesquet
 */
class CommentDAO extends DAO {
    
    /**
     * Un article concerné par le commentaire
     * 
     * @var \MicroCMS\DAO\ArticleDAO
     */
    private $articleDAO;
    
    /**
     * L'auteur du commentaire
     * 
     * @var \MicroCMS\DAO\UserDAO;
     */
    private $userDao;
    
    /**
     * Définit l'article qui va recevoir le commentaire
     * 
     * @param \MicroCMS\DAO\ArticleDAO $articleDAO
     * @return void
     */
    public function setArticleDAO(ArticleDAO $articleDAO)
    {
        $this->articleDAO = $articleDAO;
    }
    
    /**
     * 
     * @param \MicroCMS\DAO\UserDAO $userDAO
     */
    public function setUserDAO(UserDAO $userDAO)
    {
        $this->userDAO = $userDAO;
    }
    
    /**
     * Méthode qui permet d'obtenir / retourner une liste de tous les commentaires pour un article,
     * les commentaires sont triés par date (le plus récent en dernier)
     * 
     * @param int $articleId L'identifiant de l'article associé au commentaire
     * @return array $comments La liste de tous les commentaires de l'article concerné
     */
    public function findAllByArticle($articleId)
    {
        // L'article associé est extrait une seule fois
        $article = $this->articleDAO->find($articleId);

        // art_id n'est pas sélectionné par la requête sql
        // L'article n'est pas récupéré lors de la construction de domaine objet
        $sql = "SELECT com_id, com_content, usr_id FROM t_comment WHERE art_id=? ORDER BY com_id";
        $result = $this->getDb()->fetchAll($sql, array($articleId));

        // Convertit le résultat de la requête en un tableau d'objet du domaine
        $comments = array();
        foreach ($result as $row)
        {
            $comId = $row['com_id'];
            $comment = $this->buildDomainObject($row);
            
            // L'article associé est défini ici pour le commentaire construit
            $comment->setArticle($article);
            $comments[$comId] = $comment;
        }
        
        return $comments;
    }
    
    /**
     * Méthode permettant de créer / définir un objet Commentaire
     * Basé sur un enregistrement (une ligne) de la table commentaire en DB
     * 
     * @param array $row Liste d'un enregistrement de la DB contenant toutes les données d'un commentaire
     * @return \MicroCMS\Domain\Comment $comment Un commentaire
     */
    protected function buildDomainObject($row)
    {
        $comment = new Comment();
        $comment->setId($row['com_id']);
        $comment->setContent($row['com_content']);

        // Si art_id présent dans la ligne de résultat SQL
        // Alors construction de l'objet
        // Permet de construire l'objet qu'une seule fois dans la méthode findAllByArticles
        // => Pour limiter les requêtes SQL et améliorer les performances de l'application 
        if (array_key_exists('art_id', $row))
        {
            // Trouve et définit l'article associé au commentaire
            $articleId = $row['art_id'];
            $article = $this->articleDAO->find($articleId);
            $comment->setArticle($article);
        }
        
        if (array_key_exists('usr_id', $row))
        {
            // Trouver et définit L'auteur associé au commentaire
            $userId = $row['usr_id'];
            $user = $this->userDao->find($userId);
            $comment->setAuthor($user);
        }
        
        return $comment;

    }
    
}
