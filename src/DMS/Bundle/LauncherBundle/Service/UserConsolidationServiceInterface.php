<?php
namespace DMS\Bundle\LauncherBundle\Service;

/**
 * User Consolidation Service
 *
 * Defines the needed interface for a Service which can register
 * PreUsers into actual application users.
 */
interface UserConsolidationServiceInterface
{

    /**
     * Responsible for creating an application user to represent the perUser
     * created in the launcher bundle. It receives the preUser instance and
     * should return data for a redirect.
     *
     * @abstract
     * @param \DMS\Bundle\LauncherBundle\Entity\PreUser $preUser
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     *
     * @todo define custom redirectresponse object to define proper params?
     */
    public function consolidatePreUser($preUser);

}
