<?php

namespace AppBundle\Services;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use AppBundle\Entity\Event;

class RequestHandler
{
    private $request;

    public function __construct(RequestStack $requestStack)
    {
        $this->request = $requestStack->getCurrentRequest();
    }

    public function handleAddComment(Event $event)
    {
        if (!$event) {
            throw new NotFoundHttpException("Page not found");
        }
        $comments = array();
        for ($i = 0; $i < count($event[0]->getComment()); $i++) {
            $comments[$i]["author"] = $event[0]->getComment()[$i]->getAuthor();
            $comments[$i]["text"] = substr($event[0]->getComment()[$i]->getText(), 0, 255);
            $comments[$i]["createdAt"] = $event[0]->getComment()[$i]->getCreatedAt()->format("d.m.Y H:i:s");
        }
        return $comments;
    }
}
