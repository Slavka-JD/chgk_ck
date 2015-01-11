<?php
namespace AppBundle\Controller;

use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template as Template;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use AppBundle\Entity\Event;
use AppBundle\Form\Type\EventType;
use AppBundle\Entity\Comment;
use AppBundle\Form\Type\CommentType;

class EventController extends Controller
{
    /**
     * @Template()
     * @param Request $request
     * @return array
     */
    public function viewAction(Request $request)
    {
        $slugExists = (bool) $request->get('slug');
        $findBy = $slugExists ? 'slug' : 'id';
        $em = $this->getDoctrine()->getManager();
        $events = $em->getRepository('AppBundle:Event')->findBy([], [$findBy => 'DESC']);
        $paginator = $this->get('knp_paginator');
        $events = $paginator->paginate(
            $events,
            $request->query->get('page', 1),
            $slugExists ? 1 : 100
        );
        $comment = new Comment();
        $form = $this->createForm(new CommentType(), $comment);


        return array(
            'events' => $events,
            'form'   => $form->createView(),
            'render_form' => $slugExists
        );
    }

    /**
     * @Template()
     *
     * @param Request $request
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function addAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $event = new Event();
        $form = $this->createForm(new EventType(), $event);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $event = $form->getData();
            $em->persist($event);
            $em->flush();

            $this->get('session')->getFlashBag()->add('success', 'Event was added successfully!');
            return $this->redirect($this->generateUrl('app_event_view', ['locale' => $request->getLocale()]));
        }

        return array(
            'form' => $form->createView(),
        );
    }

    /**
     * @param $slug
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response|static
     *
     */
    public function deleteAction($slug, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $event = $em->getRepository('AppBundle:Event')->findOneBySlug($slug);

        $em->remove($event);
        $em->flush();

        $this->get('session')->getFlashBag()->add('success', 'Event was deleted successfully!');
        return $this->redirect($this->generateUrl('app_event_view', ['locale' => $request->getLocale()]));
    }
}
