<?php

namespace Tabbi89\CommanderBundle\Event;

use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Class EventDispatcher
 *
 * @package Tabbi89\CommanderBundle\Event
 */
class EventDispatcher
{
    /**
     * @var EventDispatcherInterface
     */
    protected $dispatcher;

    /**
     * @var LoggerInterface
     */
    protected $log;

    /**
     * @param EventDispatcherInterface $dispatcher
     * @param LoggerInterface          $log
     */
    public function __construct(EventDispatcherInterface $dispatcher, LoggerInterface $log)
    {
        $this->dispatcher = $dispatcher;
        $this->log   = $log;
    }

    /**
     * Dispatch all events
     *
     * @param array $events
     */
    public function dispatch(array $events)
    {
        foreach ($events as $event) {
            $eventName = $this->getEventName($event);

            $this->dispatcher->dispatch($eventName, $event);

            $this->log->info($eventName . ' was fired.');
        }
    }

    /**
     * We'll make the fired event name look
     * just a bit more object-oriented.
     *
     * @param mixed $event
     *
     * @return mixed
     */
    protected function getEventName($event)
    {
        return str_replace('\\', '.', get_class($event));
    }
}
