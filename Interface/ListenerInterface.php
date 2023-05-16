<?php

namespace Sruuua\EventDispatcher\Interface;

interface ListenerInterface
{
    public function __invoke(object $event);

    /**
     * Return the event class;
     */
    public function listen(): string;
}
