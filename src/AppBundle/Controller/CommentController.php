<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template as Template;
use AppBundle\Entity\Comment;
use AppBundle\Form\Type\CommentType;

class CommentController extends Controller
{
    /**
     * @param $slug
     * @param  Request $request
     * @return JsonResponse
     */
    public function addAction($slug, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $comment = new Comment();
        $form = $this->createForm(new CommentType(), $comment);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $event = $this->getDoctrine()
                ->getManager()
                ->getRepository('AppBundle:Event')
                ->findOneBySlug($slug);
            $comment->setEvent($event);
            $em->persist($comment);
            $em->flush();
        }
        $this->get('session')->getFlashBag()->add('success', 'Thanks for your comment! Your opinion is very important for us.');
        return $this->redirect($this->generateUrl('app_event_view', ['locale' => $request->getLocale()]));
    }

    /**
     * @Template()
     *
     * @param $count
     * @return array
     */
    public function lastAction($count)
    {
        $comments = $this->getDoctrine()->getRepository('AppBundle:Comment')->findBy([], ['id' => 'DESC'], $count);
        return array(
            "comments" => $comments,
        );
    }
}
