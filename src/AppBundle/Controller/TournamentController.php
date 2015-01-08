<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use AppBundle\Form\Type\TournamentType;
use AppBundle\Entity\Tournament;
use AppBundle\Entity\Player;


class TournamentController extends Controller
{
    /**
     * @Route("/addtournament", name="tournament")
     */

    public function newAction(Request $request)
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
}