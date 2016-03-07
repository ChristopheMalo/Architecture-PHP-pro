<?php

namespace MicroCMS\Domain;

use Symfony\Component\Security\Core\User\UserInterface;

/**
 * MicroCMS
 * =========================================================================================================
 * 
 * Classe représentant un utilisateur
 * 
 *
 * @author      Christophe Malo
 * @date        04/03/2016
 * @version     1.0.0
 * @copyright   OpenClassrooms - Baptiste Pesquet
 */
class User implements UserInterface {
    
    /**
     * L'identifiant de l'utilisateur
     * 
     * @var int
     */
    private $id;
    
    /**
     * Le nom de l'utilisateur
     * @var string
     */
    private $username;
    
    /**
     * Le mot de passe de l'utilisateur
     * @var string
     */
    private $password;
    
    /**
     * Le salt associé au mot de passe de l'utilisateur
     * Utiliser pour encoder le mot de passe
     * 
     * @var string
     */
    private $salt;
    
    /**
     * Role de l'utilisateur
     * Valeurs : ROEL_USER ou ROLE_ADMIN
     * 
     * @var string
     */
    private $role;
    
    
    
    
    /**
     * Retourne l'identifiant de l'utilisateur
     * 
     * @return int L'id de l'utilisateur
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * @inheritDoc 
     */
    public function getUsername()
    {
        return $this->username;
    }
    
    /**
     * @inheritDoc
     */
    public function getPassword()
    {
        return $this->password;
    }
    
    /**
     * @inheritDoc
     */
    public function getSalt()
    {
        return $this->salt;
    }
    
    /**
     * Obtient le role de l'utilisateur
     * 
     * @return array Le role de l'utilisateur
     */
    public function getRole()
    {
        return $this->role;
    }
            
    /**
     * @inheritDoc
     */
    public function getRoles()
    {
        return array($this->getRole());
    }
    
    
    
    
    /**
     * Définit l'identifiant de l'utilisateur
     * 
     * @param int $id
     * @return void
     */
    public function setId($id)
    {
        $this->id = $id;
    }
    
    /**
     * Définir le nom de l'utilsiateur
     * 
     * @param string $username
     * @return void
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }
    
    /**
     * Définit le mot de passe de l'utilisateur
     * 
     * @param string $password
     * @return void
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }
    
    /**
     * Définit le salt associé au mot de passe de l'utilisateur
     * 
     * @param string $salt
     * @return void
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;
    }
    
    /**
     * Définit le rôle de l'utilisateur
     * 
     * @param string $role
     * @return void
     */
    public function setRole($role)
    {
        $this->role = $role;
    }
    
    /**
     * @inheritDoc
     */
    public function eraseCredentials()
    {
        
    }
    
}
