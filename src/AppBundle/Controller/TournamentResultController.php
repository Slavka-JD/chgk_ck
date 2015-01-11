<?php
namespace AppBundle\Controller;

use AppBundle\Entity\Result;
use AppBundle\Entity\Tournament;
use AppBundle\Form\Type\ResultType;
use AppBundle\Form\Type\TournamentType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template as Template;


class TournamentResultController extends Controller
{
    public function viewAction()
    {
        return $this->render(
            'AppBundle:TournamentResult:tournamentresult.html.twig',
            [
                'Tournaments' => $this->getAllTournaments(),
                'Results' => $this->getAllResults()
            ]
        );
    }

    public function getAllTournaments()
    {
        $tournaments = $this->getDoctrine()
            ->getManager()
            ->getRepository('AppBundle:Tournament')
            ->findAll();
        return $tournaments;
    }

    public function getAllResults()
    {
        $results = $this->getDoctrine()
            ->getManager()
            ->getRepository('AppBundle:Result')
            ->findAll();
        return $results;
    }

    public function addTournamentAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $tournament = new Tournament();
        $results = $this->getAllResults();
        $form = $this->createForm(new TournamentType($results), $tournament);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $tournament = $form->getData();
            $em->persist($tournament);
            $em->flush();

            $this->get('session')->getFlashBag()->add('success', 'New tournament was added!');
            return $this->redirect($this->generateUrl('app_tournament_view', ['locale' => $request->getLocale()]));
        }

        return $this->render(
            'AppBundle:TournamentResult:addtournament.html.twig',
            [
                'Results' => $this->getAllResults(),
                'Tournaments' => $this->getAllTournaments(),
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * @Template()
     *
     * @param Request $request
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
     */

    public function addResultAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $result = new Result();
        $tournaments = $this->getAllTournaments();
        $form = $this->createForm(new ResultType($tournaments), $result);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $result = $form->getData();
            $em->persist($result);
            $em->flush();

            $this->get('session')->getFlashBag()->add('success', 'New result was added!');
            return $this->redirect($this->generateUrl('app_tournament_view', ['locale' => $request->getLocale()]));
        }

        return $this->render(
            'AppBundle:TournamentResult:addresult.html.twig',
            [
                'Tournaments' => $this->getAllTournaments(),
                'Results' => $this->getAllResults(),
                'form' => $form->createView(),
            ]
        );
    }
}