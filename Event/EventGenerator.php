<?php

namespace Tabbi89\CommanderBundle\Event;

/**
 * Aggregates can use this trait to raise and harbor events to be released later to the dispatcher.
 *
 * @package Tabbi89\CommanderBundle\Event
 */
trait EventGenerator
{
    /**
     * Events list
     *
     * @var array
     */
    protected $pendingEvents = [];

    /**
     * Release aggrageated event
     *
     * @return array
     */
    public function releaseEvents()
    {
        $events = $this->pendingEvents;
        $this->pendingEvents = [];

        return $events;
    }

    /**
     * Add event
     *
     * @param mixed $event
     */
    protected function raise($event)
    {
        $this->pendingEvents[] = $event;
    }
}
