<?php
namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use AppBundle\Entity\Team;

class PlayerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', 'text', array(
            'label' => 'player.player_name'
        ));
        $builder->add('age', 'date', array(
            'label' => 'player.player_age'
        ));
        $builder->add('email', 'email', array(
            'label' => 'player.player_email'
        ));
        $builder->add('type', 'choice', [
            'choices' => ['базовый игрок', 'легионер', 'капитан'],
            'data' => 'базовый игрок',
        ], array(
            'label' => 'player.player_type'
        ));
        $builder->add('teams', 'entity', array(
            'label' => 'player.player_teams',
            'class' => 'AppBundle\Entity\Team',
            'multiple' => true));
    }

    public function getName()
    {
        return 'Player';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Player',
            'csrf_protection' => false,
        ));
    }
}
