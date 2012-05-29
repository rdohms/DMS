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

    /**
     * @var \Symfony\Component\Security\Core\SecurityContext $securityContext
     */
    protected $securityContext;

    public function __construct($enable, $securityContext)
    {
        $this->enable = $enable;
        $this->securityContext = $securityContext;
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        $request = $event->getRequest();

        //Let launcher URLs through
        if (strpos('launcher', $request->getPathInfo()) !== false) {
            return null;
        }

        //If the user is logged in he can go where he likes
        if ($this->hasLoggedUser()) {
            return null;
        }

        //No session - FORWARD to launcher page
        var_dump($request);

    }

    /**
     * Checks if a user is logged in
     *
     * @return bool
     */
    protected function hasLoggedUser()
    {
        if (null === $token = $this->securityContext->getToken()) {
            return false;
        }

        if (!is_object($user = $token->getUser())) {
            return false;
        }

        return true;
    }
}
