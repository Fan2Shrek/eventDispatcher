<?php

namespace Sruuua\EventDispatcher;

use Sruuua\EventDispatcher\Interfaces\ListenerInterface;
use Sruuua\EventDispatcher\Interfaces\ListenerProviderInterface;

class ListenerProvider implements ListenerProviderInterface
{

    private array $listeners;

    public function __construct()
    {
        $this->listeners = array();
    }

    public function addListener(string $eventType, ListenerInterface $listener)
    {
        $this->listeners[$eventType][] = $listener;
    }

    public function getListenersForEvent(object $event): iterable
    {
        if ($this->has($event::class)) {
            return $this->listeners[$event::class];
        }

        return [];
    }

    public function has(string $eventType)
    {
        return isset($this->listeners[$eventType]);
    }
}
