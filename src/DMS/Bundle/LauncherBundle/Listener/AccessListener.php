<?php
namespace DMS\Bundle\LauncherBundle\Listener;

use Symfony\Component\HttpKernel\Event\PostResponseEvent

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
//
//        if (HttpKernelInterface::MASTER_REQUEST === $event->getRequestType()) {
//            $this->urlMatcher->getContext()->fromRequest($request);
//        }
//
//        if ($request->attributes->has('_controller')) {
//            // routing is already done
//            return;
//        }
//
//        // add attributes based on the path info (routing)
//        try {
//            $parameters = $this->urlMatcher->match($request->getPathInfo());
//
//            if (null !== $this->logger) {
//                $this->logger->info(sprintf('Matched route "%s" (parameters: %s)', $parameters['_route'], $this->parametersToString($parameters)));
//            }
//
//            $request->attributes->add($parameters);
//            unset($parameters['_route']);
//            unset($parameters['_controller']);
//            $request->attributes->set('_route_params', $parameters);
//        } catch (ResourceNotFoundException $e) {
//            $message = sprintf('No route found for "%s %s"', $request->getMethod(), $request->getPathInfo());
//
//            throw new NotFoundHttpException($message, $e);
//        } catch (MethodNotAllowedException $e) {
//            $message = sprintf('No route found for "%s %s": Method Not Allowed (Allow: %s)', $request->getMethod(), $request->getPathInfo(), strtoupper(implode(', ', $e->getAllowedMethods())));
//
//            throw new MethodNotAllowedHttpException($e->getAllowedMethods(), $message, $e);
//        }
    }
}
