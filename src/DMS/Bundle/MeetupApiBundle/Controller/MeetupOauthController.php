<?php

namespace DMS\Bundle\MeetupApiBundle\Controller;

use DMS\Bundle\MeetupApiBundle\Service\ClientFactory;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Exception\RouteNotFoundException;

/**
 * @Route("/meetup-oauth")
 */
class MeetupOauthController extends Controller
{

    /**
     * @Route("/authorize", name="meetup-oauth-authorize")
     */
    public function authorizeAction()
    {
        /** @var $clientFactory ClientFactory */
        $clientFactory = $this->container->get('dms_meetup_api.client_factory');
        $clientFactory->clearSessionTokens();

        $client = $clientFactory->getOauthClient();

        $tokenResponse = $client->getRequestToken(array(
                'oauth_callback' => $this->generateUrl('meetup-oauth-callback')
        ));

        $clientFactory->setSessionTokens($tokenResponse['oauth_token'], $tokenResponse['oauth_token_secret']);

        return $this->redirect('http://www.meetup.com/authorize/?oauth_token=' . $tokenResponse['oauth_token']);
    }

    /**
     * @Route("/callback", name="meetup-oauth-callback")
     */
    public function callbackAction(Request $request)
    {
        /** @var $clientFactory ClientFactory */
        $clientFactory = $this->container->get('dms_meetup_api.client_factory');
        $client = $clientFactory->getOauthClient(true);

        $response = $client->getAccessToken($request->query->all());

        $clientFactory->setSessionTokens($response['oauth_token'], $response['oauth_token_secret']);


        //Redirect to defined route, or to index page.
        try {
            $redirect = $this->generateUrl('meetup_redirect_url');
        } catch (RouteNotFoundException $e) {
            $redirect = '/';
        }

        return $this->redirect($redirect);
    }
}
