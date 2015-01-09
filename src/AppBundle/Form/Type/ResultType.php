<?php
namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ResultType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('team', array(
            'label' => 'team.team_name'
        ));
        $builder->add('points', array(
            'label' => 'result.result_points'
        ));
        $builder->add('place', array(
            'label' => 'result.result_place'
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