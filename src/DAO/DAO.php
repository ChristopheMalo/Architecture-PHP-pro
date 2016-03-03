<?php

namespace MicroCMS\DAO;

use Doctrine\DBAL\Connection;

/**
 * MicroCMS
 * =========================================================================================================
 * 
 * Data Access Object - Objet d'accès aux données
 * 
 * 
 * @author      Christophe Malo
 * @date        02/03/2016
 * @version     1.0.0
 * @copyright   OpenClassrooms - Baptiste Pesquet
 */
abstract class DAO
{
    
    /**
     * Connexion à la base de données - Objet
     * 
     * @var \Doctrine\DBAL\Connection
     */
    private $db;
    
    /**
     * Le constucteur
     * 
     * @param object \Doctrine\DBAL\Connection L'objet de connexion à la DB
     * @return void
     */
    public function __construct(Connection $db)
    {
        $this->db = $db;
    }
    
    /**
     * Donne accès à l'objet de connexion à la DB
     * 
     * @return object \Doctrine\DBAL\Connection L'objet de connexion à la DB
     */
    protected function getDb()
    {
        return $this->db;
    }
    
    /**
     * Construit un objet de domaine (Article, Commentaire...) à partir d'une entrée de la DB
     * Doit être définie par des classes enfants.
     */
    protected abstract function buildDomainObject($row);
}
