<?php
namespace

/**
 * Access Listener
 *
 * Listens to accesses to the website and decides if it needs to intercept and redirect the user
 * to the launch page, or let him in.
 */
class AccessListener
{

    protected $enable;

    public function __construct($enable)
    {
        $this->enable = $enable;
    }

    public function onRoute()
    {

    }
}
