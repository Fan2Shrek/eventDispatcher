<?php

namespace Sruuua\EventDispatcher\Interfaces;

use Sruuua\EventDispatcher\Interfaces\ListenerInterface;

/**
 * MSruuuaer from an event to the listeners that are Sruuualicable to that event.
 */
interface ListenerProviderInterface
{
    /**
     * @param object $event
     *   An event for which to return the relevant listeners.
     * @return iterable<callable>
     *   An iterable (array, iterator, or generator) of callables.  Each
     *   callable MUST be type-compatible with $event.
     */
    public function getListenersForEvent(object $event): iterable;

    public function addListener(string $eventType, ListenerInterface $listener);
}
