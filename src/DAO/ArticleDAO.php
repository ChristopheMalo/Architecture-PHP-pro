<?php

namespace MicroCMS\DAO;

use Doctrine\DBAL\Connection;
use MicroCMS\Domain\Article;

/**
 * MicroCMS
 * =========================================================================================================
 * 
 * Classe représentant le code d'accès aux données d'un article
 * 
 *
 * @author      Christophe Malo
 * @date        29/02/2016
 * @version     1.0.0
 * @copyright   OpenClassrooms - Baptiste Pesquet
 */
class ArticleDAO
{
    
    /**
     * Connexion à la base de données
     * 
     * @var \Doctrine\DBAL\Connection
     */
    private $db;
    
    /**
     * Méthode de construction pour se connecter à la DB
     * 
     * @param Connection $db L'objet de connexion de la base de données
     * @return void
     */
    public function __construct(Connection $db)
    {
        $this->db = $db;
    }
    
    /**
     * Méthode permettant de retourner une liste de tous les articles, classés par date (Le plus récent en premier)
     * 
     * @return array $articles La liste de tous les articles
     */
    public function findAll()
    {
        $sql = "SELECT * FROM t_article ORDER BY art_id DESC";
        $result = $this->db->fetchAll($sql);
        
        $articles = array();
        foreach ($result as $row)
        {
            $articleId = $row['art_id'];
            $articles[$articleId] = $this->buildArticle($row);
        }
        
        return $articles;
    }
    
    /**
     * Méthode permettant de créer un objet article basé sur un enregistrement de la DB
     * 
     * @param array $row Un enregistrement (une ligne) de la DB contenant un article
     * @return Object \MicroCMS\Domain\Article Un objet article
     */
    private function buildArticle(array $row)
    {
        $article = new Article();
        $article->setId($row['art_id']);
        $article->setTitle($row['art_title']);
        $article->setContent($row['art_content']);
        
        return $article;
    }
    
}