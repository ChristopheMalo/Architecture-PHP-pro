<?php

namespace MicroCMS\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * MicroCMS
 * =========================================================================================================
 * 
 * Classe représentant le formulaire d'ajout d'un utilisateur (depuis le backoffice)
 * 
 *
 * @author      Christophe Malo
 * @date        05/02/2016
 * @version     1.0.0
 * @copyright   OpenClassrooms - Baptiste Pesquet
 */
class UserType extends AbstractType
{
    
    /**
     * Construit le formulaire
     * 
     * @param FormBuilderInterface $builder
     * @param array $options
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', 'text')
            ->add('password', 'repeated', array(
                'type'            => 'password',
                'invalid_message' => 'The password fields must match.',
                'options'         => array('required' => true),
                'first_options'   => array('label' => 'Password'),
                'second_options'  => array('label' => 'Repeat password'),
            ))
            ->add('role', 'choice', array(
                'choices' => array('ROLE_ADMIN' => 'Admin', 'ROLE_USER' => 'User')
            ));

    }
    
    /**
     * Obtient le nom du formulaire
     * 
     * @return string
     */
    public function getName()
    {
        return 'user';
    }
    
}