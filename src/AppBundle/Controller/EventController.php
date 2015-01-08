<?php
namespace AppBundle\Controller;

use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template as Template;
use AppBundle\Form\Type\EventType;
use AppBundle\Entity\Event;
use AppBundle\Form\Type\CommentType;

class EventController extends Controller
{
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

            return array($this->redirect($this->generateUrl('event', array(
                'form' => $form->createView()))));
        }
    }

    /**
     * @Template()
     *
     * @param $slug
     * @return array
     */
    public function viewAction($slug)
    {
        $event = $this->getDoctrine()->getRepository('AppBundle:Event')->findOneBy(['slugEvent' => $slug]);
        $form = $this->createForm(new CommentType());
        return array(
            "event" => $event,
            "form" => $form->createView(),
        );
    }

    /**
     * @param $slug
     * @return \Symfony\Component\HttpFoundation\Response|static
     */
    public function deleteEventAction($slug)
    {
        $em = $this->getDoctrine()->getManager();
        $event = $em->getRepository('AppBundle:Event')->findOneBy(['slugEvent' => $slug]);
        $this->get('request_handler');
        $em->remove($event);
        $em->flush();
        return JsonResponse::create(["code" => 200]);
    }
}