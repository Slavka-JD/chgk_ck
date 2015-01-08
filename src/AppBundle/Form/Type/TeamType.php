<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TeamType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', 'text', array(
            'label' => 'team.team_name'
        ));
        $builder->add('type', 'choice', [
            'choices' => ['взрослая', 'молодежная', 'школьная'],
            'data' => 'взрослая',
        ], array(
            'label' => 'team.team_type'
        ));
        $builder->add('description', 'textarea', array(
            'label' => 'team.team_description'
        ));
        $builder->add('rating', 'integer', array(
            'label' => 'team.team_rating'
        ));
        $builder->add('totalplayers', 'hidden', array(
            'empty_data' => 0
        ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Team',
            'csrf_protection' => false,
        ));
    }

    public function getName()
    {
        return 'Team';
    }
}
