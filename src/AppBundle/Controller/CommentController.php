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
            $comment->setEvent($this->getDoctrine()->getManager()->getRepository('AppBundle:Event')->findOneBySlugEvent($slug));
            $em->persist($comment);
            $em->flush();
            $event = $this->getDoctrine()
                ->getManager()
                ->getRepository('AppBundle:Event')
                ->findBySlugEvent($slug);
            $comments = $this->get('requesthandler')->handleAddComment($event);
            return new JsonResponse([$comments]);
        }
        return new JsonResponse([], 500);
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