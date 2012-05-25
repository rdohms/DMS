<?php
namespace DMS\Bundle\LauncherBundle\Listener;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;

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

    public function onKernelRequest(GetResponseEvent $event)
    {
        $request = $event->getRequest();


        //Launcher URL - SKIP

        //Admin User logged in - SKIP

        //User logged in - SKIP

        //No session - FORWARD

        var_dump($request);

    }
}
