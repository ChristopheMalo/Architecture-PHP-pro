<?php

namespace MicroCMS\Domain;

/**
 * MicroCMS
 * =========================================================================================================
 * 
 * Classe représentant un commentaire
 * 
 *
 * @author      Christophe Malo
 * @date        01/03/2016
 * @version     1.0.0
 * @copyright   OpenClassrooms - Baptiste Pesquet
 */
class Comment {
    
    /** Les attributs **/
    /**
     * L'identifiant du commentaire
     * 
     * @var int
     */
    private $id;
    
    /**
     * L'auteur du commentaire
     * 
     * @var \MicroCMS\Domain\User
     */
    private $author;
    
    /**
     * Le contenu du commentaire
     * 
     * @var string
     */
    private $content;
    
    /**
     * L'article associé au commentaire
     * 
     * @var \MicroCMS\Domain\Article
     */
    private $article;
    
    
    /** Les getters - Accesseurs **/
    /**
     * Obtient l'identifiant du commentaire
     * 
     * @return int $id
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * Obtient l'auteur du commentaire

     * @return \MicroCMS\Domain\User $author
     */
    public function getAuthor()
    {
        return $this->author;
    }
    
    /**
     * Obtient le contenu du commentaire
     * 
     * @return string $content
     */
    public function getContent()
    {
        return $this->content;
    }
    
    /**
     * Obtient l'article associé au commentaire
     * 
     * @return \MicroCMS\Domain\Article
     */
    public function getArticle()
    {
        return $this->article;
    }
    
    
    /** Les setters - Mutateurs **/
    /**
     * Définit l'identifiant du commentaire
     * 
     * @param int $id
     * @return void
     */
    public function setId($id)
    {
        $this->id = $id;
    }
    
    /**
     * Définit l'auteur du commentaire
     * 
     * @param \MicroCMS\Domain\User $author
     * @return void
     */
    public function setAuthor(User $author)
    {
        $this->author = $author;
    }
    
    /**
     * Définit le contenu du commentaire
     * 
     * @param string $content
     * @return void
     */
    public function setContent($content)
    {
        $this->content = $content;
    }
    
    /**
     * Définit l'article associé au commentaire
     * 
     * @param \MicroCMS\Domain\Article $article
     * @return void
     */
    public function setArticle(Article $article)
    {
        $this->article = $article;
    }
    
}