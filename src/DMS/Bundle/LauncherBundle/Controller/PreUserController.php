<?php

namespace DMS\Bundle\LauncherBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use DMS\Bundle\LauncherBundle\Entity\PreUser;

/**
 * PreUser controller.
 *
 * @Route("/launcher/admin/preuser")
 */
class PreUserController extends Controller
{
    /**
     * Lists all PreUser entities.
     *
     * @Route("/", name="admin_preuser")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('DMSLauncherBundle:PreUser')->findAll();

        return array('entities' => $entities);
    }

    /**
     * Finds and displays a PreUser entity.
     *
     * @Route("/{id}/show", name="admin_preuser_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('DMSLauncherBundle:PreUser')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PreUser entity.');
        }

        return array(
            'entity'        => $entity,
            'referralCount' => $em->getRepository('DMSLauncherBundle:PreUser')->getReferralsCount($entity->getToken()),
        );
    }

    /**
     * Lists all PreUsers
     *
     * @Route("/", name="preuser_list")
     * @Template()
     *
     * @return array
     */
    public function listAction()
    {
        /** @var $preUserService \DMS\Bundle\LauncherBundle\Service\PreUserService */
        $preUserService = $this->container->get('dms_launcher.preUser');

        $preUsers = $preUserService->getAll();

        return array(
            'users' => $preUsers
        );
    }

    /**
     * Triggers process to welcome user into application.
     *
     */
    public function consolidateAction($preUserId)
    {

        /** @var $preUserService \DMS\Bundle\LauncherBundle\Service\PreUserService */
        $preUserService = $this->container->get('dms_launcher.preUser');

        $preUser = $preUserService->get($preUserId);

        if ($preUser === null) {
            //TODO User not found
        }

        /** @var $consolidationService \DMS\Bundle\LauncherBundle\Service\UserConsolidationServiceInterface */
        $consolidationService = $this->get('launcher.preUser.consolidator');

        return $consolidationService->consolidatePreUser($preUser);
    }
}
