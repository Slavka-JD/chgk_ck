<?php
namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\FormBuilderInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template as Template;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use AppBundle\Form\Type\TournamentType;
use AppBundle\Entity\Tournament;
use AppBundle\Entity\Player;


class TournamentController extends Controller
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
        $tournament = new Tournament();
        $form = $this->createForm(new TournamentType(), $tournament);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $tournament = $form->getData();
            $em->persist($tournament);
            $em->flush();

            //sending email to players
            $player = new Player();
            $this->get('mailerhandler')->Send(
                'Письмо для' . $player->getEmail() . 'с результатами турнира',
                'myroslavazel@gmail.com',
                $player->getEmail(),
                $player->getLetter());

            return $this->redirect($this->generateUrl('tournament', array(
                'form' => $form->createView())));
        }

        if (false === $this->get('security.context')->isGranted('ROLE_ADMIN')) {
            throw new AccessDeniedException();
        }

        return $this->render('default/tournament.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function deletection($slug)
    {
        $em = $this->getDoctrine()->getManager();
        $tournament = $em->getRepository('AppBundle:Tournament')->findOneBy(['slugTournament' => $slug]);
        $this->get('request_handler');
        $em->remove($tournament);
        $em->flush();
        return JsonResponse::create(["code" => 200]);
    }
}
