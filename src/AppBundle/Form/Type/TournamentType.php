<?php
namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TournamentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', array(
            'label' => 'tournament.tournament_name'
        ));
        $builder->add('description', array(
            'label' => 'tournament.tournament_description'
        ));
        $builder->add('playdate', array(
            'label' => 'tournament.tournament_playdate'
        ));

        $builder->add('results', 'collection', array(
            'type' => new ResultType(),
            'allow_add' => true,
            'by_reference' => false,
            'allow_delete' => true,
            'label' => 'tournament.tournament_results'
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
