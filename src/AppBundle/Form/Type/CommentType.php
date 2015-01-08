<?php
namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use AppBundle\Entity\Comment;

class CommentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('author', 'text', array(
            'label' => 'comment.comment_author'
        ));
        $builder->add('text', 'textarea', [
            'max_length' => 255
        ], array('label' => 'comment.comment_body'
        ));
    }

    public function getName()
    {
        return 'Comment';
    }
}
