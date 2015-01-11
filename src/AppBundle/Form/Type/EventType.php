<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use AppBundle\Entity\Event;

class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title', 'text', array(
            'label' => 'event.event_title'
        ));
        $builder->add('author', 'text', array(
            'label' => 'event.event_author'
        ));
        $builder->add('text', 'textarea', array(
            'label' => 'event.event_body'
        ));
        $builder->add('submit', 'submit', array(
            'label' => 'submit.submit_button'
        ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Event',
            'csrf_protection' => false,
        ));
    }

    public function getName()
    {
        return 'Event';
    }
}
