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
     * Retourne un utilisateurcorrespondant à l'id en argument
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
            throw new Exception("Pas d'utilisateur avec cet id " . $id);
        }
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