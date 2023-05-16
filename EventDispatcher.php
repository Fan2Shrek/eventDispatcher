<?php

namespace Sruuua\EventDispatcher;

use Sruuua\EventDispatcher\Interface\EventDispatcherInterface;
use Sruuua\EventDispatcher\Interface\ListenerInterface;
use Sruuua\EventDispatcher\Interface\ListenerProviderInterface;
use Sruuua\EventDispatcher\Interface\StoppableEventInterface;
use Sruuua\DependencyInjection\Container;

class EventDispatcher implements EventDispatcherInterface
{

    private ListenerProviderInterface $listenerProvider;

    private Container $container;

    public function __construct(ListenerProvider $listenerProvider, Container $container)
    {
        $this->listenerProvider = $listenerProvider;
        $this->container = $container;

        $this->registerListeners();
    }

    public function registerListeners()
    {
        foreach ($this->container->getAllByType(ListenerInterface::class) as $listener) {
            $this->listenerProvider->addListener($listener->listen(), $listener);
        }
    }

    public function dispatch(object $event)
    {
        $listeners = $this->listenerProvider->getListenersForEvent($event);

        if ($event instanceof StoppableEventInterface) {
            foreach ($listeners as $listener) {
                if ($event->isPropagationStopped()) return;
                $listener($event);
            }
        }

        foreach ($listeners as $listener) {
            $listener($event);
        }
    }
}
