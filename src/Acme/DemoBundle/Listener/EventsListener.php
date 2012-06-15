<?php

namespace Acme\DemoBundle\Listener;

use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\HttpFoundation\Response;

class EventsListener
{
    public function onKernelRequest(GetResponseEvent $event)
    {
        echo '<h2>Evento: kernel.request</h2>';
        ld($event);

        //$event->setResponse(new Response('Not found', 404));
    }

    public function onKernelController(FilterControllerEvent $event)
    {
        echo '<h2>Evento: kernel.controller</h2>';
        ld($event);

        $controller = $event->getController();
        ld($controller);

        //$controllerNew = array($controller[1], 'redirectorAction');
        //$event->setController($controllerNew);
    }

    public function onKernelView(GetResponseForControllerResultEvent $event)
    {
        echo '<h2>Evento: kernel.view</h2>';
        ld($event);
    }

    public function onKernelResponse(FilterResponseEvent $event)
    {
        echo '<h2>Evento: kernel.response</h2>';
        ld($event);

        //$date = new \DateTime();
        //$date->modify('+60 seconds');
        //$event->getResponse()->setExpires($date);
    }
}