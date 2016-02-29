<?php

namespace MicroCMS\Domain;

/**
 * MicroCMS
 * =========================================================================================================
 * 
 * Classe représentant un article
 * 
 *
 * @author      Christophe Malo
 * @date        29/02/2016
 * @version     1.0.0
 * @copyright   OpenClassrooms - Baptiste Pesquet
 */
class Article
{
    
    /** Les attributs **/
    /**
     * Identifiant de l'article
     * 
     * @var int 
     */
    private $id;
    
    /**
     * Le titre de l'article
     * 
     * @var string
     */
    private $title;
    
    /**
     * Le contenu de l'article
     * 
     * @var string
     */
    private $content;
    
    /**  Les accesseurs - Les getters **/
    /**
     * Retourne l'identifiant de l'article
     * 
     * @return int $id L'identifiant de l'article
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * Retourne le titre de l'article
     * 
     * @return string $title Le titre de l'article
     */
    public function getTitle()
    {
        return $this->title;
    }
    
    /**
     * Retourne le contenu de l'article
     * 
     * @return string $content Le contenu de l'article
     */
    public function getContent()
    {
        return $this->content;
    }
    
    /** Les mutateurs - Les setters **/
    /**
     * Assigne un identifiant à l'article
     * 
     * @param int $id
     * @return void
     */
    public function setId($id)
    {
        $this->id = $id;
    }
    
    /**
     * Assigne un titre à l'article
     * 
     * @param string $title
     * @return void
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }
    
    /**
     * Assigne un contenu à l'article
     * 
     * @param string $content
     * @return void
     */
    public function setContent($content)
    {
        $this->content = $content;
    }
    
}