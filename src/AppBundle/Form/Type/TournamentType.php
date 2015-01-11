<?php
namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use AppBundle\Entity\Result;

class TournamentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', 'string', array(
            'label' => 'tournament.tournament_name'
        ));
        $builder->add('description', 'text', array(
            'label' => 'tournament.tournament_description'
        ));
        $builder->add('playdate', 'date', array(
            'label' => 'tournament.tournament_playdate'
        ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Acme\TaskBundle\Entity\Tournament',
            'csrf_protection' => false,
        ));
    }

    public function getName()
    {
        return 'tournament';
    }
}
