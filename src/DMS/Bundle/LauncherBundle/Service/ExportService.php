<?php
namespace DMS\Bundle\LauncherBundle\Service;

use Doctrine\ORM\EntityManager;

/**
 * Export Service
 *
 * This service gives access to the list of pre-registered users.
 */
class ExportService
{

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $em;

    /**
     * @var \DMS\Bundle\LauncherBundle\Entity\PreUserRepository
     */
    protected $repository;
    /**
     * @param \Doctrine\ORM\EntityManager $entityManager
     */
    public function __construct( EntityManager $entityManager)
    {
        $this->em = $entityManager;
        $this->repository = $this->em->getRepository('DMSLauncherBundle:PreUser');
    }

    /**
     * Returns a list of all pre-registered users
     *
     * @return array
     */
    public function exportAllUsers()
    {
        return $this->repository->findAll();
    }
}
