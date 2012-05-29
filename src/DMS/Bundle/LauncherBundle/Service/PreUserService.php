<?php
namespace DMS\Bundle\LauncherBundle\Service;

use Doctrine\ORM\EntityManager;

class PreUserService
{

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $entityManager;

    /**
     * @var \Doctrine\ORM\EntityRepository
     */
    protected $entityRepository;

    /**
     * @param \Doctrine\ORM\EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->entityRepository = $entityManager->getRepository('DMSLauncherBundle:PreUser');
    }

    /**
     * Get the PreUser
     *
     * @param $id
     * @return object
     */
    public function get($id)
    {
        return $this->entityRepository->find($id);
    }

    /**
     * Get all preUsers
     *
     * @return array
     */
    public function getAll()
    {
       return $this->entityRepository->findAll();
    }
}
