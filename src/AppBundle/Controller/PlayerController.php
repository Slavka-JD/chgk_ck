<?php
namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template as Template;
use AppBundle\Form\Type\PlayerType;
use AppBundle\Entity\Player;

class PlayerController extends Controller
{
    /**
     * @Template()
     *
     * @param Request $request
     * @return array
     *
     */

    public function addAction(Request $request)
    {
        $locale = $request->getLocale();

        $em = $this->getDoctrine()->getManager();
        $player = new Player();
        $form = $this->createForm(new PlayerType(), $player);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $player = $form->getData();
            $em->persist($player);
            $em->flush();

            return $this->redirect($this->generateUrl('player', array(
                'form' => $form->createView())));
        }

        if (false === $this->get('security.context')->isGranted('ROLE_ADMIN')) {
            throw new AccessDeniedException();
        }

        return $this->render('default/player.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/admin")
     * @param $slug
     * @return \Symfony\Component\HttpFoundation\Response|static
     */
    public function deleteAction($slug)
    {
        $em = $this->getDoctrine()->getManager();
        $player = $em->getRepository('AppBundle:Player')->findOneBy(['slugPlayer' => $slug]);
        $this->get('request_handler');
        $em->remove($player);
        $em->flush();
        return JsonResponse::create(["code" => 200]);
    }
}
