<?php

namespace MicroCMS\DAO;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use MicroCMS\Domain\User;

/**
 * MicroCMS
 * =========================================================================================================
 * 
 * Classe représentant le code d'accès aux données d'un utilisateur - Model
 * 
 *
 * @author      Christophe Malo
 * @date        04/03/2016
 * @version     1.0.O
 * @copyright   OpenClassrooms - Baptiste Pesquet
 */
class UserDAO extends DAO implements UserProviderInterface {
    
    /**
     * Retourne un utilisateur correspondant à l'id en argument
     * 
     * @param int $id
     * @return int $id L'identifiant de l'utilisateur
     * @throws \MicroCMS\Domain\User\Exception Si un utilisayteur n'est pas trouvé
     */
    public function find($id)
    {
        $sql = "SELECT * FROM t_user WHERE usr_id=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));
        
        if ($row)
        {
            return $this->buildDomainObject ($row);
        }
        else
        {
            throw new \Exception("Pas d'utilisateur avec cet id " . $id);
        }
    }
    
    /**
     * Méthode permettant de retourner une liste de tous les utilisateurs, classés par rôle et username
     * 
     * @return array $entities La liste de tous les utilisateurs
     */
    public function findAll()
    {
        $sql = "SELECT * FROM t_user ORDER BY usr_role, usr_name";
        $result = $this->getDb()->fetchAll($sql);

        // Convertit le résultat de la requête en un array d'objets du domaine
        $entities = array();
        foreach ($result as $row) {
            $id = $row['usr_id'];
            $entities[$id] = $this->buildDomainObject($row);
        }
        return $entities;

    }
    
    /**
     * @inheritDoc
     */
    public function loadUserByUsername($username) {
        $sql = "select * from t_user where usr_name=?";
        $row = $this->getDb()->fetchAssoc($sql, array($username));

        if ($row)
        {
            return $this->buildDomainObject($row);
        }
        else
        {
            throw new UsernameNotFoundException(sprintf('Utilisateur "%s" pas trouvé.', $username));
        }
    }
    
    /**
     * @inheritDoc
     */
    public function refreshUser(UserInterface $user) {
        $class = get_class($user);
        if (!$this->supportsClass($class))
        {
            throw new UnsupportedUserException(sprintf('Instances de "%s" n\'est pas supportée.', $class));
        }
        return $this->loadUserByUsername($user->getUsername());

    }
    
    /**
     * @inheritDoc
     */
    public function supportsClass($class) {
        return 'MicroCMS\Domain\User' === $class;
    }
    
    /**
     * Méthode permettant de créer un objet user basé sur un enregistrement de la DB
     * 
     * @param array $row Un enregistrement (une ligne) de la DB contenant un utilisateur
     * @return \MicroCMS\Domain\User $user Un utilisateur
     */
    protected function buildDomainObject($row) {
        $user = new User();
        $user->setId($row['usr_id']);
        $user->setUsername($row['usr_name']);
        $user->setPassword($row['usr_password']);
        $user->setSalt($row['usr_salt']);
        $user->setRole($row['usr_role']);
        
        return $user;
    }
    
}