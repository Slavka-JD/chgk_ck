<?php
namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\FormBuilderInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template as Template;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use AppBundle\Form\Type\TeamType;
use AppBundle\Entity\Team;

class TeamController extends Controller
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
        $team = new Team();
        $form = $this->createForm(new TeamType(), $team);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $team = $form->getData();
            $em->persist($team);
            $em->flush();

            return $this->redirect($this->generateUrl('team', array(
                'form' => $form->createView())));
        }

        if (false === $this->get('security.context')->isGranted('ROLE_ADMIN')) {
            throw new AccessDeniedException();
        }

        return $this->render('default/team.html.twig', array(
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
        $team = $em->getRepository('AppBundle:Team')->findOneBy(['slugTeam' => $slug]);
        $this->get('request_handler');
        $em->remove($team);
        $em->flush();
        return JsonResponse::create(["code" => 200]);
    }
}
