<?php
    namespace AppBundle\Controller;

    use AppBundle\Entity\Player;
    use AppBundle\Entity\Team;
    use AppBundle\Form\Type\PlayerType;
    use AppBundle\Form\Type\TeamType;
    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\JsonResponse;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template as Template;


    class TeamPlayerController extends Controller
    {
        public function viewAction()
        {
            return $this->render(
                'AppBundle:TeamPlayer:teamplayer.html.twig',
                [
                    'Teams'   => $this->getAllTeams(),
                    'Players' => $this->getAllPlayers()
                ]
            );
        }

        public function getAllTeams()
        {
            $teams = $this->getDoctrine()
                ->getManager()
                ->getRepository('AppBundle:Team')
                ->findAll();
            return $teams;
        }

        public function getAllPlayers()
        {
            $players = $this->getDoctrine()
                ->getManager()
                ->getRepository('AppBundle:Player')
                ->findAll();
            return $players;
        }

        public function addTeamAction(Request $request)
        {
            $em = $this->getDoctrine()->getManager();
            $team = new Team();
            $players = $this->getAllPlayers();
            $form = $this->createForm(new TeamType($players), $team);
            $form->handleRequest($request);
            if ($form->isValid()) {
                $team = $form->getData();
                $em->persist($team);
                $em->flush();

                $this->get('session')->getFlashBag()->add('success', 'New team was added!');
                return $this->redirect($this->generateUrl('app_team_view', ['locale' => $request->getLocale()]));
            }

            return $this->render(
                'AppBundle:TeamPlayer:addteam.html.twig',
                [
                    'Players' => $this->getAllPlayers(),
                    'Teams'   => $this->getAllTeams(),
                    'form'    => $form->createView(),
                ]
            );
        }

        /**
         * @Template()
         *
         * @param Request $request
         * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
         */

        public function addPlayerAction(Request $request)
        {
            $em = $this->getDoctrine()->getManager();
            $player = new Player();
            $teams = $this->getAllTeams();
            $form = $this->createForm(new PlayerType($teams), $player);
            $form->handleRequest($request);
            if ($form->isValid()) {
                $player = $form->getData();
                $em->persist($player);
                $em->flush();

                $this->get('session')->getFlashBag()->add('success', 'New player was added!');
                return $this->redirect($this->generateUrl('app_team_view', ['locale' => $request->getLocale()]));
            }

            return $this->render(
                'AppBundle:TeamPlayer:addplayer.html.twig',
                [
                    'Teams'   => $this->getAllTeams(),
                    'Players' => $this->getAllPlayers(),
                    'form'    => $form->createView(),
                ]
            );
        }
    }