<?php

namespace DMS\Bundles\LauncherBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use DMS\Bundles\LauncherBundle\Entity\PreUser;

/**
 * PreUser controller.
 *
 * @Route("/admin/preuser")
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

}
