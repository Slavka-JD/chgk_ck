<?php
namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ResultType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('team', 'entity', array(
            'label' => 'player.player_teams',
            'class' => 'AppBundle\Entity\Team',
        ));
        $builder->add('points', 'integer', array(
            'label' => 'result.result_points'
        ));
        $builder->add('place', 'integer', array(
            'label' => 'result.result_place'
        ));
        $builder->add('tournament', 'entity', array(
            'label' => 'tournament.tournament_results',
            'class' => 'AppBundle\Entity\Tournament',
        ));
        $builder->add('submit', 'submit', array(
            'label' => 'submit.submit_button'
        ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Result',
            'csrf_protection' => false,
        ));
    }

    public function getName()
    {
        return 'result';
    }
}
