<?php

namespace DMS\Bundle\MeetupApiBundle\Service;

use DMS\Service\Meetup\MeetupKeyAuthClient;
use DMS\Service\Meetup\MeetupOAuthClient;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class ClientFactory
{

    const CLIENT_KEY   = 'key';
    const CLIENT_OAUTH = 'oauth';

    /**
     * @var SessionInterface
     */
    protected $session;

    /**
     * @var array
     */
    protected $config;

    /**
     * @var array
     */
    protected $instances = array();

    /**
     * @param SessionInterface $session
     * @param $config
     */
    public function __construct(SessionInterface $session, array $config)
    {
        $this->session = $session;
        $this->config  = $config;
    }

    /**
     * Get a new instance of a Key Auth Client for Meetup API
     * @param bool $forceNew
     * @return MeetupKeyAuthClient
     */
    public function getKeyAuthClient($forceNew = false)
    {
        if ( ! isset($this->instances[self::CLIENT_KEY]) || $forceNew) {
            $this->instances[self::CLIENT_KEY] = MeetupKeyAuthClient::factory($this->config);
        }

        return $this->instances[self::CLIENT_KEY];
    }

    /**
     * Get a new instance of a Oauth Client for Meetup API
     *
     * @param bool $forceNew
     * @return MeetupOAuthClient
     */
    public function getOauthClient($forceNew = false)
    {
        if ( ! isset($this->instances[self::CLIENT_OAUTH]) || $forceNew) {
            $this->instances[self::CLIENT_OAUTH] = MeetupOAuthClient::factory($this->getUpdatedOauthConfig());
        }

        return $this->instances[self::CLIENT_OAUTH];
    }

    /**
     * Loads Oauth token and secret from session and adds to configuration
     *
     * @return array
     */
    public function getUpdatedOauthConfig()
    {
        $token       = $this->session->has('meetup_token')? $this->session->get('meetup_token') : null;
        $tokenSecret = $this->session->has('meetup_token_secret')? $this->session->get('meetup_token_secret') : null;

        return array_merge(
            array('token' => $token, 'token_secret' => $tokenSecret),
            $this->config
        );
    }
}
