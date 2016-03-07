<?php

namespace MicroCMS\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * MicroCMS
 * =========================================================================================================
 * 
 * Classe représentant le formulaire d'ajout de commentaire à un article
 * 
 *
 * @author      Christophe Malo
 * @date        05/02/2016
 * @version     1.0.0
 * @copyright   OpenClassrooms - Baptiste Pesquet
 */
class CommentType extends AbstractType
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
        $builder->add('content', 'textarea');
    }
    
    /**
     * Obtient le nom du formulaire
     * 
     * @return string
     */
    public function getName()
    {
        return 'comment';
    }
    
}
