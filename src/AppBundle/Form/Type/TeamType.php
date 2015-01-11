<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TeamType extends AbstractType
{
    protected $teams;

    public function __construct(Array $teams)
    {
        $this->teams = $teams;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', 'text', array(
            'label' => 'team.team_name'
        ));
        $builder->add('type', 'choice', array(
            'choices'  => [
                'взрослая'   => 'взрослая',
                'молодежная' => 'молодежная',
                'школьная'   => 'школьная',
            ],
            'data' => 'взрослая',
            'required' => true,
            'label' => 'team.team_type'
        ));
        $builder->add('description', 'textarea', array(
            'label' => 'team.team_description'
        ));
        $builder->add('rating', 'integer', array(
            'label' => 'team.team_rating'
        ));
        $builder->add('submit', 'submit', array(
            'label' => 'submit.submit_button'
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
