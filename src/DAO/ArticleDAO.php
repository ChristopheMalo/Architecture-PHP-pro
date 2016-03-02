<?php

namespace MicroCMS\DAO;

use MicroCMS\Domain\Article;

/**
 * MicroCMS
 * =========================================================================================================
 * 
 * Classe représentant le code d'accès aux données d'un article - Model
 * 
 *
 * @author      Christophe Malo
 * @date        29/02/2016
 * @update      02/03/2016
 * @version     1.0.1
 * @copyright   OpenClassrooms - Baptiste Pesquet
 * 
 * @commentaire update v1.0.1 : refactoring du code pour utiliser la class DAO
 */
class ArticleDAO extends DAO
{
    /**
     * Méthode permettant d'obtenir / retourner un article
     * correspondant à l'identifiant fourni en argument
     * 
     * @param type $id L'identifiant de l'article
     * @return Object \MicroCMS\Domain\Article Un objet article
     * @throws \Exception
     */
    public function find($id)
    {
        $sql = "SELECT * FROM t_article WHERE art_id=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));
        
        if ($row)
        {
            return $this->buildDomainObject($row);
        }
        else
        {
            throw new \Exception("Pas d'article correspondant à cet id " . $id);
        }
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
            $articles[$articleId] = $this->buildDomainObject($row);
        }
        
        return $articles;
    }
    
    /**
     * Méthode permettant de créer un objet article basé sur un enregistrement de la DB
     * 
     * @param array $row Un enregistrement (une ligne) de la DB contenant un article
     * @return Object \MicroCMS\Domain\Article Un objet article
     */
    protected function buildDomainObject($row)
    {
        $article = new Article();
        $article->setId($row['art_id']);
        $article->setTitle($row['art_title']);
        $article->setContent($row['art_content']);
        
        return $article;
    }
    
}